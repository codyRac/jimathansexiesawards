<template>
    <svg
        viewBox="0 0 360 440"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        role="img"
        aria-label="The Xies golden microphone trophy"
    >
        <defs>
            <radialGradient id="xiesGlow" cx="0.5" cy="0.42" r="0.55">
                <stop stop-color="#C9A24A" stop-opacity="0.45" />
                <stop offset="0.6" stop-color="#C9A24A" stop-opacity="0.12" />
                <stop offset="1" stop-color="#C9A24A" stop-opacity="0" />
            </radialGradient>
            <linearGradient
                id="xiesGoldV"
                x1="180"
                y1="40"
                x2="180"
                y2="280"
                gradientUnits="userSpaceOnUse"
            >
                <stop stop-color="#F0CF72" />
                <stop offset="0.45" stop-color="#C9A24A" />
                <stop offset="1" stop-color="#7d5f24" />
            </linearGradient>
            <linearGradient
                id="xiesGoldH"
                x1="120"
                y1="0"
                x2="240"
                y2="0"
                gradientUnits="userSpaceOnUse"
            >
                <stop stop-color="#8A6B2B" />
                <stop offset="0.35" stop-color="#F0CF72" />
                <stop offset="0.65" stop-color="#C9A24A" />
                <stop offset="1" stop-color="#7d5f24" />
            </linearGradient>
            <linearGradient
                id="xiesXGold"
                x1="60"
                y1="120"
                x2="300"
                y2="330"
                gradientUnits="userSpaceOnUse"
            >
                <stop stop-color="#F0CF72" />
                <stop offset="1" stop-color="#8A6B2B" />
            </linearGradient>
            <clipPath id="xiesMicBody">
                <rect x="138" y="52" width="84" height="128" rx="42" />
            </clipPath>
        </defs>

        <!-- ambient glow + halo ring -->
        <circle cx="180" cy="185" r="175" fill="url(#xiesGlow)" />
        <circle
            cx="180"
            cy="180"
            r="128"
            stroke="#C9A24A"
            stroke-opacity="0.35"
            stroke-width="1.5"
        />
        <circle
            cx="180"
            cy="180"
            r="140"
            stroke="#C9A24A"
            stroke-opacity="0.15"
            stroke-width="1"
        />

        <!-- X letterform behind the microphone -->
        <path
            d="M96 120h34l50 74 50-74h34l-66 98 66 98h-34l-50-74-50 74H96l66-98-66-98Z"
            fill="url(#xiesXGold)"
            opacity="0.35"
        />

        <!-- microphone body -->
        <rect
            x="138"
            y="52"
            width="84"
            height="128"
            rx="42"
            fill="url(#xiesGoldV)"
        />
        <g
            clip-path="url(#xiesMicBody)"
            stroke="#070707"
            stroke-opacity="0.35"
            stroke-width="2"
        >
            <line x1="130" y1="70" x2="230" y2="70" />
            <line x1="130" y1="82" x2="230" y2="82" />
            <line x1="130" y1="94" x2="230" y2="94" />
            <line x1="130" y1="106" x2="230" y2="106" />
            <line x1="130" y1="118" x2="230" y2="118" />
            <line x1="130" y1="130" x2="230" y2="130" />
            <line x1="130" y1="142" x2="230" y2="142" />
            <line x1="130" y1="154" x2="230" y2="154" />
            <line x1="130" y1="166" x2="230" y2="166" />
        </g>
        <ellipse
            cx="162"
            cy="78"
            rx="14"
            ry="24"
            fill="#FFF6DC"
            opacity="0.35"
        />

        <!-- yoke -->
        <path
            d="M126 128v18c0 34 22 54 54 54s54-20 54-54v-18"
            stroke="url(#xiesGoldH)"
            stroke-width="10"
            stroke-linecap="round"
            fill="none"
        />

        <!-- stem and collar -->
        <rect x="174" y="204" width="12" height="52" fill="url(#xiesGoldH)" />
        <rect
            x="166"
            y="252"
            width="28"
            height="10"
            rx="4"
            fill="url(#xiesGoldH)"
        />

        <!-- pedestal -->
        <rect
            x="118"
            y="262"
            width="124"
            height="26"
            rx="6"
            fill="#151515"
            stroke="#C9A24A"
            stroke-opacity="0.6"
        />
        <rect
            x="100"
            y="288"
            width="160"
            height="30"
            rx="6"
            fill="#0d0d0d"
            stroke="#C9A24A"
            stroke-opacity="0.45"
        />
        <rect
            x="82"
            y="318"
            width="196"
            height="36"
            rx="8"
            fill="#151515"
            stroke="#C9A24A"
            stroke-opacity="0.6"
        />
        <text
            x="180"
            y="342"
            text-anchor="middle"
            fill="#F0CF72"
            font-size="17"
            font-weight="700"
            letter-spacing="7"
            font-family="inherit"
        >
            XIES
        </text>

        <!-- sparkles -->
        <path
            d="M76 84l3.2 8.8L88 96l-8.8 3.2L76 108l-3.2-8.8L64 96l8.8-3.2L76 84Z"
            fill="#F0CF72"
            opacity="0.9"
        />
        <path
            d="M288 132l2.4 6.6 6.6 2.4-6.6 2.4-2.4 6.6-2.4-6.6-6.6-2.4 6.6-2.4 2.4-6.6Z"
            fill="#F0CF72"
            opacity="0.7"
        />
        <path
            d="M262 52l2 5.5 5.5 2-5.5 2-2 5.5-2-5.5-5.5-2 5.5-2 2-5.5Z"
            fill="#F0CF72"
            opacity="0.6"
        />
        <path
            d="M94 220l2 5.5 5.5 2-5.5 2-2 5.5-2-5.5-5.5-2 5.5-2 2-5.5Z"
            fill="#F0CF72"
            opacity="0.5"
        />
    </svg>
</template>
