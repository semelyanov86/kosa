<script setup lang="ts">
import PaginationList from '@/components/PaginationList.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BusinessEventModel } from '@/types/BusinessEventModel';
import { PaginationModel } from '@/types/PaginationModel';
import { Head } from '@inertiajs/vue3';

defineProps<{
    events: PaginationModel<BusinessEventModel>;
}>();
</script>

<template>
    <Head title="Events List" />

    <AppLayout title="Events List">
        <ul role="list" class="divide-y divide-gray-100">
            <li
                v-for="project in events.data"
                :key="project.id"
                class="flex items-center justify-between gap-x-6 py-5"
            >
                <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <p class="text-sm/6 font-semibold text-gray-900">
                            {{ project.name }}
                        </p>
                        <p
                            :class="[
                                'bg-gray-50 text-gray-600 ring-gray-500/10',
                                'mt-0.5 rounded-md px-1.5 py-0.5 text-xs font-medium whitespace-nowrap ring-1 ring-inset',
                            ]"
                        >
                            {{ project.place }}
                        </p>
                    </div>
                    <div
                        class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500"
                    >
                        <p class="whitespace-nowrap">
                            Due on
                            <time :datetime="project.ended_at">{{
                                project.ended_at
                            }}</time>
                        </p>
                        <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                            <circle cx="1" cy="1" r="1" />
                        </svg>
                        <p class="truncate">
                            Launched at {{ project.started_at }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                    <a
                        href="#"
                        class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:block"
                        >View event<span class="sr-only"
                            >, {{ project.name }}</span
                        ></a
                    >
                </div>
            </li>
        </ul>
        <PaginationList :pagination="events"></PaginationList>
    </AppLayout>
</template>

<style scoped></style>
