<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div
            class="flex flex-col md:flex-row bg-white shadow-xl rounded-3xl overflow-hidden w-full max-w-5xl"
        >
            <!-- Left Section -->
            <div class="w-full md:w-1/2 p-8 md:p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        Penbrooke Trucking Inc.
                    </h2>
                    <p class="text-gray-500">
                        Log in to your account to continue
                    </p>
                </div>

                <form @submit.prevent="submit">
                    <label class="block mb-2 text-gray-700"
                        >Email or Username</label
                    >
                    <InputText
                        v-model="form.login"
                        placeholder="Enter your email or username"
                        class="w-full mb-4"
                    />
                    <Message
                        v-if="form.errors.login"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ form.errors.login }}</Message
                    >

                    <label class="block mb-2 text-gray-700">Password</label>
                    <InputText
                        v-model="form.password"
                        type="password"
                        placeholder="Enter your password"
                        class="w-full mb-4"
                    />
                    <Message
                        v-if="form.errors.password"
                        severity="error"
                        size="small"
                        variant="simple"
                        >{{ form.errors.password }}</Message
                    >

                    <div class="flex justify-between items-center mb-4 mt-4">
                        <div class="flex items-center">
                            <Checkbox
                                v-model="checked1"
                                :binary="true"
                                class="mr-2"
                            />
                            <label class="text-gray-600">Remember me</label>
                        </div>
                        <a href="#" class="text-primary font-semibold"
                            >Forgot Password?</a
                        >
                    </div>

                    <Button
                        label="Log In"
                        type="submit"
                        class="w-full py-3 text-lg"
                    />
                </form>

                <!-- <p class="text-center mt-4 text-gray-600">
                    Don't have an account?
                    <a href="#" class="text-primary font-semibold"
                        >Create one</a
                    >
                </p> -->
            </div>

            <!-- Right Section with Gradient Animation -->
            <div
                class="hidden md:flex w-1/2 relative items-center justify-center gradient-section"
            >
                <img
                    src="/blog-02-01-22.jpg"
                    alt="Truck Fleet"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="absolute inset-0 animated-gradient"></div>

                <div class="text-center text-white z-10 max-w-xs">
                    <h3 class="text-3xl font-semibold mb-4">
                        Streamline Your Fleet Operations
                    </h3>
                    <p class="text-lg">
                        Effortlessly track your trucks, manage routes, and
                        ensure on-time deliveries with our customizable
                        dashboard.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Checkbox from "primevue/checkbox";

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

/* graident right section */
.animated-gradient {
    background: linear-gradient(
        to right,
        rgba(0, 102, 204, 0.8),
        /* Bright Blue */ rgba(0, 76, 153, 0.8),
        /* Deep Blue */ rgba(0, 51, 102, 0.8),
        /* Darker Navy Blue */ rgba(0, 153, 255, 0.8) /* Sky Blue */
    );
    background-size: 200% 100%; /* Double width for smooth animation */
    animation: gradientBG 6s ease infinite;
    border-radius: 0;
}

@keyframes gradientBG {
    0% {
        background-position: 0% 0;
    }
    50% {
        background-position: 100% 0;
    }
    100% {
        background-position: 0% 0;
    }
}
</style>
