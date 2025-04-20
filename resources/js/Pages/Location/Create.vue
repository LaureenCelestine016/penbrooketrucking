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
                    <div>
                        <label
                            class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                        >
                            Address Information
                        </label>

                        <!-- Address Input + Search -->
                        <div
                            class="flex flex-row items-center justify-center gap-6 mb-4"
                        >
                            <div class="w-full">
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
                                        @keyup.enter="searchAddress"
                                    />
                                    <Message
                                        v-if="form.errors.name"
                                        severity="error"
                                        size="small"
                                        variant="simple"
                                    >
                                        {{ form.errors.name }}
                                    </Message>
                                </FormField>
                            </div>
                            <Button
                                type="button"
                                class="w-[200px]"
                                @click="searchAddress"
                            >
                                Search Address
                            </Button>
                        </div>

                        <!-- Optional guidance -->
                        <p
                            v-if="!form.latitude || !form.longitude"
                            class="text-sm text-red-500 mb-2"
                        >
                            Please pick a location on the map or use Search
                            Address before submitting.
                        </p>

                        <!-- Map -->
                        <div
                            id="map"
                            style="width: 100%; height: 450px; background: #eee"
                        ></div>

                        <!-- Submit -->
                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-4"
                            :disabled="
                                !form.latitude ||
                                !form.longitude ||
                                !isMapClicked
                            "
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
import { debounce } from "lodash";

const toast = useToast();
const map = ref(null);
const marker = ref(null);
const isMapClicked = ref(false);

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

const searchAddress = debounce(async () => {
    if (!form.address) return;

    try {
        const response = await fetch(
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
                form.address
            )}`
        );
        const data = await response.json();

        if (data && data.length > 0) {
            const { lat, lon } = data[0];
            const latNum = parseFloat(lat);
            const lonNum = parseFloat(lon);

            form.latitude = latNum;
            form.longitude = lonNum;

            if (map.value) {
                map.value.setView([latNum, lonNum], 13);

                if (marker.value) {
                    map.value.removeLayer(marker.value);
                }

                marker.value = L.marker([latNum, lonNum]).addTo(map.value);
            }
        } else {
            alert("Address not found.");
        }
    } catch (error) {
        console.error("Error searching address:", error);
        alert("Failed to search address.");
    }
}, 500);

const location = async () => {
    await nextTick();

    const mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container not found!");
        return;
    }

    if (map.value) {
        map.value.remove();
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
                    const { lat, lng } = e.latlng;

                    form.latitude = lat;
                    form.longitude = lng;
                    isMapClicked.value = true; // ✅ Now allow submitting

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
