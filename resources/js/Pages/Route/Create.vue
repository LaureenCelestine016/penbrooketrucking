<template>
    <Head title="Add Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Route
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-6">
                        <!-- Vehicle Infomation -->
                        <div class="">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Route</label
                            >
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="tructor"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Tructor Truck<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="tructor"
                                        name="tructor"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="tructor"
                                            class="w-full"
                                            :suggestions="tructors"
                                            @complete="tructorNameSearch"
                                            @item-select="onTructorSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Plate no."
                                        />
                                        <Message
                                            v-if="form.errors.vehicleId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.vehicleId
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="trailer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trailer Truck<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="trailer"
                                        name="trailer"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="trailer"
                                            class="w-full"
                                            :suggestions="trailers"
                                            @complete="trailerNameSearch"
                                            @item-select="onTrailerSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Plate no."
                                        />
                                        <Message
                                            v-if="form.errors.vehicleId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.vehicleId
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="driver"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Driver<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            :suggestions="driverName"
                                            @complete="driverNameSearch"
                                            @item-select="onDriverSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Driver name"
                                        />
                                        <Message
                                            v-if="form.errors.driverId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.driverId }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="First_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Status<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="First_name"
                                        name="First_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="vehicle_name"
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
                                            >{{ form.errors.status }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="start_location"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Start Location<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="start_location"
                                        name="start_location"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="start_location"
                                            class="w-full"
                                            :suggestions="startLoc"
                                            @complete="startLocSearch"
                                            @item-select="onStLocSelect"
                                            optionLabel="address"
                                            dropdown
                                            placeholder="Location"
                                        />
                                        <Message
                                            v-if="form.errors.startLocId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.startLocId
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="driver"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip End Location<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="driver"
                                        name="driver"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="driver"
                                            class="w-full"
                                            :suggestions="endLoc"
                                            @complete="endLocSearch"
                                            @item-select="onEndLocSelect"
                                            optionLabel="address"
                                            dropdown
                                            placeholder="Location"
                                        />
                                        <Message
                                            v-if="form.errors.endLocId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.endLocId }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip Start Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="license_expired_date"
                                        name="license_expired_date"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.dateStart"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="license_expired"
                                                placeholder="Start Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.dateStart"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.dateStart
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="license_expired_date"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trip End Date<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        >
                                    </label>
                                    <FormField
                                        id="license_expired_date"
                                        name="license_expired_date"
                                        class="flex flex-col gap-1"
                                    >
                                        <div class="flex-auto">
                                            <DatePicker
                                                id="registration_expired"
                                                v-model="form.dateEnd"
                                                showIcon
                                                fluid
                                                :showOnFocus="false"
                                                inputId="license_expired"
                                                placeholder="End Date"
                                            />
                                        </div>
                                        <Message
                                            v-if="form.errors.dateEnd"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.dateEnd }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-5">
                                <div class="w-full">
                                    <label
                                        for="First_name"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Approx TOTAL KM<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="First_name"
                                        name="First_name"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            v-model="form.aproxKM"
                                            class="user--input firstName"
                                            placeholder="Kilometer"
                                        />
                                        <Message
                                            v-if="form.errors.aproxKM"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.aproxKM }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="fuel"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Fuel amount<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="fuel"
                                        name="fuel"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="vehicle_name"
                                            class="w-full"
                                            :suggestions="fuelAmount"
                                            @complete="fuelAmountSearch"
                                            @item-select="onFuelSelect"
                                            dropdown
                                            placeholder="Amount"
                                            optionLabel="display"
                                            :forceSelection="true"
                                        >
                                            <template #option="slotProps">
                                                <div>
                                                    <span
                                                        >₱
                                                        {{
                                                            slotProps.option
                                                                .cost
                                                        }}</span
                                                    >
                                                    <span class="fuel-date">
                                                        — Refuel Date:
                                                        {{
                                                            slotProps.option
                                                                .date
                                                        }}</span
                                                    >
                                                </div>
                                            </template>
                                        </AutoComplete>

                                        <Message
                                            v-if="form.errors.fuelId"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.fuelId }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                        </div>
                        <div>
                            <Button
                                label="SUBMIT"
                                type="submit"
                                icon="pi pi-send"
                                class="w-full mt-12"
                            />
                        </div>
                    </form>
                    <div
                        id="map"
                        style="
                            width: 100%;
                            height: 550px;
                            background: #eee;
                            display: none;
                        "
                    ></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import dayjs from "dayjs";
import { ref, watch, nextTick } from "vue";

import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import L from "leaflet";
import "leaflet-routing-machine";

const tructors = ref([]);
const trailers = ref([]);
const driverName = ref([]);
const startLoc = ref([]);
const endLoc = ref([]);
const tripStatus = ref([]);
const fuelAmount = ref([]);
const toast = useToast();
const startLat = ref(null);
const startLng = ref(null);
const endLat = ref(null);
const endLng = ref(null);
const map = ref(null);
const marker = ref(null);
const secondMarker = ref(null);
const routingControl = ref(null);
const approx = ref(null);

