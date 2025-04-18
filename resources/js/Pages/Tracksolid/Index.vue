<template>
    <div class="p-8 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">TracksolidPro API Token</h1>

        <button
            @click="getToken"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
        >
            Get Token
        </button>

        <div v-if="loading" class="mt-4 text-gray-600">Loading...</div>

        <div v-if="tokenData" class="mt-4 bg-gray-100 p-4 rounded">
            <h2 class="text-lg font-semibold">Token Response:</h2>
            <pre class="text-sm whitespace-pre-wrap">{{ tokenData }}</pre>
        </div>

        <!-- Button to fetch vehicle data -->
        <button
            @click="getLocation"
            class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow"
        >
            Get Vehicle Location
        </button>

        <!-- Display Location Data -->
        <div v-if="locationData" class="mt-4 bg-gray-100 p-4 rounded">
            <h2 class="text-lg font-semibold">Vehicle Data:</h2>
            <pre class="text-sm whitespace-pre-wrap">{{ locationData }}</pre>
        </div>

        <div v-if="errorMessage" class="mt-4 text-red-600">
            <p>{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const tokenData = ref(null);
const loading = ref(false);
const locationData = ref(null);
const errorMessage = ref(null);

defineProps({
    tracksolid: Object,
    location: Object,
});

const getToken = () => {
    loading.value = true;
    tokenData.value = null;

    router.post(
        "/tracksolid/get-token",
        {},
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                loading.value = false;
                const response = page.props.tracksolid?.response;
                tokenData.value = JSON.stringify(response, null, 2);
            },
            onError: () => {
                loading.value = false;
                alert("Failed to fetch token.");
            },
        }
    );
};

const getLocation = () => {
    // if (!tokenData.value) return alert("Please get token first!");

    const parsed = JSON.parse(tokenData.value);
    const accessToken = parsed?.result?.accessToken;

    // const deviceId = "VL01LA-48139"; // Your device ID

    router.post(
        "/tracksolid/location",
        { accessToken },
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.location) {
                    locationData.value = JSON.stringify(
                        page.props.location,
                        null,
                        2
                    );
                    errorMessage.value = null; // Clear any previous errors
                } else {
                    errorMessage.value = "No location data returned.";
                }
            },
            onError: () => {
                errorMessage.value = "Failed to get location data.";
                locationData.value = null;
            },
        }
    );
};
</script>
