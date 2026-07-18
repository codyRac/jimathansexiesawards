<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { BadgeCheck, Clock, DollarSign, Inbox, Paperclip } from '@lucide/vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';

interface NominationRow {
    id: number;
    number: string | null;
    nominee_name: string;
    nominee_x_handle: string;
    show_name: string | null;
    categories: string[];
    amount_due: number;
    payment_method: string;
    payment_reference: string | null;
    status: string;
    attachments_count: number;
    nominator_name: string;
    nominator_email: string;
    nominator_phone: string | null;
    submitted_at: string | null;
}

defineProps<{
    nominations: NominationRow[];
    stats: {
        total: number;
        pending: number;
        verified: number;
        verifiedRevenue: number;
    };
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const toggleStatus = (nomination: NominationRow) => {
    router.patch(
        `/dashboard/nominations/${nomination.id}/status`,
        { status: nomination.status === 'verified' ? 'pending' : 'verified' },
        { preserveScroll: true },
    );
};
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div
                class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <Inbox class="size-4" />
                    Total nominations
                </div>
                <p class="mt-2 text-3xl font-bold">{{ stats.total }}</p>
            </div>
            <div
                class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <Clock class="size-4" />
                    Pending payment
                </div>
                <p class="mt-2 text-3xl font-bold">{{ stats.pending }}</p>
            </div>
            <div
                class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <BadgeCheck class="size-4" />
                    Verified
                </div>
                <p class="mt-2 text-3xl font-bold">{{ stats.verified }}</p>
            </div>
            <div
                class="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
            >
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <DollarSign class="size-4" />
                    Verified revenue
                </div>
                <p class="mt-2 text-3xl font-bold">
                    ${{ stats.verifiedRevenue }}
                </p>
            </div>
        </div>

        <div
            class="flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
        >
            <div
                class="flex items-center justify-between border-b border-sidebar-border/70 px-4 py-3 dark:border-sidebar-border"
            >
                <h2 class="font-semibold">Nominations</h2>
                <span class="text-sm text-muted-foreground"
                    >Mark entries verified once payment is matched</span
                >
            </div>

            <div
                v-if="nominations.length === 0"
                class="flex flex-col items-center gap-2 py-16 text-muted-foreground"
            >
                <Inbox class="size-8" />
                <p class="text-sm">
                    No nominations yet — they'll appear here as they come in.
                </p>
            </div>

            <div v-else class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr
                            class="border-b border-sidebar-border/70 text-xs text-muted-foreground uppercase dark:border-sidebar-border"
                        >
                            <th class="px-4 py-2.5 font-medium">Number</th>
                            <th class="px-4 py-2.5 font-medium">Nominee</th>
                            <th class="px-4 py-2.5 font-medium">Categories</th>
                            <th class="px-4 py-2.5 font-medium">Amount</th>
                            <th class="px-4 py-2.5 font-medium">Payment</th>
                            <th class="px-4 py-2.5 font-medium">Nominator</th>
                            <th class="px-4 py-2.5 font-medium">Submitted</th>
                            <th class="px-4 py-2.5 font-medium">Status</th>
                            <th class="px-4 py-2.5" />
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="nomination in nominations"
                            :key="nomination.id"
                            class="border-b border-sidebar-border/40 align-top last:border-0 dark:border-sidebar-border/40"
                        >
                            <td
                                class="px-4 py-3 font-mono text-xs whitespace-nowrap"
                            >
                                {{ nomination.number }}
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-medium">
                                    {{ nomination.nominee_name }}
                                </p>
                                <p class="text-xs text-muted-foreground">
                                    @{{ nomination.nominee_x_handle }}
                                </p>
                                <p
                                    v-if="nomination.show_name"
                                    class="text-xs text-muted-foreground italic"
                                >
                                    {{ nomination.show_name }}
                                </p>
                                <p
                                    v-if="nomination.attachments_count"
                                    class="mt-1 flex items-center gap-1 text-xs text-muted-foreground"
                                >
                                    <Paperclip class="size-3" />
                                    {{ nomination.attachments_count }} file(s)
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex max-w-52 flex-wrap gap-1">
                                    <Badge
                                        v-for="category in nomination.categories"
                                        :key="category"
                                        variant="secondary"
                                    >
                                        {{ category }}
                                    </Badge>
                                </div>
                            </td>
                            <td
                                class="px-4 py-3 font-semibold whitespace-nowrap"
                            >
                                ${{ nomination.amount_due }}
                            </td>
                            <td class="px-4 py-3">
                                <p class="capitalize">
                                    {{ nomination.payment_method }}
                                </p>
                                <p
                                    v-if="nomination.payment_reference"
                                    class="font-mono text-xs text-muted-foreground"
                                >
                                    {{ nomination.payment_reference }}
                                </p>
                                <p
                                    v-else
                                    class="text-xs text-muted-foreground italic"
                                >
                                    no reference
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                <p>{{ nomination.nominator_name }}</p>
                                <p class="text-xs text-muted-foreground">
                                    {{ nomination.nominator_email }}
                                </p>
                                <p
                                    v-if="nomination.nominator_phone"
                                    class="text-xs text-muted-foreground"
                                >
                                    {{ nomination.nominator_phone }}
                                </p>
                            </td>
                            <td
                                class="px-4 py-3 text-xs whitespace-nowrap text-muted-foreground"
                            >
                                {{ nomination.submitted_at }}
                            </td>
                            <td class="px-4 py-3">
                                <Badge
                                    :variant="
                                        nomination.status === 'verified'
                                            ? 'default'
                                            : 'outline'
                                    "
                                >
                                    {{ nomination.status }}
                                </Badge>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <Button
                                    size="sm"
                                    variant="outline"
                                    @click="toggleStatus(nomination)"
                                >
                                    {{
                                        nomination.status === 'verified'
                                            ? 'Mark pending'
                                            : 'Mark verified'
                                    }}
                                </Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
