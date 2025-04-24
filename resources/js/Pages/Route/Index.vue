<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route List
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                <div class="card">
                    <DataTable
                        ref="dt"
                        v-model:selection="selectedRoute"
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
                                            !selectedRoute ||
                                            !selectedRoute.length
                                        "
                                    />
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
                            </div>
                        </template>

                        <Column
                            selectionMode="multiple"
                            style="width: 3rem"
                            :exportable="false"
                        ></Column>
                        <Column
                            field="vehicle.license_plate"
                            header="Truck"
                            sortable
                            style="min-width: 9rem"
                        ></Column>
                        <Column
                            field=""
                            header="Driver"
                            sortable
                            style="min-width: 8rem"
                            ><template #body="slotProps">
                                {{ slotProps.data.driver?.first_name }}
                                {{ slotProps.data.driver?.last_name }}
                            </template></Column
                        >
                        <Column
                            field=""
                            header="Start Location"
                            sortable
                            style="min-width: 8rem"
                        >
                            <template #body="slotProps">
                                {{ slotProps.data.start_location?.address }}
                            </template>
                        </Column>
                        <Column
                            field=""
                            header="End Location"
                            sortable
                            style="min-width: 8rem"
                        >
                            <template #body="slotProps">
                                {{ slotProps.data.end_location?.address }}
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
                                            slotProps.data?.status ===
                                            'Ongoing',
                                    }"
                                    :value="slotProps.data?.status"
                                    :severity="
                                        getStatusLabel(slotProps.data?.status)
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
                                    @click="confirmDeleteRoute(slotProps.data)"
                                />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog
                        v-model:visible="deleteRouteDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="routeData"
                                >Are you sure you want to delete this route?
                            </span>
                        </div>
                        <template #footer>
                            <Button
                                label="No"
                                icon="pi pi-times"
                                text
                                @click="deleteRouteDialog = false"
                            />
                            <Button
                                label="Yes"
                                icon="pi pi-check"
                                @click="deleteRoute(routeData.id)"
                            />
                        </template>
                    </Dialog>

                    <Dialog
                        v-model:visible="deleteRoutesDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="selectedRoute"
                                >Are you sure you want to delete the selected
                                routes?</span
                            >
                        </div>
                        <template #footer>
                            <Button
                                label="No"
                                icon="pi pi-times"
                                text
                                @click="deleteRoutesDialog = false"
                            />
                            <Button
                                label="Yes"
                                icon="pi pi-check"
                                text
                                @click="deleteSelectedRoutes"
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

const toast = useToast();
const selectedRoute = ref(0);
const routeData = ref({});
const deleteRoutesDialog = ref(false);
const deleteRouteDialog = ref(false);
const dt = ref();

const showDetail = (id) => {
    router.get(route("route.show", id));
};

const confirmDeleteRoute = (route) => {
    console.log(route);

    routeData.value = route;
    deleteRouteDialog.value = true;
};

const confirmDeleteSelected = () => {
    deleteRoutesDialog.value = true;
};

const deleteRoute = (id) => {
    router.delete(route("route.delete", id), {
        onSuccess: () => {
            deleteRouteDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Route Deleted",
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

const deleteSelectedRoutes = () => {
    const ids = selectedRoute.value.map((m) => m.id);

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
        route("routes.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteRoutesDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Routes Deleted",
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
