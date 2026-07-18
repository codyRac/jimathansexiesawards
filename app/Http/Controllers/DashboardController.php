<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with all nominations.
     */
    public function index(): Response
    {
        $nominations = Nomination::query()->latest()->get();

        return Inertia::render('Dashboard', [
            'nominations' => $nominations->map(fn (Nomination $nomination): array => [
                'id' => $nomination->id,
                'number' => $nomination->nomination_number,
                'nominee_name' => $nomination->nominee_name,
                'nominee_x_handle' => $nomination->nominee_x_handle,
                'show_name' => $nomination->show_name,
                'categories' => $nomination->categories,
                'amount_due' => $nomination->amount_due,
                'payment_method' => $nomination->payment_method,
                'payment_reference' => $nomination->payment_reference,
                'status' => $nomination->status,
                'attachments_count' => count($nomination->attachments ?? []),
                'nominator_name' => $nomination->nominator_name,
                'nominator_email' => $nomination->nominator_email,
                'nominator_phone' => $nomination->nominator_phone,
                'submitted_at' => $nomination->created_at?->format('M j, Y g:ia'),
            ])->values()->all(),
            'stats' => [
                'total' => $nominations->count(),
                'pending' => $nominations->where('status', Nomination::STATUS_PENDING)->count(),
                'verified' => $nominations->where('status', Nomination::STATUS_VERIFIED)->count(),
                'verifiedRevenue' => $nominations->where('status', Nomination::STATUS_VERIFIED)->sum('amount_due'),
            ],
        ]);
    }

    /**
     * Update a nomination's payment verification status.
     */
    public function updateStatus(Request $request, Nomination $nomination): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([Nomination::STATUS_PENDING, Nomination::STATUS_VERIFIED])],
        ]);

        $nomination->update($validated);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __(':number marked :status.', [
                'number' => $nomination->nomination_number,
                'status' => $nomination->status,
            ]),
        ]);

        return back();
    }
}
