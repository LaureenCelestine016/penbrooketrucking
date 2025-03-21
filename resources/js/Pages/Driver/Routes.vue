<template>
    <Head title="Driver" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedVehicle"
                            :value="routes"
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
                                    <!-- <Button
                                        label="EXPORT TO EXCEL"
                                        icon="pi pi-upload"
                                        severity="secondary"
                                        @click="exportCSV($event)"
                                    /> -->

                                    <div
                                        class="flex gap-4 justify-center items-center"
                                    >
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
                                header="Tractor / Trailer"
                                sortable
                                style="min-width: 10rem"
                            >
                                <template #body="slotProps">
                                    {{ slotProps.data.vehicle.license_plate }} /
                                    {{ slotProps.data.trailer.license_plate }}
                                </template></Column
                            >
                            <Column
                                header="Delivery Location"
                                sortable
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.end_location.address }}
                                    /
                                    {{ slotProps.data.trailer.license_plate }}
                                </template></Column
                            >
                            <Column
                                field="start_date"
                                header="Start Date"
                                sortable
                                style="min-width: 10rem"
                            >
                                <!-- <template #body="slotProps">
                                    {{ formatCurrency(slotProps.data.price) }}
                                </template> -->
                            </Column>
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
                                            getStatusLabel(
                                                slotProps.data.status
                                            )
                                        "
                                    />
                                </template>
                            </Column>
                            <!-- <Column
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
                                        class="ml-3"
                                        @click="editRoute(slotProps.data)"
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
                            </Column> -->
                        </DataTable>
                        <form @submit.prevent="submit">
                            <Dialog
                                v-model:visible="routeDialog"
                                :style="{ width: '750px' }"
                                header="Change Status"
                                :modal="true"
                            >
                                <div class="flex flex-row gap-5 mb-4">
                                    <div class="w-full">
                                        <label
                                            for="status"
                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                            >Trip Status<span
                                                class="ml-1 text-red-400"
                                                >*</span
                                            ></label
                                        >
                                        <FormField
                                            id="status"
                                            name="status"
                                            class="flex flex-col gap-1"
                                        >
                                            <AutoComplete
                                                id="status"
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
                                                >{{
                                                    form.errors.status
                                                }}</Message
                                            >
                                        </FormField>
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
                        </form>

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
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router, useForm } from "@inertiajs/vue3";
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
import AutoComplete from "primevue/autocomplete";
import { FilterMatchMode } from "@primevue/core/api";
import { useToast } from "primevue/usetoast";

const props = defineProps({
    routes: {
        type: Object,
        required: true,
    },
});

const routeDialog = ref(false);
const tripStatus = ref([]);

const form = useForm({
    status: "",
});

const editRoute = (route) => {
    console.log(route);
    form.id = route.id;
    form.status = route.status;
    routeDialog.value = true;
};

const submit = () => {
    form.put(route("route.update", form.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Route updated successfully!",
                life: 3000,
            });
        },
        onError: () => {
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "There were errors in your form submission.",
                life: 3000,
            });
        },
    });

    locationDialog.value = false;
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const tripStatusSearch = () => {
    tripStatus.value = ["Yet to start", "Completed", "Ongoing", "Cancelled"];
};

const getStatusLabel = (status) => {
    switch (status) {
        case "Yet to start":
            return "warn";

        case "Ongoing":
            return "info";
        case "Cancelled":
            return "danger";

        default:
            return null;
    }
};
</script>
