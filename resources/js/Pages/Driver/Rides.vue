<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Rides</h2>
        </template>
        <div class="py-8">
            <div class="mx-12">
                <h3 class="text-lg font-medium mb-4">Assigned Rides</h3>
                <div v-if="rides.length">
                    <ul>
                        <li v-for="ride in rides" :key="ride.id" class="mb-2 p-4 bg-white shadow rounded">
                            <p><strong>Date:</strong> {{ ride.start_date }}</p>
                            <p><strong>Status:</strong> {{ ride.status }}</p>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <p>No rides assigned.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const rides = props.rides;
</script>
