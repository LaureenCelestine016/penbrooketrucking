<script setup>
import Login from "./Auth/Login.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";

import Button from "primevue/button";

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
</script>

<template>
    <Head title="Welcome" />
    <div class="w-full h-16 border-b bg-blue-800">
        <div v-if="canLogin" class="flex h-full max-w-89rem mx-auto">
            <div class="flex h-full items-center">
                <h2 class="font-bold tracking-widest text-blue-100">
                    LOGO HERE
                </h2>
            </div>
            <div class="grow h-100"></div>
            <div class="flex gap-3 items-center flex-none h-full">
                <Link v-if="$page.props.auth.user" class="font-sans"
                    >Dashboard</Link
                >
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="font-sans font-semibold hover:text-blue-50 text-blue-100"
                        >Login</Link
                    >
                    <Link
                        :href="route('register')"
                        class="font-sans font-semibold hover:text-blue-50 text-blue-100"
                        >Register</Link
                    >
                </template>
            </div>
        </div>
    </div>

    <div
        class="flex lg:flex-row flex-col gap-4 bg-surface-0 dark:bg-surface-900"
    >
        <div class="flex-1 flex items-center justify-center">
            <div class="p-6 pt-12 lg:p-12">
                <h1
                    class="text-3xl lg:text-5xl font-bold text-surface-900 dark:text-surface-0 mb-4 lg:leading-normal text-center lg:text-left"
                >
                    Create the screens your <br /><span class="text-primary"
                        >visitors deserve to see</span
                    >
                </h1>
                <p
                    class="text-surface-700 dark:text-surface-200 leading-normal mb-8 text-center lg:text-left"
                >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                </p>
                <div
                    class="flex items-center justify-center lg:justify-start gap-6"
                >
                    <Button label="Learn More" type="button" />
                    <Button label="Live Demo" type="button" outlined />
                </div>
            </div>
        </div>
        <div class="flex-1 overflow-hidden">
            <img
                src="https://fqjltiegiezfetthbags.supabase.co/storage/v1/render/image/public/block.images/blocks/hero/hero-1.png"
                alt="hero-1"
                class="h-full w-full object-cover lg:[clip-path:polygon(12%_0,100%_0%,100%_100%,0_100%)]"
            />
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
