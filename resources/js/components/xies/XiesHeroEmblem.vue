<script setup lang="ts">
// Marquee bulbs studding the outer edge of the ring.
const bulbCount = 22;
const bulbRadius = 48; // percent from center
const bulbs = Array.from({ length: bulbCount }, (_, i) => i);

function bulbStyle(i: number) {
    const angle = (i / bulbCount) * 360;
    const rad = (angle * Math.PI) / 180;
    const x = (50 + bulbRadius * Math.cos(rad)).toFixed(4);
    const y = (50 + bulbRadius * Math.sin(rad)).toFixed(4);

    return {
        left: `${x}%`,
        top: `${y}%`,
        animationDelay: `${(i % 6) * 0.25}s`,
    };
}

// Loose sparkle glints scattered around the emblem.
const sparkles = [
    { top: '2%', left: '20%', size: 16, delay: '0s' },
    { top: '8%', left: '85%', size: 11, delay: '0.5s' },
    { top: '34%', left: '1%', size: 13, delay: '1s' },
    { top: '90%', left: '9%', size: 10, delay: '1.4s' },
    { top: '95%', left: '80%', size: 14, delay: '0.7s' },
    { top: '58%', left: '98%', size: 9, delay: '1.8s' },
    { top: '0%', left: '52%', size: 12, delay: '1.1s' },
    { top: '72%', left: '93%', size: 10, delay: '0.3s' },
];

const marqueeChase =
    'background: conic-gradient(from 0deg, transparent 0deg, rgba(240,207,114,0.95) 7deg, transparent 16deg, transparent 84deg, rgba(240,207,114,0.65) 91deg, transparent 100deg, transparent 174deg, rgba(240,207,114,0.95) 181deg, transparent 190deg, transparent 264deg, rgba(240,207,114,0.65) 271deg, transparent 280deg, transparent 360deg);' +
    '-webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 4px));' +
    'mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 4px));';
</script>

<template>
    <div
        class="relative mx-auto aspect-square w-full max-w-[340px] pointer-events-none sm:max-w-[420px] lg:max-w-[480px]"
    >
        <!-- ambient glow -->
        <div
            class="absolute inset-[-15%] rounded-full bg-[radial-gradient(circle,rgba(201,162,74,0.4),transparent_65%)] blur-2xl"
        />

        <!-- rotating marquee chase ring -->
        <div class="absolute inset-0 rounded-full animate-spin-slow" :style="marqueeChase" />

        <!-- static definition rings -->
        <div
            class="absolute inset-[5%] rounded-full border border-xies-gold/50 shadow-[0_0_50px_rgba(201,162,74,0.4)]"
        />
        <div
            class="absolute inset-[9%] rounded-full border border-xies-goldlight/25 animate-spin-slow-reverse"
        />

        <!-- marquee bulbs -->
        <span
            v-for="i in bulbs"
            :key="`bulb-${i}`"
            class="absolute size-[5px] rounded-full bg-xies-goldlight shadow-[0_0_6px_2px_rgba(240,207,114,0.75)] animate-twinkle"
            :style="bulbStyle(i)"
        />

        <!-- scattered sparkles -->
        <svg
            v-for="(s, i) in sparkles"
            :key="`sparkle-${i}`"
            viewBox="0 0 24 24"
            class="absolute fill-xies-goldlight animate-twinkle"
            :style="{
                top: s.top,
                left: s.left,
                width: `${s.size}px`,
                height: `${s.size}px`,
                animationDelay: s.delay,
            }"
        >
            <path
                d="M12 0 L14.5 9.5 L24 12 L14.5 14.5 L12 24 L9.5 14.5 L0 12 L9.5 9.5 Z"
            />
        </svg>

        <!-- light trail streaks -->
        <div
            class="absolute top-[14%] left-[8%] h-px w-2/5 rotate-[-30deg] bg-gradient-to-r from-transparent via-xies-goldlight/90 to-transparent"
        />
        <div
            class="absolute right-[10%] bottom-[18%] h-px w-1/3 rotate-[22deg] bg-gradient-to-r from-transparent via-xies-gold/70 to-transparent"
        />

        <!-- trophy -->
        <div class="absolute inset-0 flex items-center justify-center">
            <img
                src="/images/xies-trophy.png"
                alt="The Jim Athans Xies Awards golden microphone and X trophy"
                class="h-[72%] w-auto animate-float-pulse drop-shadow-[0_0_70px_rgba(201,162,74,0.55)]"
            />
        </div>
    </div>
</template>
