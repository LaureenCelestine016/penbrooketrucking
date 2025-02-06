<template>
    <Head title="Vehicle" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Location
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-89rem mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Location</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";

const toast = useToast();
</script>
