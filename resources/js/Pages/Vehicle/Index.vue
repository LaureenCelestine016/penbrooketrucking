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
                                <Button
                                    label="Add Vehicle"
                                    icon="pi pi-plus"
                                    class="mr-3"
                                    severity="info"
                                    @click="addVehicle"
                                />
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
                                    <Link> </Link>
                                    <Button
                                        icon="pi pi-eye"
                                        outlined
                                        rounded
                                        class="mr-2"
                                        @click="editProduct(slotProps.data.id)"
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

const addVehicle = () => {
    router.get(route("vehicle.create"));
};

const confirmDeleteSelected = () => {
    deleteVehiclesDialog.value = true;
};

const confirmDeleteVehicle = (vehicle) => {
    vehicleData.value = vehicle;
    deleteVehicleDialog.value = true;
};

const editProduct = (id) => {
    console.log(id);

    router.get(route("vehicle.show", id), {
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

.btn--delete {
    width: 100px;
}
</style>
