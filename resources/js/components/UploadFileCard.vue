<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { route } from 'ziggy-js';

const isUploading = ref(false);
const selectedFile = ref<File | null>(null);
const uploadError = ref<string>('');

const form = useForm({
    business_card: null,
});

const uploadBusinessCard = async () => {
    if (!form.business_card) {
        uploadError.value = 'Please select a file';
        return;
    }

    isUploading.value = true;
    uploadError.value = '';
    form.post(route('contacts.parseBusinessCard'));
};
</script>

<template>
    <div class="mx-auto max-w-lg text-center">
        <svg
            class="mx-auto h-16 w-16 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
            />
        </svg>
        <h3 class="mt-4 text-lg font-semibold text-gray-900">
            Upload Business Card
        </h3>
        <p class="mt-2 text-sm text-gray-600">
            Upload an image or PDF of a business card to automatically extract
            contact information
        </p>

        <div class="mt-6">
            <label
                for="file-upload"
                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-none hover:text-indigo-500"
            >
                <input
                    id="file-upload"
                    name="file-upload"
                    type="file"
                    accept=".jpg,.jpeg,.png,.pdf"
                    @input="form.business_card = $event.target.files[0]"
                    class="block w-full text-sm text-gray-900 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                />
            </label>
        </div>

        <p v-if="selectedFile" class="mt-3 text-sm text-gray-600">
            Selected: {{ selectedFile.name }}
        </p>

        <p v-if="uploadError" class="mt-3 text-sm text-red-600">
            {{ uploadError }}
        </p>

        <button
            @click="uploadBusinessCard"
            :disabled="!form.business_card"
            class="mt-6 inline-flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:cursor-not-allowed disabled:opacity-50"
        >
            <span v-if="isUploading">Processing...</span>
            <span v-else>Upload and Parse</span>
        </button>
    </div>
</template>

<style scoped></style>
