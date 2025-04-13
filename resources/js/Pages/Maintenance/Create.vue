<template>
    <Head title="Add Maintenance" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Maintenance
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit" class="p-6">
                    <div class="">
                        <div class="flex flex-row gap-x-8 mb-6">
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="truck"
                                    inputId="ingredient1"
                                    name="truck"
                                    value="1"
                                />
                                <label for="ingredient1">TRACTOR HEAD</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="truck"
                                    inputId="ingredient2"
                                    name="truck"
                                    value="2"
                                />
                                <label for="ingredient2">TRAILER</label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-10 mb-6">
                            <div class="w-full">
                                <label
                                    for="tructor"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Tructor Truck<span
                                        class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="tructor"
                                    name="tructor"
                                    class="flex flex-col gap-1"
                                >
                                    <AutoComplete
                                        id="tructor"
                                        class="w-full"
                                        :suggestions="tructors"
                                        @complete="tructorNameSearch"
                                        @item-select="onTructorSelect"
                                        optionLabel="name"
                                        dropdown
                                        placeholder="Plate no."
                                        :disabled="truck !== '1'"
                                    />
                                    <Message
                                        v-if="form.errors.vehicleId"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.vehicleId }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="trailer"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Trailer Truck<span
                                        class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="trailer"
                                    name="trailer"
                                    class="flex flex-col gap-1"
                                >
                                    <AutoComplete
                                        id="trailer"
                                        class="w-full"
                                        :suggestions="trailers"
                                        @complete="trailerNameSearch"
                                        @item-select="onTrailerSelect"
                                        optionLabel="name"
                                        dropdown
                                        placeholder="Plate no."
                                        :disabled="truck !== '2'"
                                    />
                                    <Message
                                        v-if="form.errors.vehicleId"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.vehicleId }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-10 mb-6">
                            <div class="w-full">
                                <label
                                    for="description"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Item and Description<span
                                        class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="description"
                                    name="description"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="description"
                                        type="text"
                                        placeholder="Description"
                                        v-model="form.description"
                                    />
                                    <Message
                                        v-if="form.errors.description"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.description }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="quantity"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Quantity<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="quantity"
                                    name="quantity"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="quantity"
                                        type="text"
                                        placeholder="Quantity"
                                        v-model="form.quantity"
                                    />
                                    <Message
                                        v-if="form.errors.quantity"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.quantity }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="unit"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Unit<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="unit"
                                    name="unit"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="unit"
                                        type="text"
                                        placeholder="Unit"
                                        v-model="form.unit"
                                    />
                                    <Message
                                        v-if="form.errors.unit"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.unit }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-10 mb-6">
                            <div class="w-full">
                                <label
                                    for="price"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Price<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="price"
                                    name="price"
                                    class="flex flex-col gap-1"
                                >
                                    <InputNumber
                                        v-model="form.price"
                                        placeholder="Price"
                                        mode="currency"
                                        currency="PHP"
                                        class="w-full"
                                    />
                                    <Message
                                        v-if="form.errors.price"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.price }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="total"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Total<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="total"
                                    name="total"
                                    class="flex flex-col gap-1"
                                >
                                    <InputNumber
                                        v-model="form.total"
                                        placeholder="Total"
                                        mode="currency"
                                        currency="PHP"
                                        class="w-full"
                                    />
                                    <Message
                                        v-if="form.errors.vehicleId"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.vehicleId }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="odometer"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Odometer<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="odometer"
                                    name="odometer"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="odometer"
                                        type="text"
                                        placeholder="Odometer"
                                        v-model="form.odometer"
                                    />
                                    <Message
                                        v-if="form.errors.odometer"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.odometer }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-10 mb-6">
                            <div class="w-full">
                                <label
                                    for="suplier"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Supplier<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="suplier"
                                    name="suplier"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="suplier"
                                        type="text"
                                        placeholder="Supplier"
                                        v-model="form.supplier"
                                    />
                                    <Message
                                        v-if="form.errors.supplier"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.supplier }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="ref_no"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Reference no.<span
                                        class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="ref_no"
                                    name="ref_no"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="ref_no"
                                        type="text"
                                        placeholder="Reference no."
                                        v-model="form.ref_no"
                                    />
                                    <Message
                                        v-if="form.errors.ref_no"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.ref_no }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="remarks"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Remarks
                                    <span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="remarks"
                                    name="remarks"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="remarks"
                                        type="text"
                                        placeholder="Remarks"
                                        v-model="form.remarks"
                                    />
                                    <Message
                                        v-if="form.errors.remarks"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.remarks }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-10 mb-2">
                            <div class="w-full">
                                <label
                                    for="breakdown"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Breakdown Date<span
                                        class="ml-1 text-red-400"
                                        >*</span
                                    >
                                </label>
                                <FormField
                                    id="breakdown"
                                    name="breakdown"
                                    class="flex flex-col gap-1"
                                >
                                    <div class="flex-auto">
                                        <DatePicker
                                            id="breakdown"
                                            showIcon
                                            fluid
                                            v-model="form.breakdown"
                                            :showOnFocus="false"
                                            inputId="expenseDate"
                                            placeholder="Breakdown Date"
                                        />
                                    </div>
                                    <Message
                                        v-if="form.errors.breakdown"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.breakdown }}</Message
                                    >
                                </FormField>
                            </div>
                            <div class="w-full">
                                <label
                                    for="update"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Up Date<span class="ml-1 text-red-400"
                                        >*</span
                                    >
                                </label>
                                <FormField
                                    id="update"
                                    name="update"
                                    class="flex flex-col gap-1"
                                >
                                    <div class="flex-auto">
                                        <DatePicker
                                            id="update"
                                            showIcon
                                            fluid
                                            v-model="form.up"
                                            :showOnFocus="false"
                                            inputId="expenseDate"
                                            placeholder="Up Date"
                                        />
                                    </div>
                                    <Message
                                        v-if="form.errors.up"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.up }}</Message
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
                </form>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
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
import RadioButton from "primevue/radiobutton";
import InputNumber from "primevue/inputnumber";

