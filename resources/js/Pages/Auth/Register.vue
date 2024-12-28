<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";

import { Form } from "@primevue/forms";

import { FormField } from "@primevue/forms";

import InputText from "primevue/inputtext";

import { useToast } from "primevue/usetoast";

import Message from "primevue/message";

import Password from "primevue/password";

const toast = useToast();

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
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

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="w-full h-14 border-b bg-blue-800">
        <div class="flex h-full w-11/12 mx-auto">
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
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-2 h-screen">
            <div class="flex flex-col items-center justify-center">
                <div class="card flex justify-center w-3/4">
                    <Form
                        :initialValues
                        :resolver
                        @submit="onFormSubmit"
                        class="form"
                    >
                        <h2 class="font-semibold text-2xl text-slate-600 mb-6">
                            Create your Account
                        </h2>
                        <FormField
                            v-slot="$field"
                            name="username"
                            initialValue=""
                            :resolver="zodUserNameResolver"
                            class="flex flex-col gap-1"
                        >
                            <label for="license" class="label"
                                >License Number</label
                            >
                            <InputText
                                id="license"
                                type="text"
                                placeholder="License#"
                                class="user--input"
                            />
                            <Message
                                v-if="$field?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $field.error?.message }}</Message
                            >
                        </FormField>
                        <div class="flex flex-row gap-20">
                            <div>
                                <label for="license" class="label"
                                    >First name</label
                                >
                                <FormField
                                    v-slot="$field"
                                    name="firstname"
                                    initialValue=""
                                    :resolver="yupFirstNameResolver"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="First Name"
                                        class="user--input firstName"
                                    />
                                    <Message
                                        v-if="$field?.invalid"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ $field.error?.message }}</Message
                                    >
                                </FormField>
                            </div>
                            <div>
                                <label for="license" class="label"
                                    >Last name</label
                                >
                                <FormField
                                    v-slot="$field"
                                    name="lastname"
                                    initialValue=""
                                    :resolver="valibotLastNameResolver"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="Last Name"
                                        class="user--input lastName"
                                    />
                                    <Message
                                        v-if="$field?.invalid"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ $field.error?.message }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <FormField
                            v-slot="$field"
                            name="username"
                            initialValue=""
                            :resolver="zodUserNameResolver"
                            class="flex flex-col gap-1"
                        >
                            <label for="license" class="label"
                                >Contact number</label
                            >
                            <InputText
                                id="license"
                                type="text"
                                placeholder="License#"
                                class="user--input"
                            />
                            <Message
                                v-if="$field?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                                >{{ $field.error?.message }}</Message
                            >
                        </FormField>

                        <Button
                            type="submit"
                            severity="secondary"
                            label="Submit"
                        />
                    </Form>
                </div>
            </div>
            <div id="map" class="w-full"></div>
        </div>
    </div>
    <!-- <form @submit.prevent="submit">
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
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
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirm Password" />

            <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Already registered?
            </Link>

            <PrimaryButton
                class="ms-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Register
            </PrimaryButton>
        </div>
    </form> -->
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

.firstName {
    width: 130% !important;
}

.lastName {
    width: 130% !important;
}
</style>
