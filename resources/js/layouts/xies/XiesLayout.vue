<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    Handshake,
    Menu,
    Phone,
    Scale,
    Search,
    Sparkles,
    Users,
    X,
} from '@lucide/vue';
import { computed, ref } from 'vue';

const page = usePage();
const mobileOpen = ref(false);

const nav = [
    { title: 'Home', href: '/' },
    { title: 'Nominate', href: '/nominate' },
    { title: 'Shop', href: '/shop' },
];

const currentPath = computed(() => page.url.split('?')[0]);

const isCurrent = (href: string) =>
    href === '/'
        ? currentPath.value === '/'
        : currentPath.value.startsWith(href);

const phones = ['877-243-9279', '816-907-8628'];

const values = [
    { icon: Scale, title: 'Fair', text: 'Judged on quality, not popularity.' },
    {
        icon: Search,
        title: 'Transparent',
        text: 'Open process. Real recognition.',
    },
    {
        icon: Sparkles,
        title: 'Impactful',
        text: 'Honoring creators who make a difference.',
    },
    { icon: Users, title: 'Big or Small', text: 'Every voice has a chance.' },
    {
        icon: Handshake,
        title: 'Together',
        text: "Let's raise the standard of conversation.",
    },
];
</script>

<template>
    <div class="flex min-h-screen flex-col bg-xies-black text-white">
        <header
            class="sticky top-0 z-50 border-b border-xies-gold/20 bg-xies-black/90 backdrop-blur"
        >
            <div class="hidden border-b border-white/5 md:block">
                <div
                    class="mx-auto flex max-w-6xl items-center justify-end gap-6 px-6 py-1.5 text-xs text-white/50"
                >
                    <span class="tracking-wide text-xies-gold/80"
                        >LIVE ON X — DECEMBER 31, 2026</span
                    >
                    <a
                        v-for="phone in phones"
                        :key="phone"
                        :href="`tel:${phone}`"
                        class="flex items-center gap-1.5 transition hover:text-xies-goldlight"
                    >
                        <Phone class="size-3" />
                        {{ phone }}
                    </a>
                </div>
            </div>

            <div
                class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-3"
            >
                <Link href="/" class="flex items-center gap-2">
                    <img
                        src="/images/xies-logo.png"
                        alt="Jim Athans Xies Awards"
                        class="h-12 w-auto transition-transform duration-300 hover:scale-105"
                    />
                </Link>

                <nav class="hidden items-center gap-8 md:flex">
                    <Link
                        v-for="item in nav"
                        :key="item.href"
                        :href="item.href"
                        class="text-sm font-semibold tracking-widest uppercase transition"
                        :class="
                            isCurrent(item.href)
                                ? 'text-xies-goldlight'
                                : 'text-white/70 hover:text-xies-goldlight'
                        "
                    >
                        {{ item.title }}
                    </Link>
                    <Link
                        href="/nominate"
                        class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-5 py-2 text-sm font-bold tracking-wide text-xies-black uppercase shadow-[0_0_24px_rgba(201,162,74,0.35)] transition hover:brightness-110"
                    >
                        Nominate Now
                    </Link>
                </nav>

                <button
                    type="button"
                    class="rounded-md border border-white/15 p-2 text-white/80 md:hidden"
                    aria-label="Toggle navigation"
                    @click="mobileOpen = !mobileOpen"
                >
                    <X v-if="mobileOpen" class="size-5" />
                    <Menu v-else class="size-5" />
                </button>
            </div>

            <div
                v-if="mobileOpen"
                class="border-t border-white/10 px-6 pt-2 pb-4 md:hidden"
            >
                <nav class="flex flex-col gap-1">
                    <Link
                        v-for="item in nav"
                        :key="item.href"
                        :href="item.href"
                        class="rounded-md px-3 py-2.5 text-sm font-semibold tracking-widest uppercase"
                        :class="
                            isCurrent(item.href)
                                ? 'bg-white/5 text-xies-goldlight'
                                : 'text-white/70'
                        "
                        @click="mobileOpen = false"
                    >
                        {{ item.title }}
                    </Link>
                    <a
                        v-for="phone in phones"
                        :key="phone"
                        :href="`tel:${phone}`"
                        class="flex items-center gap-2 px-3 py-2 text-sm text-white/50"
                    >
                        <Phone class="size-3.5" />
                        {{ phone }}
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="border-t border-xies-gold/20 bg-xies-black">
            <div class="mx-auto max-w-6xl px-6 py-12">
                <div
                    class="grid gap-8 text-center sm:grid-cols-3 lg:grid-cols-5"
                >
                    <div
                        v-for="value in values"
                        :key="value.title"
                        class="flex flex-col items-center gap-2"
                    >
                        <component
                            :is="value.icon"
                            class="size-6 text-xies-gold"
                        />
                        <span
                            class="text-xs font-bold tracking-widest text-xies-goldlight uppercase"
                            >{{ value.title }}</span
                        >
                        <span class="text-xs leading-relaxed text-white/50">{{
                            value.text
                        }}</span>
                    </div>
                </div>

                <div
                    class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-8 text-sm text-white/60 sm:flex-row"
                >
                    <div
                        class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2"
                    >
                        <a
                            v-for="phone in phones"
                            :key="phone"
                            :href="`tel:${phone}`"
                            class="flex items-center gap-1.5 transition hover:text-xies-goldlight"
                        >
                            <Phone class="size-3.5" />
                            {{ phone }}
                        </a>
                    </div>
                    <span class="text-xies-gold/80"
                        >www.jimathansxiesawards.com</span
                    >
                </div>

                <p
                    class="mt-8 text-center text-xs leading-relaxed text-white/35"
                >
                    The Jim Athans Xies Awards (X Impact Awards) are an
                    independent production and are not affiliated with, endorsed
                    by, or sponsored by X Corp. Terms, Privacy, and Refund
                    policies are being finalized with legal review and will be
                    published before launch.
                </p>
                <p class="mt-2 text-center text-xs text-white/35">
                    &copy; 2026 Jim Athans Xies Awards. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</template>
