<template>
    <div
        v-if="notification"
        class="cursor-pointer text-yellow-600 hover:underline"
        @click="handleClick"
    >
        {{ notification.message }}
    </div>
    <div v-else class="text-red-500">⚠️ No notification data passed!</div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { defineProps, onMounted } from "vue";

const props = defineProps({
    notification: {
        type: Object,
        required: true,
    },
});

const { notification } = props;
console.log(notification);

console.log("📦 ToastContent received:", props.notification);
onMounted(() => {});

const handleClick = () => {
    const truckId = props.notification.vehicle_id; // or message.data.truckId depending on structure
    if (truckId) {
        router.get(`/registration/edit/${truckId}`);
    }
};
</script>
