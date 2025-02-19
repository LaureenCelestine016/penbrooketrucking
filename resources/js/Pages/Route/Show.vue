<template>
    <Head title="Route Detail " />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route Detail
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="grid grid-cols-2 gap-y-6">
                    <div class="col-span-3">
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-sm"
                        >
                            <div class="p-4">
                                <h2
                                    class="font-semibold text-lg text-gray-800 mb-3"
                                >
                                    Overview
                                </h2>
                                <div
                                    class="text-lg font-medium flex flex-row justify-around text-center"
                                >
                                    <p class="">
                                        {{ route.start_location.address }}
                                    </p>
                                    <p class="text-red-400">to</p>
                                    <p class="">
                                        {{ route.end_location.address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="grid grid-cols-[600px_1fr] gap-4">
                            <div
                                class="bg-white overflow-hidden shadow-sm sm:rounded-md h-[430px]"
                            >
                                <form action="" class="px-5 pb-5">
                                    <h2
                                        class="font-semibold text-lg text-gray-800 pt-4"
                                    >
                                        Information
                                    </h2>
                                    <div
                                        :class="[
                                            'grid grid-cols-2 gap-6 mt-4',
                                            form.hasErrors ? 'mb-3' : 'mb-6',
                                        ]"
                                    >
                                        <div class="w-full">
                                            <label
                                                for="vehicle"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Vehicle<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <InputText
                                                id="vehicle"
                                                disabled=""
                                                v-model="form.vehicle.name"
                                                required="true"
                                                fluid
                                                class="!bg-gray-50"
                                            />
                                        </div>
                                        <div class="w-full">
                                            <label
                                                for="driver"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Driver<span
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
                                                    v-model="
                                                        form.driver.fullname
                                                    "
                                                    :suggestions="driverName"
                                                    @complete="driverNameSearch"
                                                    @item-select="
                                                        onDriverSelect
                                                    "
                                                    optionLabel="name"
                                                    dropdown
                                                    placeholder="Driver name"
                                                />
                                            </FormField>
                                            <Message
                                                v-if="form.errors.driver_id"
                                                severity="error"
                                                size="small"
                                                variant="simple"
                                                >{{
                                                    form.errors.driver_id
                                                }}</Message
                                            >
                                        </div>
                                    </div>
                                    <div
                                        :class="[
                                            'grid grid-cols-2 gap-6',
                                            form.hasErrors ? 'mb-3' : 'mb-6',
                                        ]"
                                    >
                                        <div class="w-full">
                                            <label
                                                for="start_date"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Trip Start Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                >
                                            </label>
                                            <FormField
                                                id="start_date"
                                                name="start_date"
                                                class="flex flex-col gap-1"
                                            >
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="start_date"
                                                        v-model="
                                                            form.start_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="start_date"
                                                        placeholder="Start Date"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="
                                                        form.errors.start_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors.start_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <div class="w-full">
                                            <label
                                                for="end_date"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Trip End Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                >
                                            </label>
                                            <FormField
                                                id="end_date"
                                                name="end_date"
                                                class="flex flex-col gap-1"
                                            >
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="end_date"
                                                        v-model="form.end_date"
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="end_date"
                                                        placeholder="End Date"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="form.errors.end_date"
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors.end_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                    </div>
                                    <div
                                        :class="[
                                            'grid grid-cols-2 gap-6 mb-6',
                                            form.hasErrors ? 'mt-3' : 'mt-6',
                                        ]"
                                    >
                                        <div class="w-full">
                                            <label
                                                for="distance"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Distance KM.<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                >
                                            </label>
                                            <FormField
                                                id="distance"
                                                name="distance"
                                                class="flex flex-col gap-1"
                                            >
                                                <InputText
                                                    id="distance"
                                                    disabled=""
                                                    required="true"
                                                    v-model="form.distance_km"
                                                    fluid
                                                    class="!bg-gray-50"
                                                />
                                            </FormField>
                                        </div>
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
                                    <Button
                                        label="UPDATE CHANGE"
                                        icon="pi pi-pencil"
                                        @click="submit"
                                        class="w-full mt-3"
                                    />
                                </form>
                            </div>
                            <div
                                class="bg-white overflow-hidden shadow-sm sm:rounded-sm"
                            >
                                <div
                                    class="flex flex-row items-center justify-between pt-3 px-3"
                                >
                                    <h2
                                        class="font-semibold text-lg text-gray-800"
                                    >
                                        Map
                                    </h2>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="28"
                                        height="28"
                                        viewBox="0 0 24 24"
                                        class="cursor-pointer hover:border"
                                        @click="fullScreen"
                                    >
                                        <path
                                            fill="#757575"
                                            d="M3 21v-5h2v3h3v2zm13 0v-2h3v-3h2v5zM3 8V3h5v2H5v3zm16 0V5h-3V3h5v5z"
                                        />
                                    </svg>
                                </div>

                                <div class="h-[600px] p-2">
                                    <div class="border p-1 overflow-hidden">
                                        <div
                                            id="map"
                                            style="
                                                width: 100%;
                                                height: 550px;
                                                background: #eee;
                                            "
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, watch, nextTick, onMounted } from "vue";
import L from "leaflet";
import "leaflet-routing-machine";
import dayjs from "dayjs";

