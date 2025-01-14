<template>
    <Head title="Show" />

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
                                <div class="border-b p-1 font-bold">Type</div>
                                <div
                                    class="border-b border-l p-1 flex items-center justify-between"
                                >
                                    <div>
                                        <InputText
                                            v-if="editNum === 1"
                                            type="text"
                                            class="!border-0"
                                            v-model="Vehicle.type"
                                            v-focus
                                        />
                                        <span v-else>{{ Vehicle.type }}</span>
                                    </div>
                                    <i
                                        class="pi pi-pencil mr-3 cursor-pointer"
                                        style="color: grey"
                                        @click="edit(1)"
                                    ></i>
                                </div>
                                <div class="border-b p-1 font-bold">Model</div>
                                <div
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
                                </div>
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
                                        style="color: grey"
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
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

import Card from "primevue/card";
import Button from "primevue/button";
import InputText from "primevue/inputtext";

const editNum = ref(0);

defineProps({
    Vehicle: {
        type: Object,
        required: true,
    },
});

const edit = (number) => {
    editNum.value = number;
};
</script>
