# Jim Athans Xies Awards — The X Impact Awards

The official site for the **Xies (X Impact Awards)** — the awards program honoring excellence across all content, creators, and communities on the X platform. Live on X, December 31, 2026.

Built with Laravel 13, Inertia, Vue 3, and Tailwind CSS 4 (Laravel Vue starter kit).

## What's here

| Page | Route | Purpose |
| --- | --- | --- |
| Landing | `/` | Hero, categories, eligibility, how to enter, fee, key dates |
| Nominate | `/nominate` | Nomination form: nominee details, categories, evidence uploads, payment |
| Confirmation | `/nominate/thank-you` | Nomination number + next steps (shown after submission) |
| Shop | `/shop` | Merchandise concept collection (coming soon states) |
| Dashboard | `/dashboard` | Admin view of nominations with payment verification toggle (auth required) |

Nominations are stored in the `nominations` table with a generated nomination number (`XIES-2026-0001`), uploaded evidence goes to `storage/app/private/nominations/`, and a receipt email is sent to the nominator (plus an admin notification when configured).

## Local development

Served by [Laravel Herd](https://herd.laravel.com) at <https://jimathansexiesawards.test>. Node 22 is required (pinned in `.nvmrc`).

```bash
nvm use
composer install && npm install
php artisan migrate
composer run dev   # serves PHP + queue + Vite together
```

Run the full check suite (what CI runs): `composer run ci:check`

## Before launch — connect these

Configured via `.env`:

| Key | Purpose |
| --- | --- |
| `XIES_PAYPAL_URL` | Real PayPal Business payment link / hosted checkout for the $10 fee. Until set, the PayPal button renders disabled. |
| `XIES_STRIPE_URL` | Stripe Payment Link (or other hosted card checkout). Until set, the card button renders disabled. |
| `XIES_ADMIN_EMAIL` | Where new-nomination notifications are sent. |
| `MAIL_*` | Swap the `log` mailer for a real provider so receipts actually send. |

Also on the launch checklist:

1. **Payment verification** — current flow is the quick manual workflow: nominators paste a transaction reference, and the team marks entries verified on the dashboard. Best practice for scale: create/verify nominations from payment webhooks instead.
2. **Uploads** — files land on the local disk. For production move the `nominations` storage to S3/R2 (swap the disk in `NominationController@store`) and raise `upload_max_filesize`/`post_max_size` if accepting 50MB clips.
3. **Store fulfillment** — shop is concept-only. Integrate apparel/mugs with Printful/Printify/Gelato; the collectible mic needs a specialty trophy manufacturer.
4. **Legal** — publish Terms, Privacy, Refund Policy, eligibility rules, content permissions/release language after professional review. The footer independence disclaimer is placeholder language, not reviewed counsel.
5. **Trademark** — the emblem/logo artwork is concept art; have a trademark professional and production designer review before mass production.

## Branding

| Token | Hex |
| --- | --- |
| Black | `#070707` |
| Charcoal | `#151515` |
| Gold | `#C9A24A` |
| Light gold | `#F0CF72` |

Available as Tailwind utilities: `xies-black`, `xies-charcoal`, `xies-gold`, `xies-goldlight`, `xies-cream` (defined in `resources/css/app.css`). Site config (fee, categories, dates, phones) lives in `config/xies.php`.
