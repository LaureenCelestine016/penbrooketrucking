<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Vehicle
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-6">
                        <!-- Vehicle Infomation -->
                        <div class="mb-11">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Vehicle Information</label
                            >
                            <div class="grid grid-cols-2 gap-10">
                                <div class="w-full">
                                    <label
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Vehicle Name<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="vehicle_name"
                                        name="vehicle_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Vehicle Name"
                                            class="user--input firstName"
                                            v-model="form.vehicleName"
                                        />
                                        <Message
                                            v-if="form.errors.vehicleName"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.vehicleName
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="model"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Model<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="model"
                                        name="model"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Model"
                                            v-model="form.model"
                                        />
                                        <Message
                                            v-if="form.errors.model"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.model }}</Message
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
                                <div class="w-full">
                                    <label
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Vehicle Type<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="vehicle_name"
                                        name="vehicle_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="vehicle_type"
                                            class="w-full"
                                            v-model="form.vehicleType"
                                            :suggestions="vehicleTypeArr"
                                            @complete="vehicleTypeSearch"
                                            dropdown
                                            placeholder="Vehicle Type"
                                        />
                                        <Message
                                            v-if="form.errors.vehicleType"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.vehicleType
                                            }}</Message
                                        >
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
                                            :suggestions="vehicleStatus"
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
                        <!-- Registration Details -->
                        <div class="mb-11">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Registration Details</label
                            >

                            <div class="grid grid-cols-2 gap-10">
                                <div class="w-100">
                                    <label
                                        for="registration_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Registration Number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="registration_number"
                                        name="registration_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Registration no."
                                            class="user--input firstName"
                                            v-model="form.registrationNumber"
                                        />
                                        <Message
                                            v-if="
                                                form.errors.registrationNumber
                                            "
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.registrationNumber
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-100">
                                    <label
                                        for="license_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >License Plate Number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="license_number"
                                        name="license_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="License Plate no."
                                            v-model="form.license_number"
                                        />
                                        <Message
                                            v-if="form.errors.plateNumber"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.plateNumber
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
                                <div class="w-100">
                                    <label
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Registration Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="registration_date"
                                        name="registration_date"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.registrationDate"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="registrationExp"
                                                placeholder="Registration Expired Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.registrationDate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.registrationDate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-100">
                                    <label
                                        for="vehicle_type"
                                        class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                        >Registration Expiration Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="registration_expired"
                                        name="registration_expired"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.registrationExp"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="registrationExp"
                                                placeholder="Registration Expired Date"
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
                        </div>
                        <!-- Technical Specifications -->
                        <div class="mb-4">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Technical Specifications</label
                            >

                            <div class="grid grid-cols-2 gap-10">
                                <div class="w-full">
                                    <label
                                        for="engine_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Engine Number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="engine_number"
                                        name="engine_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="engine_number"
                                            type="text"
                                            placeholder="Engine No."
                                            v-model="form.engineNumber"
                                        />
                                        <Message
                                            v-if="form.errors.engineNumber"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.engineNumber
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="chassis_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Chassis Number<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="chassis_number"
                                        name="chassis_number"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="chassis_number"
                                            type="text"
                                            placeholder="Chassis No."
                                            v-model="form.chassisNumber"
                                        />
                                        <Message
                                            v-if="form.errors.chassisNumber"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.chassisNumber
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
                                <div class="w-full">
                                    <label
                                        for="manufacturer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Manufacturer<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="manufacturer"
                                        name="manufacturer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="manufacturer"
                                            type="text"
                                            placeholder="Manufacture"
                                            v-model="form.manufacture"
                                        />
                                        <Message
                                            v-if="form.errors.manufacture"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.manufacture
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="manufacturer_year"
                                        class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                        >Manufacture Year<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="manufacturer_year"
                                        name="manufacturer_year"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="manufacturer_year"
                                            type="number"
                                            placeholder="Manufacture Year"
                                            v-model="form.manufactureYear"
                                        />
                                        <Message
                                            v-if="form.errors.manufactureYear"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.manufactureYear
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
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
                                :headers="csrfHeaders"
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
                            class="w-full mt-16"
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
import { watch, ref } from "vue";
import dayjs from "dayjs";

import Toolbar from "primevue/toolbar";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import { FormField } from "@primevue/forms";

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const toast = useToast();
const vehicleTypeArr = ref([]);
const vehicleStatus = ref([]);
const csrfHeaders = ref({
    "X-CSRF-TOKEN": csrfToken,
});

const form = useForm({
    registrationNumber: "",
    vehicleName: "",
    vehicleType: "",
    model: "",
    plateNumber: "",
    chassisNumber: "",
    engineNumber: "",
    manufacture: "",
    manufactureYear: "",
    status: "",
    registrationDate: "",
    registrationExp: "",
});

const submit = () => {
    form.post(route("vehicle.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Vehicle created successfully!",
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
    form,
    function (old, newForm) {
        form.registrationDate = form.registrationDate
            ? dayjs(newForm.registrationDate).format("YYYY-MM-DD")
            : "";
        form.registrationExp = form.registrationDate
            ? dayjs(form.registrationDate).add(1, "year").format("YYYY-MM-DD")
            : old.registrationExp;
    },
    { deep: true }
);

const vehicleTypeSearch = () => {
    vehicleTypeArr.value = ["Truck", "Taxi", "Bus", "Taxi", "Jeep"];
};

const statusSearch = () => {
    vehicleStatus.value = ["Active", "Inactive", "Maintenance"];
};

const goBack = () => {
    history.back();
};
</script>

<style scoped>
.btn--back {
    margin-right: 8px;
    display: flex;
    gap: 6px;
    background-color: #0813ad;
    color: #ebfbee;
    padding: 8px 12px 8px 12px;
    border-radius: 6px;
    font-weight: 600;
}
</style>

<!-- Registration number: HR26DQ5551
Vehicle Name : Truck
Vehicle Type : Truck
Model : 2016 GMC Canyon
Plate no. PAQ323
Chassis no. WDB1290601F012345
Engine no. 52WVC10338
Manufacture : Western Star Trucks
Manufacture Year: 1990 -->
