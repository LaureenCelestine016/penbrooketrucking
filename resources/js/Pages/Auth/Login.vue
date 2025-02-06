<template>
    <Head title="Log in" />

    <Toast />
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="w-full h-16 border-b bg-navyblue">
        <div class="flex h-full mx-12">
            <div class="flex h-full items-center">
                <h2 class="text-2xl font-bold tracking-widest text-white">
                    Penbrooke Inc.
                </h2>
            </div>
            <div class="grow h-100"></div>
            <div class="flex gap-3 items-center flex-none h-full">
                <Link
                    v-if="$page.component === 'Auth/Login'"
                    :href="route('register')"
                    class="font-sans font-semibold hover:text-blue-50 text-blue-100"
                    >Register</Link
                >
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-2 h-screen">
            <div class="flex flex-col items-center justify-center">
                <div class="card flex justify-center w-3/4">
                    <!-- class="flex flex-col gap-4 w-full sm:w-60" -->
                    <form @submit.prevent="submit" class="form">
                        <h2 class="font-semibold text-2xl text-slate-600 mb-6">
                            Login to Truck Management System
                        </h2>
                        <div class="flex flex-col gap-1">
                            <label for="email" class="label"
                                >Email Address or Username</label
                            >
                            <InputText
                                id="email"
                                name="username"
                                type="text"
                                v-model="form.login"
                                placeholder="johndoe@example.com"
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.login"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ form.errors.login }}</Message
                            >
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="password" class="label">Password</label>
                            <Password
                                id="password"
                                name="password"
                                placeholder="••••••••••"
                                v-model="form.password"
                                :feedback="false"
                                toggleMask
                                fluid
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.password"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.password }}
                            </Message>
                            <Link
                                :href="route('password.request')"
                                class="text-blue-600 hover:text-gray-900 self-end"
                            >
                                Forgot your password?
                            </Link>
                        </div>

                        <Button
                            type="submit"
                            label="Log in"
                            class="btn-submit"
                        />
                    </form>
                </div>
            </div>
            <div id="map" class="w-full"></div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";

import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import Password from "primevue/password";
import Button from "primevue/button";
import InputText from "primevue/inputtext";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const toast = useToast();

const form = useForm({
    login: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Account login successfully!",
                life: 3000,
            });
            form.reset("password", "password_confirmation");
        },
        onError: () => {
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "There were errors in your form submission.",
                life: 3000,
            });
        },
        onFinish: () => form.reset("password"),
    });
};

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
                    .bindPopup("You are here!")
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
<style scoped>
.form {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 100%;
}

.user--input {
    height: 48px;
    background-color: #f8f9fa;
}

.label {
    color: #495057;
    font-size: 15px;
    margin-bottom: 3px;
}

.btn-submit {
    background-color: #213555;
    border: none;
    margin-top: 14px;
    color: rgb(219 234 254);
    height: 52px;
    font-weight: 900;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    font-size: 18px;
}

.btn-submit:hover {
    background-color: rgb(41, 71, 167) !important;
    border: none !important;
}
</style>