const props = defineProps({
    tructor: {
        type: Array,
        required: true,
    },
    trailer: {
        type: Array,
        required: true,
    },
    locations: {
        type: Array,
        required: true,
    },
    drivers: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    tructorId: "",
    trailerId: "",
    driverId: "",
    startLocId: "",
    endLocId: "",
    fuelId: "",
    dateStart: "",
    dateEnd: "",
    status: "",
    aproxKM: "",
});

const submit = () => {
    form.post(route("route.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Driver created successfully!",
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
};

const tructorNameSearch = () => {
    tructors.value = props.tructor.map((tructor) => ({
        id: tructor.id,
        name: tructor.license_plate,
    }));
};

const onTructorSelect = (event) => {
    form.tructorId = event.value.id;
};

const trailerNameSearch = () => {
    trailers.value = props.trailer.map((trailer) => ({
        id: trailer.id,
        name: trailer.license_plate,
    }));
};

const onTrailerSelect = (event) => {
    form.trailerId = event.value.id;
};

const driverNameSearch = () => {
    driverName.value = props.drivers.map((driver) => ({
        id: driver.id,
        name: driver.fullname,
    }));
};

const onDriverSelect = (event) => {
    form.driverId = event.value.id;
};

const startLocSearch = () => {
    startLoc.value = props.locations.map((stLoc) => ({
        id: stLoc.id,
        address: stLoc.address,
        latitude: stLoc.latitude,
        longitude: stLoc.longitude,
    }));
};

const onStLocSelect = async (event) => {
    form.startLocId = event.value.id;
    startLat.value = event.value.latitude;
    startLng.value = event.value.longitude;
};

const endLocSearch = () => {
    endLoc.value = props.locations.map((endLoc) => ({
        id: endLoc.id,
        address: endLoc.address,
        latitude: endLoc.latitude,
        longitude: endLoc.longitude,
    }));
};

const onEndLocSelect = (event) => {
    form.endLocId = event.value.id;
    endLat.value = event.value.latitude;
    endLng.value = event.value.longitude;
};

const tripStatusSearch = () => {
    tripStatus.value = ["Yet to start", "Completed", "Ongoing", "Cancelled"];
};

const fuelAmountSearch = () => {
    const selectedVehicle = props.vehicles.find((v) => v.id === form.vehicleId);

    if (selectedVehicle) {
        fuelAmount.value = selectedVehicle.fuel_records.map((record) => ({
            id: record.id,
            cost: record.cost,
            date: record.refueling_date,
            display: `₱ ${record.cost} -- Refuel Date: ${record.refueling_date}`, // UI display value
        }));
    } else {
        fuelAmount.value = []; // Clear if no vehicle found
    }
};

const onFuelSelect = (event) => {
    form.fuelId = event.value.id;
};

const location = async () => {
    await nextTick(); // Ensure DOM is ready

    const mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container not found!");
        return;
    }

    // **Fix: Check if the map is already initialized**
    if (!map.value) {
        map.value = L.map("map").setView([startLat.value, startLng.value], 13);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
            map.value
        );
    } else {
        map.value.setView([startLat.value, startLng.value], 13); // Just update view
    }

    if (!marker.value) {
        marker.value = L.marker([startLat.value, startLng.value]).addTo(
            map.value
        );
    } else {
        marker.value.setLatLng([startLat.value, startLng.value]);
    }

    if (endLat.value !== null && endLng.value !== null) {
        if (!secondMarker.value) {
            secondMarker.value = L.marker([endLat.value, endLng.value]).addTo(
                map.value
            );
        } else {
            secondMarker.value.setLatLng([endLat.value, endLng.value]);
        }
    }

    // **Fix: Remove previous route before adding a new one**
    if (routingControl.value) {
        map.value.removeControl(routingControl.value);
    }

    if (endLat.value !== null && endLng.value !== null) {
        routingControl.value = L.Routing.control({
            waypoints: [
                L.latLng(startLat.value, startLng.value),
                L.latLng(endLat.value, endLng.value),
            ],
            createMarker: () => null, // Prevent extra markers
            routeWhileDragging: true,
        })
            .on("routesfound", function (e) {
                let distance = e.routes[0].summary.totalDistance;
                form.aproxKM = distance / 1000;
            })
            .addTo(map.value);
    }
};

// **Call location() when values change**
watch(
    [startLat, startLng, endLat, endLng],
    ([newStartLat, newStartLng, newEndLat, newEndLng]) => {
        if (newStartLat && newStartLng && newEndLat && newEndLng) {
            location();
        }
    }
);

watch(
    () => form.dateStart,
    (newValue) => {
        if (newValue) {
            form.dateStart = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.dateEnd,
    (newValue) => {
        if (newValue) {
            form.dateEnd = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

// **Initialize the map when the component is mounted**
</script>

<style scoped>
.fuel-date {
    font-size: 12px; /* Small text */
    color: red; /* Red color */
    margin-left: 5px;
}
</style>
