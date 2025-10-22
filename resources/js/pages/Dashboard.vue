<script setup lang="ts">
import ContactTable from '@/components/contacts/ContactTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ContactModel } from '@/types/ContactModel';
import { PaginationModel } from '@/types/PaginationModel';
import { Head, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{
    contacts: PaginationModel<ContactModel>;
}>();
</script>

<template>
    <Head title="Contacts List" />

    <AppLayout title="Contacts List">
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
            <div
                class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap"
            >
                <div class="mt-4 ml-4">
                    <h3 class="text-base font-semibold text-gray-900">
                        Contacts List
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Here you can see list of all contacts in our application
                    </p>
                </div>
                <div class="mt-4 ml-4 shrink-0">
                    <button
                        type="button"
                        class="relative inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        @click="router.get(route('contacts.create'))"
                    >
                        Create new contact
                    </button>
                </div>
            </div>
        </div>
        <ContactTable :contacts="contacts"></ContactTable>
    </AppLayout>
</template>
