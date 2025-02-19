<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Toast from "primevue/toast";
</script>

<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-12">
                <div class="grid grid-cols-4 gap-y-3">
                    <div class="col-span-5">1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
