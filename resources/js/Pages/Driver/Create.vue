<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Driver
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <!-- Personal Information -->
                        <div class="mb-4">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Personal Information</label
                            >
                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <!-- firstName -->
                                <div class="w-100">
                                    <label
                                        for="First_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >First name<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="First_name"
                                        name="First_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.firstName"
                                            class="user--input firstName"
                                            placeholder="First name"
                                        />
                                        <Message
                                            v-if="form.errors.firstName"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.firstName
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- middlename -->
                                <div class="w-100">
                                    <label
                                        for="middle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Middle Name
                                    </label>
                                    <FormField
                                        id="middle_name"
                                        name="middle_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.middleName"
                                            placeholder="Middle name"
                                        />
                                        <Message
                                            v-if="form.errors.middle"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <!-- lastname -->
                                <div class="w-100">
                                    <label
                                        for="last_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Last name<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="last_name"
                                        name="last_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Last name"
                                            class="user--input firstName"
                                            v-model="form.lastName"
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

                            <div
                                class="grid grid-cols-3 gap-10 mb-4 items-center"
                            >
                                <!-- Civil Status -->
                                <div class="w-100">
                                    <label
                                        for="civil_status"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Civil Status<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="civil_status"
                                        name="civil_status"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="status"
                                            class="w-full"
                                            v-model="form.civilStatus"
                                            :suggestions="civilStatus"
                                            @complete="civilStatusSearch"
                                            dropdown
                                            placeholder="Civil Status"
                                        />
                                        <Message
                                            v-if="form.errors.civilStatus"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.civilStatus
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Birthday -->
                                <div class="w-100">
                                    <label
                                        for="birthday"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Birthday<span class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="age"
                                        name="age"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.birthDay"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="birthday"
                                                placeholder="Birthday"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.birthDay"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.birthDay }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- age -->
                                <div class="w-100">
                                    <label
                                        for="age"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Age<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="age"
                                        name="age"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            disabled="true"
                                            type="number"
                                            class="classAge"
                                            v-model="form.age"
                                            placeholder="Age"
                                        />
                                        <Message
                                            v-if="form.errors.age"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.age }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <!-- Address -->
                                <div class="w-100">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Address<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="civil_status"
                                        name="civil_status"
                                        class="flex flex-col gap-1"
                                    >
                                        <Textarea
                                            v-model="form.address"
                                            variant="filled"
                                            rows="3"
                                            cols="30"
                                            placeholder="Address"
                                        />
                                        <Message
                                            v-if="form.errors.address"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.address }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Contact number -->
                                <div class="w-100">
                                    <label
                                        for="contact_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="age"
                                        name="age"
                                        class="flex flex-col gap-1"
                                    >
                                        <input
                                            id="phone"
                                            type="tel"
                                            ref="phoneInput"
                                            v-model="form.contactNumber"
                                        />
                                        <p v-if="phoneNumber">
                                            Formatted Phone Number:
                                            {{ phoneNumber }}
                                        </p>
                                        <Message
                                            v-if="form.errors.contactNumber"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contactNumber
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Contact Person -->
                                <div class="w-100">
                                    <label
                                        for="age"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact Person<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="last_name"
                                        name="last_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <input
                                            id="phone"
                                            type="tel"
                                            ref="phoneInputPerson"
                                            v-model="form.contactPerson"
                                        />

                                        <Message
                                            v-if="form.errors.contactPerson"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contactPerson
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <!-- Government Id -->
                        <div>
                            <label
                                for="First_name"
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 mt-8 block"
                                >Government Id's</label
                            >

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Philhealth no. -->
                                <div class="w-100">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Philhealth no.</label
                                    >
                                    <FormField
                                        id="civil_status"
                                        name="civil_status"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="plate_no"
                                            type="text"
                                            v-model="form.philhealth_no"
                                            placeholder="Philhealth no."
                                        />
                                        <Message
                                            v-if="form.errors.philhealth_no"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.philhealth_no
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Pagibig no. -->
                                <div class="w-100">
                                    <label
                                        for="contact_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Pagibig no.
                                    </label>
                                    <FormField
                                        id="age"
                                        name="age"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.pagibig_no"
                                            placeholder="Pagibig no."
                                        />
                                        <Message
                                            v-if="form.errors.pagibig_no"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.pagibig_no
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- SSS no. -->
                                <div class="w-100">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >SSS no.</label
                                    >
                                    <FormField
                                        id="civil_status"
                                        name="civil_status"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="plate_no"
                                            type="text"
                                            v-model="form.sss_no"
                                            placeholder="SSS no."
                                        />
                                        <Message
                                            v-if="form.errors.sss_no"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.philhealth_no
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Pagibig no. -->
                                <div class="w-100">
                                    <label
                                        for="contact_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >TIN no.
                                    </label>
                                    <FormField
                                        id="age"
                                        name="age"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.tin_no"
                                            placeholder="TIN no."
                                        />
                                        <Message
                                            v-if="form.errors.tin_no"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.tin_no }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <!-- License Details -->
                        <div>
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 mt-8 block"
                                >License Details</label
                            >

                            <div
                                class="grid grid-cols-2 gap-10 mb-4 items-center"
                            >
                                <!-- License no.-->
                                <div class="w-100">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >License no.<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="civil_status"
                                        name="civil_status"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="plate_no"
                                            type="text"
                                            v-model="form.license_number"
                                            placeholder="License no."
                                        />
                                        <Message
                                            v-if="form.errors.license_number"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.license_number
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- License Expired Date. -->
                                <div class="w-100">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >License Expired Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="license_expired_date"
                                        name="license_expired_date"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.license_expired"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="license_expired"
                                                placeholder="Expiration Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.license_expired"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.license_expired
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <!-- Account Details -->
                        <div>
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 mt-8 block"
                                >Account Details</label
                            >

                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <!-- Username-->
                                <div class="w-100">
                                    <label
                                        for="username"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Username<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="username"
                                        name="username"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="username"
                                            type="text"
                                            v-model="form.username"
                                            placeholder="Username"
                                        />
                                        <Message
                                            v-if="form.errors.username"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.username }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Password -->
                                <div class="w-100">
                                    <label
                                        for="password"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Password<span class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="password"
                                        name="password"
                                        class="flex flex-col gap-1"
                                    >
                                        <Password
                                            id="password"
                                            name="password"
                                            placeholder="Password"
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
                                </div>
                                <!-- Confirm password -->
                                <div class="w-100">
                                    <label
                                        for="confirm_password"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Repeat Password<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="confirm_password"
                                        name="confirm_password"
                                        class="flex flex-col gap-1"
                                    >
                                        <Password
                                            id="password"
                                            name="password"
                                            placeholder="Confirm password"
                                            v-model="form.password_confirmation"
                                            :feedback="false"
                                            toggleMask
                                            fluid
                                            class="user--input"
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
                                    </FormField>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-10 items-center">
                            <div class="w-100">
                                <label
                                    for="email"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Email Address
                                    <span class="text-red-400">(Optional)</span>
                                </label>
                                <FormField
                                    id="email"
                                    name="email"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="email"
                                        type="text"
                                        v-model="form.email_address"
                                        placeholder="Email Address"
                                    />
                                </FormField>
                            </div>
                            <div class="w-100">
                                <label
                                    for="status"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Status<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="status"
                                    name="status"
                                    class="flex flex-col gap-1"
                                >
                                    <AutoComplete
                                        id="status"
                                        class="w-full"
                                        v-model="form.status"
                                        :suggestions="driverStatus"
                                        @complete="statusSearch"
                                        dropdown
                                        placeholder="Status"
                                    />
                                    <Message
                                        v-if="form.errors.status"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.status }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <div class="w-100 mt-8">
                            <label
                                for="image_upload"
                                class="text-slate-800 dark:text-surface-0 text-sm font-medium mb-2 block"
                                >Image Upload</label
                            >
                            <Toast />

                            <FileUpload
                                for="image_upload"
                                url="/image/upload"
                                @upload="onAdvancedUpload($event)"
                                :multiple="true"
                                accept="image/*"
                                :maxFileSize="1000000"
                            >
                                <template #empty>
                                    <span
                                        >Drag and drop files to here to
                                        upload.</span
                                    >
                                </template>
                            </FileUpload>
                        </div>

                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-14"
                        />
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted, onBeforeUnmount, watch } from "vue";

