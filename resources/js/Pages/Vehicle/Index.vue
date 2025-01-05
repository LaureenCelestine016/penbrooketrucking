<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vehicle
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-89rem mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{ vehicles.data }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    vehicles: {
        type: String,
        required: true,
    },
});
</script>
