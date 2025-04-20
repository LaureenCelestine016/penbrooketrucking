<template>
    <Head title="Fuel" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Fuel List
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
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
                            style="min-width: 8rem"
                        ></Column>
                        <Column
                            field="total_refuel"
                            header="Liters"
                            sortable
                            style="min-width: 8rem"
                        ></Column>
                        <Column
                            field="amount"
                            header="Amount"
                            sortable
                            style="min-width: 8rem"
                        >
                        </Column>
                        <Column
                            field="total_distance"
                            header="Distance"
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
                                    @click="confirmDeleteFuel(slotProps.data)"
                                />
                            </template>
                        </Column>
                    </DataTable>
                    <form @submit.prevent="submit">
                        <Dialog
                            v-model:visible="fuelDialog"
                            :style="{ width: '750px' }"
                            header="Fuel Details"
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
                                        <AutoComplete
                                            id="tractor"
                                            class="w-full"
                                            v-model="licensePlate"
                                            :suggestions="tractorName"
                                            @complete="tractorNameSearch"
                                            @item-select="onTractorSelect"
                                            optionLabel="license_plate"
                                            dropdown
                                            placeholder="Truck name"
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
                                        >Driver</label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            v-model="driveFullname"
                                            :suggestions="driverName"
                                            @complete="driverNameSearch"
                                            @item-select="onDriverSelect"
                                            optionLabel="display"
                                            dropdown
                                            placeholder="Driver name"
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
                                        >Current Odometer</label
                                    >
                                    <FormField
                                        id="c-odometer"
                                        name="c-odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.current_odometer"
                                            placeholder="Current Odometer"
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
                                        >Previous Odometer</label
                                    >
                                    <FormField
                                        id="p_odometer"
                                        name="p_odometer"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.previous_odometer"
                                            placeholder="Previous Odometer"
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
                                        >Total Distance</label
                                    >
                                    <FormField
                                        id="t-distance"
                                        name="t-distance"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputNumber
                                            v-model="form.total_distance"
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
                                        >Total Refuel
                                        <span class="font-thin text-sm"
                                            >(Liter)</span
                                        ></label
                                    >
                                    <InputNumber
                                        v-model="form.total_refuel"
                                        placeholder="Total Refuel"
                                        class="w-full"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Avg. Fuel Consumption</label
                                    >
                                    <InputNumber
                                        v-model="form.avg_fuel_consumption"
                                        placeholder="Avg. Fuel"
                                        class="w-full"
                                    />
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Amount
                                    </label>
                                    <InputNumber
                                        v-model="form.amount"
                                        placeholder="Amount"
                                        class="w-full"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Station</label
                                    >
                                    <InputText
                                        v-model="form.station"
                                        placeholder="Station"
                                        class="w-full"
                                    />
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Refilled Date
                                    </label>
                                    <div class="flex-auto">
                                        <DatePicker
                                            v-model="form.refueling_date"
                                            id="dateRefuel"
                                            showIcon
                                            fluid
                                            :showOnFocus="false"
                                            inputId="dateRefuel"
                                            placeholder="Date Refilled"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="w-full">
                                    <label
                                        for="remarks"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
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
                        v-model:visible="deleteFuelDialog"
                        :style="{ width: '450px' }"
                        header="Confirm"
                        :modal="true"
                    >
                        <div class="flex items-center gap-4">
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="fuelData"
                                >Are you sure you want to delete this fuel with
                                the cost and date is
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
                            <i class="pi pi-exclamation-triangle !text-3xl" />
                            <span v-if="fuels"
                                >Are you sure you want to delete the selected
                                fuels?</span
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
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
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
import AutoComplete from "primevue/autocomplete";
import InputNumber from "primevue/inputnumber";
import DatePicker from "primevue/datepicker";
import Textarea from "primevue/textarea";
import dayjs from "dayjs";

const props = defineProps({
    fuels: {
        type: Object,
        required: true,
    },
    drivers: {
        type: Array,
        required: true,
    },
    tractor: {
        type: Array,
        required: true,
    },
});

const toast = useToast();
const selectedFuels = ref(0);
const fuelData = ref({});
const deleteFuelsDialog = ref(false);
const deleteFuelDialog = ref(false);
const fuelDialog = ref(false);
const driveFullname = ref("");
const licensePlate = ref("");
const driverName = ref([]);
const tractorName = ref([]);

const form = useForm({
    id: "",
    vehicleId: "",
    vehicle_name: "",
    driverId: "",
    current_odometer: "",
    previous_odometer: "",
    total_distance: "",
    total_refuel: "",
    avg_fuel_consumption: "",
    amount: "",
    station: "",
    refueling_date: "",
    remarks: "",
});

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

const showDetail = (fuel) => {
    form.id = fuel.id;
    licensePlate.value = fuel.vehicle.license_plate;
    driveFullname.value = `${fuel.driver.first_name} ${fuel.driver.last_name}`;
    form.vehicleId = fuel.vehicle_id;
    form.driverId = fuel.driver_id;
    form.current_odometer = fuel.current_odometer;
    form.previous_odometer = fuel.previous_odometer;
    form.total_distance = fuel.total_distance;
    form.total_refuel = fuel.total_refuel;
    form.avg_fuel_consumption = fuel.avg_fuel_consumption;
    form.amount = fuel.amount;
    form.station = fuel.station;
    form.refueling_date = fuel.refueling_date;
    form.remarks = fuel.remarks;

    fuelDialog.value = true;
};

const tractorNameSearch = (event) => {
    const query = event.query.toLowerCase();

    if (Array.isArray(props.tractor) && props.tractor.length > 0) {
        tractorName.value = props.tractor
            .filter((tr) => tr.license_plate.toLowerCase().includes(query))
            .map((tr) => ({
                id: tr.id,
                license_plate: tr.license_plate,
            }));
    }
};
const onTractorSelect = (event) => {
    form.vehicleId = event.value.id;
};

const driverNameSearch = (event) => {
    const query = event.query.toLowerCase();

    if (Array.isArray(props.drivers) && props.drivers.length > 0) {
        driverName.value = props.drivers
            .filter((dr) =>
                `${dr.first_name} ${dr.last_name}`.toLowerCase().includes(query)
            )
            .map((dr) => ({
                id: dr.id,
                firstName: dr.first_name,
                lastName: dr.last_name,
                display: `${dr.first_name} ${dr.last_name}`,
            }));
    }
};

const onDriverSelect = (event) => {
    form.driverId = event.value.id;
};

const submit = () => {
    form.put(route("fuel.update", form.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Fuel updated successfully!",
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

    fuelDialog.value = false;
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

watch(
    () => form.refueling_date,
    (newValue) => {
        if (newValue) {
            form.refueling_date = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);
</script>
