<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { ContactModel } from '@/types/ContactModel';
import { Form, Head, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{
    id: number | null;
    contact: ContactModel;
}>();
</script>

<template>
    <Head title="Create Contact" />

    <AppLayout title="Create Contact">
        <Form
            method="post"
            :action="
                id
                    ? route('contacts.update', { id: id })
                    : route('contacts.store')
            "
            #default="{ errors }"
        >
            <div class="space-y-12 sm:space-y-16">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Personal Information
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm/6 text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>

                    <div
                        class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0"
                    >
                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="name"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Full name</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    autocomplete="name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                    :value="contact.name"
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

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="position"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Position</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="position"
                                    id="position"
                                    :value="contact.position"
                                    autocomplete="position"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.position"
                                    class="mt-2 text-sm text-red-600"
                                    id="position-error"
                                >
                                    {{ errors.position }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="email"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Email address</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    :value="contact.email"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.email"
                                    class="mt-2 text-sm text-red-600"
                                    id="email-error"
                                >
                                    {{ errors.email }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="email"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Phone</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    id="phone"
                                    name="phone"
                                    type="phone"
                                    autocomplete="phone"
                                    :value="contact.phone"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.phone"
                                    class="mt-2 text-sm text-red-600"
                                    id="phone-error"
                                >
                                    {{ errors.phone }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="company"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Company</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="company"
                                    id="position"
                                    :value="contact.company"
                                    autocomplete="company"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.company"
                                    class="mt-2 text-sm text-red-600"
                                    id="company-error"
                                >
                                    {{ errors.company }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="address"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >Street address</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    autocomplete="address"
                                    :value="contact.address"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xl sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.address"
                                    class="mt-2 text-sm text-red-600"
                                    id="address-error"
                                >
                                    {{ errors.address }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="city"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >City</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    :value="contact.city"
                                    autocomplete="address-level2"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.city"
                                    class="mt-2 text-sm text-red-600"
                                    id="city-error"
                                >
                                    {{ errors.city }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="zip"
                                class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                >ZIP / Postal code</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input
                                    type="text"
                                    name="zip"
                                    id="zip"
                                    autocomplete="zip"
                                    :value="contact.zip"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                />
                                <p
                                    v-if="errors.zip"
                                    class="mt-2 text-sm text-red-600"
                                    id="zip-error"
                                >
                                    {{ errors.zip }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button
                        type="button"
                        class="cursor-pointer text-sm/6 font-semibold text-gray-900"
                        @click="router.get(route('dashboard'))"
                    >
                        Cancel
                    </button>
                    <button
                        v-if="id"
                        type="button"
                        @click="
                            router.delete(route('contacts.delete', { id: id }))
                        "
                        class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                    >
                        Delete Contact
                    </button>
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Save
                    </button>
                </div>
            </div>
        </Form>
    </AppLayout>
</template>

<style scoped></style>
