<script setup lang="ts">
import ContactsListBox from '@/components/ContactsListBox.vue';
import { ContactModel } from '@/types/ContactModel';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{
    eventId: number;
    contacts: ContactModel[];
    otherContacts: ContactModel[];
}>();
const imageUrl =
    'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';
const showForm = ref(false);
const onDetach = (id: number) => {
    router.delete(route('events.detach', { event: props.eventId, id: id }));
};
</script>

<template>
    <div>
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
            <h3 class="text-base font-semibold text-gray-900">
                Attached Contacts
            </h3>
        </div>
        <ul role="list" class="divide-y divide-gray-100">
            <li
                v-for="person in props.contacts"
                :key="person.id"
                class="flex items-center justify-between gap-x-6 py-5"
            >
                <div class="flex min-w-0 gap-x-4">
                    <img
                        class="size-12 flex-none rounded-full bg-gray-50"
                        :src="imageUrl"
                        :alt="person.name"
                    />
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm/6 font-semibold text-gray-900">
                            {{ person.name }}
                        </p>
                        <p class="mt-1 truncate text-xs/5 text-gray-500">
                            {{ person.email }}
                        </p>
                    </div>
                </div>
                <a
                    href="#"
                    class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
                    @click="onDetach(person.id)"
                    >Detach</a
                >
            </li>
        </ul>
        <div v-if="showForm" class="mb-8">
            <ContactsListBox
                :contacts="otherContacts"
                :event-id="eventId"
            ></ContactsListBox>
        </div>
        <a
            href="#"
            class="flex w-full items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:outline-offset-0"
            v-if="!showForm"
            @click="showForm = true"
            >Attach another</a
        >
    </div>
</template>

<style scoped></style>
