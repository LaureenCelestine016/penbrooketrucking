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
        username: z.string().min(1, { message: "Username is required." }),
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

    <!-- <h2>Login to Penbrooke</h2> -->
    <Form
        v-slot="$form"
        :initialValues
        :resolver
        @submit="submit"
        class="flex flex-col gap-4 w-full sm:w-60"
    >
        <div class="flex flex-col gap-1">
            <InputText
                name="username"
                type="text"
                v-model="form.email"
                placeholder="Username"
                class="user--input"
            />
            <Message
                v-if="$form.username?.invalid"
                severity="error"
                size="small"
                variant="simple"
                >{{ $form.username.error.message }}</Message
            >
        </div>
        <div class="flex flex-col gap-1">
            <Password
                name="password"
                placeholder="Password"
                v-model="form.password"
                :feedback="false"
                toggleMask
                fluid
            />
            <Message
                v-if="$form.password?.invalid"
                severity="error"
                size="small"
                variant="simple"
            >
                <ul class="my-0 px-4 flex flex-col gap-1">
                    <li
                        v-for="(error, index) of $form.password.errors"
                        :key="index"
                    >
                        {{ error.message }}
                    </li>
                </ul>
            </Message>
        </div>
        <Button type="submit" severity="secondary" label="Submit" />
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
.user--input {
    margin-top: 10px;
    height: 50px;
    width: 250%;
    border: ;
}
</style>
