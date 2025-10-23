<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head, router } from '@inertiajs/vue3';

import RelatedContacts from '@/components/RelatedContacts.vue';
import { BusinessEventModel } from '@/types/BusinessEventModel';
import { ContactModel } from '@/types/ContactModel';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{
    id: number;
    event: BusinessEventModel;
    otherContacts: ContactModel[];
}>();

const date = ref(props.event.started_at);
const dateEnded = ref(props.event.ended_at);
</script>

<template>
    <Head :title="id ? 'Edit Event' : 'Create Event'" />
    <AppLayout :title="id ? 'Edit Event' : 'Create Event'">
        <div class="divide-y divide-gray-900/10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Event Information
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        This information will be displayed publicly so be
                        careful what you share.
                    </p>
                </div>

                <Form
                    method="post"
                    :action="
                        id
                            ? route('events.update', { id: id })
                            : route('events.store')
                    "
                    class="bg-white shadow-xs ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2"
                    #default="{ errors }"
                >
                    <div class="px-4 py-6 sm:p-8">
                        <div
                            class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                        >
                            <div class="sm:col-span-4">
                                <label
                                    for="name"
                                    class="block text-sm/6 font-medium text-gray-900"
                                    >Name</label
                                >
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                    >
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                            placeholder="Party"
                                            :value="event.name"
                                        />
                                        <p
                                            v-if="errors.name"
                                            class="mt-2 text-sm text-red-600"
                                            id="name-error"
                                        >
                                            {{ errors.name }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label
                                    for="place"
                                    class="block text-sm/6 font-medium text-gray-900"
                                    >Place</label
                                >
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <input
                                        type="text"
                                        name="place"
                                        id="place"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        placeholder="Hamburg"
                                        :value="event.place"
                                    />
                                    <p
                                        v-if="errors.place"
                                        class="mt-2 text-sm text-red-600"
                                        id="name-error"
                                    >
                                        {{ errors.place }}
                                    </p>
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label
                                    for="started_at"
                                    class="block text-sm/6 font-medium text-gray-900"
                                    >Date of start</label
                                >
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                    >
                                        <VueDatePicker
                                            format="yyyy-MM-dd HH:mm"
                                            name="started_at"
                                            id="started_at"
                                            v-model="date"
                                        ></VueDatePicker>
                                    </div>
                                    <p
                                        v-if="errors.started_at"
                                        class="mt-2 text-sm text-red-600"
                                        id="name-error"
                                    >
                                        {{ errors.started_at }}
                                    </p>
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label
                                    for="ended_at"
                                    class="block text-sm/6 font-medium text-gray-900"
                                    >Date of end</label
                                >
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                    >
                                        <VueDatePicker
                                            format="yyyy-MM-dd HH:mm"
                                            name="ended_at"
                                            id="ended_at"
                                            v-model="dateEnded"
                                        ></VueDatePicker>
                                        <p
                                            v-if="errors.ended_at"
                                            class="mt-2 text-sm text-red-600"
                                            id="name-error"
                                        >
                                            {{ errors.ended_at }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8"
                    >
                        <button
                            type="button"
                            class="cursor-pointer text-sm/6 font-semibold text-gray-900"
                            @click="router.get(route('events.index'))"
                        >
                            Cancel
                        </button>
                        <button
                            v-if="id"
                            type="button"
                            @click="
                                router.delete(
                                    route('events.delete', { id: id }),
                                )
                            "
                            class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                        >
                            Delete Event
                        </button>
                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Save
                        </button>
                    </div>
                </Form>
            </div>
        </div>
        <div v-if="id">
            <RelatedContacts
                :event-id="id"
                :contacts="event.contacts"
                :other-contacts="otherContacts"
            ></RelatedContacts>
        </div>
    </AppLayout>
</template>

<style scoped></style>
