<script setup>
import { computed } from "vue";

const props = defineProps({
    style: {
        type: String,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() => (props.active ? "#2e269c" : "#908e8e"));
</script>

<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
    >
        <path :fill="classes" :d="style" />
    </svg>
</template>
