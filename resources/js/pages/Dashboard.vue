<script setup lang="ts">
import ContactTable from '@/components/contacts/ContactTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ContactModel } from '@/types/ContactModel';
import { PaginationModel } from '@/types/PaginationModel';
import { Head } from '@inertiajs/vue3';

defineProps<{
    contacts: PaginationModel<ContactModel>;
}>();
</script>

<template>
    <Head title="Contacts List" />

    <AppLayout title="Contacts List">
        <ContactTable :contacts="contacts"></ContactTable>
    </AppLayout>
</template>