import Toolbar from "primevue/toolbar";
import Password from "primevue/password";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import { FormField } from "@primevue/forms";
import Textarea from "primevue/textarea";
import "primeicons/primeicons.css";
import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

const toast = useToast();
const civilStatus = ref([]);
const driverStatus = ref([]);
const phoneInput = ref(null);
const phoneInputPerson = ref(null);
const phoneNumber = ref("");

let iti = null;

const form = useForm({
    firstName: "",
    middleName: "",
    lastName: "",
    civilStatus: "",
    birthDay: "",
    age: "",
    address: "",
    contactNumber: "",
    contactPerson: "",
    philhealth_no: "",
    pagibig_no: "",
    sss_no: "",
    tin_no: "",
    license_number: "",
    license_expired: "",
    username: "",
    email_address: "",
    password: "",
    password_confirmation: "",
    status: "",
});

watch(
    form,
    function (old, newForm) {
        const birthday = new Date(newForm.birthDay);
        const birthYear = birthday.getFullYear();

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();

        form.age = currentYear - birthYear;
    },
    { deep: true }
);

const submit = () => {
    form.post(route("driver.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Driver created successfully!",
                life: 3000,
            });
        },
        onError: () => {
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "There were errors in your form submission.",
                life: 3000,
            });
        },
    });
};

onMounted(() => {
    // Initialize intl-tel-input

    iti = intlTelInput(phoneInput.value, {
        initialCountry: "auto",
        geoIpLookup: (callback) => {
            fetch("https://ipapi.co/json")
                .then((response) => response.json())
                .then((data) => callback(data.country_code))
                .catch(() => callback("US"));
        },
        utilsScript:
            "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/js/utils.js", // For number validation/formatting
    });

    // Listen for changes
    phoneInput.value.addEventListener("blur", () => {
        phoneNumber.value = iti.getNumber(); // Get full international phone number
    });
});

onMounted(() => {
    // Initialize intl-tel-input
    iti = intlTelInput(phoneInputPerson.value, {
        initialCountry: "auto",
        geoIpLookup: (callback) => {
            fetch("https://ipapi.co/json")
                .then((response) => response.json())
                .then((data) => callback(data.country_code))
                .catch(() => callback("US"));
        },
        utilsScript:
            "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/js/utils.js", // For number validation/formatting
    });

    // Listen for changes
    phoneInputPerson.value.addEventListener("blur", () => {
        phoneNumber.value = iti.getNumber(); // Get full international phone number
    });
});

onBeforeUnmount(() => {
    // Destroy intl-tel-input instance
    if (iti) iti.destroy();
});

const statusSearch = () => {
    driverStatus.value = ["Active", "Inactive"];
};

const civilStatusSearch = () => {
    civilStatus.value = ["Single", "Married", "Widowed", "Divorced"];
};

const goBack = () => {
    history.back();
};
</script>

<style scoped>
/* Optional styling for your input */
input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 6px;
    border: #adb5bd 1px solid;
}

.classAge {
    background-color: whitesmoke !important;
}
</style>
