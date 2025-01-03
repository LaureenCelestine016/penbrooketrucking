<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";

import { FormField } from "@primevue/forms";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import Password from "primevue/password";
import Button from "primevue/button";
const toast = useToast();

const form = useForm({
    firstName: "",
    lastName: "",
    email: "",
    mobileNumber: "",
    username: "",
    password: "",
    password_confirmation: "",
    userType: 1,
});

const trimFormFields = () => {
    for (const key in form) {
        if (typeof form[key] === "string") {
            form[key] = form[key].trim();
        }
    }
};

const submit = () => {
    trimFormFields();

    form.post(route("register"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Account created successfully!",
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
        onFinish: () => {
            // This can handle additional cleanup if needed
        },
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

<template>
    <Head title="Register" />
    <Toast />
    <div class="w-full h-14 border-b bg-blue-800">
        <div class="flex h-full max-w-89rem mx-auto">
            <div class="flex h-full items-center">
                <h2 class="font-bold tracking-widest text-blue-100">
                    LOGO HERE
                </h2>
            </div>
            <div class="grow h-100"></div>
            <div class="flex gap-3 items-center flex-none h-full">
                <Link
                    v-if="$page.component === 'Auth/Register'"
                    :href="route('login')"
                    class="font-sans font-semibold hover:text-blue-50 text-blue-100"
                    >Log in</Link
                >
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-2 h-screen">
            <div class="flex flex-col items-center justify-center">
                <div class="card flex justify-center w-3/4">
                    <form @submit.prevent="submit" class="form">
                        <h2 class="font-semibold text-2xl text-slate-600 mb-6">
                            Create your Account
                        </h2>

                        <!-- Full Name -->
                        <div class="flex flex-row gap-24">
                            <div>
                                <!-- First Name -->
                                <FormField
                                    id="firstname"
                                    name="firstName"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="First Name"
                                        class="user--input firstName"
                                        v-model="form.firstName"
                                    />
                                    <Message
                                        v-if="form.errors.firstName"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.firstName }}</Message
                                    >
                                </FormField>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <FormField
                                    id="lastname"
                                    name="lastName"
                                    class="flex flex-col gap-1 justify-end"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="Last Name"
                                        v-model="form.lastName"
                                        class="user--input lastName"
                                    />
                                    <Message
                                        v-if="form.errors.lastName"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.lastName }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <FormField
                            name="mobileNumber"
                            class="flex flex-col gap-1"
                        >
                            <label
                                for="mobile_number"
                                class="text-sm text-slate-800"
                                >Mobile number</label
                            >
                            <span class="text-xs text-slate-500"
                                >e.g. +63917XXXXXXXX</span
                            >
                            <InputText
                                id="mobile_number"
                                type="text"
                                placeholder="+63"
                                v-model="form.mobileNumber"
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.mobileNumber"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ form.errors.mobileNumber }}</Message
                            >
                        </FormField>

                        <!-- Email -->
                        <FormField name="email" class="flex flex-col gap-1">
                            <label
                                for="emailaddress"
                                class="text-sm mb-1 text-slate-800"
                                >Email address</label
                            >
                            <InputText
                                id="emailaddress"
                                type="text"
                                placeholder="johndoe@example.com"
                                v-model="form.email"
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.email"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ form.errors.email }}</Message
                            >
                        </FormField>

                        <!-- Username -->
                        <FormField name="username" class="flex flex-col gap-1">
                            <label
                                for="license"
                                class="text-sm mb-1 text-slate-800"
                                >Username</label
                            >
                            <InputText
                                id="license"
                                type="text"
                                placeholder="Username"
                                v-model="form.username"
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.username"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ form.errors.username }}</Message
                            >
                        </FormField>

                        <!-- Password -->
                        <FormField name="password" class="flex flex-col gap-1">
                            <label
                                for="password"
                                class="text-sm mb-1 text-slate-800"
                                >Password</label
                            >
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
                                >{{ form.errors.password }}</Message
                            >
                        </FormField>

                        <FormField name="password" class="flex flex-col gap-1">
                            <label
                                for="password"
                                class="text-sm mb-1 text-slate-800"
                                >Confirm Password</label
                            >
                            <Password
                                id="password"
                                name="password"
                                placeholder="••••••••••"
                                v-model="form.password_confirmation"
                                :feedback="false"
                                toggleMask
                                fluid
                                class="user--input"
                            />
                            <Message
                                v-if="form.errors.password_confirmation"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{
                                    form.errors.password_confirmation
                                }}</Message
                            >
                        </FormField>

                        <!-- Submit Button -->
                        <Button
                            type="submit"
                            label="Sign up"
                            class="btn-submit"
                        />
                    </form>
                </div>
            </div>
            <div id="map" class="w-full"></div>
        </div>
    </div>
</template>
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

.label-fullname {
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 8px !important;
}

.firstName {
    width: 139% !important;
}

.lastName {
    width: 139% !important;
}

.btn-submit {
    background-color: rgb(30, 64, 175);
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
