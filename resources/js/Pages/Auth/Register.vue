<template>
    <Head title="Admin Registration" />
    <Toast position="top-center" />
    <div
        class="min-h-screen bg-gray-50 flex items-center justify-center py-6 px-4"
    >
        <div
            class="flex flex-col md:flex-row bg-white shadow-xl rounded-3xl overflow-hidden w-full max-w-5xl"
        >
            <!-- Left Section with Stepper -->
            <div class="w-full md:w-1/2 p-6 md:p-8">
                <div class="text-center mb-4">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        Admin Account Setup
                    </h2>
                    <p class="text-gray-500 text-base px-1">
                        Complete the form to create your admin account.
                    </p>
                </div>

                <Stepper v-model:value="activeStep" class="w-full">
                    <form @submit.prevent="submit">
                        <StepPanels class="stepClass">
                            <!-- Step 1 -->
                            <StepPanel :value="1" v-slot="{ activateCallback }">
                                <div class="flex flex-col gap-4 px-1">
                                    <div class="flex flex-row justify-between">
                                        <div class="flex flex-col gap-1">
                                            <label
                                                class="text-gray-700 font-medium"
                                                >First Name<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <InputText
                                                v-model="form.firstname"
                                                placeholder="First name"
                                                class="w-[205px]"
                                            />
                                            <Message
                                                v-if="form.errors.firstname"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.firstname
                                                }}</Message
                                            >
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <label
                                                class="text-gray-700 font-medium"
                                                >Last Name<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <InputText
                                                v-model="form.lastname"
                                                placeholder="Last name"
                                                class="w-[205px]"
                                            />
                                            <Message
                                                v-if="form.errors.lastname"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.lastname
                                                }}</Message
                                            >
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex flex-col gap-1">
                                            <label
                                                class="text-gray-700 font-medium"
                                                >Admin Access Key<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <InputText
                                                v-model="form.access_key"
                                                placeholder="Enter your Admin Access Key"
                                                class="w-full"
                                            />
                                            <Message
                                                v-if="form.errors.access_key"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.access_key
                                                }}</Message
                                            >
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <label class="text-gray-700 font-medium"
                                            >Email Address<span
                                                class="text-xs font-thin ml-1"
                                                >(Optional)</span
                                            ></label
                                        >
                                        <InputText
                                            v-model="form.email"
                                            placeholder="Enter admin email"
                                            class="w-full"
                                        />
                                        <Message
                                            v-if="form.errors.email"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.email }}</Message
                                        >
                                    </div>

                                    <div class="flex justify-between mt-2">
                                        <Button
                                            label="Back"
                                            severity="secondary"
                                            icon="pi pi-arrow-left"
                                            :disabled="activeStep"
                                        />
                                        <Button
                                            label="Next"
                                            icon="pi pi-arrow-right"
                                            iconPos="right"
                                            @click="validateAndProceed"
                                        />
                                    </div>
                                </div>
                            </StepPanel>

                            <!-- Step 2 -->
                            <StepPanel :value="2" v-slot="{ activateCallback }">
                                <div class="flex flex-col gap-4 px-1">
                                    <div class="flex flex-col gap-1">
                                        <label class="text-gray-700 font-medium"
                                            >Mobile Number</label
                                        >
                                        <InputText
                                            v-model="form.mobile"
                                            placeholder="09*********"
                                            class="w-full"
                                        />
                                        <Message
                                            v-if="form.errors.mobile"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.mobile }}</Message
                                        >
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label class="text-gray-700 font-medium"
                                            >Username</label
                                        >
                                        <InputText
                                            v-model="form.username"
                                            placeholder="Choose a username"
                                            class="w-full"
                                        />
                                        <Message
                                            v-if="form.errors.username"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.username }}</Message
                                        >
                                    </div>

                                    <div class="flex flex-row justify-between">
                                        <div class="flex flex-col gap-1">
                                            <label
                                                class="text-gray-700 font-medium"
                                                >Password</label
                                            >
                                            <InputText
                                                v-model="form.password"
                                                type="password"
                                                placeholder="Password"
                                                class="w-full"
                                            />
                                            <Message
                                                v-if="form.errors.password"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.password
                                                }}</Message
                                            >
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <label
                                                class="text-gray-700 font-medium"
                                                >Confirm Password</label
                                            >
                                            <InputText
                                                v-model="
                                                    form.password_confirmation
                                                "
                                                type="password"
                                                placeholder="Confirm Password"
                                                class="w-full"
                                            />
                                            <Message
                                                v-if="
                                                    form.errors
                                                        .password_confirmation
                                                "
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors
                                                        .password_confirmation
                                                }}</Message
                                            >
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-2">
                                        <Button
                                            label="Back"
                                            severity="secondary"
                                            icon="pi pi-arrow-left"
                                            @click="activateCallback(1)"
                                        />
                                        <Button
                                            label="Register as Admin"
                                            type="submit"
                                            icon="pi pi-check"
                                        />
                                    </div>
                                </div>
                            </StepPanel>
                        </StepPanels>
                    </form>
                </Stepper>

                <p class="text-center text-gray-600 text-base">
                    Already an admin?
                    <Link
                        :href="route('login')"
                        class="text-primary font-semibold"
                    >
                        Log in here
                    </Link>
                </p>
            </div>

            <!-- Right Section -->
            <div
                class="hidden md:flex w-1/2 relative items-center justify-center gradient-section"
            >
                <img
                    src="/blog-02-01-22.jpg"
                    alt="Admin Dashboard Illustration"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="absolute inset-0 animated-gradient"></div>
                <div class="text-center text-white z-10 max-w-xs">
                    <h3 class="text-3xl font-semibold mb-4">
                        Penbrooke Administrator Access Portal
                    </h3>
                    <p class="text-lg">
                        Efficiently oversee users, fleet operations, and system
                        settings with your administrator account.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, nextTick } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Stepper from "primevue/stepper";
