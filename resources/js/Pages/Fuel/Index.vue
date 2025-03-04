<template>
    <Head title="Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Fuel List
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedFuels"
                            :value="fuels"
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
                                                !selectedFuels ||
                                                !selectedFuels.length
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
                                header="Truck"
                                sortable
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.vehicle.license_plate }}
                                </template></Column
                            >
                            <Column
                                field="liters"
                                header="Liters"
                                sortable
                                style="min-width: 8rem"
                            ></Column>
                            <Column
                                field="cost"
                                header="Cost"
                                sortable
                                style="min-width: 8rem"
                            >
                            </Column>
                            <Column
                                field="fuel_type"
                                header="Type"
                                sortable
                                style="min-width: 8rem"
                            >
                            </Column>
                            <Column
                                field="refueling_date"
                                header="Date Refilled"
                                sortable
                                style="min-width: 8rem"
                            ></Column>
                            <!-- <Column
                                field="status"
                                header="Status"
                                sortable
                                style="min-width: 10rem"
                            >
                                <template #body="slotProps">
                                    <Tag
                                        class="status"
                                        :value="
                                            slotProps.data.is_used === '1'
                                                ? 'Used'
                                                : 'Unused'
                                        "
                                        :severity="
                                            getStatusLabel(
                                                slotProps.data.is_used
                                            )
                                        "
                                    />
                                </template>
                            </Column> -->
                            <Column
                                header="Action"
                                sortable=""
                                :exportable="false"
                                style="min-width: 8rem"
                            >
                                <template #body="slotProps">
                                    <div style="margin-left: 12px">
                                        <Button
                                            icon="pi pi-trash"
                                            outlined
                                            rounded
                                            severity="danger"
                                            @click="
                                                confirmDeleteFuel(
                                                    slotProps.data
                                                )
                                            "
                                        />
                                    </div>
                                    <!-- <Button
                                        icon="pi pi-pencil"
                                        outlined
                                        rounded
                                        class="mr-2"
                                        @click="showDetail(slotProps.data.id)"
                                    /> -->
                                </template>
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="deleteFuelDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="fuelData"
                                    >Are you sure you want to delete this fuel
                                    with the cost and date is
                                    <b class="text-red-700 text-sm"
                                        >₱{{ fuelData.cost }} -
                                        {{ fuelData.refueling_date }}</b
                                    >?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteFuelDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="deleteFuel(fuelData.id)"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteFuelsDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="fuels"
                                    >Are you sure you want to delete the
                                    selected fuels?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteFuelsDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    text
                                    @click="deleteSelectedFuels"
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
import Toast from "primevue/toast";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import { FilterMatchMode } from "@primevue/core/api";
import { useToast } from "primevue/usetoast";

defineProps({
    fuels: {
        type: Object,
        required: true,
    },
});

const toast = useToast();
const selectedFuels = ref(0);
const fuelData = ref({});
const deleteFuelsDialog = ref(false);
const deleteFuelDialog = ref(false);

const confirmDeleteSelected = () => {
    deleteFuelsDialog.value = true;
};

const confirmDeleteFuel = (fuel) => {
    fuelData.value = fuel;
    deleteFuelDialog.value = true;
};

const deleteSelectedFuels = () => {
    const ids = selectedFuels.value.map((m) => m.id);

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
        route("fuels.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteFuelsDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Fuels Deleted",
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

const deleteFuel = (id) => {
    router.delete(route("fuel.delete", id), {
        onSuccess: () => {
            deleteFuelDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Fuel Deleted",
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

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

// const getStatusLabel = (status) => {
//     switch (status) {
//         case "1":
//             return "info";
//         case "0":
//             return "warn";
//         default:
//             return "secondary";
//     }
// };
</script>
