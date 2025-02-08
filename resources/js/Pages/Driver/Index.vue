<template>
    <Head title="Driver" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Driver List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedDriver"
                            :value="drivers.data"
                            dataKey="id"
                            :paginator="true"
                            :rows="5"
                            :filters="filters"
                            :globalFilterFields="[
                                'name.first',
                                'name.middle',
                                'name.last',
                                'license_details.license_number',
                                'status',
                            ]"
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
                                                !selectedDriver ||
                                                !selectedDriver.length
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
                                field="name"
                                header="Name"
                                sortable
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.name.first }}
                                    {{ slotProps.data.name.middle }}
                                    {{ slotProps.data.name.last }}
                                </template>
                            </Column>
                            <Column
                                header="Age"
                                sortable
                                style="min-width: 5rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.personal_details.age }}
                                </template></Column
                            >
                            <Column
                                header="Address"
                                sortable
                                style="min-width: 12rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.contact_details.address }}
                                </template>
                            </Column>
                            <Column
                                header="Civil status"
                                sortable
                                style="min-width: 5rem"
                                ><template #body="slotProps">
                                    {{
                                        slotProps.data.personal_details
                                            .civil_status
                                    }}
                                </template></Column
                            >
                            <Column
                                header="License number"
                                sortable
                                style="min-width: 12rem"
                                ><template #body="slotProps">
                                    {{
                                        slotProps.data.license_details
                                            .license_number
                                    }}
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
                                        @click="showDetail(slotProps.data.id)"
                                    />
                                    <Button
                                        icon="pi pi-trash"
                                        outlined
                                        rounded
                                        severity="danger"
                                        @click="
                                            confirmDeleteDriver(slotProps.data)
                                        "
                                    />
                                </template>
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="deleteDriverDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="driverData"
                                    >Are you sure you want to delete
                                    <b>{{ driverData.name.first }}</b
                                    >?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteDriverDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="deleteDriver(driverData.id)"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteDriversDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="drivers"
                                    >Are you sure you want to delete the
                                    selected drivers?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteDriversDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    text
                                    @click="deleteSelectedDrivers"
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
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

import Toolbar from "primevue/toolbar";

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

const selectedDriver = ref(0);
const toast = useToast();
const driverData = ref({});
const dt = ref();
const deleteDriversDialog = ref(false);
const deleteDriverDialog = ref(false);

defineProps({
    drivers: {
        type: Object,
        required: true,
    },
});

const confirmDeleteSelected = () => {
    deleteDriversDialog.value = true;
};

const confirmDeleteDriver = (driver) => {
    driverData.value = driver;
    deleteDriverDialog.value = true;
};

const showDetail = (id) => {
    router.get(route("driver.show", id));
};

const exportCSV = () => {
    dt.value.exportCSV();
};

const deleteDriver = (id) => {
    router.delete(route("driver.delete", id), {
        onSuccess: () => {
            deleteDriverDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Driver Deleted",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error("Error deleting driver:", errors);
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "Failed to delete driver",
                life: 3000,
            });
        },
    });
};

const deleteSelectedDrivers = () => {
    const ids = selectedDriver.value.map((m) => m.id);

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
        route("drivers.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteDriversDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Drivers Deleted",
                    life: 3000,
                });
            },
            onError: (errors) => {
                console.error("Error deleting drivers:", errors);
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: "Failed to delete drivers",
                    life: 3000,
                });
            },
        }
    );
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

console.log(filters);

const getStatusLabel = (status) => {
    switch (status) {
        case "Active":
            return "success";
        case "Inactive":
            return "danger";

        default:
            return null;
    }
};
</script>
