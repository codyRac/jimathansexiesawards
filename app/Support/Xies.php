<?php

namespace App\Support;

class Xies
{
    /**
     * Categories open for nomination.
     *
     * @return list<string>
     */
    public static function categories(): array
    {
        /** @var list<string> $categories */
        $categories = config('xies.categories');

        return $categories;
    }

    /**
     * The fee per nomination entry, in whole US dollars.
     */
    public static function fee(): int
    {
        return (int) config('xies.fee');
    }

    public static function paypalUrl(): ?string
    {
        $url = config('xies.paypal_url');

        return is_string($url) && $url !== '' ? $url : null;
    }

    public static function stripeUrl(): ?string
    {
        $url = config('xies.stripe_url');

        return is_string($url) && $url !== '' ? $url : null;
    }

    public static function adminEmail(): ?string
    {
        $email = config('xies.admin_email');

        return is_string($email) && $email !== '' ? $email : null;
    }

    /**
     * @return list<string>
     */
    public static function phones(): array
    {
        /** @var list<string> $phones */
        $phones = config('xies.phones');

        return $phones;
    }

    public static function website(): string
    {
        return (string) config('xies.website');
    }

    /**
     * @return array{nominations_open: string, nominations_close: string, show: string}
     */
    public static function dates(): array
    {
        /** @var array{nominations_open: string, nominations_close: string, show: string} $dates */
        $dates = config('xies.dates');

        return $dates;
    }

    /**
     * Props shared by every public Xies page.
     *
     * @return array<string, mixed>
     */
    public static function siteProps(): array
    {
        return [
            'fee' => self::fee(),
            'phones' => self::phones(),
            'website' => self::website(),
            'dates' => self::dates(),
        ];
    }
}
