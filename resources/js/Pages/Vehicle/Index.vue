<template>
    <Head title="Vehicle" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Vehicle list
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-89rem mx-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="card">
                        <Toolbar class="mb-6">
                            <template #start>
                                <Link
                                    :href="route('vehicle.add')"
                                    icon="pi pi-car"
                                    class="btn--add"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="#fafafa"
                                            d="M6 19v1q0 .425-.288.713T5 21H4q-.425 0-.712-.288T3 20v-8l2.1-6q.15-.45.538-.725T6.5 5H9V3h6v2h2.5q.475 0 .863.275T18.9 6l2.1 6v8q0 .425-.287.713T20 21h-1q-.425 0-.712-.288T18 20v-1zm-.2-9h12.4l-1.05-3H6.85zM5 12v5zm2.5 4q.625 0 1.063-.437T9 14.5t-.437-1.062T7.5 13t-1.062.438T6 14.5t.438 1.063T7.5 16m9 0q.625 0 1.063-.437T18 14.5t-.437-1.062T16.5 13t-1.062.438T15 14.5t.438 1.063T16.5 16M5 17h14v-5H5z"
                                        />
                                    </svg>
                                    <span>Add Vehicle</span>
                                </Link>
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
                            </template>
                        </Toolbar>

                        <DataTable
                            ref="dt"
                            v-model:selection="selectedVehicle"
                            :value="vehicles.data"
                            dataKey="id"
                            :paginator="true"
                            :rows="5"
                            :filters="filters"
                            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                            :rowsPerPageOptions="[5, 10, 25]"
                            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} vehivcles"
                        >
                            <template #header>
                                <div
                                    class="flex flex-wrap gap-2 items-center justify-between"
                                >
                                    <Button
                                        label="EXPORT TO EXCEL"
                                        icon="pi pi-upload"
                                        severity="secondary"
                                        @click="exportCSV($event)"
                                    />

                                    <!-- <h4 class="m-0">Manage Products</h4> -->
                                    <IconField>
                                        <InputIcon>
                                            <i class="pi pi-search" />
                                        </InputIcon>
                                        <InputText
                                            v-model="filters['global'].value"
                                            placeholder="Search..."
                                        />
                                    </IconField>
                                </div>
                            </template>

                            <Column
                                selectionMode="multiple"
                                style="width: 3rem"
                                :exportable="false"
                            ></Column>
                            <Column
                                field="vehicle_name"
                                header="Vehicle Name"
                                sortable
                                style="min-width: 5rem"
                            ></Column>
                            <Column
                                field="vehicle_type"
                                header="Vehicle type"
                                sortable
                                style="min-width: 5rem"
                            ></Column>
                            <Column
                                field="license_plate"
                                header="Plate number"
                                sortable
                                style="min-width: 8rem"
                            >
                                <!-- <template #body="slotProps">
                                    {{ formatCurrency(slotProps.data.price) }}
                                </template> -->
                            </Column>
                            <Column
                                field="registration_no."
                                header="Registration number"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                field="engine_no."
                                header="Engine number"
                                sortable
                                style="min-width: 12rem"
                            >
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
                                    <Button
                                        icon="pi pi-pencil"
                                        outlined
                                        rounded
                                        class="mr-2"
                                        @click="editProduct(slotProps.data)"
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
import { Head, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";

import Toolbar from "primevue/toolbar";
import Toast from "primevue/toast";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import Tag from "primevue/tag";
import Dialog from "primevue/dialog";
import { FilterMatchMode } from "@primevue/core/api";
import { useToast } from "primevue/usetoast";

const selectedVehicle = ref(0);
const toast = useToast();
const vehicleData = ref({});
const dt = ref();
const deleteVehicleDialog = ref(false);
const deleteVehiclesDialog = ref(false);

defineProps({
    vehicles: {
        type: Object,
        required: true,
    },
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const confirmDeleteSelected = () => {
    deleteVehiclesDialog.value = true;
};

const confirmDeleteVehicle = (vehicle) => {
    vehicleData.value = vehicle;
    deleteVehicleDialog.value = true;
};

const deleteVehicle = (id) => {
    router.delete(route("vehicle.delete", id), {
        onSuccess: () => {
            deleteVehicleDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Vehicle Deleted",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error("Error deleting vehicle:", errors);
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "Failed to delete vehicle",
                life: 3000,
            });
        },
    });
};

const deleteSelectedVehicles = () => {
    const ids = selectedVehicle.value.map((m) => m.id);

    if (ids.length === 0) {
        toast.add({
            severity: "warn",
            summary: "No Selection",
            detail: "No vehicles selected for deletion",
            life: 3000,
        });
        return;
    }

    router.post(
        route("vehicles.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteVehiclesDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Vehicles Deleted",
                    life: 3000,
                });
            },
            onError: (errors) => {
                console.error("Error deleting vehicles:", errors);
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: "Failed to delete vehicles",
                    life: 3000,
                });
            },
        }
    );
};

const exportCSV = () => {
    dt.value.exportCSV();
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

<style scoped>
.status {
    font-size: 12px;
}

.btn--add {
    margin-right: 8px;
    display: flex;
    gap: 6px;
    background-color: #10b981;
    color: #ebfbee;
    padding: 8px 12px 8px 12px;
    border-radius: 6px;
    font-weight: 600;
}

.btn--delete {
    width: 100px;
}
</style>
