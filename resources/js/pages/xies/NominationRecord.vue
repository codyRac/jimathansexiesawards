<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    BadgeCheck,
    Check,
    Clock,
    ExternalLink,
    Link2,
    Share2,
} from '@lucide/vue';
import { computed, ref } from 'vue';

const props = defineProps<{
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
        show_name: string | null;
        categories: string[];
        reason: string;
        links: string | null;
        status: string;
        submitted_at: string | null;
    };
}>();

const supportingLinks = computed(() =>
    (props.nomination.links ?? '')
        .split(/\r?\n/)
        .map((line) => line.trim())
        .filter((line) => /^https?:\/\//i.test(line)),
);

const pageUrl = () => window.location.href;

const shareOnXUrl = computed(() => {
    const text = `${props.nomination.nominee_name} (@${props.nomination.nominee_x_handle}) is nominated for the Jim Athans XIES Awards — Nothing Is As Sexy As An XIE!`;

    return `https://x.com/intent/post?text=${encodeURIComponent(text)}&url=${encodeURIComponent(pageUrl())}`;
});

const copied = ref(false);

const copyLink = async () => {
    await navigator.clipboard.writeText(pageUrl());
    copied.value = true;
    setTimeout(() => (copied.value = false), 2000);
};
</script>

<template>
    <Head
        :title="`${nomination.nominee_name} — Nomination ${nomination.number}`"
    />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 pt-10 pb-24">
            <Link
                href="/nominations"
                class="inline-flex items-center gap-1.5 text-xs font-bold tracking-widest text-white/50 uppercase transition hover:text-xies-goldlight"
            >
                <ArrowLeft class="size-3.5" />
                All Nomination Records
            </Link>

            <!-- Record card -->
            <div
                class="mt-6 rounded-3xl border border-xies-gold/40 bg-xies-charcoal p-8 sm:p-10"
            >
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <p class="font-mono text-sm tracking-widest text-white/50">
                        {{ nomination.number }}
                    </p>
                    <span
                        v-if="nomination.status === 'verified'"
                        class="inline-flex items-center gap-1.5 rounded-full border border-xies-gold px-3 py-1 text-xs font-bold tracking-widest text-xies-goldlight uppercase"
                    >
                        <BadgeCheck class="size-3.5" />
                        Verified Nomination
                    </span>
                    <span
                        v-else
                        class="inline-flex items-center gap-1.5 rounded-full border border-white/20 px-3 py-1 text-xs font-bold tracking-widest text-white/50 uppercase"
                    >
                        <Clock class="size-3.5" />
                        Pending Verification
                    </span>
                </div>

                <p
                    class="mt-8 text-xs font-black tracking-[0.25em] text-xies-gold uppercase"
                >
                    Official Xies Nominee
                </p>
                <h1
                    class="mt-2 text-4xl font-black tracking-tight uppercase sm:text-5xl"
                >
                    {{ nomination.nominee_name }}
                </h1>
                <a
                    :href="`https://x.com/${nomination.nominee_x_handle}`"
                    target="_blank"
                    rel="noopener nofollow"
                    class="mt-2 inline-flex items-center gap-1.5 text-lg font-bold text-xies-gold transition hover:text-xies-goldlight"
                >
                    @{{ nomination.nominee_x_handle }}
                    <ExternalLink class="size-4" />
                </a>
                <p
                    v-if="nomination.show_name"
                    class="mt-2 text-lg text-white/70 italic"
                >
                    {{ nomination.show_name }}
                </p>

                <h2
                    class="mt-8 text-xs font-black tracking-[0.2em] text-white/60 uppercase"
                >
                    Nominated For
                </h2>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span
                        v-for="cat in nomination.categories"
                        :key="cat"
                        class="rounded-full border border-xies-gold/40 bg-xies-gold/10 px-3.5 py-1.5 text-sm font-semibold text-xies-goldlight"
                    >
                        {{ cat }}
                    </span>
                </div>

                <h2
                    class="mt-8 text-xs font-black tracking-[0.2em] text-white/60 uppercase"
                >
                    The Case
                </h2>
                <p
                    class="mt-3 leading-relaxed whitespace-pre-line text-white/80"
                >
                    {{ nomination.reason }}
                </p>

                <template v-if="supportingLinks.length">
                    <h2
                        class="mt-8 text-xs font-black tracking-[0.2em] text-white/60 uppercase"
                    >
                        Supporting Links
                    </h2>
                    <ul class="mt-3 space-y-2">
                        <li v-for="link in supportingLinks" :key="link">
                            <a
                                :href="link"
                                target="_blank"
                                rel="noopener nofollow"
                                class="inline-flex max-w-full items-center gap-2 text-sm text-xies-gold transition hover:text-xies-goldlight"
                            >
                                <ExternalLink class="size-3.5 shrink-0" />
                                <span class="truncate">{{ link }}</span>
                            </a>
                        </li>
                    </ul>
                </template>

                <p
                    v-if="nomination.submitted_at"
                    class="mt-8 border-t border-white/10 pt-5 text-xs text-white/40"
                >
                    Nomination submitted {{ nomination.submitted_at }} &middot;
                    The Jim Athans Xies Awards — live on X, {{ dates.show }}.
                </p>
            </div>

            <!-- Share -->
            <div
                class="mt-6 rounded-2xl border border-white/10 bg-xies-charcoal p-6 text-center"
            >
                <h2
                    class="flex items-center justify-center gap-2 text-sm font-black tracking-[0.2em] text-white/70 uppercase"
                >
                    <Share2 class="size-4 text-xies-gold" />
                    Rally Your Community
                </h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-white/60">
                    This is a public record — share the link and get the word
                    out.
                </p>
                <div
                    class="mt-5 flex flex-col items-center justify-center gap-3 sm:flex-row"
                >
                    <a
                        :href="shareOnXUrl"
                        target="_blank"
                        rel="noopener"
                        class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-6 py-2.5 text-sm font-black tracking-wide text-xies-black uppercase transition hover:brightness-110"
                    >
                        Post on X
                    </a>
                    <button
                        type="button"
                        class="inline-flex items-center gap-2 rounded-md border border-xies-gold/50 px-6 py-2.5 text-sm font-bold tracking-wide text-xies-goldlight uppercase transition hover:bg-xies-gold/10"
                        @click="copyLink"
                    >
                        <Check v-if="copied" class="size-4" />
                        <Link2 v-else class="size-4" />
                        {{ copied ? 'Link Copied!' : 'Copy Link' }}
                    </button>
                </div>
            </div>

            <p class="mt-8 text-center text-sm text-white/50">
                Know another voice that deserves recognition?
                <Link
                    href="/nominate"
                    class="font-bold text-xies-goldlight underline underline-offset-4"
                    >Nominate them</Link
                >
                before {{ dates.nominations_close }}.
            </p>
        </div>
    </section>
</template>
