<script setup lang="ts" generic="T">
import { PaginationModel } from '@/types/PaginationModel';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid';
import { computed } from 'vue';

interface Props {
    pagination: PaginationModel<T>;
}

const props = defineProps<Props>();

const emit = defineEmits<{
    (e: 'page-changed', page: number): void;
}>();

const pages = computed(() => {
    const current = props.pagination.meta.current_page;
    const last = props.pagination.meta.last_page;
    const delta = 2;
    const left = current - delta;
    const right = current + delta + 1;
    const range: (number | string)[] = [];
    const rangeWithDots: (number | string)[] = [];
    let l: number | undefined;

    for (let i = 1; i <= last; i++) {
        if (i === 1 || i === last || (i >= left && i < right)) {
            range.push(i);
        }
    }

    for (const i of range) {
        if (l) {
            if (i !== l + 1) {
                rangeWithDots.push('...');
            }
        }
        rangeWithDots.push(i);
        l = i as number;
    }

    return rangeWithDots;
});

const handlePageChange = (page: number) => {
    if (
        page !== props.pagination.meta.current_page &&
        page >= 1 &&
        page <= props.pagination.meta.last_page
    ) {
        emit('page-changed', page);
    }
};

const goToPrevious = () => {
    if (props.pagination.meta.current_page > 1) {
        handlePageChange(props.pagination.meta.current_page - 1);
    }
};

const goToNext = () => {
    if (props.pagination.meta.current_page < props.pagination.meta.last_page) {
        handlePageChange(props.pagination.meta.current_page + 1);
    }
};
</script>

<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <button
                @click="goToPrevious"
                :disabled="pagination.meta.current_page === 1"
                :class="[
                    'relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700',
                    pagination.meta.current_page === 1
                        ? 'cursor-not-allowed opacity-50'
                        : 'hover:bg-gray-50',
                ]"
            >
                Previous
            </button>
            <button
                @click="goToNext"
                :disabled="
                    pagination.meta.current_page === pagination.meta.last_page
                "
                :class="[
                    'relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700',
                    pagination.meta.current_page === pagination.meta.last_page
                        ? 'cursor-not-allowed opacity-50'
                        : 'hover:bg-gray-50',
                ]"
            >
                Next
            </button>
        </div>

        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ pagination.meta.from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ pagination.meta.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ pagination.meta.total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md shadow-xs"
                    aria-label="Pagination"
                >
                    <!-- Previous button -->
                    <button
                        @click="goToPrevious"
                        :disabled="pagination.meta.current_page === 1"
                        :class="[
                            'relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset focus:z-20 focus:outline-offset-0',
                            pagination.meta.current_page === 1
                                ? 'cursor-not-allowed opacity-50'
                                : 'hover:bg-gray-50',
                        ]"
                    >
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="size-5" aria-hidden="true" />
                    </button>

                    <!-- Page numbers -->
                    <template v-for="(page, index) in pages" :key="index">
                        <button
                            v-if="page !== '...'"
                            @click="handlePageChange(page as number)"
                            :aria-current="
                                page === pagination.meta.current_page
                                    ? 'page'
                                    : undefined
                            "
                            :class="[
                                'relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20',
                                page === pagination.meta.current_page
                                    ? 'z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                    : 'text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:outline-offset-0',
                                index >= 2 && index <= pages.length - 3
                                    ? 'hidden md:inline-flex'
                                    : '',
                            ]"
                        >
                            {{ page }}
                        </button>
                        <span
                            v-else
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset focus:outline-offset-0"
                        >
                            ...
                        </span>
                    </template>
                    <button
                        @click="goToNext"
                        :disabled="
                            pagination.meta.current_page ===
                            pagination.meta.last_page
                        "
                        :class="[
                            'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset focus:z-20 focus:outline-offset-0',
                            pagination.meta.current_page ===
                            pagination.meta.last_page
                                ? 'cursor-not-allowed opacity-50'
                                : 'hover:bg-gray-50',
                        ]"
                    >
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="size-5" aria-hidden="true" />
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>
