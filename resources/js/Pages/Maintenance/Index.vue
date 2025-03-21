<template>
    <Head title="Maintenance" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Maintenance Record
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedMaintenance"
                            :value="maintenance"
                            dataKey="id"
                            :paginator="true"
                            :rows="10"
                            :filters="filters"
                            :globalFilterFields="['vehicle.name']"
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
                                                !selectedMaintenance ||
                                                !selectedMaintenance.length
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
                                header="Tructor / Trailer"
                                sortable
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.vehicle?.model }}
                                    {{ slotProps.data.vehicle?.license_plate }}
                                    {{ slotProps.data.trailer?.license_plate }}
                                </template></Column
                            >
                            <Column
                                field="item_description"
                                header="Item"
                                sortable
                                style="min-width: 8rem"
                            ></Column>
                            <Column
                                field="quantity"
                                header="Quantity"
                                sortable
                                style="min-width: 8rem"
                            >
                            </Column>
                            <Column
                                field="unit"
                                header="Unit"
                                sortable
                                style="min-width: 8rem"
                            >
                            </Column>
                            <Column
                                field="price"
                                header="Price"
                                sortable
                                style="min-width: 8rem"
                            ></Column>
                            <Column
                                field="total"
                                header="Total"
                                sortable
                                style="min-width: 8rem"
                            ></Column>
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
                                        @click="showDetail(slotProps.data.id)"
                                    />
                                    <Button
                                        icon="pi pi-trash"
                                        outlined
                                        rounded
                                        severity="danger"
                                        @click="
                                            confirmDeleteMaintenance(
                                                slotProps.data
                                            )
                                        "
                                    />
                                </template>
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="deleteMaintenanceDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="maintenanceData"
                                    >Are you sure you want to delete this
                                    maintenance?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteMaintenanceDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="
                                        deleteMaintenance(maintenanceData.id)
                                    "
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteMaintenancesDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="maintenance"
                                    >Are you sure you want to delete the
                                    selected maintenance?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteMaintenancesDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    text
                                    @click="deleteSelectedMaintenance"
                                />
                            </template>
                        </Dialog>
                    </div>
                </div>
            </div></div
    ></AuthenticatedLayout>
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

const props = defineProps({
    maintenance: {
        type: Object,
        required: true,
    },
});

const toast = useToast();
const selectedMaintenance = ref(0);
const deleteMaintenancesDialog = ref(false);
const deleteMaintenanceDialog = ref(false);
const maintenanceData = ref({});

const confirmDeleteSelected = () => {
    deleteMaintenancesDialog.value = true;
};

const deleteSelectedMaintenance = () => {
    const ids = selectedMaintenance.value.map((m) => m.id);

    if (ids.length === 0) {
        toast.add({
            severity: "warn",
            summary: "No Selection",
            detail: "No Maintenance selected for deletion",
            life: 3000,
        });
        return;
    }

    router.post(
        route("maintenances.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteMaintenancesDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Maintenance Deleted",
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

const deleteMaintenance = (id) => {
    router.delete(route("maintenance.delete", id), {
        onSuccess: () => {
            deleteMaintenanceDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Maintenance Deleted",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error("Error deleting driver:", errors);
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "Failed to delete maintenance",
                life: 3000,
            });
        },
    });
};

const confirmDeleteMaintenance = (maintenance) => {
    maintenanceData.value = maintenance;
    deleteMaintenanceDialog.value = true;
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
</script>
