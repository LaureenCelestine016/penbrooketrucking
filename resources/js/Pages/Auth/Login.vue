<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Form } from "@primevue/forms";
import { zodResolver } from "@primevue/forms/resolvers/zod";
import { z } from "zod";
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

const resolver = zodResolver(
    z.object({
        username: z.string().min(1, { message: "Email is required." }),
        password: z.string().min(1, { message: "Password is required." }),
    })
);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
    toast.add({
        severity: "success",
        summary: "Form is submitted.",
        life: 3000,
    });
};
</script>

<template>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <!-- class="flex flex-col gap-4 w-full sm:w-60" -->
    <Form @submit="submit" class="form">
        <h2 class="font-semibold text-2xl text-slate-600 mb-6">
            Login to Truck Management System
        </h2>
        <div class="flex flex-col gap-1">
            <label for="email" class="label">Email Address</label>
            <InputText
                id="email"
                name="username"
                type="text"
                v-model="form.email"
                placeholder="johndoe@example.com"
                class="user--input"
            />
            <Message
                v-if="form.username?.invalid"
                severity="error"
                size="small"
                variant="simple"
                >{{ form.username.error.message }}</Message
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
                v-if="form.password?.invalid"
                severity="error"
                size="small"
                variant="simple"
            >
                <ul class="my-0 px-4 flex flex-col gap-1">
                    <li
                        v-for="(error, index) of form.password.errors"
                        :key="index"
                    >
                        {{ error.message }}
                    </li>
                </ul>
            </Message>
            <Link
                :href="route('password.request')"
                class="text-blue-600 hover:text-gray-900 self-end"
            >
                Forgot your password?
            </Link>
        </div>

        <Button type="submit" label="Log in" class="btn-submit" />
    </Form>

    <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form> -->
</template>
<style scoped>
.form {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 70%;
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
