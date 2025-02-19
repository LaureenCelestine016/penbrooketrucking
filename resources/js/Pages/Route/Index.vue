<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedVehicle"
                            :value="route"
                            dataKey="id"
                            :paginator="true"
                            :rows="5"
                            :filters="filters"
                            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                            :rowsPerPageOptions="[5, 10, 25]"
                            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} vehicles"
                        >
                            <template #header>
                                <div
                                    class="flex flex-wrap gap-2 items-center justify-between p-1"
                                >
                                    <Button
                                        label="EXPORT TO EXCEL"
                                        icon="pi pi-upload"
                                        severity="secondary"
                                        @click="exportCSV($event)"
                                    />

                                    <div
                                        class="flex gap-4 justify-center items-center"
                                    >
                                        <Button
                                            label="Delete"
                                            icon="pi pi-trash"
                                            severity="danger"
                                            outlined
                                            @click="confirmDeleteSelected"
                                            :disabled="
                                                !selectedVehicle ||
                                                !selectedVehicle.length
                                            "
                                        />
                                        <IconField>
                                            <InputIcon>
                                                <i class="pi pi-search" />
                                            </InputIcon>
                                            <InputText
                                                v-model="
                                                    filters['global'].value
                                                "
                                                placeholder="Search..."
                                            />
                                        </IconField>
                                    </div>

                                    <!-- <h4 class="m-0">Manage Products</h4> -->
                                </div>
                            </template>

                            <Column
                                selectionMode="multiple"
                                style="width: 3rem"
                                :exportable="false"
                            ></Column>
                            <Column
                                field=""
                                header="Vehicle"
                                sortable
                                style="min-width: 9rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.vehicle.name }}
                                </template></Column
                            >
                            <Column
                                field=""
                                header="Driver"
                                sortable
                                style="min-width: 8rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.driver.first_name }}
                                    {{ slotProps.data.driver.last_name }}
                                </template></Column
                            >
                            <Column
                                field=""
                                header="Start Location"
                                sortable
                                style="min-width: 8rem"
                            >
                                <template #body="slotProps">
                                    {{ slotProps.data.start_location.address }}
                                </template>
                            </Column>
                            <Column
                                field=""
                                header="End Location"
                                sortable
                                style="min-width: 8rem"
                            >
                                <template #body="slotProps">
                                    {{ slotProps.data.end_location.address }}
                                </template>
                            </Column>
                            <Column
                                field="status"
                                header="Status"
                                sortable
                                style="min-width: 8rem"
                            >
                                <template #body="slotProps">
                                    <Tag
                                        class="status"
                                        :class="{
                                            'blinking-status':
                                                slotProps.data.status ===
                                                'Ongoing',
                                        }"
                                        :value="slotProps.data.status"
                                        :severity="
                                            getStatusLabel(
                                                slotProps.data.status
                                            )
                                        "
                                    />
                                </template>
                            </Column>
                            <Column
                                header="Action"
                                sortable=""
                                :exportable="false"
                                style="min-width: 8rem"
                            >
                                <template #body="slotProps">
                                    <Link> </Link>
                                    <Button
                                        icon="pi pi-pencil"
                                        outlined
                                        rounded
                                        class="mr-2"
                                        @click="showDetail(slotProps.data)"
                                    />
                                    <Button
                                        icon="pi pi-trash"
                                        outlined
                                        rounded
                                        severity="danger"
                                        @click="
                                            confirmDeleteVehicle(slotProps.data)
                                        "
                                    />
                                </template>
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="routeDialog"
                            :style="{ width: '970px' }"
                            header="Route Details"
                            :modal="true"
                        >
                            <div class="grid grid-cols-3 gap-10 mb-4">
                                <div class="w-full">
                                    <label
                                        for="vehicle"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Vehicle</label
                                    >
                                    <InputText
                                        id="vehicle"
                                        required="true"
                                        v-model="form.name"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                                <div class="w-full">
                                    <label
                                        for="vehicle"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Driver</label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            v-model="form.driver"
                                            :suggestions="driverName"
                                            @complete="driverNameSearch"
                                            @item-select="onDriverSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Driver name"
                                        />
                                        <Message
                                            v-if="form.errors.driverId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.driverId }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Distance<span class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <InputText
                                        id="vehicle"
                                        required="true"
                                        v-model="form.distance_km"
                                        fluid
                                    />
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-10 mb-4">
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
                                                v-model="form.dateStart"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="license_expired"
                                                placeholder="Start Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.dateStart"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.dateStart
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
                                                v-model="form.dateEnd"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="license_expired"
                                                placeholder="End Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.dateEnd"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.dateEnd }}</Message
                                        >
                                    </FormField>
                                </div>
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
                                            v-model="form.status"
                                            :suggestions="tripStatus"
                                            @complete="tripStatusSearch"
                                            dropdown
                                            placeholder="Status"
                                        />
                                        <Message
                                            v-if="form.errors.status"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.status }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div>
                                <label
                                    for="vehicle"
                                    class="block font-bold mb-3"
                                    >Overview</label
                                >
                                <div
                                    class="h-[400px] border-2 border-dashed border-surface p-2"
                                >
                                    <div
                                        class="flex flex-rows items-center gap-3 mb-3"
                                    >
                                        <h2
                                            class="font-bold text-lg text-center"
                                        >
                                            {{ form.start_location }}
                                        </h2>
                                        <span
                                            class="font-semibold text-lg text-red-500"
                                            >to</span
                                        >
                                        <h2
                                            class="font-bold text-lg text-center"
                                        >
                                            {{ form.end_location }}
                                        </h2>
                                    </div>
                                    <div class="border p-1">
                                        <div
                                            id="map"
                                            style="
                                                width: 100%;
                                                height: 600px;
                                                background: #eee;
                                            "
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <template #footer>
                                <Button
                                    label="UPDATE CHANGE"
                                    icon="pi pi-pencil"
                                    @click="submit"
                                    class="w-full mt-4"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteVehicleDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="vehicles"
                                    >Are you sure you want to delete
                                    <b>{{ vehicleData.vehicle_name }}</b
                                    >?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteVehicleDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="deleteVehicle(vehicleData.id)"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteVehiclesDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="vehicles"
                                    >Are you sure you want to delete the
                                    selected vehicles?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteVehiclesDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    text
                                    @click="deleteSelectedVehicles"
                                />
                            </template>
                        </Dialog>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, watch, nextTick } from "vue";
import L from "leaflet";
import "leaflet-routing-machine";

import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Toast from "primevue/toast";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import DatePicker from "primevue/datepicker";
import Tag from "primevue/tag";
import Dialog from "primevue/dialog";
import { FilterMatchMode } from "@primevue/core/api";
import AutoComplete from "primevue/autocomplete";
import { useToast } from "primevue/usetoast";

const props = defineProps({
    route: {
        type: Object,
        required: true,
    },
    drivers: {
        type: Object,
        required: true,
    },
});

const routeDialog = ref(false);
const tripStatus = ref([]);
const driverName = ref([]);

const showDetail = (id) => {
    router.get(route("route.show", id));
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const getStatusLabel = (status) => {
    switch (status) {
        case "Yet to start":
            return "warn";

        case "Completed":
            return "success";

        case "Ongoing":
            return "info";

        case "Cancelled":
            return "danger";

        default:
            return null;
    }
};
</script>
<style scoped>
.scrollable-column {
    max-width: 250px; /* Adjust based on your layout */
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #ccc transparent; /* For Firefox */
}

@keyframes blink {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0.1;
    }
    100% {
        opacity: 1;
    }
}

.blinking-status {
    animation: blink 3s infinite;
}
</style>
