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
                                <div class="w-full">
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
                                <div class="w-full">
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
                                <div class="w-full">
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
                                class="grid grid-cols-3 gap-10 mb-4 items-start"
                            >
                                <!-- Civil Status -->
                                <div class="w-full">
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
                                            v-if="form.errors.relation"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.relation }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- Birthday & Age -->
                                <div class="flex items-center gap-5">
                                    <!-- Birthday -->
                                    <div class="w-full">
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
                                                    id="birthday"
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
                                                >{{
                                                    form.errors.birthDay
                                                }}</Message
                                            >
                                        </FormField>
                                    </div>
                                    <!-- age -->
                                    <div class="w-full">
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
                                            class="flex flex-col gap-1 class-age"
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
                                <!-- Address -->
                                <div class="w-full">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Address<span class="ml-1 text-red-400"
                                            >*</span
                                        ><span class="text-xs font-thin"
                                            >(Street,
                                            Brgy.,Municipality,Province)</span
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
                            </div>
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Contact Information</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Contact number -->
                                <div class="w-full">
                                    <label
                                        for="contact_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact no.<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="contact_number"
                                        name="contact_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <input
                                            id="contact_number"
                                            type="tel"
                                            ref="phoneInput"
                                            v-model="form.contactNumber"
                                            placeholder="Contact no."
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
                                <div class="w-full">
                                    <label
                                        for="contact_person"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact Person
                                        <span class="text-xs font-thin"
                                            >(Incase of Emergency)</span
                                        >
                                        <span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="contact_person"
                                        name="contact_person"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.contactNamePerson"
                                            placeholder="Contact Person"
                                        />

                                        <Message
                                            v-if="form.errors.contactNamePerson"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.contactNamePerson
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Contact number -->
                                <div class="w-full">
                                    <label
                                        for="contact_number_person"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Contact no.<span
                                            class="text-xs font-thin ml-1"
                                            >(of Person Incase of
                                            Emergency)</span
                                        ><span class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="contact_number_person"
                                        name="contact_number_person"
                                        class="flex flex-col gap-1"
                                    >
                                        <input
                                            id="phone"
                                            type="tel"
                                            ref="phoneInputPerson"
                                            v-model="form.contactPerson"
                                            placeholder="Contact no."
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
                                <!-- Relation -->
                                <div class="w-full">
                                    <label
                                        for="relation"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Relation
                                        <span class="ml-1 text-red-400"
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
                        <!-- Government Id -->
                        <div>
                            <label
                                for="First_name"
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 mt-8 block"
                                >Government Id's</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Philhealth no. -->
                                <div class="w-full">
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
                                        <!-- <InputText
                                            id="plate_no"
                                            type="text"
                                            v-model="form.philhealth_no"
                                            placeholder="Philhealth no."
                                        /> -->
                                        <InputMask
                                            id="ssn"
                                            v-model="form.philhealth_no"
                                            mask="99-999999999-9"
                                            placeholder="00-000000000-0"
                                            fluid
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
                                <div class="w-full">
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
                                        <InputMask
                                            id="ssn"
                                            v-model="form.pagibig_no"
                                            mask="9999-9999-9999"
                                            placeholder="0000-0000-0000"
                                            fluid
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
                                <div class="w-full">
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
                                        <InputMask
                                            id="ssn"
                                            v-model="form.sss_no"
                                            mask="99-9999999-9"
                                            placeholder="00-0000000-0"
                                            fluid
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
                                <div class="w-full">
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
                                        <InputMask
                                            id="ssn"
                                            v-model="form.tin_no"
                                            mask="999-999-999-999"
                                            placeholder="000-000-000-000"
                                            fluid
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
                                <div class="w-full">
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
                                        <InputMask
                                            id="ssn"
                                            v-model="form.license_number"
                                            mask="a99-99-999999"
                                            placeholder="000-00-000000"
                                            fluid
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
                                <div class="w-full">
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
                                <div class="w-full">
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
                        </div>

                        <div class="grid grid-cols-2 gap-10 items-center">
                            <div class="w-full">
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
                            <div class="w-full">
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
                        <div class="w-full mt-8">
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
import InputMask from "primevue/inputmask";
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
const relation = ref([]);
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
    contactNamePerson: "",
    contactPerson: "",
    relation: "",
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

const relationSearch = () => {
    relation.value = [
        "Spouse",
        "Father",
        "Mother",
        "Children",
        "Sibling",
        "Other",
    ];
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
    width: 180px;
}
</style>
