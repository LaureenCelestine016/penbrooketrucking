<template>
    <Head title="Driver" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                My Profile
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit" class="p-2">
                    <div class="p-8">
                        <div class="mb-10">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-semibold mb-4 block"
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
                                            v-model="form.first_name"
                                            class="classText"
                                            placeholder="First name"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.first_name"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.first_name
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- middlename -->
                                <div class="w-100">
                                    <label
                                        for="Middle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Middle Name
                                    </label>
                                    <FormField
                                        id="Middle_name"
                                        name="Middle_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.middle_name"
                                            placeholder="Middle name"
                                            class="classText"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.middle_name"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.middle_name
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- lastname -->
                                <div class="w-100">
                                    <label
                                        for="Last_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Last name<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="Last_name"
                                        name="Last_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Last name"
                                            class="classText"
                                            v-model="form.last_name"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.last_name"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.last_name
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-10 items-start">
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
                                            class="classText"
                                            v-model="form.civil_status"
                                            :suggestions="civilStatus"
                                            @complete="civilStatusSearch"
                                            dropdown
                                            placeholder="Civil Status"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.civil_status"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.civil_status
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Birthday && Age -->
                                <div class="flex flex-rows gap-3">
                                    <div class="w-100">
                                        <label
                                            for="birthday"
                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                            >Birthday<span
                                                class="ml-1 text-red-400"
                                                >*</span
                                            >
                                        </label>
                                        <FormField
                                            id="birthday"
                                            name="birthday"
                                            class="flex flex-col gap-1"
                                        >
                                            <div class="flex-auto">
                                                <DatePicker
                                                    id="registration_expired"
                                                    v-model="form.birthday"
                                                    showIcon
                                                    fluid
                                                    :showOnFocus="false"
                                                    inputId="birthday"
                                                    placeholder="Birthday"
                                                    disabled=""
                                                    class="classText"
                                                />
                                            </div>
                                            <Message
                                                v-if="form.errors.birthday"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.birthday
                                                }}</Message
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
                                                type="text"
                                                class="classText"
                                                v-model="form.age"
                                                placeholder="Age"
                                                disabled=""
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
                                <div class="w-100">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Address<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="address"
                                        name="address"
                                        class="flex flex-col gap-1"
                                    >
                                        <Textarea
                                            v-model="form.address"
                                            variant="filled"
                                            rows="2"
                                            cols="30"
                                            placeholder="Address"
                                            disabled
                                            class="classText"
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
                            </div>
                        </div>
                        <div class="mb-10">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-semibold mb-4 block"
                                >Contact Information</label
                            >

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- contact_number -->
                                <div class="w-100">
                                    <label
                                        for="contact_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact no.</label
                                    >
                                    <FormField
                                        id="contact_number"
                                        name="contact_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.contact_number"
                                            class="classText"
                                            placeholder="Contact no."
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.contact_number"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contact_number
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- contact_person -->
                                <div class="w-100">
                                    <label
                                        for="contact_person"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact Person
                                        <span class="text-xs font-thin"
                                            >(Incase of Emergency)</span
                                        >
                                    </label>
                                    <FormField
                                        id="contact_person"
                                        name="contact_person"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.contact_person"
                                            placeholder="Contact Person"
                                            disabled=""
                                            class="classText"
                                        />
                                        <Message
                                            v-if="form.errors.contact_person"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contact_person
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10">
                                <!-- contact_#_person -->
                                <div class="w-100">
                                    <label
                                        for="contact_#_person"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact no.
                                        <span class="text-xs font-thin"
                                            >(of Person Incase of
                                            Emergency)</span
                                        >
                                    </label>
                                    <FormField
                                        id="contact_#_person"
                                        name="contact_#_person"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Last name"
                                            class="classText"
                                            v-model="form.contact_no_person"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.contact_no_person"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contact_no_person
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-100">
                                    <label
                                        for="relation"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Relation<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="relation"
                                        name="relation"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="status"
                                            class="w-full"
                                            v-model="form.relation"
                                            :suggestions="relation"
                                            @complete="relationSearch"
                                            dropdown
                                            placeholder="Relation"
                                            disabled=""
                                        />
                                        <Message
                                            v-if="form.errors.relation"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.relation }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-semibold mb-4 block"
                                >Government Id's</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Philhealth no. -->
                                <div class="w-100">
                                    <label
                                        for="philhealth"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Philhealth no.</label
                                    >
                                    <FormField
                                        id="philhealth"
                                        name="philhealth"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="philhealth"
                                            type="text"
                                            v-model="form.philhealth_no"
                                            placeholder="Philhealth no."
                                            disabled=""
                                            class="classText"
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
                                        for="pagibig"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Pagibig no.
                                    </label>
                                    <FormField
                                        id="pagibig"
                                        name="pagibig"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.pagibig_no"
                                            placeholder="Pagibig no."
                                            disabled=""
                                            class="classText"
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
                                        for="sss_no"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >SSS no.</label
                                    >
                                    <FormField
                                        id="sss_no"
                                        name="sss_no"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="plate_no"
                                            type="text"
                                            v-model="form.sss_no"
                                            placeholder="SSS no."
                                            disabled=""
                                            class="classText"
                                        />
                                        <Message
                                            v-if="form.errors.sss_no"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.sss_no }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- TIN no. -->
                                <div class="w-100">
                                    <label
                                        for="tin_no"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >TIN no.
                                    </label>
                                    <FormField
                                        id="tin_no"
                                        name="tin_no"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.tin_no"
                                            placeholder="TIN no."
                                            disabled=""
                                            class="classText"
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
                        <div>
                            <label
                                class="text-customblue dark:text-surface-0 text-xl font-semibold mb-4 block"
                                >License Detail</label
                            >

                            <div
                                class="grid grid-cols-2 gap-10 mb-4 items-center"
                            >
                                <!-- License no.-->
                                <div class="w-100">
                                    <label
                                        for="license_no"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >License no.<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="license_no"
                                        name="license_no"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="license_no"
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
                        <div class="mb-8">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 mt-8 block"
                                >Account Details</label
                            >

                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <!-- Username-->
                                <div class="w-full">
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
                                            v-model="form.user.username"
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
                                <div class="w-full">
                                    <label
                                        for="password"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Change Password<span
                                            class="ml-1 text-red-400"
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
                                <div class="w-full">
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

                            <div class="">
                                <div class="w-full">
                                    <label
                                        for="email"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Email Address
                                        <span class="text-red-400"
                                            >(Optional)</span
                                        >
                                    </label>
                                    <FormField
                                        id="email"
                                        name="email"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="email"
                                            type="text"
                                            v-model="form.user.email_address"
                                            placeholder="Email Address"
                                        />
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <Button
                            label="UPDATE CHANGE"
                            type="submit"
                            icon="pi pi-pencil"
                            class="w-full mt-4"
                        />
                    </div>
                </form>
            </div></div
    ></AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import dayjs from "dayjs";

import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import Textarea from "primevue/textarea";
import Button from "primevue/button";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Message from "primevue/message";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import Dialog from "primevue/dialog";
import Password from "primevue/password";

const toast = useToast();

const props = defineProps({
    driverProfile: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    ...props.driverProfile,
    password: "", // Add missing password fields
    password_confirmation: "",
    license_number: props.driverProfile.license_number || "",
    license_expired: props.driverProfile.license_expired || "",
});

const submit = () => {
    form.post(route("driver.userupdate"), {
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

watch(
    () => form.license_expired,
    (newValue) => {
        if (newValue) {
            form.license_expired = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);
</script>

<style scope>
.classText {
    background-color: whitesmoke !important;
    width: 100%;
}
</style>
