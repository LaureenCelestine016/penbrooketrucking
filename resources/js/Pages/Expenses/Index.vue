<template>
    <Head title="Expenses" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Expenses
            </h2>
        </template>

        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                <div class="card">
                    <DataTable
                        ref="dt"
                        v-model:selection="selectedExpenses"
                        :value="expenses"
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
                                            !selectedExpenses ||
                                            !selectedExpenses.length
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
                            ><template #body="slotProps">
                                {{ slotProps.data.tractor?.model }}
                                {{ slotProps.data.tractor?.license_plate }}
                                {{ slotProps.data.trailer?.license_plate }}
                            </template></Column
                        >
                        <Column
                            header="Category"
                            sortable
                            style="min-width: 10rem"
                            ><template #body="slotProps">
                                {{ slotProps.data.category?.name }}
                            </template></Column
                        >
                        <Column
                            field="amount"
                            header="Amount"
                            sortable
                            style="min-width: 10rem"
                        >
                        </Column>
                        <Column
                            field="expense_date"
                            header="Expense Date"
                            sortable
                            style="min-width: 10rem"
                        ></Column>

                        <Column
                            field="description"
                            header="Remarks"
                            sortable
                            style="min-width: 10rem"
                        >
                        </Column>
                        <Column
                            header="Action"
                            sortable=""
                            :exportable="false"
                            style="min-width: 5rem"
                        >
                            <template #body="slotProps">
                                <Button
                                    icon="pi pi-trash"
                                    outlined
                                    rounded
                                    severity="danger"
                                    @click="
                                        confirmDeleteExpenses(slotProps.data)
                                    "
                                />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog
                        v-model:visible="deleteExpensesDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="expensesData"
                                >Are you sure you want to delete expenses?</span
                            >
                        </div>
                        <template #footer>
                            <Button
                                label="No"
                                icon="pi pi-times"
                                text
                                @click="deleteExpensesDialog = false"
                            />
                            <Button
                                label="Yes"
                                icon="pi pi-check"
                                @click="deleteExpenses(expensesData.id)"
                            />
                        </template>
                    </Dialog>

                    <Dialog
                        v-model:visible="deleteExpensessDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="expenses"
                                >Are you sure you want to delete the selected
                                expenses?</span
                            >
                        </div>
                        <template #footer>
                            <Button
                                label="No"
                                icon="pi pi-times"
                                text
                                @click="deleteExpensessDialog = false"
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
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import dayjs from "dayjs";

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
    expenses: {
        type: Array,
        required: true,
    },
});

const toast = useToast();
const selectedExpenses = ref(0);
const expensesData = ref({});
const deleteExpensessDialog = ref(false);
const deleteExpensesDialog = ref(false);

const confirmDeleteSelected = () => {
    deleteExpensessDialog.value = true;
};

const deleteSelectedMaintenance = () => {
    const ids = selectedExpenses.value.map((m) => m.id);

    if (ids.length === 0) {
        toast.add({
            severity: "warn",
            summary: "No Selection",
            detail: "No Expenses selected for deletion",
            life: 3000,
        });
        return;
    }

    router.post(
        route("expensess.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteExpensessDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Expenses Deleted",
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

const confirmDeleteExpenses = (expenses) => {
    expensesData.value = expenses;
    deleteExpensesDialog.value = true;
};

const deleteExpenses = (id) => {
    router.delete(route("expenses.delete", id), {
        onSuccess: () => {
            deleteExpensesDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Expenses Deleted",
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
