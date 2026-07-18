<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import {
    ChevronDown,
    CreditCard,
    ExternalLink,
    Paperclip,
    Phone,
    Upload,
    X,
} from '@lucide/vue';
import { computed } from 'vue';
import InputError from '@/components/InputError.vue';

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
    categories: string[];
    categoryGroups: { label: string; categories: string[] }[];
    paypalUrl: string | null;
    stripeUrl: string | null;
}>();

const form = useForm({
    nominator_name: '',
    nominator_email: '',
    nominator_phone: '',
    nominator_x_handle: '',
    self_nomination: false,
    nominee_name: '',
    nominee_x_handle: '',
    show_name: '',
    categories: [] as string[],
    reason: '',
    links: '',
    attachments: [] as File[],
    payment_method: 'paypal' as 'paypal' | 'card',
    payment_reference: '',
    terms: false,
});

const total = computed(() => form.categories.length * props.fee);

const selectedInGroup = (categories: string[]) =>
    form.categories.filter((category) => categories.includes(category)).length;

const attachmentErrors = computed(() => {
    const errors = form.errors as Record<string, string>;

    return Object.keys(errors)
        .filter(
            (key) => key === 'attachments' || key.startsWith('attachments.'),
        )
        .map((key) => errors[key]);
});

const onSelfNomination = () => {
    if (form.self_nomination) {
        form.nominee_name = form.nominator_name;
        form.nominee_x_handle = form.nominator_x_handle;
    }
};

const onFilesSelected = (event: Event) => {
    const input = event.target as HTMLInputElement;
    form.attachments = [
        ...form.attachments,
        ...Array.from(input.files ?? []),
    ].slice(0, 5);
    input.value = '';
};

const removeFile = (index: number) => {
    form.attachments = form.attachments.filter((_, i) => i !== index);
};

const formatSize = (bytes: number) => {
    if (bytes >= 1024 * 1024) {
        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    }

    return `${Math.max(1, Math.round(bytes / 1024))} KB`;
};

const submit = () => {
    form.post('/nominate', { forceFormData: true, preserveScroll: true });
};

const inputClass =
    'w-full rounded-md border border-white/15 bg-white/5 px-3.5 py-2.5 text-sm text-white placeholder-white/30 transition focus:border-xies-gold focus:ring-1 focus:ring-xies-gold focus:outline-none';

const labelClass =
    'mb-1.5 block text-xs font-bold tracking-widest text-white/70 uppercase';
</script>

