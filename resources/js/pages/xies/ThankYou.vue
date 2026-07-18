<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    BadgeCheck,
    CircleCheck,
    Mail,
    Phone,
    Search,
    Trophy,
} from '@lucide/vue';

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
    nomination: {
        number: string | null;
        nominee_name: string;
        nominee_x_handle: string;
        categories: string[];
        amount_due: number;
        payment_method: string;
        payment_reference: string | null;
        nominator_email: string;
    };
}>();
</script>

<template>
    <Head title="Nomination Received" />

    <section class="mx-auto max-w-2xl px-6 py-16 text-center">
        <CircleCheck class="mx-auto size-16 text-xies-gold" />
        <h1 class="mt-6 text-4xl font-black tracking-tight uppercase">
            Nomination Received!
        </h1>
        <p class="mt-3 text-white/60">
            A receipt was sent to
            <span class="font-semibold text-white/90">{{
                nomination.nominator_email
            }}</span
            >. Save your nomination number:
        </p>

        <div
            class="mt-6 inline-block rounded-xl border-2 border-xies-gold bg-xies-charcoal px-10 py-5"
        >
            <p
                class="font-mono text-3xl font-black tracking-widest text-xies-goldlight"
            >
                {{ nomination.number }}
            </p>
        </div>

        <div
            class="mt-10 rounded-2xl border border-white/10 bg-xies-charcoal p-6 text-left"
        >
            <h2
                class="text-xs font-black tracking-[0.2em] text-white/60 uppercase"
            >
                Entry Summary
            </h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div class="flex justify-between gap-4">
                    <dt class="text-white/50">Nominee</dt>
                    <dd class="text-right font-semibold">
                        {{ nomination.nominee_name }}
                        <span class="text-xies-gold"
                            >@{{ nomination.nominee_x_handle }}</span
                        >
                    </dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-white/50">Categories</dt>
                    <dd class="text-right font-semibold">
                        {{ nomination.categories.join(', ') }}
                    </dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-white/50">Nomination fee</dt>
                    <dd class="font-black text-xies-goldlight">
                        ${{ nomination.amount_due }}
                    </dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-white/50">Payment</dt>
                    <dd class="text-right font-semibold capitalize">
                        {{ nomination.payment_method }}
                        <span
                            v-if="nomination.payment_reference"
                            class="block font-mono text-xs text-white/50"
                        >
                            ref: {{ nomination.payment_reference }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="mt-8 space-y-4 text-left">
            <h2
                class="text-center text-xs font-black tracking-[0.2em] text-white/60 uppercase"
            >
                What Happens Next
            </h2>
            <div
                class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4"
            >
                <BadgeCheck class="mt-0.5 size-5 shrink-0 text-xies-gold" />
                <p class="text-sm text-white/70">
                    <span class="font-bold text-white"
                        >Payment verification.</span
                    >
                    Our team matches your ${{ nomination.amount_due }} payment
                    to this entry — your nomination becomes official once it's
                    verified.
                </p>
            </div>
            <div
                class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4"
            >
                <Search class="mt-0.5 size-5 shrink-0 text-xies-gold" />
                <p class="text-sm text-white/70">
                    <span class="font-bold text-white"
                        >Eligibility review.</span
                    >
                    We review your entry, links, and uploads against the
                    {{ dates.nominations_open }} –
                    {{ dates.nominations_close }} eligibility period.
                </p>
            </div>
            <div
                class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4"
            >
                <Trophy class="mt-0.5 size-5 shrink-0 text-xies-gold" />
                <p class="text-sm text-white/70">
                    <span class="font-bold text-white">The show.</span> Winners
                    are celebrated at the Jim Athans Xies Awards — live on X,
                    {{ dates.show }}.
                </p>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <Link
                href="/nominate"
                class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-6 py-3 text-sm font-black tracking-wide text-xies-black uppercase transition hover:brightness-110"
            >
                Nominate Another
            </Link>
            <Link
                href="/"
                class="rounded-md border border-xies-gold/50 px-6 py-3 text-sm font-bold tracking-wide text-xies-goldlight uppercase transition hover:bg-xies-gold/10"
            >
                Back to Home
            </Link>
        </div>

        <div
            class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm text-white/50"
        >
            <span class="flex items-center gap-2"
                ><Mail class="size-4 text-xies-gold" /> Questions about your
                entry?</span
            >
            <a
                v-for="phone in phones"
                :key="phone"
                :href="`tel:${phone}`"
                class="flex items-center gap-1.5 font-semibold text-white/80 transition hover:text-xies-goldlight"
            >
                <Phone class="size-3.5" /> {{ phone }}
            </a>
        </div>
    </section>
</template>
