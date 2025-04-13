<template>
    <Head title="Add Location" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Location
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit" class="p-6">
                    <div class="">
                        <label
                            class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                            >Address Information</label
                        >
                        <!---


                            -->
                        <!-- <div class="grid grid-cols-2 gap-10 mb-4">
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
                                            id="region"
                                            class="w-full"
                                            v-model="form.region"
                                            :suggestions="regions"
                                            @complete="fetchRegions"
                                            dropdown
                                            placeholder="Region"
                                        />
                                        <Message
                                            v-if="form.errors.region"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.region }}</Message
                                        >
                                    </FormField>
                                </div>

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
                                            id="province"
                                            class="w-full"
                                            v-model="form.province"
                                            :suggestions="provinces"
                                            @complete="fetchProvinces"
                                            dropdown
                                            placeholder="Province"
                                        />
                                        <Message
                                            v-if="form.errors.province"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.province }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-4">

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
                                        ></Message>
                                    </FormField>
                                </div>

                                <div class="w-full">
                                    <label
                                        for="city"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >City</label
                                    >
                                    <FormField
                                        id="city"
                                        name="city"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="city"
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
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-4">

                                <div class="w-full">
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
                                            v-if="form.errors.barangay"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.barangay }}</Message
                                        >
                                    </FormField>
                                </div>

                                <div class="w-full">
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
                                        id="street"
                                        name="street"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="street"
                                            type="text"
                                            placeholder="Street"
                                            v-model="form.street"
                                        />
                                        <Message
                                            v-if="form.errors.street"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.street }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div> -->

                        <!-- landmark -->
                        <div>
                            <div class="w-full mb-5">
                                <label
                                    for="landmark"
                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                    >Address<span class="ml-1 text-red-400"
                                        >*</span
                                    ></label
                                >
                                <FormField
                                    id="landmark"
                                    name="landmark"
                                    class="flex flex-col gap-1"
                                >
                                    <InputText
                                        id="landmark"
                                        type="text"
                                        class="user--input firstName"
                                        placeholder="Address"
                                        v-model="form.address"
                                    />
                                    <Message
                                        v-if="form.errors.name"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                        >{{ form.errors.name }}</Message
                                    >
                                </FormField>
                            </div>
                        </div>
                        <!-- <div class="flex items-center gap-2 mt-3">
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
                            </div> -->
                        <!-- <div class="grid grid-cols-2 gap-10 mb-4">
                                <div class="w-full">
                                    <label
                                        for="latitude"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Latitude
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="latitude"
                                        name="latitude"
                                        class="flex flex-col gap-1"
                                    >
                                        <InputText
                                            id="latitude"
                                            type="text"
                                            placeholder="Latitude"
                                            v-model="form.latitude"
                                            class="w-full"
                                        />

                                        <Message
                                            v-if="form.errors.latitude"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{ form.errors.latitude }}</Message
                                        >
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="longitude"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Longitude
                                        <span class="ml-1 text-red-400">*</span>
                                    </label>
                                    <FormField
                                        id="longitude"
                                        name="longitude"
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
                                            v-if="form.errors.longitude"
                                            severity="error"
                                            size="small"
                                            variant="simple"
                                            >{{
                                                form.errors.longitude
                                            }}</Message
                                        >
                                    </FormField>
                                </div>
                            </div> -->

                        <div
                            id="map"
                            style="width: 100%; height: 450px; background: #eee"
                        ></div>
                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-4"
                        />
                    </div>
                </form>
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
import Message from "primevue/message";

const toast = useToast();
const map = ref(null);
const marker = ref(null);

const form = useForm({
    latitude: "",
    longitude: "",
    address: "",
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
// const fetchRegions = async () => {
//     try {
//         const response = await fetch("https://psgc.cloud/api/regions");
//         const data = await response.json();
//         regions.value = data.map((region) => region.name);
//     } catch (error) {
//         console.error("Error fetching regions:", error);
//     }
// };

// // ✅ Fetch provinces when user selects a region
// const fetchProvinces = async () => {
//     if (!form.region) return;
//     try {
//         const response = await fetch(
//             `https://psgc.cloud/api/regions/${form.region}/provinces`
//         );
//         const data = await response.json();
//         provinces.value = data.map((province) => province.name);
//     } catch (error) {
//         console.error("Error fetching provinces:", error);
//     }
// };

// // ✅ Fetch municipalities when user selects a province
// const fetchMunicipalities = async () => {
//     if (!form.province) return;
//     try {
//         const response = await fetch(
//             `https://psgc.cloud/api/provinces/${form.province}/municipalities`
//         );
//         const data = await response.json();
//         municipalities.value = data.map((municipality) => municipality.name);
//     } catch (error) {
//         console.error("Error fetching municipalities:", error);
//     }
// };

// const fetchCities = async () => {
//     if (!form.province) return;
//     try {
//         const response = await fetch(
//             `https://psgc.cloud/api/provinces/${form.province}/cities`
//         );
//         const data = await response.json();
//         cities.value = data.map((city) => city.name);
//     } catch (error) {
//         console.error("Error fetching municipalities:", error);
//     }
// };

// // ✅ Fetch barangays when user selects a municipality
// const fetchBarangays = async () => {
//     if (form.municipality) {
//         try {
//             const response = await fetch(
//                 `https://psgc.cloud/api/municipalities/${form.municipality}/barangays`
//             );

//             const data = await response.json();

//             barangays.value = data.map((brgy) => brgy.name);
//         } catch (error) {
//             console.error("Error fetching barangays:", error);
//         }
//     }
//     if (form.city) {
//         try {
//             const response = await fetch(
//                 `https://psgc.cloud/api/municipalities/${form.city}/barangays`
//             );

//             const data = await response.json();

//             barangays.value = data.map((brgy) => brgy.name);
//         } catch (error) {
//             console.error("Error fetching barangays:", error);
//         }
//     } else {
//         return;
//     }
// };

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

                map.value = L.map("map").setView(coords, 13);

                L.tileLayer(
                    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                ).addTo(map.value);

                map.value.on("click", async (e) => {
                    // ✅ Make this function async

                    const { lat, lng } = e.latlng;
                    form.latitude = lat;
                    form.longitude = lng;

                    if (marker.value) {
                        map.value.removeLayer(marker.value);
                    }

                    marker.value = L.marker([lat, lng]).addTo(map.value);

                    try {
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
                        );
                        const data = await response.json();

                        if (data && data.display_name) {
                            form.address = data.display_name;
                        } else {
                            alert("Address not found.");
                        }
                    } catch (error) {
                        console.error("Error fetching address:", error);
                        alert("Failed to get address.");
                    }
                });
            },
            () => {
                alert("Could not get your position");
            }
        );
    }
};

onMounted(() => {
    location();
});
</script>

<style scoped>
.lat-input {
    width: 100%;
    border-radius: none !important;
}
</style>
