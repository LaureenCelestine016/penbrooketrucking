<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 pt-1 text-blue-900 text-medium font-bold"
        : "inline-flex items-center px-1 pt-1  text-medium font-semibold leading-5 text-gray-600 hover:text-gray-700 hover:text-blue-800 "
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
