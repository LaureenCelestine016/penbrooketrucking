<template>
    <Head title="Add Maintenance" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Maintenance
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="flex flex-row gap-x-8 mb-6">
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="truck"
                                    inputId="ingredient1"
                                    name="pizza"
                                    value="Cheese"
                                />
                                <label for="ingredient1">TRACTOR HEAD</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="truck"
                                    inputId="ingredient2"
                                    name="pizza"
                                    value="Mushroom"
                                />
                                <label for="ingredient2">TRAILER</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <!-- Truck name -->
                                <div class="w-full">
                                    <label
                                        for="civil_status"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Truck<span class="ml-1 text-red-400"
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
                                            :suggestions="civilStatus"
                                            @complete="civilStatusSearch"
                                            dropdown
                                            placeholder="Civil Status"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
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
                                            placeholder="Middle name"
                                        />
                                        <Message
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

                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-14"
                        />
                    </form>
                </div>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

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

const truck = ref("");

const civilStatusSearch = () => {
    civilStatus.value = ["Single", "Married", "Widowed", "Divorced"];
};
</script>
