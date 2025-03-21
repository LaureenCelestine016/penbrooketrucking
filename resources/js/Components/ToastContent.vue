<template>
    <div class="flex flex-col gap-2">
        <p class="text-sm">{{ message }}</p>
        <Button
            label="View Details"
            class="p-button-sm p-button-text p-button-danger"
            @click="onViewDetails"
        />
    </div>
</template>
<script setup>
import Button from "primevue/button";

defineProps(["message", "onViewDetails"]);
</script>
