<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNominationRequest;
use App\Mail\NominationReceived;
use App\Models\Nomination;
use App\Support\Xies;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class NominationController extends Controller
{
    /**
     * Show the public list of nomination records.
     */
    public function index(Request $request): Response
    {
        $search = trim((string) $request->query('search', ''));
        $category = (string) $request->query('category', '');

        if (! in_array($category, Xies::allCategories(), true)) {
            $category = '';
        }

        $nominations = Nomination::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('nominee_name', 'like', "%{$search}%")
                    ->orWhere('nominee_x_handle', 'like', "%{$search}%")
                    ->orWhere('show_name', 'like', "%{$search}%");
            }))
            ->when($category !== '', fn ($query) => $query->whereJsonContains('categories', $category))
            ->latest()
            ->paginate(24)
            ->withQueryString()
            ->through(fn (Nomination $nomination) => [
                'number' => $nomination->nomination_number,
                'nominee_name' => $nomination->nominee_name,
                'nominee_x_handle' => $nomination->nominee_x_handle,
                'show_name' => $nomination->show_name,
                'categories' => $nomination->categories,
                'status' => $nomination->status,
                'submitted_at' => $nomination->created_at?->format('M j, Y'),
            ]);

        return Inertia::render('xies/Nominations', [
            ...Xies::siteProps(),
            'nominations' => $nominations,
            'allCategories' => Xies::allCategories(),
            'filters' => [
                'search' => $search,
                'category' => $category,
            ],
        ]);
    }

    /**
     * Show a single public nomination record.
     */
    public function show(Nomination $nomination): Response
    {
        return Inertia::render('xies/NominationRecord', [
            ...Xies::siteProps(),
            'nomination' => [
                'number' => $nomination->nomination_number,
                'nominee_name' => $nomination->nominee_name,
                'nominee_x_handle' => $nomination->nominee_x_handle,
                'show_name' => $nomination->show_name,
                'categories' => $nomination->categories,
                'reason' => $nomination->reason,
                'links' => $nomination->links,
                'status' => $nomination->status,
                'submitted_at' => $nomination->created_at?->format('F j, Y'),
            ],
        ]);
    }

    /**
     * Show the nomination form.
     */
    public function create(): Response
    {
        return Inertia::render('xies/Nominate', [
            ...Xies::siteProps(),
            'categories' => Xies::categories(),
            'categoryGroups' => Xies::categoryGroups(),
            'paypalUrl' => Xies::paypalUrl(),
            'stripeUrl' => Xies::stripeUrl(),
        ]);
    }

    /**
     * Store a new nomination.
     */
    public function store(StoreNominationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $attachments = [];

        /** @var array<int, UploadedFile> $files */
        $files = $request->file('attachments', []);

        foreach ($files as $file) {
            $path = $file->store('nominations', 'local');

            if (is_string($path)) {
                $attachments[] = $path;
            }
        }

        /** @var list<string> $categories */
        $categories = $validated['categories'];

        $nomination = Nomination::create([
            ...Arr::except($validated, ['attachments', 'terms']),
            'attachments' => $attachments,
            'amount_due' => count($categories) * Xies::fee(),
            'status' => Nomination::STATUS_PENDING,
        ]);

        Mail::to($nomination->nominator_email)->send(new NominationReceived($nomination));

        if (($admin = Xies::adminEmail()) !== null) {
            Mail::to($admin)->send(new NominationReceived($nomination, forAdmin: true));
        }

        return to_route('nominate.confirmation')->with('nomination', $nomination->id);
    }

    /**
     * Show the post-submission confirmation page.
     */
    public function confirmation(Request $request): Response|RedirectResponse
    {
        $nomination = Nomination::find($request->session()->get('nomination'));

        if (! $nomination instanceof Nomination) {
            return to_route('nominate');
        }

        return Inertia::render('xies/ThankYou', [
            ...Xies::siteProps(),
            'nomination' => [
                'number' => $nomination->nomination_number,
                'nominee_name' => $nomination->nominee_name,
                'nominee_x_handle' => $nomination->nominee_x_handle,
                'categories' => $nomination->categories,
                'amount_due' => $nomination->amount_due,
                'payment_method' => $nomination->payment_method,
                'payment_reference' => $nomination->payment_reference,
                'nominator_email' => $nomination->nominator_email,
            ],
        ]);
    }
}
