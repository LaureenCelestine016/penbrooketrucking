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
                                    @click="
                                        confirmDeleteExpenses(slotProps.data)
                                    "
                                />
                            </template>
                        </Column>
                    </DataTable>

                    <form @submit.prevent="submit">
                        <Dialog
                            v-model:visible="expensesDialog"
                            :style="{ width: '750px' }"
                            header="Expenses Details"
                            :modal="true"
                        >
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="tractor"
                                        class="block font-bold mb-3"
                                        >Truck</label
                                    >
                                    <FormField
                                        id="tractor"
                                        name="tractor"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            v-model="form.truck"
                                            placeholder="Truck"
                                            class="w-full !bg-gray-50"
                                            disabled=""
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Category</label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            v-model="form.category"
                                            placeholder="Item"
                                            class="w-full !bg-gray-50"
                                            disabled=""
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Description</label
                                    >
                                    <FormField
                                        id="c-odometer"
                                        name="c-odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            v-model="form.description"
                                            placeholder="Item"
                                            class="w-full !bg-gray-50"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Amount</label
                                    >
                                    <FormField
                                        id="p_odometer"
                                        name="p_odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.amount"
                                            placeholder="Quantity"
                                            class="w-full"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="w-full">
                                    <label
                                        for="breakdown"
                                        class="block font-bold mb-3"
                                        >Expense Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="breakdown"
                                        name="breakdown"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="breakdown"
                                                showIcon
                                                fluid
                                                v-model="form.expense_date"
                                                :showOnFocus="false"
                                                inputId="expenseDate"
                                                placeholder="Expenses Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.breakdown"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.breakdown
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
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import dayjs from "dayjs";

import Toast from "primevue/toast";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Tag from "primevue/tag";
import Dialog from "primevue/dialog";
import { FilterMatchMode } from "@primevue/core/api";
import { useToast } from "primevue/usetoast";
import DatePicker from "primevue/datepicker";

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
const expensesDialog = ref(false);
const dt = ref();

const form = useForm({
    id: "",
    truck: "",
    category: "",
    amount: "",
    expense_date: "",
    description: "",
});

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

const showDetail = (expenses) => {
    form.id = expenses.id;
    form.truck =
        expenses.tractor.license_plate ?? expenses.vehicle.license_plate;
    form.category = expenses.category?.name;
    form.amount = expenses.amount;
    form.description = expenses.description;
    form.expense_date = expenses.expense_date;

    expensesDialog.value = true;
};

const submit = () => {
    form.put(route("expenses.update", form.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Maintenace updated successfully!",
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

    expensesDialog.value = false;
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

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
