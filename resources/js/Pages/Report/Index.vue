<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-md"
                ></div>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, watch, nextTick, onMounted } from "vue";
import L from "leaflet";
import "leaflet-routing-machine";
import dayjs from "dayjs";
</script>
