<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    CalendarCheck,
    CircleCheck,
    Phone,
    Podcast,
    Radio,
    Sparkles,
    Trophy,
    Tv,
    Users,
} from '@lucide/vue';
import { onMounted } from 'vue';

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
    categories: string[];
}>();

const platformPillars = [
    { icon: Podcast, label: 'Podcasts' },
    { icon: Radio, label: 'Spaces' },
    { icon: Tv, label: 'Live Shows' },
    { icon: Users, label: 'Communities' },
    { icon: Sparkles, label: 'Impact' },
];

const entrantTypes = [
    'Podcasts',
    'Spaces',
    'Live Shows',
    'Communities',
    'Creators',
    'Guests',
    'Producers',
    'Broadcasters',
];

const eligibility = [
    'Anyone who creates or hosts content on X Spaces, X Live, or any broadcast format on X.',
    'Individuals, co-hosts, teams, and producers are all welcome.',
    'You can nominate yourself or be nominated by your fans, listeners, or community.',
    'Open to all countries, all languages, and all topics.',
    'Any shows or outstanding guests can be nominated in whatever category.',
];

const steps = [
    {
        title: 'Choose Your Category(ies)',
        text: 'There is a category for every voice — pick the ones where your work shines.',
    },
    {
        title: 'Submit Your Entry',
        text: 'Tell us why you deserve to be recognized. Include links, screenshots, clips, and supporting evidence.',
    },
    {
        title: 'Pay the Nomination Fee',
        text: '$10 per nomination. All categories.',
    },
    {
        title: 'Share With Your Community',
        text: 'Get the word out and rally support!',
    },
];

// Scroll-triggered animations
onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    // Optionally unobserve after animation
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1 },
    );

    // Observe all sections with scroll-animate class
    document.querySelectorAll('[data-scroll-animate]').forEach((el) => {
        observer.observe(el);
    });
});
</script>

