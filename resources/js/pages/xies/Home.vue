<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    CalendarCheck,
    CircleCheck,
    Phone,
    Trophy,
} from '@lucide/vue';
import { onMounted } from 'vue';

defineProps<{
    fee: number;
    phones: string[];
    website: string;
    dates: {
        nominations_open: string;
        nominations_close: string;
        show: string;
    };
    categories: string[];
}>();

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
        { threshold: 0.1 }
    );

    // Observe all sections with scroll-animate class
    document.querySelectorAll('[data-scroll-animate]').forEach((el) => {
        observer.observe(el);
    });
});
</script>

<template>
    <Head title="The X Impact Awards" />

    <!-- Hero - Glamorous Centered Trophy -->
    <section class="relative overflow-hidden bg-black pt-12 pb-20">
        <!-- Background sparkles and stars -->
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(201,162,74,0.08),transparent_60%)]" />

        <div class="mx-auto max-w-4xl px-6">
            <!-- Top tagline -->
            <p
                class="text-center text-sm font-bold tracking-[0.3em] text-xies-gold uppercase animate-slide-in-up"
                style="animation-delay: 0.1s"
            >
                The Premier Awards Show on the X Platform
            </p>

            <!-- JIM ATHANS -->
            <p
                class="text-center mt-6 text-xl font-black tracking-widest text-xies-gold uppercase animate-slide-in-up"
                style="animation-delay: 0.2s"
            >
                JIM ATHANS
            </p>

            <!-- Trophy - CENTERED HERO -->
            <div
                class="relative mx-auto mt-8 mb-8 w-full max-w-xs animate-slide-in-up"
                style="animation-delay: 0.3s"
            >
                <img
                    src="/images/xies-full-logo.png"
                    alt="The Jim Athans Xies Awards golden microphone trophy"
                    class="w-full animate-float-pulse drop-shadow-[0_0_120px_rgba(201,162,74,0.4)]"
                />
            </div>

            <!-- XIES (large centered) -->
            <h1
                class="text-center text-7xl sm:text-8xl font-black tracking-tight italic text-transparent bg-gradient-to-b from-xies-goldlight via-xies-gold to-xies-gold bg-clip-text animate-slide-in-up"
                style="animation-delay: 0.4s; line-height: 0.9"
            >
                XIES
            </h1>

            <!-- X IMPACT AWARDS -->
            <p
                class="text-center mt-2 text-sm font-bold tracking-widest text-xies-goldlight uppercase animate-slide-in-up"
                style="animation-delay: 0.5s"
            >
                X Impact Awards
            </p>
            <p
                class="text-center text-xs tracking-[0.2em] text-white/40 uppercase animate-slide-in-up"
                style="animation-delay: 0.6s"
            >
                Excellence in X Broadcasting
            </p>

            <!-- Info boxes row -->
            <div
                class="grid gap-6 mt-10 md:grid-cols-2 lg:gap-10 animate-slide-in-up"
                style="animation-delay: 0.7s"
            >
                <!-- Left box: What are the Xies -->
                <div class="rounded-2xl border border-xies-gold/60 bg-xies-cream p-6 text-xies-black text-center md:text-left">
                    <h3 class="font-bold text-sm tracking-widest uppercase text-[#8A6B2B]">What Are the Xies?</h3>
                    <p class="mt-2 text-sm leading-relaxed">
                        The first and only comprehensive awards program honoring excellence across all content, creators, and communities on the X platform.
                    </p>
                    <p class="mt-3 text-xs font-bold tracking-widest text-[#8A6B2B] uppercase">We recognize:</p>
                    <ul class="mt-2 text-xs space-y-1">
                        <li>✓ News & Journalism</li>
                        <li>✓ Comedy & Entertainment</li>
                        <li>✓ Sports & Gaming</li>
                        <li>✓ And 14+ more categories</li>
                    </ul>
                </div>

                <!-- Right box: Who can enter -->
                <div class="rounded-2xl border border-xies-gold/60 bg-xies-charcoal p-6 text-center md:text-left">
                    <h3 class="font-bold text-sm tracking-widest uppercase text-xies-goldlight">Who Can Enter?</h3>
                    <ul class="mt-3 space-y-2 text-sm text-white/80">
                        <li class="flex items-start gap-2">
                            <span class="text-xies-gold mt-1">✓</span>
                            <span>Anyone who creates or hosts on X Spaces, X Live, or any broadcast format</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-xies-gold mt-1">✓</span>
                            <span>Self-nominate or be nominated by your community</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-xies-gold mt-1">✓</span>
                            <span>All countries, languages, and topics</span>
                        </li>
                    </ul>
                    <p class="mt-4 text-lg font-black text-xies-goldlight italic">
                        If you broadcast on X,<br />you belong here!
                    </p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col gap-3 mt-10 sm:flex-row sm:gap-4 sm:justify-center animate-slide-in-up" style="animation-delay: 0.8s">
                <Link
                    href="/nominate"
                    class="rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-8 py-3.5 text-base font-black tracking-wide text-xies-black uppercase shadow-[0_0_40px_rgba(201,162,74,0.4)] transition hover:brightness-110 hover:shadow-[0_0_60px_rgba(201,162,74,0.6)]"
                >
                    Nominate Now
                </Link>
                <Link
                    href="/shop"
                    class="rounded-md border border-xies-gold/50 px-8 py-3.5 text-base font-bold tracking-wide text-xies-goldlight uppercase transition hover:bg-xies-gold/10 hover:border-xies-gold"
                >
                    Visit Shop
                </Link>
            </div>

            <!-- Live badge -->
            <div class="flex justify-center mt-8 animate-slide-in-up" style="animation-delay: 0.9s">
                <p
                    class="inline-flex items-center gap-2 rounded-full border border-xies-gold/40 px-4 py-1.5 text-xs font-semibold tracking-widest text-xies-goldlight uppercase animate-glow"
                >
                    <span class="relative flex size-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-xies-gold opacity-75" />
                        <span class="relative inline-flex size-2 rounded-full bg-xies-goldlight" />
                    </span>
                    Live on X — {{ dates.show }}
                </p>
            </div>

            <!-- "Nothing Is as Sexy as an XIE" Slogan -->
            <div class="mt-14 text-center animate-slide-in-up" style="animation-delay: 1.0s">
                <p class="text-4xl sm:text-5xl font-black tracking-tight italic text-transparent bg-gradient-to-r from-xies-goldlight via-xies-gold to-xies-goldlight bg-clip-text">
                    Nothing Is as Sexy<br />as an <span class="text-6xl sm:text-7xl">XIE</span>
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
                The first and only comprehensive awards program honoring excellence across all content, creators, and communities on the X platform.
            </p>
            <p
                class="mx-auto mt-3 max-w-2xl text-center leading-relaxed text-xies-black/70"
            >
                We recognize creators, broadcasters, podcasters, X Spaces hosts, independent journalists, entertainers, educators, and communities building conversations around the world.
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
                    If you broadcast on X, you belong here!
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
                <h2 class="text-3xl font-black tracking-tight uppercase animate-slide-in-left">
                    How to Enter
                </h2>
                <ol class="mt-8 space-y-6">
                    <li
                        v-for="(step, index) in steps"
                        :key="step.title"
                        class="flex items-start gap-4 animate-slide-in-up"
                        :style="{ animationDelay: `${0.1 * index}s` }"
                    >
                        <span
                            class="flex size-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-b from-xies-goldlight to-xies-gold text-base font-black text-xies-black animate-glow"
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
                class="flex flex-col justify-center rounded-3xl border-2 border-xies-gold bg-xies-charcoal p-8 text-center animate-slide-in-up animate-glow"
            >
                <h3
                    class="text-sm font-black tracking-[0.25em] text-white/70 uppercase"
                >
                    Nomination Fee
                </h3>
                <p
                    class="mt-4 text-7xl font-black text-transparent animate-shimmer"
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
                class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 animate-slide-in-up hover:border-xies-gold/50 transition-colors duration-300"
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
                class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 animate-slide-in-up hover:border-xies-gold/50 transition-colors duration-300"
                :style="{ animationDelay: '0.1s' }"
            >
                <CalendarCheck class="size-7 text-xies-gold animate-spin-slow" />
                <p class="mt-4 text-lg font-black text-xies-goldlight">
                    {{ dates.nominations_close }}
                </p>
                <p class="mt-1 text-sm tracking-wide text-white/60 uppercase">
                    Nominations close &amp; voting ends
                </p>
            </div>
            <div
                class="rounded-2xl border border-xies-gold/50 bg-xies-charcoal p-6 animate-slide-in-up hover:border-xies-goldlight hover:shadow-[0_0_30px_rgba(240,207,114,0.3)] transition-all duration-300"
                :style="{ animationDelay: '0.2s' }"
            >
                <Trophy class="size-7 text-xies-gold animate-spin-slow" style="animation-delay: 0.5s" />
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
            {{ dates.nominations_open }} – {{ dates.nominations_close }}.
            Includes all shows, Spaces, and broadcasts during this time.
        </p>
    </section>

    <!-- CTA banner -->
    <section class="mx-auto max-w-6xl px-6 pb-20" data-scroll-animate>
        <div
            class="rounded-3xl bg-gradient-to-br from-xies-goldlight via-xies-gold to-[#a8853a] p-10 text-center text-xies-black sm:p-14 shadow-xl hover:shadow-2xl transition-shadow duration-300"
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
