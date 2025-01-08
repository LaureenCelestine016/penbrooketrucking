<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Vehicle
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-89rem mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Toolbar class="mb-6">
                        <template #start>
                            <Button
                                label="Go back"
                                icon="pi pi-chevron-circle-left"
                                severity="info"
                                @click="goBack"
                            />
                        </template>
                    </Toolbar>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

import Toolbar from "primevue/toolbar";
import Button from "primevue/button";

const goBack = () => {
    history.back();
};
</script>

<style scoped>
.btn--back {
    margin-right: 8px;
    display: flex;
    gap: 6px;
    background-color: #0813ad;
    color: #ebfbee;
    padding: 8px 12px 8px 12px;
    border-radius: 6px;
    font-weight: 600;
}
</style>
