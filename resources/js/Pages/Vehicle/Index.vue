<template>
    <Head title="Tractor" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl md:text-2xl text-gray-800 leading-tight"
            >
                Tractor Head
            </h2>
        </template>

        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <DataTable
                        ref="dt"
                        v-model:selection="selectedVehicle"
                        :value="Vehicles"
                        dataKey="id"
                        :paginator="true"
                        :rows="5"
                        :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} Tractor"
                        class="w-full overflow-auto"
                    >
                        <!-- Table Header -->
                        <template #header>
                            <div
                                class="flex flex-col md:flex-row gap-3 md:gap-4 justify-between items-start md:items-center p-2"
                            >
                                <Button
                                    label="EXPORT TO EXCEL"
                                    icon="pi pi-upload"
                                    severity="secondary"
                                    @click="exportCSV($event)"
                                    class="w-full md:w-auto"
                                />

                                <div
                                    class="flex flex-col sm:flex-row gap-2 items-start sm:items-center"
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
                                        class="w-full sm:w-auto"
                                    />
                                    <IconField class="w-full sm:w-64">
                                        <InputIcon>
                                            <i class="pi pi-search" />
                                        </InputIcon>
                                        <InputText
                                            v-model="filters['global'].value"
                                            placeholder="Search..."
                                            class="w-full"
                                        />
                                    </IconField>
                                </div>
                            </div>
                        </template>

                        <!-- Table Columns -->
                        <Column
                            selectionMode="multiple"
                            style="width: 3rem"
                            :exportable="false"
                        />
                        <Column
                            field="license_plate"
                            header="Plate number"
                            sortable
                            style="min-width: 10rem"
                        />
                        <Column
                            field="model"
                            header="Model"
                            sortable
                            style="min-width: 10rem"
                        />
                        <Column
                            field="engine_number"
                            header="Engine number"
                            sortable
                            style="min-width: 10rem"
                        />
                        <Column
                            field="capacity"
                            header="Capacity"
                            sortable
                            style="min-width: 10rem"
                        />
                        <Column
                            field="status"
                            header="Status"
                            sortable
                            style="min-width: 10rem"
                        >
                            <template #body="slotProps">
                                <Tag
                                    class="status"
                                    :value="slotProps.data.status"
                                    :severity="
                                        getStatusLabel(slotProps.data.status)
                                    "
                                />
                            </template>
                        </Column>
                        <Column
                            header="Action"
                            :exportable="false"
                            style="min-width: 10rem"
                        >
                            <template #body="slotProps">
                                <Button
                                    icon="pi pi-pencil"
                                    outlined
                                    rounded
                                    class="mr-2"
                                    @click="showDetail(slotProps.data.id)"
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

                    <!-- Confirm Delete Dialog -->
                    <Dialog
                        v-model:visible="deleteVehicleDialog"
                        :style="{ width: '90%', maxWidth: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i
                                class="pi pi-exclamation-triangle text-3xl text-red-500"
                            />
                            <span v-if="vehicles">
                                Are you sure you want to delete
                                <b>{{ vehicleData.vehicle_name }}</b
                                >?
                            </span>
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

                    <!-- Confirm Delete Multiple Dialog -->
                    <Dialog
                        v-model:visible="deleteVehiclesDialog"
                        :style="{ width: '90%', maxWidth: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i
                                class="pi pi-exclamation-triangle text-3xl text-red-500"
                            />
                            <span v-if="vehicles">
                                Are you sure you want to delete the selected
                                vehicles?
                            </span>
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
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";

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
    Vehicles: {
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

const showDetail = (id) => {
    router.get(route("vehicle.show", id));
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
        case "Operational":
            return "success";

        case "Non-Operational":
            return "warn";

        case "Maintenance":
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

.btn--delete {
    width: 100px;
}
</style>
