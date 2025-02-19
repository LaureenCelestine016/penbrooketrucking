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
