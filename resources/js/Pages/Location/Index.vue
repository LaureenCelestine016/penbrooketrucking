<template>
    <Head title="Location" />
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
                            v-model:selection="selectedLocation"
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
                                                !selectedLocation ||
                                                !selectedLocation.length
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
                                field="street"
                                header="Street"
                                sortable
                                style="min-width: 7rem"
                            ></Column>
                            <Column
                                field="barangay"
                                header="Barangay"
                                sortable
                                style="min-width: 10rem"
                            ></Column>
                            <Column
                                header="Municipality (City)"
                                sortable
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.municipality }}
                                    {{ slotProps.data.city }}
                                </template>
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
                                            confirmDeleteLocation(
                                                slotProps.data
                                            )
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
                                <div class="w-full" v-if="form.municipality">
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
                                <div class="w-full" v-else>
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >City</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        v-model="form.city"
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
                            <div class="flex flex-row gap-5 mb-4">
                                <div class="w-full">
                                    <label
                                        for="name"
                                        class="block font-bold mb-3"
                                        >Latitude</label
                                    >
                                    <InputText
                                        id="name"
                                        disabled=""
                                        required="true"
                                        v-model="form.latitude"
                                        class="!bg-gray-50"
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
                                        >Longitude</label
                                    >
                                    <InputText
                                        id="name"
                                        required="true"
                                        disabled=""
                                        v-model="form.longitude"
                                        class="!bg-gray-50"
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
                            v-model:visible="deleteLocationsDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span
                                    >Are you sure you want to delete the
                                    selected location?</span
                                >
                            </div>
                            <template #footer>
                                <Button
                                    label="No"
                                    icon="pi pi-times"
                                    text
                                    @click="deleteLocationsDialog = false"
                                />
                                <Button
                                    label="Yes"
                                    icon="pi pi-check"
                                    @click="deleteSelectedLocation"
                                />
                            </template>
                        </Dialog>

                        <Dialog
                            v-model:visible="deleteLocationDialog"
                            :style="{ width: '450px' }"
                            header="Confirm"
                            :modal="true"
                        >
                            <div class="flex items-center gap-4">
                                <i
                                    class="pi pi-exclamation-triangle !text-3xl"
                                />
                                <span v-if="locationData"
                                    >Are you sure you want to delete this
                                    location?</span
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
                                    @click="deleteLocation(locationData.id)"
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
import { Head, useForm, router } from "@inertiajs/vue3";
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
const props = defineProps({
    location: {
        type: Object,
        required: true,
    },
});

const selectedLocation = ref(0);
const locationDialog = ref(false);
const deleteLocationsDialog = ref(false);
const deleteLocationDialog = ref(false);
const locationData = ref({});
const dt = ref();

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
        () => form.city,
        () => form.province,
        () => form.region,
    ],
    () => {
        form.address = `${form.name}, ${form.street}, ${form.barangay} ${
            form.municipality ? form.municipality : form.city
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

const exportCSV = () => {
    dt.value.exportCSV();
};

const confirmDeleteLocation = (loc) => {
    locationData.value = loc;
    deleteLocationDialog.value = true;
};

const confirmDeleteSelected = () => {
    deleteLocationsDialog.value = true;
};

const deleteLocation = (id) => {
    router.delete(route("location.delete", id), {
        onSuccess: () => {
            deleteLocationDialog.value = false;
            toast.add({
                severity: "success",
                summary: "Successful",
                detail: "Location Deleted",
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

const deleteSelectedLocation = () => {
    const ids = selectedLocation.value.map((m) => m.id);

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
        route("locations.delete"),
        { ids },
        {
            onSuccess: () => {
                deleteLocationsDialog.value = false;
                toast.add({
                    severity: "success",
                    summary: "Successful",
                    detail: "Locations Deleted",
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
</script>