import AutoComplete from "primevue/autocomplete";
import InputText from "primevue/inputtext";
import DatePicker from "primevue/datepicker";
import Button from "primevue/button";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import Message from "primevue/message";

const props = defineProps({
    route: {
        type: Object,
        required: true,
    },
    driver: {
        type: Object,
        required: true,
    },
});

const tripStatus = ref([]);
const driverName = ref([]);
const toast = useToast();
const map = ref(null);
const marker = ref(null);
const secondMarker = ref(null);
const routingControl = ref(null);
const startLat = ref(props.route.start_location.latitude);
const startLng = ref(props.route.start_location.longitude);
const endLat = ref(props.route.end_location.latitude);
const endLng = ref(props.route.end_location.longitude);

const form = useForm({
    ...props.route,
});

const location = async () => {
    const mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container not found!"); // Debugging log
        return;
    }

    let truckIcon = L.icon({
        iconUrl: "/storage/images/trucks.png",
        iconSize: [50, 50],
    });

    if (!map.value) {
        map.value = L.map("map").setView([startLat.value, startLng.value], 13);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
            map.value
        );
    } else {
        map.value.setView([startLat.value, startLng.value], 2);
    }

    if (!marker.value) {
        marker.value = L.marker([startLat.value, startLng.value], {
            icon: truckIcon,
        }).addTo(map.value);
    } else {
        marker.value.setLatLng([startLat.value, startLng.value]);
    }

    if (!secondMarker.value) {
        secondMarker.value = L.marker([endLat.value, endLng.value]).addTo(
            map.value
        );
    } else {
        secondMarker.value.setLatLng([endLat.value, endLng.value]);
    }

    if (routingControl.value) {
        map.value.removeControl(routingControl.value); // Remove previous route
    }

    routingControl.value = L.Routing.control({
        waypoints: [
            L.latLng(startLat.value, startLng.value), // User's current location
            L.latLng(endLat.value, endLng.value), // Destination
        ],
        createMarker: () => null, // Prevent extra markers
        routeWhileDragging: true, // Allow dragging waypoints
    })
        // .on("routesfound", function (e) {
        //     console.log(e);
        //     e.routes[0].coordinates.forEach(function (coord, index) {
        //         setTimeout(() => {
        //             if (marker.value) {
        //                 marker.value.setLatLng([coord.lat, coord.lng]);
        //             }
        //         }, 1000 * index);
        //     });
        // })
        .addTo(map.value);
};

const submit = () => {
    form.put(route("route.update", props.route.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Route updated successfully!",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error(errors); // Debug server errors if necessary
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "There were errors in your form submission.",
                life: 3000,
            });
        },
    });
};

const fullScreen = () => {
    const mapContainer = document.getElementById("map");
    if (mapContainer) {
        mapContainer.requestFullscreen();
    } else {
        console.error("Map container not found!");
    }
};

const driverNameSearch = () => {
    driverName.value = props.driver.map((driver) => ({
        id: driver.id,
        name: driver.fullname,
    }));
};

const onDriverSelect = (event) => {
    form.driver.id = event.value.id;
};

onMounted(() => {
    location();
});

watch(
    form,
    function (old, newForm) {
        form.start_date = form.start_date
            ? dayjs(newForm.start_date).format("YYYY-MM-DD")
            : "";
        form.end_date = form.end_date
            ? dayjs(newForm.end_date).format("YYYY-MM-DD")
            : "";
    },
    { deep: true }
);

const tripStatusSearch = () => {
    tripStatus.value = ["Yet to start", "Completed", "Ongoing", "Cancelled"];
};
</script>

<style scoped>
.grid-style {
    display: grid;
    grid-template-columns: 500px 1fr;
}
</style>