const truck = ref("");
const optionLabel = ref("name");
const tructors = ref([]);
const trailers = ref([]);

const toast = useToast();

const props = defineProps({
    tructor: {
        type: Array,
        required: true,
    },
    trailer: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    tructorId: "",
    trailerId: "",
    description: "",
    quantity: "",
    unit: "",
    price: "",
    total: "",
    odometer: "",
    supplier: "",
    ref_no: "",
    remarks: "",
    breakdown: "",
    up: "",
});

const submit = () => {
    form.post(route("maintenance.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Maintenance created successfully!",
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

const tructorNameSearch = () => {
    tructors.value = props.tructor.map((tructor) => ({
        id: tructor.id,
        name: tructor.license_plate,
    }));
};

const onTructorSelect = (event) => {
    form.tructorId = event.value.id;
};

const trailerNameSearch = () => {
    trailers.value = props.trailer.map((trailer) => ({
        id: trailer.id,
        name: trailer.license_plate,
    }));
};

const onTrailerSelect = (event) => {
    form.trailerId = event.value.id;
};

watch(() => {
    form.total = form.quantity * form.price;
});

watch(
    () => form.breakdown,
    (newValue) => {
        if (newValue) {
            form.breakdown = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.up,
    (newValue) => {
        if (newValue) {
            form.up = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

watch(truck, (newVal) => {
    if (newVal !== "1") {
        form.tructorId = "";

        if (tructors.value.length > 0) {
            tructors.value[0].name = "";
        }
    } else if (newVal !== "2") {
        form.trailerId = "";

        if (trailers.value.length > 0) {
            trailers.value[0].name = "";
        }
    }
});
</script>
