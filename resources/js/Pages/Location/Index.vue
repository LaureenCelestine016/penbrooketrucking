<template>
    <Head title="Vehicle" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Location List
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                        <DataTable
                            ref="dt"
                            v-model:selection="selectedVehicle"
                            :value="location.data"
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
                                                !selectedVehicle ||
                                                !selectedVehicle.length
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
                                field="street"
                                header="Street"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                field="barangay"
                                header="Barangay"
                                sortable
                                style="min-width: 5rem"
                            ></Column>
                            <Column
                                field="municipality"
                                header="Municipality"
                                sortable
                                style="min-width: 8rem"
                            >
                                <!-- <template #body="slotProps">
                                    {{ formatCurrency(slotProps.data.price) }}
                                </template> -->
                            </Column>
                            <Column
                                field="province"
                                header="Province
"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                field="region"
                                header="Region"
                                sortable
                                style="min-width: 12rem"
                            >
                            </Column>
                            <!-- <Column
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
                            </Column> -->
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
                                        @click="editLocation(slotProps.data)"
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
                            </Column>
                        </DataTable>

                        <Dialog
                            v-model:visible="locationDialog"
                            :style="{ width: '750px' }"
                            header="Location Details"
                            :modal="true"
                        >
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Landmark</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.name"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Street</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.street"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Barangay</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.barangay"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Municipality</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.municipality"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                            </div>

                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Province</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.province"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Region</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.region"
                                        fluid
                                    />
                                    <small
                                        v-if="submitted && !product.name"
                                        class="text-red-500"
                                        >Name is required.</small
                                    >
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="name" class="block font-bold mb-3"
                                    >Address</label
                                >
                                <InputText
                                    id="name"
                                    disabled=""
                                    required="true"
                                    v-model="form.address"
                                    fluid
                                    class="!bg-gray-50"
                                />
                                <small
                                    v-if="submitted && !product.name"
                                    class="text-red-500"
                                    >Name is required.</small
                                >
                            </div>

                            <template #footer>
                                <Button
                                    label="UPDATE CHANGE"
                                    icon="pi pi-pencil"
                                    @click="saveProduct"
                                    class="w-full mt-4"
                                />
                            </template>
                        </Dialog>

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
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import Tag from "primevue/tag";
import Dialog from "primevue/dialog";
import { FilterMatchMode } from "@primevue/core/api";

const toast = useToast();

const locationDialog = ref(false);

defineProps({
    location: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: "",
    street: "",
    barangay: "",
    municipality: "",
    city: "",
    province: "",
    address: "",
    region: "",
    latitude: "",
    longitude: "",
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

watch(
    [
        () => form.name,
        () => form.street,
        () => form.barangay,
        () => form.municipality,
        () => form.province,
        () => form.region,
    ],
    () => {
        form.address = `${form.name}, ${form.street}, ${form.barangay} ${
            form.municipality ? form.municipality : ""
        } ${form.province}, ${form.region}`;
    }
);

const editLocation = (loc) => {
    form.name = loc.name;
    form.street = loc.street;
    form.barangay = loc.barangay;
    form.municipality = loc.municipality;
    form.city = loc.city;
    form.province = loc.province;
    form.region = loc.region;
    form.latitude = loc.latitude;
    form.longitude = loc.longitude;

    locationDialog.value = true;
};
</script>
