<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ArrowRight, BadgeCheck, Clock, Search } from '@lucide/vue';
import { ref } from 'vue';

interface NominationCard {
    number: string | null;
    nominee_name: string;
    nominee_x_handle: string;
    show_name: string | null;
    categories: string[];
    status: string;
    submitted_at: string | null;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

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
    nominations: {
        data: NominationCard[];
        links: PaginationLink[];
        total: number;
        from: number | null;
        to: number | null;
    };
    allCategories: string[];
    filters: {
        search: string;
        category: string;
    };
}>();

const search = ref(props.filters.search);
const category = ref(props.filters.category);

const cleanLabel = (label: string) =>
    label
        .replace('&laquo;', '«')
        .replace('&raquo;', '»')
        .replace('&hellip;', '…');

const applyFilters = () => {
    router.get(
        '/nominations',
        {
            ...(search.value ? { search: search.value } : {}),
            ...(category.value ? { category: category.value } : {}),
        },
        { preserveState: true, preserveScroll: true },
    );
};
</script>

<template>
    <Head title="Nomination Records" />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 py-14 text-center">
            <p
                class="text-sm font-bold tracking-[0.25em] text-xies-gold uppercase"
            >
                Nomination Records
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight uppercase">
                The Official
                <span
                    class="bg-gradient-to-r from-xies-goldlight to-xies-gold bg-clip-text text-transparent"
                    >Nomination Roll</span
                >
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-white/60">
                Every voice nominated for the Jim Athans Xies Awards. Each
                record has its own public page — share it and rally your
                community.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 pb-24">
        <!-- Filters -->
        <form
            class="flex flex-col gap-3 sm:flex-row"
            @submit.prevent="applyFilters"
        >
            <div class="relative flex-1">
                <Search
                    class="pointer-events-none absolute top-1/2 left-3.5 size-4 -translate-y-1/2 text-white/40"
                />
                <input
                    v-model="search"
                    type="search"
                    placeholder="Search nominee, X handle, or show name..."
                    class="w-full rounded-md border border-white/15 bg-white/5 py-2.5 pr-3.5 pl-10 text-sm text-white placeholder-white/30 transition focus:border-xies-gold focus:ring-1 focus:ring-xies-gold focus:outline-none"
                />
            </div>
            <select
                v-model="category"
                class="rounded-md border border-white/15 bg-xies-charcoal px-3.5 py-2.5 text-sm text-white transition focus:border-xies-gold focus:ring-1 focus:ring-xies-gold focus:outline-none sm:max-w-64"
                @change="applyFilters"
            >
                <option value="">All categories</option>
                <option
                    v-for="option in allCategories"
                    :key="option"
                    :value="option"
                >
                    {{ option }}
                </option>
            </select>
            <button
                type="submit"
                class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-6 py-2.5 text-sm font-black tracking-wide text-xies-black uppercase transition hover:brightness-110"
            >
                Search
            </button>
        </form>

        <p v-if="nominations.total > 0" class="mt-4 text-xs text-white/40">
            Showing {{ nominations.from }}–{{ nominations.to }} of
            {{ nominations.total }}
            {{ nominations.total === 1 ? 'nomination' : 'nominations' }}
        </p>

        <!-- Records grid -->
        <div
            v-if="nominations.data.length"
            class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3"
        >
            <Link
                v-for="record in nominations.data"
                :key="record.number ?? record.nominee_name"
                :href="`/nominations/${record.number}`"
                class="group flex flex-col rounded-2xl border border-white/10 bg-xies-charcoal p-6 transition hover:border-xies-gold/50 hover:shadow-[0_0_30px_rgba(201,162,74,0.15)]"
            >
                <div class="flex items-start justify-between gap-3">
                    <p class="font-mono text-xs tracking-widest text-white/40">
                        {{ record.number }}
                    </p>
                    <span
                        v-if="record.status === 'verified'"
                        class="inline-flex items-center gap-1 rounded-full border border-xies-gold px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-xies-goldlight uppercase"
                    >
                        <BadgeCheck class="size-3" />
                        Verified
                    </span>
                    <span
                        v-else
                        class="inline-flex items-center gap-1 rounded-full border border-white/20 px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-white/50 uppercase"
                    >
                        <Clock class="size-3" />
                        Pending
                    </span>
                </div>

                <h2
                    class="mt-3 text-xl leading-tight font-black transition group-hover:text-xies-goldlight"
                >
                    {{ record.nominee_name }}
                </h2>
                <p class="mt-0.5 text-sm font-semibold text-xies-gold">
                    @{{ record.nominee_x_handle }}
                </p>
                <p
                    v-if="record.show_name"
                    class="mt-1 text-sm text-white/60 italic"
                >
                    {{ record.show_name }}
                </p>

                <div class="mt-4 flex flex-1 flex-wrap content-start gap-1.5">
                    <span
                        v-for="cat in record.categories.slice(0, 3)"
                        :key="cat"
                        class="rounded-full bg-xies-gold/10 px-2.5 py-1 text-[11px] font-semibold text-xies-goldlight"
                    >
                        {{ cat }}
                    </span>
                    <span
                        v-if="record.categories.length > 3"
                        class="rounded-full bg-white/5 px-2.5 py-1 text-[11px] font-semibold text-white/50"
                    >
                        +{{ record.categories.length - 3 }} more
                    </span>
                </div>

                <div
                    class="mt-5 flex items-center justify-between border-t border-white/5 pt-4"
                >
                    <span class="text-xs text-white/40">{{
                        record.submitted_at
                    }}</span>
                    <span
                        class="flex items-center gap-1 text-xs font-bold tracking-widest text-xies-gold uppercase transition group-hover:gap-2"
                    >
                        View Record
                        <ArrowRight class="size-3.5" />
                    </span>
                </div>
            </Link>
        </div>

        <!-- Empty state -->
        <div
            v-else
            class="mt-6 rounded-2xl border border-white/10 bg-xies-charcoal p-12 text-center"
        >
            <p class="text-xl font-black tracking-wide uppercase">
                No nominations found
            </p>
            <p class="mx-auto mt-2 max-w-md text-sm text-white/60">
                {{
                    filters.search || filters.category
                        ? 'Try a different search or category.'
                        : 'The nomination roll is just getting started — be the first name on it.'
                }}
            </p>
            <Link
                href="/nominate"
                class="mt-6 inline-block rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-8 py-3 text-sm font-black tracking-wide text-xies-black uppercase transition hover:brightness-110"
            >
                Nominate Now
            </Link>
        </div>

        <!-- Pagination -->
        <nav
            v-if="nominations.links.length > 3"
            class="mt-10 flex flex-wrap items-center justify-center gap-2"
            aria-label="Pagination"
        >
            <template v-for="(link, index) in nominations.links" :key="index">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    preserve-scroll
                    class="rounded-md border px-3.5 py-2 text-sm font-semibold transition"
                    :class="
                        link.active
                            ? 'border-xies-gold bg-xies-gold/10 text-xies-goldlight'
                            : 'border-white/10 text-white/70 hover:border-white/30'
                    "
                >
                    {{ cleanLabel(link.label) }}
                </Link>
                <span
                    v-else
                    class="rounded-md border border-white/5 px-3.5 py-2 text-sm text-white/30"
                >
                    {{ cleanLabel(link.label) }}
                </span>
            </template>
        </nav>
    </section>
</template>
