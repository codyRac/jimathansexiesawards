<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Globe, Package, Phone, ShieldCheck } from '@lucide/vue';

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

const printfulPoints = [
    { icon: Package, text: 'Printed & shipped on demand' },
    { icon: ShieldCheck, text: 'Premium quality, secure ordering' },
    { icon: Globe, text: 'Global shipping worldwide' },
];
</script>

<template>
    <Head title="Merchandise" />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 py-14 text-center">
            <p
                class="text-sm font-bold tracking-[0.25em] text-xies-gold uppercase"
            >
                Official Xies Merchandise
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight uppercase">
                Premium Quality.
                <span
                    class="bg-gradient-to-r from-xies-goldlight to-xies-gold bg-clip-text text-transparent"
                    >Bold Statement.</span
                >
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-white/60">
                Represent the movement. Celebrate excellence. Tees, hoodies,
                mugs, hats, and more — all in the black &amp; gold Xies
                standard.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-4xl px-6 pb-20">
        <img
            src="/images/xies-merch-board.jpg"
            alt="Official Xies merchandise collection — t-shirts, hoodies, mugs, tumblers, hats, beanies, bags, phone cases, water bottles, sweatshirts, and posters in black and gold"
            class="mx-auto w-full max-w-2xl rounded-2xl border border-xies-gold/40 shadow-[0_0_60px_rgba(201,162,74,0.25)]"
        />

        <div
            class="mx-auto mt-10 max-w-2xl rounded-2xl border-2 border-xies-gold bg-xies-charcoal p-8 text-center"
        >
            <p
                class="text-lg font-black tracking-[0.15em] text-xies-goldlight uppercase"
            >
                All orders are fulfilled by Printful.
            </p>
            <p class="mx-auto mt-2 max-w-md text-sm text-white/60">
                Printful handles production, printing, fulfillment, and shipping
                for every order.
            </p>
            <div
                class="mt-6 flex flex-wrap items-center justify-center gap-x-8 gap-y-3"
            >
                <span
                    v-for="point in printfulPoints"
                    :key="point.text"
                    class="flex items-center gap-2 text-xs font-bold tracking-widest text-white/60 uppercase"
                >
                    <component :is="point.icon" class="size-4 text-xies-gold" />
                    {{ point.text }}
                </span>
            </div>
        </div>

        <div
            class="mx-auto mt-6 max-w-2xl rounded-2xl border border-white/10 bg-xies-charcoal p-8 text-center"
        >
            <h2 class="text-xl font-black tracking-wide uppercase">
                Ready to order?
            </h2>
            <p class="mx-auto mt-2 max-w-lg text-sm text-white/60">
                Call 877-243-9279 for product info — sizing, pricing, and ordering.
            </p>
            <div
                class="mt-5 flex flex-wrap items-center justify-center gap-x-8 gap-y-2"
            >
                <a
                    v-for="phone in phones"
                    :key="phone"
                    :href="`tel:${phone}`"
                    class="flex items-center gap-2 text-xl font-black text-white transition hover:text-xies-goldlight"
                >
                    <Phone class="size-4 text-xies-gold" />
                    {{ phone }}
                </a>
            </div>
            <p class="mt-6 text-sm text-white/50">
                While you're here —
                <Link
                    href="/nominate"
                    class="font-bold text-xies-goldlight underline underline-offset-4"
                    >get your nomination in</Link
                >
                before {{ dates.nominations_close }}.
            </p>
        </div>
    </section>
</template>
