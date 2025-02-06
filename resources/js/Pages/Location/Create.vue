<template>
    <Head title="Add Location" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Location
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="">
                            <label
                                class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                >Address Information</label
                            >

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- region -->
                                <div class="w-full">
                                    <label
                                        for="region"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Region<span class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="region"
                                        name="region"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="status"
                                            class="w-full"
                                            v-model="form.region"
                                            :suggestions="regions"
                                            @complete="fetchRegions"
                                            dropdown
                                            placeholder="Region"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <!-- province -->
                                <div class="w-full">
                                    <label
                                        for="province"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Province
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="province"
                                        name="province"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="status"
                                            class="w-full"
                                            v-model="form.province"
                                            :suggestions="provinces"
                                            @complete="fetchProvinces"
                                            dropdown
                                            placeholder="Province"
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
                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- municipality -->
                                <div class="w-full">
                                    <label
                                        for="municipality"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Municipality</label
                                    >
                                    <FormField
                                        id="municipality"
                                        name="municipality"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="municipality"
                                            class="w-full"
                                            v-model="form.municipality"
                                            :suggestions="municipalities"
                                            @complete="fetchMunicipalities"
                                            dropdown
                                            placeholder="Municipality"
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
                                        for="municipality"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >City</label
                                    >
                                    <FormField
                                        id="municipality"
                                        name="municipality"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="municipality"
                                            class="w-full"
                                            v-model="form.city"
                                            :suggestions="cities"
                                            @complete="fetchCities"
                                            dropdown
                                            placeholder="City"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                                <!-- barangay -->
                            </div>

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- cities -->
                                <div class="w-100">
                                    <label
                                        for="barangay"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Barangay
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="barangay"
                                        name="barangay"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="barangay"
                                            class="w-full"
                                            v-model="form.barangay"
                                            :suggestions="barangays"
                                            @complete="fetchBarangays"
                                            dropdown
                                            placeholder="Barangay"
                                        />
                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>

                                <div class="w-100">
                                    <label
                                        for="street"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Street<span
                                            class="text-xs font-thin ml-1"
                                            >(Bldg.Blk.Lot#)</span
                                        >
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="barangay"
                                        name="barangay"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Street"
                                            v-model="form.street"
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
                                <label
                                    for="First_name"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Landmark<span class="ml-1 text-red-400"
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
                                        class="user--input firstName"
                                        placeholder="Landmark"
                                        v-model="form.name"
                                    />
                                    <Message
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{
                                    }}</Message>
                                </FormField>
                            </div>
                            <div class="flex items-center gap-2 mt-3">
                                <label
                                    class="text-gray-900 dark:text-surface-0 text-xl font-medium my-4 block"
                                    >Coordinates</label
                                >
                                <div
                                    class="flex flex-row items-center gap-1 cursor-pointer"
                                    @click="latitudeModal = true"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="#8c8c8c"
                                            d="M11 21.95v-1q-3.125-.35-5.363-2.587T3.05 13h-1q-.425 0-.712-.288T1.05 12t.288-.712T2.05 11h1q.35-3.125 2.588-5.363T11 3.05v-1q0-.425.288-.712T12 1.05t.713.288t.287.712v1q3.125.35 5.363 2.588T20.95 11h1q.425 0 .713.288t.287.712t-.287.713t-.713.287h-1q-.35 3.125-2.587 5.363T13 20.95v1q0 .425-.288.713T12 22.95t-.712-.287T11 21.95M12 19q2.9 0 4.95-2.05T19 12t-2.05-4.95T12 5T7.05 7.05T5 12t2.05 4.95T12 19m0-3q-1.65 0-2.825-1.175T8 12t1.175-2.825T12 8t2.825 1.175T16 12t-1.175 2.825T12 16"
                                        />
                                    </svg>
                                    <span
                                        class="text-xs text-red-400 hover:underline"
                                        >Get Coordinates here</span
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-10 mb-4">
                                <!-- latitude -->
                                <div class="w-full">
                                    <label
                                        for="street"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Latitude
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="barangay"
                                        name="barangay"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            type="text"
                                            placeholder="Latitude"
                                            v-model="form.latitude"
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

                                <!-- longitude -->
                                <div class="w-full">
                                    <label
                                        for="street"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Longitude
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="barangay"
                                        name="barangay"
                                        class="flex flex-col gap-1"
                                    >
                                        <span
                                            class="flex flex-row items-center relative"
                                        >
                                            <InputText
                                                type="text"
                                                placeholder="Longitude"
                                                v-model="form.longitude"
                                                class="w-full"
                                            />
                                        </span>

                                        <Message
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                        }}</Message>
                                    </FormField>
                                </div>
                            </div>

                            <Button
                                label="SUBMIT"
                                type="submit"
                                icon="pi pi-send"
                                class="w-full mt-4"
                            />
                        </div>
                    </form>

                    <!-- latitude modal -->
                    <Dialog
                        v-model:visible="latitudeModal"
                        maximizable
                        modal
                        header="Location"
                        :style="{ width: '70rem', height: '50rem' }"
                        :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
                    >
                        <div
                            id="map"
                            style="width: 100%; height: 600px; background: #eee"
                        ></div>
                    </Dialog>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, watch, onMounted, nextTick } from "vue";

