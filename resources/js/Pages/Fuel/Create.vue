<template>
    <Head title="Add Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Route
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-6">
                        <!-- Vehicle Infomation -->
                        <div class="">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Add Fuel</label
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
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Quantity<span class="ml-1 text-red-400"
                                            >*</span
                                        ><span class="text-xs font-thin"
                                            >(Liters)</span
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
                                            v-model="form.quantity"
                                            placeholder="Quantity"
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
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="engine_number"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Cost<span class="ml-1 text-red-400"
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
                                            v-model="form.cost"
                                            placeholder="0.00"
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
                                        for="vehicle_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Fuel Type<span
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
                                            :suggestions="fuelName"
                                            @complete="fuelNameSearch"
                                            v-model="form.type"
                                            dropdown
                                            placeholder="Type"
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
                                        for="birthday"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Refueling Date<span
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
                                                showIcon
                                                fluid
                                                v-model="form.refuelingDate"
                                                :showOnFocus="false"
                                                inputId="birthday"
                                                placeholder="Refueling Date"
                                            />
                                        </div>
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
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
import { ref, watch } from "vue";

import { useToast } from "primevue/usetoast";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import Toast from "primevue/toast";

const toast = useToast();
const fuelName = ref([]);
const vehicleName = ref([]);

const props = defineProps({
    vehicles: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    vehicleId: "",
    quantity: "",
    cost: "",
    type: "",
    refuelingDate: "",
});

const submit = () => {
    form.post(route("fuel.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Fuel created successfully!",
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

const fuelNameSearch = () => {
    fuelName.value = [
        "Diesel",
        "Gasoline",
        "Ethanol",
        "Biodiesel",
        "Hydrogen",
        "Methanol",
        "Natural Gas",
    ];
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
</script>
