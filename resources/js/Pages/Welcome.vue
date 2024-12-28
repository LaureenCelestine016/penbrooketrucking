<script setup>
import Login from "./Auth/Login.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const location = () => {
    const map = ref(null);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const { latitude } = position.coords;
                const { longitude } = position.coords;

                const coords = [latitude, longitude];

                // Initialize the map
                map.value = L.map("map").setView(coords, 13);

                // Add a tile layer to the map
                L.tileLayer(
                    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                ).addTo(map.value);

                // Add a marker to the map
                L.marker(coords)
                    .addTo(map.value)
                    .bindPopup("A pretty marker.<br> Easily customizable.")
                    .openPopup();
            },
            function () {
                alert(`Could not get your position`);
            }
        );
    }
};

onMounted(() => {
    location();
});
</script>

<template>
    <Head title="Welcome" />
    <div class="w-full h-14 border-b bg-teal-500">
        <div v-if="canLogin" class="flex h-full w-11/12 mx-auto">
            <div class="flex h-full items-center">
                <h2 class="font-bold tracking-widest text-white">LOGO HERE</h2>
            </div>
            <div class="grow h-100"></div>
            <div class="flex gap-3 items-center flex-none h-full">
                <Link v-if="$page.props.auth.user" class="font-sans"
                    >Dashboard</Link
                >
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="font-sans font-semibold hover:text-teal-900 text-white"
                        >Login</Link
                    >
                    <Link
                        :href="route('register')"
                        class="font-sans font-semibold hover:text-teal-900 text-white"
                        >Register</Link
                    >
                </template>
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-2 h-screen">
            <div class="form--container">
                <Login />
            </div>
            <div id="map" class="w-full"></div>
        </div>
    </div>
    <!-- <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
            </template>
        </div>
    </div> -->
</template>

<style scoped>
.img {
    width: 80px;
    background: none;
}

.form--container {
}
</style>

<!-- <style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style> -->
