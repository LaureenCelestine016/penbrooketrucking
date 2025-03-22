<template>
    <Head title="Add Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Fuel
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
                                        for="tractor"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Truck
                                        <span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="tractor"
                                        name="tractor"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="tractor"
                                            class="w-full"
                                            :suggestions="tractorName"
                                            @complete="tractorNameSearch"
                                            @item-select="onTractorSelect"
                                            optionLabel="license_plate"
                                            dropdown
                                            placeholder="Truck name"
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
                                            optionLabel="display"
                                            dropdown
                                            placeholder="Driver name"
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
                                        for="c-odometer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Current Odometer<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="c-odometer"
                                        name="c-odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.curr_odometer"
                                            placeholder="Current Odometer"
                                            class="w-full"
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
                                        for="p_odometer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Previous Odometer<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="p_odometer"
                                        name="p_odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.prev_odometer"
                                            placeholder="Previous Odometer"
                                            class="w-full"
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
                                        for="t-distance"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Total Distance<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="t-distance"
                                        name="t-distance"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.curr_odometer"
                                            placeholder="Total Distance"
                                            class="w-full"
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
                                        for="t_refuel"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Total Refuel<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ><span class="text-xs font-thin"
                                            >(Liter)</span
                                        ></label
                                    >
                                    <FormField
                                        id="t_refuel"
                                        name="t_refuel"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.prev_odometer"
                                            placeholder="Total Refuel"
                                            class="w-full"
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
                                        for="avg_fuel"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Avg. Fuel Consumption<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ><span class="text-xs font-thin"
                                            >(Kilometer / Liter)</span
                                        ></label
                                    >
                                    <FormField
                                        id="avg_fuel"
                                        name="avg_fuel"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.curr_odometer"
                                            placeholder="Avg. Fuel"
                                            class="w-full"
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
                                        for="t_refuel"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Amount<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="t_refuel"
                                        name="t_refuel"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.prev_odometer"
                                            placeholder="Amount"
                                            class="w-full"
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
                                        for="station"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Station<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="station"
                                        name="station"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.curr_odometer"
                                            placeholder="Station"
                                            class="w-full"
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
                                        for="remarks"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Remarks<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="remarks"
                                        name="remarks"
                                        class="flex flex-col gap-1"
                                    >
                                        <Textarea
                                            v-model="form.address"
                                            variant="filled"
                                            rows="3"
                                            cols="30"
                                            placeholder="Remarks"
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

                            <!-- <div class="w-full">
                                <label
                                    for="image_upload"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Purchase Order</label
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
                            </div> -->
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
import dayjs from "dayjs";

import { useToast } from "primevue/usetoast";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import Toast from "primevue/toast";
import InputNumber from "primevue/inputnumber";
import Textarea from "primevue/textarea";

const toast = useToast();
const tractorName = ref([]);
const driverName = ref([]);

const props = defineProps({
    tractor: {
        type: Array,
        required: true,
    },
    driver: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    vehicleId: "",
    driverId: "",
    liters: "",
    cost: "",
    fuel_type: "",
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

const tractorNameSearch = () => {
    tractorName.value = props.tractor.map((tr) => ({
        id: tr.id,
        license_plate: tr.license_plate,
    }));
};

const onTractorSelect = (event) => {
    form.vehicleId = event.value.id;
};

const driverNameSearch = () => {
    driverName.value = props.driver.map((dr) => ({
        id: dr.id,
        firstName: dr.first_name,
        lastName: dr.last_name,
        display: `${dr.first_name} ${dr.last_name}`,
    }));

    console.log(driverName.value);
};

const onDriverSelect = (event) => {
    form.driverId = event.value.id;
};

watch(
    () => form.refuelingDate,
    (newValue) => {
        if (newValue) {
            form.refuelingDate = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);
</script>
