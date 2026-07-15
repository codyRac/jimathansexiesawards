<?php

namespace Tests\Feature;

use App\Mail\NominationReceived;
use App\Models\Nomination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class NominationTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_landing_page_renders()
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('xies/Home')
                ->has('categories', 18)
                ->where('fee', 10));
    }

    public function test_the_shop_page_renders()
    {
        $this->get(route('shop'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('xies/Shop'));
    }

    public function test_the_nomination_form_renders()
    {
        $this->get(route('nominate'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('xies/Nominate')
                ->has('categories')
                ->has('paypalUrl'));
    }

    public function test_a_nomination_can_be_submitted()
    {
        Storage::fake('local');
        Mail::fake();

        $response = $this->post(route('nominate.store'), [
            ...$this->validPayload(),
            'attachments' => [
                UploadedFile::fake()->create('clip.mp4', 2048, 'video/mp4'),
                UploadedFile::fake()->create('poster.png', 512, 'image/png'),
            ],
        ]);

        $response->assertRedirect(route('nominate.confirmation'));

        $nomination = Nomination::firstOrFail();

        $this->assertSame('XIES-'.now()->format('Y').'-0001', $nomination->nomination_number);
        $this->assertSame('Jane Broadcaster', $nomination->nominee_name);
        $this->assertSame('janeonx', $nomination->nominee_x_handle);
        $this->assertSame(['Sports', 'Interviews'], $nomination->categories);
        $this->assertSame(20, $nomination->amount_due);
        $this->assertSame(Nomination::STATUS_PENDING, $nomination->status);
        $this->assertCount(2, $nomination->attachments ?? []);

        foreach ($nomination->attachments ?? [] as $path) {
            Storage::disk('local')->assertExists($path);
        }

        Mail::assertSent(NominationReceived::class, function (NominationReceived $mail) use ($nomination) {
            return $mail->hasTo($nomination->nominator_email) && ! $mail->forAdmin;
        });
    }

    public function test_the_confirmation_page_shows_the_new_nomination()
    {
        Mail::fake();

        $this->post(route('nominate.store'), $this->validPayload());

        $this->get(route('nominate.confirmation'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('xies/ThankYou')
                ->where('nomination.nominee_name', 'Jane Broadcaster'));
    }

    public function test_the_confirmation_page_redirects_without_a_fresh_submission()
    {
        $this->get(route('nominate.confirmation'))
            ->assertRedirect(route('nominate'));
    }

    public function test_the_admin_is_notified_when_configured()
    {
        Mail::fake();
        config(['xies.admin_email' => 'admin@example.com']);

        $this->post(route('nominate.store'), $this->validPayload());

        Mail::assertSent(NominationReceived::class, function (NominationReceived $mail) {
            return $mail->hasTo('admin@example.com') && $mail->forAdmin;
        });
    }

    public function test_required_fields_are_validated()
    {
        $this->post(route('nominate.store'), [])
            ->assertSessionHasErrors([
                'nominator_name',
                'nominator_email',
                'nominee_name',
                'nominee_x_handle',
                'categories',
                'reason',
                'payment_method',
                'terms',
            ]);

        $this->assertSame(0, Nomination::count());
    }

    public function test_unknown_categories_are_rejected()
    {
        $this->post(route('nominate.store'), [
            ...$this->validPayload(),
            'categories' => ['Made Up Category'],
        ])->assertSessionHasErrors(['categories.0']);
    }

    public function test_the_leading_at_is_stripped_from_handles()
    {
        Mail::fake();

        $this->post(route('nominate.store'), [
            ...$this->validPayload(),
            'nominee_x_handle' => '@janeonx',
        ]);

        $this->assertSame('janeonx', Nomination::firstOrFail()->nominee_x_handle);
    }

    public function test_the_dashboard_lists_nominations()
    {
        $nomination = Nomination::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Dashboard')
                ->has('nominations', 1)
                ->where('nominations.0.nominee_name', $nomination->nominee_name)
                ->where('stats.total', 1));
    }

    public function test_a_nomination_can_be_marked_verified()
    {
        $nomination = Nomination::factory()->create();

        $this->actingAs(User::factory()->create())
            ->patch(route('dashboard.nominations.status', $nomination), ['status' => 'verified'])
            ->assertRedirect();

        $this->assertSame(Nomination::STATUS_VERIFIED, $nomination->refresh()->status);
    }

    public function test_guests_cannot_update_nomination_status()
    {
        $nomination = Nomination::factory()->create();

        $this->patch(route('dashboard.nominations.status', $nomination), ['status' => 'verified'])
            ->assertRedirect(route('login'));

        $this->assertSame(Nomination::STATUS_PENDING, $nomination->refresh()->status);
    }

    /**
     * A valid nomination payload without attachments.
     *
     * @return array<string, mixed>
     */
    private function validPayload(): array
    {
        return [
            'nominator_name' => 'Cody Fan',
            'nominator_email' => 'fan@example.com',
            'nominator_x_handle' => 'codyfan',
            'self_nomination' => false,
            'nominee_name' => 'Jane Broadcaster',
            'nominee_x_handle' => 'janeonx',
            'show_name' => 'The Morning Space',
            'categories' => ['Sports', 'Interviews'],
            'reason' => 'Jane hosts the most consistent sports Space on the platform with real interviews.',
            'links' => "https://x.com/janeonx/status/1\nhttps://x.com/janeonx/status/2",
            'payment_method' => 'paypal',
            'payment_reference' => 'PP-12345',
            'terms' => true,
        ];
    }
}
