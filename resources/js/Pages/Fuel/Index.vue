<template>
    <Head title="Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Fuel List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                ></div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
