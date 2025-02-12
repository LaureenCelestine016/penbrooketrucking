<template>
    <Head title="Add Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Route
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <!-- Vehicle Infomation -->
                        <div class="">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Route</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Vehicle<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="vehicle_name"
                                        name="vehicle_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="vehicle_name"
                                            class="w-full"
                                            :suggestions="vehicleName"
                                            @complete="vehicleNameSearch"
                                            @item-select="onVehicleSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Vehicle name"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="driver"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Driver<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            :suggestions="driverName"
                                            @complete="driverNameSearch"
                                            @item-select="onDriverSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Driver name"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                        ></Message>
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="start_location"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Start Location<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="start_location"
                                        name="start_location"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="start_location"
                                            class="w-full"
                                            :suggestions="startLoc"
                                            @complete="startLocSearch"
                                            @item-select="onStLocSelect"
                                            optionLabel="address"
                                            dropdown
                                            placeholder="Location"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="driver"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip End Location<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            :suggestions="endLoc"
                                            @complete="endLocSearch"
                                            @item-select="onEndLocSelect"
                                            optionLabel="address"
                                            dropdown
                                            placeholder="Location"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                        ></Message>
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Start Date<span
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
                                                placeholder="Start Date"
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
                                <div class="w-full">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip End Date<span
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
                                                placeholder="End Date"
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
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="First_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Approx TOTAL KM<span
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
                                            placeholder="Kilometer"
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
                                <div class="w-full">
                                    <label
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Fuel amount<span
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
                                            id="vehicle_name"
                                            class="w-full"
                                            :suggestions="fuelAmount"
                                            @complete="fuelAmountSearch"
                                            dropdown
                                            placeholder="Vehicle name"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                            </div>
                            <div>
                                <div class="w-full">
                                    <label
                                        for="First_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Status<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="First_name"
                                        name="First_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="vehicle_name"
                                            class="w-full"
                                            :suggestions="tripStatus"
                                            @complete="tripStatusSearch"
                                            dropdown
                                            placeholder="Status"
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
                            </div>
                        </div>
                        <div>
                            <Button
                                label="SUBMIT"
                                type="submit"
                                icon="pi pi-send"
                                class="w-full mt-12"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";

const vehicleName = ref([]);
const driverName = ref([]);
const startLoc = ref([]);
const endLoc = ref([]);
const tripStatus = ref([]);
const fuelAmount = ref([]);

const props = defineProps({
    vehicles: {
        type: Array,
        required: true,
    },
    locations: {
        type: Array,
        required: true,
    },
    drivers: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    vehicleId: "",
    driverId: "",
    startLoc: "",
    endLoc: "",
});

const submit = () => {
    form.post(route("route.store"), {
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

const vehicleNameSearch = () => {
    vehicleName.value = props.vehicles.map((vehicle) => ({
        id: vehicle.id,
        name: vehicle.name,
    }));
};

const onVehicleSelect = (event) => {
    form.vehicleId = event.value.id;
};

const driverNameSearch = () => {
    driverName.value = props.drivers.map((driver) => ({
        id: driver.id,
        name: driver.fullname,
    }));
};

const onDriverSelect = (event) => {
    form.driverId = event.value.id;
};

const startLocSearch = () => {
    startLoc.value = props.locations.map((stLoc) => ({
        id: stLoc.id,
        address: stLoc.address,
    }));
};

const onStLocSelect = (event) => {
    form.startLoc = event.value.id;
};

const endLocSearch = () => {
    endLoc.value = props.locations.map((endLoc) => ({
        id: endLoc.id,
        address: endLoc.address,
    }));
};

const onEndLocSelect = (event) => {
    form.endLoc = event.value.id;
};

const tripStatusSearch = () => {
    tripStatus.value = ["Yet to start", "Completed", "Ongoing", "Cancelled"];
};

const fuelAmountSearch = () => {
    // for (let i = 0; i < props.vehicles.length; i++) {
    //     const element = props.vehicles[i].fuel_records;
    //     fuelAmount.value = element.map((fuel) => fuel);
    //     console.log(fuelAmount.value.data);
    // }

    fuelAmount.value = props.vehicles.map((vehicle) => vehicle).fuel_record;

    console.log(fuelAmount.value);
};
</script>
