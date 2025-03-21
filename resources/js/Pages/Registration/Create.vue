<template>
    <Head title="Add Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Update Registration
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
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
                                    <label for="ingredient1"
                                        >TRACTOR HEAD</label
                                    >
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
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
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
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                            </div>
                            <div>
                                <div class="mt-10 mb-5" v-if="truck === '1'">
                                    <div class="w-full">
                                        <label
                                            for="tructor"
                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                            >Registration Category<span
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
                                                :suggestions="tractorsCategory"
                                                @complete="
                                                    tractorCategorySearch
                                                "
                                                dropdown
                                                placeholder="Select Registration"
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
                                <div class="mt-10 mb-5" v-else>
                                    <div class="w-full">
                                        <label
                                            for="tructor"
                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                            >Registration Category<span
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
                                                :suggestions="trailerCategory"
                                                @complete="
                                                    trailerCategorySearch
                                                "
                                                dropdown
                                                placeholder="Select Registration"
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
                            </div>

                            <div>
                                <div
                                    :class="[
                                        'grid grid-cols-2 gap-10 ',
                                        // form.hasErrors ? 'mt-3' : 'mt-6',
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
                                                    showIcon
                                                    fluid
                                                    :showOnFocus="false"
                                                    inputId="LTORegDate"
                                                    placeholder="LTO Registration Date"
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
                                                    showIcon
                                                    fluid
                                                    :showOnFocus="false"
                                                    inputId="LTOExpDate"
                                                    placeholder="LTO Expired Date"
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

import RadioButton from "primevue/radiobutton";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";

const truck = ref("1");
const tructors = ref([]);
const trailers = ref([]);
const tractorsCategory = ref([]);
const trailerCategory = ref([]);

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

const tractorCategorySearch = () => {
    tractorsCategory.value = ["LTO ", "Conveyance ", "Filcon Fab ", "LTFRB "];
};
const trailerCategorySearch = () => {
    trailerCategory.value = ["LTO ", "Calibration "];
};
</script>