import StepPanels from "primevue/steppanels";
import StepPanel from "primevue/steppanel";
import Message from "primevue/message";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";

const activeStep = ref(1);
const toast = useToast();

// Errors for manual validation
const localErrors = ref({});

const form = useForm({
    access_key: "",
    firstname: "",
    lastname: "",
    mobile: "",
    username: "",
    password: "",
    email: "",
    password_confirmation: "",
});

const validateAndProceed = () => {
    localErrors.value = {}; // Reset

    if (!form.firstname) localErrors.value.firstname = "First name is required";
    if (!form.lastname) localErrors.value.lastname = "Last name is required";
    if (!form.access_key)
        localErrors.value.access_key = "Access key is required";

    if (Object.keys(localErrors.value).length) {
        showErrorsAsToasts();
        return;
    }

    activeStep.value = 2; // Move to next step
};

const showErrorsAsToasts = () => {
    nextTick(() => {
        Object.values(localErrors.value).forEach((msg) => {
            toast.add({
                severity: "error",
                summary: "Validation Error",
                detail: msg,
                life: 3000,
            });
        });
    });
};

const submit = () => {
    form.post(route("register"), {
        onSuccess: () => {
            form.reset("password", "password_confirmation");
            toast.add({
                severity: "success",
                summary: "Registration Successful",
                detail: "Your account has been created.",
                life: 3000,
            });
        },
        onError: () => {
            // Show backend errors from form.errors
            showBackendErrorsAsToasts(form.errors);

            // Auto-navigate to step 1 if any step 1 field has errors
            const step1Fields = [
                "access_key",
                "firstname",
                "lastname",
                "email",
            ];
            const step1HasErrors = step1Fields.some(
                (field) => form.errors[field]
            );
            if (step1HasErrors) {
                activeStep.value = 1;
            }
        },
    });
};

const showBackendErrorsAsToasts = (errors) => {
    if (!errors) return;

    nextTick(() => {
        Object.values(errors).forEach((msg) => {
            toast.add({
                severity: "error",
                summary: "Validation Error",
                detail: msg,
                life: 3000,
            });
        });
    });
};
</script>

<style scoped>
.animated-gradient {
    background: linear-gradient(
        to right,
        rgba(0, 102, 204, 0.8),
        rgba(0, 76, 153, 0.8),
        rgba(0, 51, 102, 0.8),
        rgba(0, 153, 255, 0.8)
    );
    background-size: 200% 100%;
    animation: gradientBG 6s ease infinite;
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

.step-button {
    background: transparent;
    border: none;
}
</style>