<template>
    <Head title="Nothing Is as Sexy as an XIE" />

    <!-- Hero - Glamorous Centered Emblem -->
    <section class="relative overflow-hidden bg-black pt-12 pb-20">
        <!-- Background atmosphere: glow, star field, and light trails -->
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(201,162,74,0.08),transparent_60%)]"
        />
        <div
            class="xies-starfield pointer-events-none absolute inset-0 opacity-80"
        />
        <div
            class="pointer-events-none absolute top-[8%] left-0 h-px w-1/3 rotate-[-8deg] bg-gradient-to-r from-transparent via-xies-gold/40 to-transparent"
        />
        <div
            class="pointer-events-none absolute right-0 bottom-[12%] h-px w-1/4 rotate-[10deg] bg-gradient-to-r from-transparent via-xies-goldlight/30 to-transparent"
        />

        <div class="relative mx-auto max-w-6xl px-6">
            <!-- Top tagline -->
            <p
                class="animate-slide-in-up text-center text-sm font-bold tracking-[0.3em] text-xies-gold uppercase"
                style="animation-delay: 0.1s"
            >
                The Premier Awards Show on the X Platform
            </p>

            <!-- Platform pillars strip -->
            <div
                class="animate-slide-in-up mt-5 flex flex-wrap items-center justify-center gap-x-8 gap-y-2"
                style="animation-delay: 0.15s"
            >
                <span
                    v-for="pillar in platformPillars"
                    :key="pillar.label"
                    class="flex items-center gap-1.5 text-xs font-bold tracking-widest text-white/50 uppercase"
                >
                    <component
                        :is="pillar.icon"
                        class="size-3.5 text-xies-gold"
                    />
                    {{ pillar.label }}
                </span>
            </div>

            <!-- Emblem + flanking callouts -->
            <div class="xies-hero-grid mt-10">
                <div
                    class="xies-hero-box-a animate-slide-in-left rounded-2xl border border-xies-gold/40 bg-xies-charcoal p-5 text-center sm:text-left"
                    style="animation-delay: 0.3s"
                >
                    <h3
                        class="text-xs font-black tracking-[0.2em] text-xies-goldlight uppercase"
                    >
                        Honoring
                    </h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-white/70">
                        Creators, broadcasters &amp; communities making an
                        impact on X.
                    </p>
                </div>
                <div
                    class="xies-hero-box-b animate-slide-in-left rounded-2xl border border-xies-gold/60 bg-xies-cream p-5 text-center text-xies-black sm:text-left"
                    style="animation-delay: 0.45s"
                >
                    <h3
                        class="text-xs font-black tracking-[0.2em] text-[#8A6B2B] uppercase"
                    >
                        What Are the Xies?
                    </h3>
                    <p class="mt-1.5 text-xs leading-relaxed">
                        The first awards program built entirely for X — every
                        voice, every format, every impact.
                    </p>
                </div>

                <div class="xies-hero-center">
                    <h1
                        class="animate-slide-in-up text-center text-lg font-black tracking-[0.35em] text-xies-gold uppercase"
                        style="animation-delay: 0.2s"
                    >
                        Jim Athans Xies Awards
                    </h1>

                    <div
                        class="animate-slide-in-up mt-4 flex justify-center"
                        style="animation-delay: 0.3s"
                    >
                        <img
                            src="/images/xies-hero-artwork.jpg"
                            alt="Nothing Is As Sexy As An XIE — five glamorous award recipients holding gold XIE Award microphone trophies"
                            class="w-full max-w-[512px] rounded-2xl border border-xies-gold/50 shadow-[0_0_60px_rgba(201,162,74,0.35)]"
                        />
                    </div>

                    <p
                        class="animate-slide-in-up mt-4 text-center text-xs tracking-[0.2em] text-white/40 uppercase"
                        style="animation-delay: 0.5s"
                    >
                        X Impact Awards &middot; Excellence in X Broadcasting
                    </p>
                </div>

                <div
                    class="xies-hero-box-c animate-slide-in-right rounded-2xl border border-xies-gold/60 bg-xies-charcoal p-5 text-center sm:text-left"
                    style="animation-delay: 0.45s"
                >
                    <div
                        class="flex items-center justify-center gap-1.5 sm:justify-start"
                    >
                        <span class="relative flex size-1.5">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-xies-gold opacity-75"
                            />
                            <span
                                class="relative inline-flex size-1.5 rounded-full bg-xies-goldlight"
                            />
                        </span>
                        <h3
                            class="text-xs font-black tracking-[0.2em] text-xies-goldlight uppercase"
                        >
                            Live on X — {{ dates.show }}
                        </h3>
                    </div>
                    <p class="mt-1.5 text-xs leading-relaxed text-white/70">
                        Celebrating excellence. Elevating every voice.
                    </p>
                </div>
                <div
                    class="xies-hero-box-d animate-slide-in-right rounded-2xl border border-xies-gold/40 bg-xies-charcoal p-5 text-center sm:text-left"
                    style="animation-delay: 0.6s"
                >
                    <h3
                        class="text-xs font-black tracking-[0.2em] text-xies-goldlight uppercase"
                    >
                        Who Can Enter?
                    </h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-white/70">
                        Anyone and everything one contributes to the X platform
                    </p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div
                class="animate-slide-in-up mt-10 flex flex-col gap-3 sm:flex-row sm:justify-center sm:gap-4"
                style="animation-delay: 0.8s"
            >
                <Link
                    href="/nominate"
                    class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-8 py-3.5 text-center text-base font-black tracking-wide text-xies-black uppercase shadow-[0_0_40px_rgba(201,162,74,0.4)] transition hover:shadow-[0_0_60px_rgba(201,162,74,0.6)] hover:brightness-110"
                >
                    Nominate Now
                </Link>
                <Link
                    href="/shop"
                    class="rounded-md border border-xies-gold/50 px-8 py-3.5 text-center text-base font-bold tracking-wide text-xies-goldlight uppercase transition hover:border-xies-gold hover:bg-xies-gold/10"
                >
                    Merchandise
                </Link>
                <Link
                    href="/trophies"
                    class="rounded-md border border-xies-gold/50 px-8 py-3.5 text-center text-base font-bold tracking-wide text-xies-goldlight uppercase transition hover:border-xies-gold hover:bg-xies-gold/10"
                >
                    Trophy Collection
                </Link>
            </div>

            <!-- Live badge -->
            <div
                class="animate-slide-in-up mt-8 flex justify-center"
                style="animation-delay: 0.9s"
            >
                <p
                    class="animate-glow inline-flex items-center gap-2 rounded-full border border-xies-gold/40 px-4 py-1.5 text-xs font-semibold tracking-widest text-xies-goldlight uppercase"
                >
                    <span class="relative flex size-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-xies-gold opacity-75"
                        />
                        <span
                            class="relative inline-flex size-2 rounded-full bg-xies-goldlight"
                        />
                    </span>
                    Live on X — {{ dates.show }}
                </p>
            </div>
        </div>
    </section>

    <!-- What are the Xies -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <div class="rounded-3xl bg-xies-cream p-8 text-xies-black sm:p-12">
            <h2
                class="text-center text-3xl font-black tracking-tight uppercase"
            >
                What Are the Xies?
            </h2>
            <p
                class="mx-auto mt-4 max-w-2xl text-center text-lg leading-relaxed font-semibold"
            >
                The first and only comprehensive awards program honoring
                excellence across all content, creators, and communities on the
                X platform.
            </p>
            <p
                class="mx-auto mt-3 max-w-2xl text-center leading-relaxed text-xies-black/70"
            >
                We recognize creators, broadcasters, podcasters, X Spaces hosts,
                independent journalists, entertainers, educators, and
                communities building conversations around the world.
            </p>

            <h3
                class="mt-10 text-sm font-black tracking-[0.2em] text-[#8A6B2B] uppercase"
            >
                We recognize excellence in:
            </h3>
            <ul
                class="mt-4 grid gap-x-8 gap-y-2.5 sm:grid-cols-2 lg:grid-cols-3"
            >
                <li
                    v-for="category in categories"
                    :key="category"
                    class="flex items-center gap-2.5 font-semibold"
                >
                    <span class="size-1.5 shrink-0 rounded-full bg-xies-gold" />
                    {{ category }}
                </li>
                <li class="flex items-center gap-2.5 font-semibold italic">
                    <span class="size-1.5 shrink-0 rounded-full bg-xies-gold" />
                    And So Much More!
                </li>
            </ul>
            <p class="mt-8 text-center font-semibold">
                These are our featured categories — see the
                <Link
                    href="/nominate"
                    class="font-black text-[#8A6B2B] underline underline-offset-4 transition hover:text-xies-black"
                    >complete list of additional categories</Link
                >
                on the Nomination page.
            </p>
        </div>
    </section>

    <!-- Who can enter -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl font-black tracking-tight uppercase">
                    Who Can Enter?
                </h2>
                <ul class="mt-6 space-y-4">
                    <li
                        v-for="item in eligibility"
                        :key="item"
                        class="flex items-start gap-3"
                    >
                        <CircleCheck
                            class="mt-0.5 size-5 shrink-0 text-xies-gold"
                        />
                        <span class="leading-relaxed text-white/80">{{
                            item
                        }}</span>
                    </li>
                </ul>
            </div>
            <div
                class="rounded-3xl border border-xies-gold/40 bg-xies-charcoal p-10 text-center"
            >
                <Trophy class="mx-auto size-12 text-xies-gold" />
                <ul
                    class="mx-auto mt-6 grid max-w-xs grid-cols-2 gap-x-8 gap-y-2 text-left"
                >
                    <li
                        v-for="type in entrantTypes"
                        :key="type"
                        class="flex items-center gap-2 text-sm font-semibold text-white/85"
                    >
                        <CircleCheck class="size-4 shrink-0 text-xies-gold" />
                        {{ type }}
                    </li>
                </ul>
                <p
                    class="mt-6 text-3xl leading-tight font-black tracking-tight text-xies-goldlight uppercase italic"
                >
                    If you've been on X, you belong here!
                </p>
                <p class="mt-4 text-sm tracking-widest text-white/50 uppercase">
                    Be seen. Be heard. Be celebrated.
                </p>
            </div>
        </div>
    </section>

    <!-- How to enter + fee -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <div class="grid gap-10 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <h2
                    class="animate-slide-in-left text-3xl font-black tracking-tight uppercase"
                >
                    How to Enter
                </h2>
                <ol class="mt-8 space-y-6">
                    <li
                        v-for="(step, index) in steps"
                        :key="step.title"
                        class="animate-slide-in-up flex items-start gap-4"
                        :style="{ animationDelay: `${0.1 * index}s` }"
                    >
                        <span
                            class="animate-glow flex size-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-b from-xies-goldlight to-xies-gold text-base font-black text-xies-black"
                        >
                            {{ index + 1 }}
                        </span>
                        <div>
                            <h3 class="font-bold tracking-wide uppercase">
                                {{ step.title }}
                            </h3>
                            <p
                                class="mt-1 text-sm leading-relaxed text-white/60"
                            >
                                {{ step.text }}
                            </p>
                        </div>
                    </li>
                </ol>
            </div>

            <div
                class="animate-slide-in-up animate-glow flex flex-col justify-center rounded-3xl border-2 border-xies-gold bg-xies-charcoal p-8 text-center"
            >
                <h3
                    class="text-sm font-black tracking-[0.25em] text-white/70 uppercase"
                >
                    Nomination Fee
                </h3>
                <p
                    class="animate-shimmer mt-4 text-7xl font-black text-transparent"
                    style="
                        background: linear-gradient(180deg, #f0cf72, #c9a24a);
                        -webkit-background-clip: text;
                        background-clip: text;
                    "
                >
                    ${{ fee }}
                </p>
                <p
                    class="mt-2 text-sm font-bold tracking-[0.2em] text-xies-goldlight uppercase"
                >
                    Per Nomination
                </p>
                <ul class="mt-6 space-y-1.5 text-sm text-white/60">
                    <li>All categories.</li>
                    <li>No early discounts.</li>
                    <li>One fee. One entry.</li>
                    <li class="font-semibold text-white/80">
                        Multiple categories allowed!
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Important dates -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <h2 class="text-3xl font-black tracking-tight uppercase">
            Important Dates
        </h2>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div
                class="animate-slide-in-up rounded-2xl border border-white/10 bg-xies-charcoal p-6 transition-colors duration-300 hover:border-xies-gold/50"
                :style="{ animationDelay: '0s' }"
            >
                <CalendarCheck class="size-7 text-xies-gold" />
                <p class="mt-4 text-lg font-black text-xies-goldlight">
                    {{ dates.nominations_open }}
                </p>
                <p class="mt-1 text-sm tracking-wide text-white/60 uppercase">
                    Nominations open &amp; voting begins
                </p>
            </div>
            <div
                class="animate-slide-in-up rounded-2xl border border-white/10 bg-xies-charcoal p-6 transition-colors duration-300 hover:border-xies-gold/50"
                :style="{ animationDelay: '0.1s' }"
            >
                <CalendarCheck
                    class="animate-spin-slow size-7 text-xies-gold"
                />
                <p class="mt-4 text-lg font-black text-xies-goldlight">
                    {{ dates.nominations_close }}
                </p>
                <p class="mt-1 text-sm tracking-wide text-white/60 uppercase">
                    Nominations close &amp; voting ends
                </p>
            </div>
            <div
                class="animate-slide-in-up rounded-2xl border border-xies-gold/50 bg-xies-charcoal p-6 transition-all duration-300 hover:border-xies-goldlight hover:shadow-[0_0_30px_rgba(240,207,114,0.3)]"
                :style="{ animationDelay: '0.2s' }"
            >
                <Trophy
                    class="animate-spin-slow size-7 text-xies-gold"
                    style="animation-delay: 0.5s"
                />
                <p class="mt-4 text-lg font-black text-xies-goldlight">
                    {{ dates.show }}
                </p>
                <p class="mt-1 text-sm tracking-wide text-white/60 uppercase">
                    The Jim Athans Xies Awards Show — live on X!
                </p>
            </div>
        </div>
        <p
            class="mt-6 rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm text-white/60"
        >
            <span class="font-bold text-xies-goldlight uppercase"
                >Eligibility period:</span
            >
            {{ dates.eligibility_start }} – {{ dates.eligibility_end }}. All
            shows and eligible content produced during 2026 may be nominated —
            including outstanding primary-season shows from before nominations
            open.
        </p>
    </section>

    <!-- CTA banner -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <div
            class="rounded-3xl bg-gradient-to-br from-xies-goldlight via-xies-gold to-[#a8853a] p-10 text-center text-xies-black shadow-xl transition-shadow duration-300 hover:shadow-2xl sm:p-14"
        >
            <h2
                class="text-3xl font-black tracking-tight uppercase sm:text-4xl"
            >
                Be Seen. Be Heard. Be Celebrated.
            </h2>
            <p class="mx-auto mt-4 max-w-2xl font-semibold">
                From comedy to commentary. From breaking news to gaming. From
                global voices to local heroes — there's a category for you.
            </p>
            <Link
                href="/nominate"
                class="mt-8 inline-block rounded-md bg-xies-black px-10 py-4 text-lg font-black tracking-wider text-xies-goldlight uppercase shadow-xl transition hover:scale-[1.02]"
            >
                Nominate Now!
            </Link>
            <p class="mt-4 text-xs font-black tracking-[0.25em] uppercase">
                Submit &bull; Pay &bull; Upload &bull; Get Recognized
            </p>
        </div>
    </section>

    <!-- Contact -->
    <section class="mx-auto max-w-6xl px-6 pb-24 text-center">
        <h2
            class="text-sm font-black tracking-[0.25em] text-white/60 uppercase"
        >
            Need Help? Contact Us!
        </h2>
        <div
            class="mt-4 flex flex-wrap items-center justify-center gap-x-10 gap-y-3"
        >
            <a
                v-for="phone in phones"
                :key="phone"
                :href="`tel:${phone}`"
                class="flex items-center gap-2 text-2xl font-black text-white transition hover:text-xies-goldlight"
            >
                <Phone class="size-5 text-xies-gold" />
                {{ phone }}
            </a>
        </div>
        <p class="mt-4 text-sm tracking-widest text-xies-gold/80 uppercase">
            {{ website }}
        </p>
    </section>
</template>

<style scoped>
/* Hero grid: emblem centered, callout boxes stack below on mobile and
   flank left/right on desktop without reordering the DOM. */
.xies-hero-grid {
    display: grid;
    grid-template-areas:
        'center'
        'a'
        'b'
        'c'
        'd';
    grid-template-columns: 1fr;
    align-items: center;
    gap: 1.25rem;
}

.xies-hero-box-a {
    grid-area: a;
}
.xies-hero-box-b {
    grid-area: b;
}
.xies-hero-box-c {
    grid-area: c;
}
.xies-hero-box-d {
    grid-area: d;
}
.xies-hero-center {
    grid-area: center;
}

@media (min-width: 1024px) {
    .xies-hero-grid {
        grid-template-areas: 'a center c' 'b center d';
        grid-template-columns: 220px 1fr 220px;
        grid-template-rows: auto auto;
        gap: 1.5rem 2.5rem;
    }
}
</style>