import L from "leaflet";

import AutoComplete from "primevue/autocomplete";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

const toast = useToast();
const regions = ref([]);
const provinces = ref([]);
const municipalities = ref([]);
const cities = ref([]);
const barangays = ref([]);
const latitudeModal = ref(false);
const map = ref(null);
const marker = ref(null);

const form = useForm({
    region: "",
    province: "",
    city: "",
    municipality: "",
    barangay: "",
    street: "",
    name: "",
    latitude: "",
    longitude: "",
});

const submit = () => {
    form.post(route("location.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Location created successfully!",
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
        onFinish: () => form.reset("password"),
    });
};

// ✅ Fetch regions on component mount
const fetchRegions = async () => {
    try {
        const response = await fetch("https://psgc.cloud/api/regions");
        const data = await response.json();
        regions.value = data.map((region) => region.name);
    } catch (error) {
        console.error("Error fetching regions:", error);
    }
};

// ✅ Fetch provinces when user selects a region
const fetchProvinces = async () => {
    if (!form.region) return;
    try {
        const response = await fetch(
            `https://psgc.cloud/api/regions/${form.region}/provinces`
        );
        const data = await response.json();
        provinces.value = data.map((province) => province.name);
    } catch (error) {
        console.error("Error fetching provinces:", error);
    }
};

// ✅ Fetch municipalities when user selects a province
const fetchMunicipalities = async () => {
    if (!form.province) return;
    try {
        const response = await fetch(
            `https://psgc.cloud/api/provinces/${form.province}/municipalities`
        );
        const data = await response.json();
        municipalities.value = data.map((municipality) => municipality.name);
    } catch (error) {
        console.error("Error fetching municipalities:", error);
    }
};

const fetchCities = async () => {
    if (!form.province) return;
    try {
        const response = await fetch(
            `https://psgc.cloud/api/provinces/${form.province}/cities`
        );
        const data = await response.json();
        cities.value = data.map((city) => city.name);
    } catch (error) {
        console.error("Error fetching municipalities:", error);
    }
};

// ✅ Fetch barangays when user selects a municipality
const fetchBarangays = async () => {
    if (form.municipality) {
        try {
            const response = await fetch(
                `https://psgc.cloud/api/municipalities/${form.municipality}/barangays`
            );

            const data = await response.json();

            barangays.value = data.map((brgy) => brgy.name);
        } catch (error) {
            console.error("Error fetching barangays:", error);
        }
    }
    if (form.city) {
        try {
            const response = await fetch(
                `https://psgc.cloud/api/municipalities/${form.city}/barangays`
            );

            const data = await response.json();

            barangays.value = data.map((brgy) => brgy.name);
        } catch (error) {
            console.error("Error fetching barangays:", error);
        }
    } else {
        return;
    }
};

const location = async () => {
    await nextTick(); // Ensure DOM updates before initializing the map

    const mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container not found!"); // Debugging log
        return;
    }

    if (map.value) {
        map.value.remove(); // Prevent duplicate maps
        map.value = null;
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const { latitude, longitude } = position.coords;
                const coords = [latitude, longitude];

                console.log("Initializing map at:", coords); // Debugging log

                map.value = L.map("map").setView(coords, 13);

                L.tileLayer(
                    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                ).addTo(map.value);

                map.value.on("click", function (e) {
                    console.log(e.latlng);
                    const { lat, lng } = e.latlng;
                    form.latitude = lat;
                    form.longitude = lng;

                    if (marker.value) {
                        map.value.removeLayer(marker.value);
                    }

                    marker.value = L.marker([lat, lng]).addTo(map.value);
                });
            },
            () => {
                alert("Could not get your position");
            }
        );
    }
};

watch(latitudeModal, async (newValue) => {
    if (newValue) {
        await nextTick(); // Ensure DOM updates before initializing
        setTimeout(() => location(), 500); // Small delay for rendering
    }
});

onMounted(() => {
    fetchRegions();
});
</script>

<style scoped>
.lat-input {
    width: 100%;
    border-radius: none !important;
}
</style>
