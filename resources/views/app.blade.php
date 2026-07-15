<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="icon" href="/favicon-96x96.png" type="image/png" sizes="96x96">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="theme-color" content="#070707">

        <link rel="canonical" href="{{ url()->current() }}">

        <meta name="description" content="The Jim Athans Xies Awards celebrate the creators, broadcasters, and communities shaping the X platform. Submit your $10 nomination — open June 3 to December 31, 2026.">

        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="en_US">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Jim Athans Xies Awards — The Premier Awards Show on the X Platform">
        <meta property="og:description" content="The first awards program built entirely for X — honoring creators, broadcasters, and communities. Nominations open June 3, 2026. $10 per entry.">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="The Jim Athans Xies Awards — gold microphone and X trophy emblem">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Jim Athans Xies Awards — The Premier Awards Show on the X Platform">
        <meta name="twitter:description" content="The first awards program built entirely for X — honoring creators, broadcasters, and communities. Nominations open June 3, 2026. $10 per entry.">
        <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        <x-inertia::head>
            <title>{{ config('app.name', 'Laravel') }}</title>
        </x-inertia::head>
    </head>
    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>
