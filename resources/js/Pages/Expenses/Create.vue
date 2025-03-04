<template>
    <Head title="Add Expenses" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Expenses
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="">
                            <!-- <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-6 block"
                                >Add Expenses</label
                            > -->
                            <div class="flex flex-row gap-x-8 mb-6">
                                <div class="flex items-center gap-2">
                                    <RadioButton
                                        v-model="truck"
                                        inputId="ingredient1"
                                        name="pizza"
                                        value="1"
                                    />
                                    <label for="ingredient1"
                                        >TRACTOR HEAD</label
                                    >
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton
                                        v-model="truck"
                                        inputId="ingredient2"
                                        name="pizza"
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
                                            >{{
                                                form.errors.vehicleId
                                            }}</Message
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
                                            >{{
                                                form.errors.vehicleId
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-6">
                                <div class="w-full">
                                    <label
                                        for="category"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Category<span class="ml-1 text-red-400"
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
                                            :suggestions="category"
                                            @complete="categoryNameSearch"
                                            @item-select="onCategorySelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Category"
                                        />
                                        <Message
                                            v-if="form.errors.category"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.category }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="trailer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Cost<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="trailer"
                                        name="trailer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="engine_number"
                                            type="text"
                                            v-model="form.cost"
                                            placeholder="0.00"
                                        />
                                        <Message
                                            v-if="form.errors.vehicleId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.vehicleId
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-6">
                                <div class="w-full">
                                    <label
                                        for="birthday"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Expense Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="expenseDate"
                                        name="expenseDate"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="expenseDate"
                                                showIcon
                                                fluid
                                                v-model="form.expenseDate"
                                                :showOnFocus="false"
                                                inputId="expenseDate"
                                                placeholder="Expense Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.expenseDate"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.expenseDate
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="address"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Description<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="address"
                                        name="address"
                                        class="flex flex-col gap-1"
                                    >
                                        <Textarea
                                            v-model="form.description"
                                            variant="filled"
                                            rows="3"
                                            cols="30"
                                            placeholder="Additional Details"
                                        />
                                        <Message
                                            v-if="form.errors.description"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.description
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <Button
                                label="SUBMIT"
                                type="submit"
                                icon="pi pi-send"
                                class="w-full mt-4"
                            />
                        </div>
                    </form>
                </div>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import dayjs from "dayjs";

import AutoComplete from "primevue/autocomplete";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import Message from "primevue/message";
import RadioButton from "primevue/radiobutton";
import DatePicker from "primevue/datepicker";
import Textarea from "primevue/textarea";

const props = defineProps({
    tructor: {
        type: Array,
        required: true,
    },
    trailer: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const truck = ref("");

const tructors = ref([]);
const trailers = ref([]);
const category = ref("");
const toast = useToast();

const form = useForm({
    tructorId: "",
    trailerId: "",
    category: "",
    cost: "",
    expenseDate: "",
    description: "",
});

const submit = () => {
    form.post(route("expenses.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Expense created successfully!",
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

const categoryNameSearch = () => {
    category.value = props.categories.map((cat) => ({
        id: cat.id,
        name: cat.name,
    }));
};

const onCategorySelect = (event) => {
    form.category = event.value.id;
};

watch(
    () => form.expenseDate, // Only watch this field
    (newValue) => {
        if (newValue) {
            form.expenseDate = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);
</script>
