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
            <div class="mx-12">
                <div class="grid grid-cols-3">
                    <Card
                        class="!w-11/12 2xl:w-96 h-5/7 max-2xl:h-4/7 overflow-hidden"
                    >
                        <template #header class="">
                            <img
                                alt="user header"
                                src="/storage/images/Truck.jpg"
                            />
                        </template>
                        <template #title>
                            <div class="flex flex-col items-center gap-3 mt-3">
                                <h1 class="text-4xl font-bold">
                                    {{ Vehicle.name }}
                                </h1>

                                <p class="text-slate-500">
                                    {{ Vehicle.license_plate }}
                                </p>

                                <Badge
                                    :value="Vehicle.status"
                                    :severity="getStatusLabel(Vehicle.status)"
                                ></Badge>
                            </div>
                        </template>
                    </Card>
                    <Card class="col-span-2">
                        <template #title
                            ><h1 class="text-2xl mb-3">Vehicle Information</h1>
                        </template>
                        <template #content>
                            <div class="grid grid-cols-2 border mb-7">
                                <!-- Name -->
                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Name :</span
                                    >
                                    <Message
                                        v-if="form.errors.name"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.name }}</Message
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
                                                v-model="form.name"
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
                                        <span v-else>{{ form.name }}</span>

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

                                <!-- Plate number -->
                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Plate number :</span
                                    >
                                    <Message
                                        v-if="form.errors.license_plate"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.license_plate
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 2"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.license_plate"
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
                                        <span v-else>{{
                                            form.license_plate
                                        }}</span>

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

                                <!-- Type -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Type :</span
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
                                            v-if="editNum === 3"
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
                                                v-if="editNum !== 3"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(3)"
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

                                <!-- Model Copy -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Model :</span
                                    >
                                    <Message
                                        v-if="form.errors.model"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.model }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 4"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.model"
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
                                        <span v-else>{{ form.model }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 4"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(4)"
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

                                <!-- Chassis No. -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Chassis Number :</span
                                    >
                                    <Message
                                        v-if="form.errors.chassis_number"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.chassis_number
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 5"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.chassis_number"
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
                                        <span v-else>{{
                                            form.chassis_number
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 5"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(5)"
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

                                <!-- Engine No. -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Engine Number :</span
                                    >
                                    <Message
                                        v-if="form.errors.engine_number"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.engine_number
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 6"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.engine_number"
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
                                        <span v-else>{{
                                            form.engine_number
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 6"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(6)"
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

                                <!-- Manifacturer -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Manufacturer :</span
                                    >
                                    <Message
                                        v-if="form.errors.manufacturer"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.manufacturer }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 7"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.manufacturer"
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
                                        <span v-else>{{
                                            form.manufacturer
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 7"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(7)"
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

                                <!-- Manifacturer Year -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Manufacture Year :</span
                                    >
                                    <Message
                                        v-if="form.errors.manufacture_year"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.manufacture_year
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 8"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.manufacture_year"
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
                                        <span v-else>{{
                                            form.manufacture_year
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 8"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(8)"
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

                                <!-- Registration Number -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Registration Number :</span
                                    >
                                    <Message
                                        v-if="form.errors.registration_number"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.registration_number
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 9"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="
                                                    form.registration_number
                                                "
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
                                        <span v-else>{{
                                            form.registration_number
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 9"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(9)"
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

                                <!-- Registration Date -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Registration Date :</span
                                    >
                                    <Message
                                        v-if="form.errors.registration_date"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors.registration_date
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 10"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.registration_date"
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
                                        <span v-else>{{
                                            form.registration_date
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 10"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(10)"
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

                                <!-- Registration Date Expired -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Registration Expired Date :</span
                                    >
                                    <Message
                                        v-if="
                                            form.errors
                                                .registration_expiration_date
                                        "
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{
                                            form.errors
                                                .registration_expiration_date
                                        }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 11"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="
                                                    form.registration_expiration_date
                                                "
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
                                        <span v-else>{{
                                            form.registration_expiration_date
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 11"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(11)"
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

                                <!-- Created Date -->

                                <div
                                    class="border-b flex items-center justify-between"
                                >
                                    <span class="pl-2 text-lg font-bold"
                                        >Created Date :</span
                                    >
                                    <Message
                                        v-if="form.errors.created_at"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.created_at }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit">
                                    <div
                                        class="border-b border-l p-2 flex items-center justify-between"
                                    >
                                        <div
                                            v-if="editNum === 12"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <InputText
                                                type="text"
                                                class="!border-0 !p-0 bg"
                                                v-model="form.created_at"
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
                                        <span v-else>{{
                                            form.created_at
                                        }}</span>

                                        <div>
                                            <i
                                                v-if="editNum !== 12"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(12)"
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

                                <!-- Status -->
                                <div class="flex items-center justify-between">
                                    <span class="pl-2 text-lg font-bold"
                                        >Status :</span
                                    >
                                    <Message
                                        v-if="form.errors.status"
                                        severity="error"
                                        size="small"
                                        class="!pr-1"
                                        variant="simple"
                                        >{{ form.errors.status }}</Message
                                    >
                                </div>

                                <form @submit.prevent="submit" class="">
                                    <div
                                        :class="[
                                            'border-l  flex items-center justify-between',
                                            editNum !== 13 ? 'p-3' : 'p-2',
                                        ]"
                                    >
                                        <div
                                            v-if="editNum === 13"
                                            class="flex justify-between items-center gap-3"
                                        >
                                            <AutoComplete
                                                class="vehicleStatus"
                                                v-model="form.status"
                                                :suggestions="vehicleStatus"
                                                @complete="statusSearch"
                                                size="small"
                                                dropdown
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
                                        <Badge
                                            v-else
                                            :value="Vehicle.status"
                                            :severity="
                                                getStatusLabel(Vehicle.status)
                                            "
                                        ></Badge>

                                        <div>
                                            <i
                                                v-if="editNum !== 13"
                                                class="pi pi-pencil mr-1 cursor-pointer"
                                                style="
                                                    color: #1c7ed6;
                                                    font-size: 14px;
                                                    font-weight: 600;
                                                "
                                                @click="edit(13)"
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
import Badge from "primevue/badge";
import AutoComplete from "primevue/autocomplete";

const props = defineProps({
    Vehicle: {
        type: Object,
        required: true,
    },
});

const editNum = ref(0);
const toast = useToast();
const updateVehicle = ref({ ...props.Vehicle });
const vehicleStatus = ref([]);

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

const upperCaseFirstLetter = (name) => {
    if (!name) return name; // Handle empty strings
    return name.charAt(0).toUpperCase() + name.slice(1);
};

const goBack = () => {
    history.back();
    setTimeout(() => {
        location.reload(); // Reloads the page to ensure updated data
    }, 100);
};

const statusSearch = () => {
    vehicleStatus.value = ["active", "inactive", "maintenance"];
};

const getStatusLabel = (status) => {
    switch (status) {
        case "active":
            return "success";

        case "maintenance":
            return "warn";

        case "inactive":
            return "danger";

        default:
            return null;
    }
};
</script>
