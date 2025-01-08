<template>
    <div class="flex justify-start">
        <Breadcrumb :home="home" :model="filteredItems" class="!bg-transparent">
            <template #item="{ item, props }">
                <router-link
                    v-if="item.route && item.route !== currentRoute"
                    :to="item.route"
                    custom
                >
                    <a v-bind="props.action">
                        {{ item.label }}
                    </a>
                </router-link>
                <span v-else class="text-surface-700 dark:text-surface-0">{{
                    item.label
                }}</span>
            </template>
        </Breadcrumb>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import Breadcrumb from "primevue/breadcrumb";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const currentRoute = page.url;

const filteredItems = computed(() => {
    return items.value.map((item) => {
        return { ...item, clickable: item.route !== currentRoute };
    });
});

const items = ref([
    { label: "Vehicle", route: "/vehicle" },
    { label: "Add Vehicle", route: "/vehicle/add" },
    // { label: "Edit Vehicle" },
    // { label: "InputText" },
]);
</script>
