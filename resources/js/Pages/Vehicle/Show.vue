<template>
    <Head title="Show" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{}}
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-89rem mx-auto">
                <div class="grid grid-cols-3">
                    <Card style="width: 25rem; overflow: hidden">
                        <template #header class="">
                            <img
                                alt="user header"
                                src="/storage/images/b77d60102225d1363e9371cab337e4d1.png"
                            />
                        </template>
                        <template #title
                            ><span>PLATE NUMBER: </span
                            >{{ Vehicle.license_plate }}</template
                        >
                        <template #subtitle
                            ><span>MODEL: </span>{{ Vehicle.model }}</template
                        >
                    </Card>
                    <Card class="col-span-2">
                        <template #title
                            ><h1 class="text-2xl mb-3">Vehicle Information</h1>
                        </template>
                        <template #content>
                            <div class="grid grid-cols-2 border mb-7">
                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Type</span
                                    >
                                    <Message
                                        v-if="form.errors.type"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.type }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 1"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.type"
                                            />
                                            <span
                                                style="
                                                    color: #fff5f5;
                                                    font-size: 10px;
                                                    font-style: italic;
                                                    background-color: #c92a2a;
                                                    padding: 0px 4px 0px 4px;
                                                    border-radius: 4px;
                                                "
                                                >Editing Mode</span
                                            >
                                        </div>
                                        <span v-else>{{ form.type }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 1"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(1)"
                                            ></i>

                                            <div v-else>
                                                <i
                                                    class="pi pi-save mr-3 cursor-pointer"
                                                    style="
                                                        color: #28a745;
                                                        font-size: 14px;
                                                        font-weight: 600;
                                                    "
                                                    @click="submit"
                                                ></i>
                                                <i
                                                    class="pi pi-times mr-2 cursor-pointer"
                                                    style="
                                                        color: #dc3545;
                                                        font-size: 14px;
                                                        font-weight: 600;
                                                    "
                                                    @click="cancel"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="border-b p-1 font-bold">Model</div>
                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div>
                                            <InputText
                                                v-if="editNum === 2"
                                                type="text"
                                                class="!border-0 !p-0"
                                                v-model="form.model"
                                            />
                                            <span v-else>{{ form.model }}</span>
                                            <Message
                                                v-if="
                                                    form.errors.registrationExp
                                                "
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.registrationExp
                                                }}</Message
                                            >
                                        </div>
                                        <div>
                                            <i
                                                v-if="editNum !== 2"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(2)"
                                            ></i>

                                            <div v-else>
                                                <i
                                                    class="pi pi-save mr-3 cursor-pointer"
                                                    v-tooltip="Save"
                                                    style="
                                                        color: #1c7ed6;
                                                        font-size: 14px;
                                                        font-weight: 600;
                                                    "
                                                    @click="submit"
                                                ></i>
                                                <i
                                                    class="pi pi-times mr-3 cursor-pointer"
                                                    style="
                                                        color: red;
                                                        font-size: 14px;
                                                        font-weight: 600;
                                                    "
                                                    @click="cancel"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.model }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.model"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(2)"
                                    ></i>
                                </div> -->
                                <div class="border-b p-1 font-bold">
                                    Chassis No.
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.chassis_number }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.chassis_number"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(3)"
                                    ></i>
                                </div>
                                <div class="border-b p-3 font-bold">
                                    Engine No.
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.engine_number }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.engine_number"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(4)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">
                                    Manufacturer
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.manufacturer }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.manufacturer"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey; font-size: 14px"
                                        @click="edit(5)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">
                                    Manufacturer Year
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.manufacture_year }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.manufacture_year"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(6)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">
                                    Registration Number
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.registration_number }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="
                                                Vehicle.registration_number
                                            "
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(7)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">
                                    Registration Date
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{ Vehicle.registration_date }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.registration_date"
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(8)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">
                                    Registration Expired Date
                                </div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        {{
                                            Vehicle.registration_expiration_date
                                        }}
                                        <InputText
                                            type="text"
                                            class="!border-0"
                                            v-model="
                                                Vehicle.registration_expiration_date
                                            "
                                        />
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(9)"
                                    ></i>
                                </div>
                                <div class="p-1 font-bold">Created Date</div>
                                <div
                                    class="border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        <InputText
                                            v-if="editNum === 10"
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.created_at"
                                        />
                                        <span v-else>{{
                                            Vehicle.created_at
                                        }}</span>
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(10)"
                                    ></i>
                                </div>
                            </div>
                            <Button
                                label="Go back"
                                icon="pi pi-chevron-circle-left"
                                severity="info"
                                @click="goBack"
                            />
                        </template>
                    </Card>
                </div>
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">{{ Vehicle.id }}</div>
                </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import Card from "primevue/card";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Message from "primevue/message";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

const props = defineProps({
    Vehicle: {
        type: Object,
        required: true,
    },
});

const editNum = ref(0);
const toast = useToast();
const updateVehicle = ref({ ...props.Vehicle });

const edit = (number) => {
    editNum.value = number;
};

const cancel = () => {
    editNum.value = 0;
    updateVehicle.value = { ...props.Vehicle }; // Reset changes
};

const form = useForm({
    ...props.Vehicle, // Bind all vehicle fields to the form
});

const submit = () => {
    form.put(route("vehicle.update", props.Vehicle.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Vehicle updated successfully!",
                life: 3000,
            });
            editNum.value = 0; // Exit edit mode after successful submission
        },
        onError: (errors) => {
            console.error(errors); // Debug server errors if necessary
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "There were errors in your form submission.",
                life: 3000,
            });
        },
    });
};
</script>
