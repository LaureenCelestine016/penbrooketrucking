<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Vehicle
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-89rem mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Toolbar class="mb-6">
                        <template #start>
                            <Button
                                label="Go back"
                                icon="pi pi-chevron-circle-left"
                                severity="info"
                                @click="goBack"
                            />
                        </template>
                    </Toolbar>

                    <form @submit.prevent="submit" class="p-5">
                        <div class="grid grid-cols-2 gap-10">
                            <div class="w-100">
                                <label
                                    for="registration_number"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Registration Number</label
                                >
                                <FormField
                                    id="registration_number"
                                    name="registration_number"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="Registration Number"
                                        class="user--input firstName"
                                        v-model="form.registrationNumber"
                                    />
                                    <Message
                                        v-if="form.errors.registrationNumber"
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
                                    for="vehicle_name"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Vehicle Name</label
                                >
                                <FormField
                                    id="vehicle_name"
                                    name="vehicle_name"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        type="text"
                                        placeholder="Vehicle Name"
                                        v-model="form.vehicleName"
                                    />
                                    <Message
                                        v-if="form.errors.vehicleName"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.vehicleName }}</Message
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
                                    for="vehicle_type"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Vehicle Type</label
                                >
                                <FormField
                                    id="vehicle_type"
                                    name="vehicle_type"
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
                                        >{{ form.errors.vehicleType }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-100">
                                <label
                                    for="model"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Model</label
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
                            <div class="w-100">
                                <label
                                    for="plate_no"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Plate No.</label
                                >
                                <FormField
                                    id="plate_no"
                                    name="plate_no"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="plate_no"
                                        type="text"
                                        placeholder="Plate No."
                                        v-model="form.plateNumber"
                                    />
                                    <Message
                                        v-if="form.errors.plateNumber"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.plateNumber }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-100">
                                <label
                                    for="chassis_no"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Chassis No.</label
                                >
                                <FormField
                                    id="chassis_no"
                                    name="chassis_no"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="chassis_no"
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
                            <div class="w-100">
                                <label
                                    for="engine_no"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Engine No.</label
                                >
                                <FormField
                                    id="engine_no"
                                    name="engine_no"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="chassis_no"
                                        type="text"
                                        placeholder="Engine No."
                                        v-model="form.engineNumber"
                                    />
                                    <Message
                                        v-if="form.errors.engineNumber"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.engineNumber }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-100">
                                <label
                                    for="manufacturer"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Manufacture</label
                                >
                                <FormField
                                    id="manufacture"
                                    name="manufacture"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="manufacture"
                                        type="text"
                                        placeholder="Manufacture"
                                        v-model="form.manufacture"
                                    />
                                    <Message
                                        v-if="form.errors.manufacture"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.manufacture }}</Message
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
                                    for="manufacturer_year"
                                    class="text-gray-600 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Manufacturer Year</label
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
                            <div class="w-100">
                                <label
                                    for="status"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Status</label
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

                        <div
                            :class="[
                                'grid grid-cols-2 gap-10 ',
                                form.hasErrors ? 'mt-3' : 'mt-6',
                            ]"
                        >
                            <div class="w-100">
                                <label
                                    for="registration_date"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Registration Date</label
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
                                    for="registration_expired"
                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                    >Registration Expired Date</label
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

                        <div class="w-100 mt-5">
                            <label
                                for="image_upload"
                                class="text-slate-800 dark:text-surface-0 text-sm font-medium mb-2 block"
                                >Image Upload</label
                            >
                            <Toast />

                            <FileUpload
                                for="image_upload"
                                name="demo[]"
                                url="/api/upload"
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
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";

import Toolbar from "primevue/toolbar";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import { FormField } from "@primevue/forms";

const toast = useToast();
const vehicleTypeArr = ref([]);
const vehicleStatus = ref([]);

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
    console.log("Test");

    form.post(route("vehicle.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Vehicle successfully added!",
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
        onFinish: () => form.reset("password"),
    });
};

const formattedDate = computed(() => {
    if (!form.registrationDate) return "";
    const inputDate = new Date(form.registrationDate);
    const year = inputDate.getFullYear();
    const month = String(inputDate.getMonth() + 1).padStart(2, "0");
    const day = String(inputDate.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
});

const afterAYear = computed(() => {
    if (!formattedDate) return "";
    const inputDate = new Date(formattedDate);
    inputDate.setFullYear(toDisplayString.getFullYear() + 1);
    const year = inputDate.getFullYear();
    const month = String(inputDate.getMonth() + 1).padStart(2, "0");
    const day = String(inputDate.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
});

const vehicleTypeSearch = () => {
    vehicleTypeArr.value = ["Truck", "Tricycle", "Jeep"];
};

const statusSearch = () => {
    vehicleStatus.value = ["Active", "Inactive", "Maintenance"];
};

const onAdvancedUpload = () => {
    toast.add({
        severity: "info",
        summary: "Success",
        detail: "File Uploaded",
        life: 3000,
    });
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
