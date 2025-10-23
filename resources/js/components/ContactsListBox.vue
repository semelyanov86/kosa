<script setup lang="ts">
import { ContactModel } from '@/types/ContactModel';
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
} from '@headlessui/vue';
import { ChevronUpDownIcon } from '@heroicons/vue/16/solid';
import { CheckCircleIcon, CheckIcon } from '@heroicons/vue/20/solid';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{
    eventId: number;
    contacts: ContactModel[];
}>();

const selected = ref<ContactModel | null>(null);

const onAttach = () => {
    if (selected.value) {
        router.post(
            route('events.attach', {
                event: props.eventId,
                id: selected.value.id,
            }),
        );
    }
};
</script>

<template>
    <div>
        <label class="mb-2 block text-sm/6 font-medium text-gray-900"
            >Registered Contacts</label
        >
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
            <Listbox as="div" v-model="selected" class="flex-1">
                <div class="relative">
                    <ListboxButton
                        class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    >
                        <span
                            class="col-start-1 row-start-1 flex w-full gap-2 pr-6"
                            v-if="selected"
                        >
                            <span class="truncate">{{ selected.name }}</span>
                            <span class="truncate text-gray-500">{{
                                selected.email
                            }}</span>
                        </span>
                        <ChevronUpDownIcon
                            class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            aria-hidden="true"
                        />
                    </ListboxButton>

                    <transition
                        leave-active-class="transition ease-in duration-100"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <ListboxOptions
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                        >
                            <ListboxOption
                                as="template"
                                v-for="person in contacts"
                                :key="person.id"
                                :value="person"
                                v-slot="{ active, selected }"
                            >
                                <li
                                    :class="[
                                        active
                                            ? 'bg-indigo-600 text-white outline-hidden'
                                            : 'text-gray-900',
                                        'relative cursor-default py-2 pr-9 pl-3 select-none',
                                    ]"
                                >
                                    <div class="flex">
                                        <span
                                            :class="[
                                                selected
                                                    ? 'font-semibold'
                                                    : 'font-normal',
                                                'truncate',
                                            ]"
                                            >{{ person.name }}</span
                                        >
                                        <span
                                            :class="[
                                                active
                                                    ? 'text-indigo-200'
                                                    : 'text-gray-500',
                                                'ml-2 truncate',
                                            ]"
                                            >{{ person.email }}</span
                                        >
                                    </div>

                                    <span
                                        v-if="selected"
                                        :class="[
                                            active
                                                ? 'text-white'
                                                : 'text-indigo-600',
                                            'absolute inset-y-0 right-0 flex items-center pr-4',
                                        ]"
                                    >
                                        <CheckIcon
                                            class="size-5"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>

            <button
                type="button"
                class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                @click="onAttach"
            >
                Attach Contact
                <CheckCircleIcon class="-mr-0.5 size-5" aria-hidden="true" />
            </button>
        </div>
    </div>
</template>

<style scoped></style>
