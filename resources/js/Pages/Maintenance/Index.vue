<template>
    <Head title="Maintenance" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Maintenance Record
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
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
                            field=""
                            header="Truck"
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
                                    @click="showDetail(slotProps.data)"
                                />
                                <Button
                                    icon="pi pi-trash"
                                    outlined
                                    rounded
                                    severity="danger"
                                    @click="
                                        confirmDeleteMaintenance(slotProps.data)
                                    "
                                />
                            </template>
                        </Column>
                    </DataTable>
                    <form @submit.prevent="submit">
                        <Dialog
                            v-model:visible="maintenanceDialog"
                            :style="{ width: '750px' }"
                            header="Maintenance Details"
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
                                        >Item</label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            v-model="form.item"
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
                                        >Odometer</label
                                    >
                                    <FormField
                                        id="c-odometer"
                                        name="c-odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            v-model="form.odometer"
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
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Quantity</label
                                    >
                                    <FormField
                                        id="p_odometer"
                                        name="p_odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.quantity"
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
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Price</label
                                    >
                                    <FormField
                                        id="t-distance"
                                        name="t-distance"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.price"
                                            placeholder="Total Distance"
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
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Total Amount
                                    </label>
                                    <InputNumber
                                        v-model="form.total"
                                        placeholder="Total Refuel"
                                        class="w-full"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="breakdown"
                                        class="block font-bold mb-3"
                                        >Breakdown Date<span
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
                                                v-model="form.breakdown"
                                                :showOnFocus="false"
                                                inputId="expenseDate"
                                                placeholder="Breakdown Date"
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
                                <div class="w-full">
                                    <label
                                        for="update"
                                        class="block font-bold mb-3"
                                        >Up Date<span class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="update"
                                        name="update"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="update"
                                                showIcon
                                                fluid
                                                v-model="form.up"
                                                :showOnFocus="false"
                                                inputId="expenseDate"
                                                placeholder="Up Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.up"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.up }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Supplier</label
                                    >
                                    <InputText
                                        v-model="form.supplier"
                                        placeholder="Avg. Fuel"
                                        class="w-full"
                                    />
                                </div>
                                <div class="w-full">
                                    <label
                                        for="remarks"
                                        class="block font-bold mb-3"
                                        >Remarks<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="remarks"
                                        name="remarks"
                                        class="flex flex-col gap-1"
                                    >
                                        <Textarea
                                            v-model="form.remarks"
                                            variant="filled"
                                            rows="2"
                                            cols="30"
                                            placeholder="Remarks"
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
                        v-model:visible="deleteMaintenanceDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
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
                                @click="deleteMaintenance(maintenanceData.id)"
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
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="maintenance"
                                >Are you sure you want to delete the selected
                                maintenance?</span
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
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link, useForm } from "@inertiajs/vue3";
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
import Textarea from "primevue/textarea";

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
const maintenanceDialog = ref(false);

const form = useForm({
    id: "",
    truck: "",
    item: "",
    odometer: "",
    quantity: "",
    price: "",
    total: "",
    odometer: "",
    supplier: "",
    breakdown: "",
    up: "",
    remarks: "",
});

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

const submit = () => {
    form.put(route("maintenance.update", form.id), {
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

    maintenanceDialog.value = false;
};

const showDetail = (maintenance) => {
    form.id = maintenance.id;
    form.truck =
        maintenance.trailer?.license_plate ??
        maintenance.vehicle?.license_plate;
    form.item = maintenance.item_description;
    form.odometer = maintenance.odometer;
    form.quantity = maintenance.quantity;
    form.price = maintenance.price;
    form.total = maintenance.total;
    form.odometer = maintenance.odometer;
    form.supplier = maintenance.supplier;
    form.breakdown = maintenance.breakdown_date;
    form.up = maintenance.up_date;
    form.remarks = maintenance.remarks;

    maintenanceDialog.value = true;
};

watch(() => {
    form.total = form.quantity * form.price;
});

watch(
    () => form.breakdown,
    (newValue) => {
        if (newValue) {
            form.breakdown = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.up,
    (newValue) => {
        if (newValue) {
            form.up = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
</script>
