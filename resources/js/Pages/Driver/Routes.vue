<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Routes</h2>
        </template>
        <div class="py-8">
            <div class="mx-12">
                <h3 class="text-lg font-medium mb-4">Routes</h3>
                <div v-if="routes.length">
                    <ul>
                        <li v-for="route in routes" :key="route.id" class="mb-2 p-4 bg-white shadow rounded">
                            <p><strong>Start Date:</strong> {{ route.start_date }}</p>
                            <p><strong>End Date:</strong> {{ route.end_date }}</p>
                            <p><strong>Status:</strong> {{ route.status }}</p>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <p>No routes found.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const routes = props.routes;
</script>