<template>
    <Head title="Submit Your Nomination" />

    <section class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(201,162,74,0.1),transparent_50%)]"
        />
        <div class="mx-auto max-w-3xl px-6 py-14 text-center">
            <p
                class="text-sm font-bold tracking-[0.25em] text-xies-gold uppercase"
            >
                Nominate Now
            </p>
            <h1 class="mt-3 text-4xl font-black tracking-tight uppercase">
                Submit &bull; Pay &bull; Upload &bull;
                <span
                    class="bg-gradient-to-r from-xies-goldlight to-xies-gold bg-clip-text text-transparent"
                    >Get Recognized</span
                >
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-white/60">
                The Xies recognize outstanding podcasts, X Spaces, livestreams,
                interviews, journalism, commentary, education, and online media
                — while helping creators expand their audience and footprint.
            </p>
            <p class="mx-auto mt-3 max-w-2xl text-white/60">
                ${{ fee }} per nomination, all categories. No early-entry
                discounts.
            </p>
            <div
                class="mx-auto mt-6 max-w-2xl rounded-xl border border-xies-gold/30 bg-xies-charcoal px-5 py-4 text-left text-sm leading-relaxed text-white/70"
            >
                <p>
                    <span class="font-bold text-xies-goldlight uppercase"
                        >Important dates:</span
                    >
                    All shows and eligible content produced
                    {{ dates.eligibility_start }} through
                    {{ dates.eligibility_end }} may be nominated. Nominations
                    and voting open {{ dates.nominations_open }} — immediately
                    after the June 2 primaries, so outstanding primary-season
                    shows are included — and both remain open through
                    {{ dates.nominations_close }}. The awards are presented on
                    New Year's Eve, live on X.
                </p>
            </div>
        </div>
    </section>

    <form
        class="mx-auto max-w-3xl space-y-8 px-6 pb-24"
        @submit.prevent="submit"
    >
        <!-- Nominator -->
        <fieldset
            class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 sm:p-8"
        >
            <legend
                class="px-2 text-sm font-black tracking-[0.2em] text-xies-goldlight uppercase"
            >
                1. About You
            </legend>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="nominator_name" :class="labelClass"
                        >Your Name *</label
                    >
                    <input
                        id="nominator_name"
                        v-model="form.nominator_name"
                        type="text"
                        :class="inputClass"
                        autocomplete="name"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominator_name"
                    />
                </div>
                <div>
                    <label for="nominator_email" :class="labelClass"
                        >Your Email *</label
                    >
                    <input
                        id="nominator_email"
                        v-model="form.nominator_email"
                        type="email"
                        :class="inputClass"
                        autocomplete="email"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominator_email"
                    />
                </div>
                <div>
                    <label for="nominator_phone" :class="labelClass"
                        >Your Phone (Optional)</label
                    >
                    <input
                        id="nominator_phone"
                        v-model="form.nominator_phone"
                        type="tel"
                        :class="inputClass"
                        autocomplete="tel"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominator_phone"
                    />
                </div>
                <div>
                    <label for="nominator_x_handle" :class="labelClass"
                        >Your X Handle</label
                    >
                    <input
                        id="nominator_x_handle"
                        v-model="form.nominator_x_handle"
                        type="text"
                        placeholder="@yourhandle"
                        :class="inputClass"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominator_x_handle"
                    />
                </div>
                <label
                    class="flex items-center gap-3 self-end pb-2.5 text-sm text-white/80"
                >
                    <input
                        v-model="form.self_nomination"
                        type="checkbox"
                        class="size-4 accent-xies-gold"
                        @change="onSelfNomination"
                    />
                    I'm nominating myself
                </label>
            </div>
        </fieldset>

        <!-- Nominee -->
        <fieldset
            class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 sm:p-8"
        >
            <legend
                class="px-2 text-sm font-black tracking-[0.2em] text-xies-goldlight uppercase"
            >
                2. The Nominee
            </legend>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="nominee_name" :class="labelClass"
                        >Nominee Name *</label
                    >
                    <input
                        id="nominee_name"
                        v-model="form.nominee_name"
                        type="text"
                        :class="inputClass"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominee_name"
                    />
                </div>
                <div>
                    <label for="nominee_x_handle" :class="labelClass"
                        >Nominee X Handle *</label
                    >
                    <input
                        id="nominee_x_handle"
                        v-model="form.nominee_x_handle"
                        type="text"
                        placeholder="@handle"
                        :class="inputClass"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.nominee_x_handle"
                    />
                </div>
                <div class="sm:col-span-2">
                    <label for="show_name" :class="labelClass"
                        >Show / Space / Broadcast Name</label
                    >
                    <input
                        id="show_name"
                        v-model="form.show_name"
                        type="text"
                        :class="inputClass"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.show_name"
                    />
                </div>
            </div>
        </fieldset>

        <!-- Categories -->
        <fieldset
            class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 sm:p-8"
        >
            <legend
                class="px-2 text-sm font-black tracking-[0.2em] text-xies-goldlight uppercase"
            >
                3. Categories
            </legend>
            <p class="mb-4 text-sm text-white/50">
                ${{ fee }} per category entry — select every category where the
                nominee deserves recognition. Any show's outstanding guests may
                be nominated in whatever category is appropriate.
            </p>

            <h3
                class="mb-3 text-xs font-black tracking-[0.2em] text-white/60 uppercase"
            >
                Featured Categories
            </h3>
            <div class="grid gap-2.5 sm:grid-cols-2">
                <label
                    v-for="category in categories"
                    :key="category"
                    class="flex cursor-pointer items-center gap-3 rounded-lg border px-3.5 py-2.5 text-sm font-medium transition"
                    :class="
                        form.categories.includes(category)
                            ? 'border-xies-gold bg-xies-gold/10 text-xies-goldlight'
                            : 'border-white/10 text-white/75 hover:border-white/25'
                    "
                >
                    <input
                        v-model="form.categories"
                        type="checkbox"
                        :value="category"
                        class="size-4 accent-xies-gold"
                    />
                    {{ category }}
                </label>
            </div>

            <h3
                class="mt-8 text-xl text-bold font-black tracking-[0.2em] text-white uppercase"
            >
                Additional Categories
            </h3>
            <p class="mt-1.5 mb-3 text-sm text-white/50">
                Open a group to browse the complete list.
            </p>
            <div class="space-y-3">
                <details
                    v-for="group in categoryGroups"
                    :key="group.label"
                    class="group rounded-xl border border-white/10 bg-white/[0.03] open:border-xies-gold/40"
                >
                    <summary
                        class="flex cursor-pointer items-center justify-between gap-3 px-4 py-3.5 select-none"
                    >
                        <span
                            class="text-sm font-bold tracking-wide text-white/85 uppercase"
                        >
                            {{ group.label }}
                        </span>
                        <span class="flex items-center gap-3">
                            <span
                                v-if="selectedInGroup(group.categories)"
                                class="rounded-full bg-xies-gold/15 px-2.5 py-0.5 text-xs font-bold text-xies-goldlight"
                            >
                                {{ selectedInGroup(group.categories) }} selected
                            </span>
                            <ChevronDown
                                class="size-4 shrink-0 text-xies-gold transition-transform group-open:rotate-180"
                            />
                        </span>
                    </summary>
                    <div class="grid gap-2.5 px-4 pb-4 sm:grid-cols-2">
                        <label
                            v-for="category in group.categories"
                            :key="category"
                            class="flex cursor-pointer items-center gap-3 rounded-lg border px-3.5 py-2.5 text-sm font-medium transition"
                            :class="
                                form.categories.includes(category)
                                    ? 'border-xies-gold bg-xies-gold/10 text-xies-goldlight'
                                    : 'border-white/10 text-white/75 hover:border-white/25'
                            "
                        >
                            <input
                                v-model="form.categories"
                                type="checkbox"
                                :value="category"
                                class="size-4 accent-xies-gold"
                            />
                            {{ category }}
                        </label>
                    </div>
                </details>
            </div>
            <InputError class="mt-3" :message="form.errors.categories" />
        </fieldset>

        <!-- Your case -->
        <fieldset
            class="rounded-2xl border border-white/10 bg-xies-charcoal p-6 sm:p-8"
        >
            <legend
                class="px-2 text-sm font-black tracking-[0.2em] text-xies-goldlight uppercase"
            >
                4. Make Your Case
            </legend>
            <div class="space-y-5">
                <div>
                    <label for="reason" :class="labelClass"
                        >Why does this nominee deserve to be recognized?
                        *</label
                    >
                    <textarea
                        id="reason"
                        v-model="form.reason"
                        rows="6"
                        :class="inputClass"
                        placeholder="Tell us about the impact, the audience, the moments that mattered..."
                    />
                    <InputError class="mt-1.5" :message="form.errors.reason" />
                </div>
                <div>
                    <label for="links" :class="labelClass"
                        >Supporting Links (one per line)</label
                    >
                    <textarea
                        id="links"
                        v-model="form.links"
                        rows="3"
                        :class="inputClass"
                        placeholder="Links to Spaces, broadcasts, clips, posts..."
                    />
                    <InputError class="mt-1.5" :message="form.errors.links" />
                </div>
                <div>
                    <span :class="labelClass">Supporting Files</span>
                    <label
                        class="flex cursor-pointer flex-col items-center gap-2 rounded-lg border border-dashed border-white/20 px-6 py-8 text-center transition hover:border-xies-gold/60"
                    >
                        <Upload class="size-6 text-xies-gold" />
                        <span class="text-sm text-white/70"
                            >Click to add video, audio, image, or PDF
                            evidence</span
                        >
                        <span class="text-xs text-white/40"
                            >Up to 5 files, 50MB each (mp4, mov, mp3, m4a, wav,
                            png, jpg, pdf)</span
                        >
                        <input
                            type="file"
                            multiple
                            class="hidden"
                            accept=".mp4,.mov,.m4v,.mp3,.m4a,.wav,.aac,.png,.jpg,.jpeg,.webp,.pdf"
                            @change="onFilesSelected"
                        />
                    </label>
                    <ul v-if="form.attachments.length" class="mt-3 space-y-2">
                        <li
                            v-for="(file, index) in form.attachments"
                            :key="`${file.name}-${index}`"
                            class="flex items-center justify-between gap-3 rounded-md border border-white/10 bg-white/5 px-3 py-2 text-sm"
                        >
                            <span class="flex min-w-0 items-center gap-2">
                                <Paperclip
                                    class="size-4 shrink-0 text-xies-gold"
                                />
                                <span class="truncate text-white/80">{{
                                    file.name
                                }}</span>
                                <span class="shrink-0 text-xs text-white/40">{{
                                    formatSize(file.size)
                                }}</span>
                            </span>
                            <button
                                type="button"
                                class="text-white/40 transition hover:text-white"
                                :aria-label="`Remove ${file.name}`"
                                @click="removeFile(index)"
                            >
                                <X class="size-4" />
                            </button>
                        </li>
                    </ul>
                    <InputError
                        v-for="(error, index) in attachmentErrors"
                        :key="index"
                        class="mt-1.5"
                        :message="error"
                    />
                    <p class="mt-2 text-xs text-white/40">
                        Full-length shows too big to upload? Paste links above
                        instead — we review linked broadcasts too.
                    </p>
                </div>
            </div>
        </fieldset>

        <!-- Payment -->
        <fieldset
            class="rounded-2xl border-2 border-xies-gold/70 bg-xies-charcoal p-6 sm:p-8"
        >
            <legend
                class="px-2 text-sm font-black tracking-[0.2em] text-xies-goldlight uppercase"
            >
                5. Nomination Fee
            </legend>

            <div class="flex flex-wrap items-baseline justify-between gap-2">
                <p class="text-sm text-white/60">
                    {{ form.categories.length || 'No' }} categor{{
                        form.categories.length === 1 ? 'y' : 'ies'
                    }}
                    selected &times; ${{ fee }}
                </p>
                <p class="text-4xl font-black text-xies-goldlight">
                    {{ total > 0 ? `$${total}` : '—' }}
                </p>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <a
                    v-if="paypalUrl"
                    :href="paypalUrl"
                    target="_blank"
                    rel="noopener"
                    class="flex items-center justify-center gap-2 rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-5 py-3 text-sm font-black tracking-wide text-xies-black uppercase transition hover:brightness-110"
                >
                    <ExternalLink class="size-4" />
                    Pay with PayPal
                </a>
                <div
                    v-else
                    class="flex items-center justify-center gap-2 rounded-md border border-white/15 px-5 py-3 text-sm font-bold tracking-wide text-white/40 uppercase"
                >
                    PayPal link
                </div>
                <a
                    v-if="stripeUrl"
                    :href="stripeUrl"
                    target="_blank"
                    rel="noopener"
                    class="flex items-center justify-center gap-2 rounded-md border border-xies-gold px-5 py-3 text-sm font-black tracking-wide text-xies-goldlight uppercase transition hover:bg-xies-gold/10"
                >
                    <CreditCard class="size-4" />
                    Stripe Link
                </a>
                <div
                    v-else
                    class="flex items-center justify-center gap-2 rounded-md border border-white/15 px-5 py-3 text-sm font-bold tracking-wide text-white/40 uppercase"
                >
                    <CreditCard class="size-4" />
                    Stripe Link
                </div>
            </div>

            <p
                v-if="!paypalUrl && !stripeUrl"
                class="mt-3 flex items-center gap-2 text-xs text-white/50"
            >
                <Phone class="size-3.5 text-xies-gold" />
                Call {{ phones.join(' or ') }} to pay by phone.
            </p>

            <div class="mt-6 grid gap-5 sm:grid-cols-2">
                <div>
                    <span :class="labelClass">How did you pay? *</span>
                    <div class="flex gap-5 pt-2">
                        <label
                            class="flex items-center gap-2 text-sm text-white/80"
                        >
                            <input
                                v-model="form.payment_method"
                                type="radio"
                                value="paypal"
                                class="size-4 accent-xies-gold"
                            />
                            PayPal
                        </label>
                        <label
                            class="flex items-center gap-2 text-sm text-white/80"
                        >
                            <input
                                v-model="form.payment_method"
                                type="radio"
                                value="card"
                                class="size-4 accent-xies-gold"
                            />
                            Stripe
                        </label>
                    </div>
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.payment_method"
                    />
                </div>
                <div>
                    <label for="payment_reference" :class="labelClass"
                        >Transaction / Receipt Number</label
                    >
                    <input
                        id="payment_reference"
                        v-model="form.payment_reference"
                        type="text"
                        :class="inputClass"
                        placeholder="e.g. PayPal transaction ID"
                    />
                    <InputError
                        class="mt-1.5"
                        :message="form.errors.payment_reference"
                    />
                </div>
            </div>

            <p class="mt-4 text-xs leading-relaxed text-white/40">
                Your nomination becomes official once your payment is verified.
                Paste your transaction number above so our team can match it
                quickly.
            </p>
        </fieldset>

        <!-- Terms + submit -->
        <div class="space-y-5">
            <label class="flex items-start gap-3 text-sm text-white/70">
                <input
                    v-model="form.terms"
                    type="checkbox"
                    class="mt-0.5 size-4 shrink-0 accent-xies-gold"
                />
                <span>
                    I agree to the
                    Xies nomination rules, eligibility period ({{
                        dates.eligibility_start
                    }}
                    – {{ dates.eligibility_end }}), and judging process. *
                </span>
            </label>
            <InputError :message="form.errors.terms" />

            <div
                v-if="form.progress"
                class="h-2 overflow-hidden rounded-full bg-white/10"
            >
                <div
                    class="h-full bg-gradient-to-r from-xies-gold to-xies-goldlight transition-all"
                    :style="{ width: `${form.progress.percentage}%` }"
                />
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="w-full rounded-md bg-gradient-to-b from-xies-goldlight to-xies-gold px-8 py-4 text-lg font-black tracking-wider text-xies-black uppercase shadow-[0_0_40px_rgba(201,162,74,0.35)] transition hover:brightness-110 disabled:cursor-not-allowed disabled:opacity-60"
            >
                {{ form.processing ? 'Submitting…' : 'Submit Nomination' }}
            </button>
        </div>
    </form>
</template>
