<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Phone } from '@lucide/vue';

defineProps<{
    fee: number;
    phones: string[];
    website: string;
    dates: {
        eligibility_start: string;
        eligibility_end: string;
        nominations_open: string;
        nominations_close: string;
        show: string;
    };
}>();

const callTopics = [
    'Pricing',
    'Engraving',
    'Prototype information',
    'Quantity orders',
    'Manufacturing updates',
];
</script>

<template>
    <Head title="Trophy Collection" />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 py-14 text-center">
            <p
                class="text-sm font-bold tracking-[0.25em] text-xies-gold uppercase"
            >
                The Xies Trophy Collection
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight uppercase">
                Celebrating Voices.
                <span
                    class="bg-gradient-to-r from-xies-goldlight to-xies-gold bg-clip-text text-transparent"
                    >Honoring Impact.</span
                >
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-white/60">
                From the Studio Collection to the Prestige Collection — the
                golden microphone in solid black and gold, made for champions of
                the airwaves.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-4xl px-6 pb-20">
        <img
            src="/images/xies-trophy-board.jpg"
            alt="Jim Athans Xies Awards trophy collection — Studio Collection and Prestige Collection golden microphone trophies with pricing"
            class="mx-auto w-full max-w-md rounded-2xl border border-xies-gold/40 shadow-[0_0_60px_rgba(201,162,74,0.25)]"
        />

         <!-- <p
            class="mx-auto mt-8 max-w-2xl rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-center text-sm text-white/60"
        >
            <span class="font-bold text-xies-goldlight uppercase"
                >Please note:</span
            >
            The microphone trophies shown are concept designs. A manufacturer
            has not yet been selected.
        </p> -->

        <div
            class="mx-auto mt-6 max-w-2xl rounded-2xl border-2 border-xies-gold bg-xies-charcoal p-8 text-center"
        >
            <h2 class="text-xl font-black tracking-wide uppercase">
                Questions or pricing? Call us.
            </h2>
            <a
                href="tel:877-243-9279"
                class="mt-4 inline-flex items-center gap-3 text-3xl font-black text-white transition hover:text-xies-goldlight sm:text-4xl"
            >
                <Phone class="size-7 text-xies-gold" />
                877-243-9279
            </a>
            <ul
                class="mx-auto mt-6 flex max-w-lg flex-wrap items-center justify-center gap-x-6 gap-y-2"
            >
                <li
                    v-for="topic in callTopics"
                    :key="topic"
                    class="flex items-center gap-2 text-xs font-bold tracking-widest text-white/60 uppercase"
                >
                    <span class="size-1.5 rounded-full bg-xies-gold" />
                    {{ topic }}
                </li>
            </ul>
            <!-- <p class="mx-auto mt-6 max-w-lg text-sm text-white/50">
                PayPal and Stripe checkout will be connected once manufacturing
                and payment processing are finalized. Until then, all trophy
                inquiries and orders are handled by phone.
            </p> -->
        </div>

        <p class="mt-10 text-center text-sm text-white/50">
            Know a voice that deserves one of these?
            <Link
                href="/nominate"
                class="font-bold text-xies-goldlight underline underline-offset-4"
                >Nominate them</Link
            >
            before {{ dates.nominations_close }}.
        </p>
    </section>
</template>
