<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    BadgeCheck,
    Coffee,
    Download,
    Mic,
    Phone,
    Shirt,
    ShoppingBag,
} from '@lucide/vue';
import type { FunctionalComponent } from 'vue';

defineProps<{
    fee: number;
    phones: string[];
    website: string;
    dates: {
        nominations_open: string;
        nominations_close: string;
        show: string;
    };
}>();

interface Product {
    icon: FunctionalComponent;
    name: string;
    description: string;
    price: string;
    status: 'Coming Soon' | 'Limited — Waitlist';
}

const products: Product[] = [
    {
        icon: Shirt,
        name: 'Xies Emblem Tee',
        description:
            'Premium heavyweight black tee with the gold Xies emblem across the chest.',
        price: '$32',
        status: 'Coming Soon',
    },
    {
        icon: ShoppingBag,
        name: 'Broadcast Hoodie',
        description:
            'Charcoal fleece hoodie with embroidered gold X and "Excellence in X Broadcasting" sleeve print.',
        price: '$58',
        status: 'Coming Soon',
    },
    {
        icon: Coffee,
        name: 'Golden Hour Mug',
        description:
            'Matte black ceramic mug with a metallic gold microphone wrap. For the pre-show ritual.',
        price: '$18',
        status: 'Coming Soon',
    },
    {
        icon: Mic,
        name: 'The Golden Mic Collectible',
        description:
            'Limited-edition replica of the Xies trophy — the gold microphone on its black pedestal.',
        price: '$149',
        status: 'Limited — Waitlist',
    },
    {
        icon: BadgeCheck,
        name: 'Creator Badge Pack (Digital)',
        description:
            'Official nominee badges, lower-thirds, and cover art to promote your entry on X.',
        price: '$12',
        status: 'Coming Soon',
    },
    {
        icon: Download,
        name: 'Nominee Media Kit (Digital)',
        description:
            'Press-style templates and show assets to rally your community behind your nomination.',
        price: '$19',
        status: 'Coming Soon',
    },
];
</script>

<template>
    <Head title="Shop" />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 py-14 text-center">
            <p
                class="text-sm font-bold tracking-[0.25em] text-xies-gold uppercase"
            >
                The Xies Shop
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight uppercase">
                Wear the
                <span
                    class="bg-gradient-to-r from-xies-goldlight to-xies-gold bg-clip-text text-transparent"
                    >Gold Standard</span
                >
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-white/60">
                The concept collection is in production — apparel and drinkware
                through print-on-demand, and the collectible mic with a
                specialty trophy maker. Everything drops before the
                {{ dates.show }} show.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-6 pb-20">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="product in products"
                :key="product.name"
                class="flex flex-col rounded-2xl border border-white/10 bg-xies-charcoal p-6 transition hover:border-xies-gold/40"
            >
                <div
                    class="flex aspect-[4/3] items-center justify-center rounded-xl bg-[radial-gradient(ellipse_at_center,rgba(201,162,74,0.18),rgba(7,7,7,0.9))]"
                >
                    <component
                        :is="product.icon"
                        class="size-14 text-xies-gold"
                    />
                </div>
                <div class="mt-5 flex items-start justify-between gap-3">
                    <h2 class="text-lg leading-tight font-bold">
                        {{ product.name }}
                    </h2>
                    <span
                        class="text-lg font-black whitespace-nowrap text-xies-goldlight"
                        >{{ product.price }}</span
                    >
                </div>
                <p class="mt-2 flex-1 text-sm leading-relaxed text-white/55">
                    {{ product.description }}
                </p>
                <span
                    class="mt-5 inline-flex w-fit items-center rounded-full border px-3 py-1 text-[11px] font-bold tracking-widest uppercase"
                    :class="
                        product.status === 'Limited — Waitlist'
                            ? 'border-xies-gold text-xies-goldlight'
                            : 'border-white/20 text-white/50'
                    "
                >
                    {{ product.status }}
                </span>
            </div>
        </div>

        <div
            class="mt-12 rounded-2xl border border-xies-gold/40 bg-xies-charcoal p-8 text-center"
        >
            <h2 class="text-xl font-black tracking-wide uppercase">
                Want first access when the shop opens?
            </h2>
            <p class="mx-auto mt-2 max-w-lg text-sm text-white/60">
                Call us and we'll add you to the launch list — nominees and
                their communities get first pick of the limited pieces.
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
                While you wait —
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
