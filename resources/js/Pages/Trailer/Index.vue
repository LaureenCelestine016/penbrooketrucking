<template>
    <Head title="Trailer" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Trailer Truck List
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedTrailer"
                            :value="trailers"
                            dataKey="id"
                            :paginator="true"
                            :rows="10"
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
                                                !selectedTrailer ||
                                                !selectedTrailer.length
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
                                field="license_plate"
                                header="Plate number"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                field="body_number"
                                header="Body number"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                field="lto_exp_date"
                                header="LTO Expired Date"
                                sortable
                                style="min-width: 10rem"
                            >
                            </Column>
                            <Column
                                field="calibration_exp_date"
                                header="Calibration Expired Date"
                                sortable
                                style="min-width: 10rem"
                            ></Column>

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
                            <Column
                                header="Action"
                                sortable=""
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
                                            confirmDeleteTrailer(slotProps.data)
                                        "
                                    />
                                </template>
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="deleteTrailerDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="trailerData"
                                    >Are you sure you want to delete
                                    <b>{{ trailerData.license_plate }}</b
                                    >?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteTrailerDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="deleteTrailer(trailerData.id)"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteTrailersDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="trailers"
                                    >Are you sure you want to delete the
                                    selected Trailers?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteTrailersDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    text
                                    @click="deleteSelectedTrailers"
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

defineProps({
    trailers: {
        type: Object,
        required: true,
    },
});

const selectedTrailer = ref(0);
const toast = useToast();
const trailerData = ref({});
const dt = ref();
const deleteTrailerDialog = ref(false);
const deleteTrailersDialog = ref(false);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const confirmDeleteSelected = () => {
    deleteTrailersDialog.value = true;
};

const deleteSelectedTrailers = () => {
    const ids = selectedTrailer.value.map((m) => m.id);

    if (ids.length === 0) {
        toast.add({
            severity: "warn",
            summary: "No Selection",
            detail: "No Trailer selected for deletion",
            life: 3000,
        });
        return;
    }

    router.post(
        route("trailers.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteTrailersDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Trailer Deleted",
                    life: 3000,
                });
            },
            onError: (errors) => {
                console.error("Error deleting vehicles:", errors);
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: "Failed to delete Trailer",
                    life: 3000,
                });
            },
        }
    );
};

const deleteTrailer = (id) => {
    router.delete(route("trailer.delete", id), {
        onSuccess: () => {
            deleteTrailerDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Trailer Deleted",
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

const confirmDeleteTrailer = (trailer) => {
    trailerData.value = trailer;
    deleteTrailerDialog.value = true;
};

const showDetail = (id) => {
    router.get(route("trailer.show", id));
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
