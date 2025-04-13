<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Trailer
            </h2>
        </template>

        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                <form @submit.prevent="submit" class="p-4">
                    <div class="mb-4 p-4">
                        <div class="">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-8 block"
                                >Trailer Information</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- Plate no. -->
                                <div class="w-full">
                                    <label
                                        for="Plate no."
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Plate Number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="Plate no."
                                        name="Plate no."
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            class="user--input firstName"
                                            placeholder="Plate number"
                                            v-model="form.license_plate"
                                        />
                                        <Message
                                            v-if="form.errors.license_plate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.license_plate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- body number -->
                                <div class="w-full">
                                    <label
                                        for="bodynumber"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Body Number
                                    </label>
                                    <FormField
                                        id="bodynumber"
                                        name="bodynumber"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Body number"
                                            v-model="form.body_number"
                                        />
                                        <Message
                                            v-if="form.errors.body_number"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.body_number
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="w-full">
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
                                            :suggestions="trailerStatus"
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
                        </div>
                        <div class="mt-10">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-6 block"
                                >Registration Details</label
                            >
                            <div class="grid grid-cols-2 gap-10">
                                <!-- Calibration -->
                                <div class="w-full">
                                    <label
                                        for="calibrationDate"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Calibration Registered Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="calibrationDate"
                                        name="calibrationDate"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="calibrationDate"
                                                v-model="form.calibrationDate"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="calibrationDate"
                                                placeholder="Calibration Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.calibrationDate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.calibrationDate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="calibExpDate"
                                        class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                        >Calibration Expiration Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="calibExpDate"
                                        name="calibExpDate"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="calibExpDate"
                                                v-model="
                                                    form.calibrationExpDate
                                                "
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="calibExpDate"
                                                placeholder="Calibration Expired Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.registrationExp"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.registrationExp
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div
                                :class="[
                                    'grid grid-cols-2 gap-10 ',
                                    form.hasErrors ? 'mt-3' : 'mt-6',
                                ]"
                            >
                                <!-- LTO Regig date -->
                                <div class="w-full">
                                    <label
                                        for="LTORegDate"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >LTO Registered Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="LTORegDate"
                                        name="LTORegDate"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="LTORegDate"
                                                v-model="form.LTOregDate"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="LTORegDate"
                                                placeholder="LTO Registration Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.LTOregDate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.LTOregDate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <!-- LTO Exp date -->
                                <div class="w-full">
                                    <label
                                        for="LTOExpDate"
                                        class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                        >LTO Expiration Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="LTOExpDate"
                                        name="LTOExpDate"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="LTOExpDate"
                                                v-model="form.LTOExpDate"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="LTOExpDate"
                                                placeholder="LTO Expired Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.LTOExpDate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.LTOExpDate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-14"
                        />
                    </div>
                </form>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import dayjs from "dayjs";

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

const trailerStatus = ref([]);

const form = useForm({
    license_plate: "",
    body_number: "",
    status: "",
    calibrationDate: "",
    calibrationExpDate: "",
    LTOregDate: "",
    LTOExpDate: "",
});

const submit = () => {
    form.post(route("trailer.store"), {
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
    () => form.LTOregDate, // Only watch this field
    (newValue) => {
        if (newValue) {
            form.LTOregDate = dayjs(newValue).format("YYYY-MM-DD");
            form.LTOExpDate = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.calibrationDate,
    (newValue) => {
        if (newValue) {
            form.calibrationDate = dayjs(newValue).format("YYYY-MM-DD");
            form.calibrationExpDate = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.conveyanceDate,
    (newValue) => {
        if (newValue) {
            form.conveyanceDate = dayjs(newValue).format("YYYY-MM-DD");
            form.conveyanceExpDate = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.filcomFabDate,
    (newValue) => {
        if (newValue) {
            form.filcomFabDate = dayjs(newValue).format("YYYY-MM-DD");
            form.filconExpDate = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.LTFRBRegDate,
    (newValue) => {
        if (newValue) {
            form.LTFRBRegDate = dayjs(newValue).format("YYYY-MM-DD");
            form.LTFRBExpDate = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.PMSCurrentReading,
    () => {
        form.consumeMileage = form.PMSCurrentReading - form.PMSLastMileAge;
    }
);

watch(
    () => form.PMSLastMileAge,
    () => {
        form.consumeMileage = form.PMSCurrentReading - form.PMSLastMileAge;
        form.nextPMSMileage = Number(form.PMSLastMileAge) + 10000;
    }
);

const statusSearch = () => {
    trailerStatus.value = ["Operational", "Non-Operational", "Maintenance"];
};
</script>
