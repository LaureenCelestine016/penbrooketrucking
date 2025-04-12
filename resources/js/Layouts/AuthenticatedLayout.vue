<template>
    <div class="min-h-screen flex flex-col justify-between bg-gray-100">
        <!-- Top Navigation Bar -->
        <nav class="bg-navyblue border-b border-gray-100">
            <div class="mx-4 sm:mx-12">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <h2
                            class="text-2xl font-bold tracking-widest text-white"
                        >
                            Penbrooke Inc.
                        </h2>
                    </div>

                    <!-- Desktop Right Menu -->
                    <div class="hidden sm:flex items-center gap-4">
                        <Dropdown align="right" width="48" class="dropdown">
                            <template #trigger>
                                <div
                                    class="flex items-center gap-2 cursor-pointer"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="36"
                                        height="36"
                                        viewBox="0 0 24 24"
                                        class="text-white"
                                    >
                                        <path
                                            fill="#b8bdf9"
                                            d="M5.85 17.1q1.275-.975 2.85-1.537T12 15t3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4T6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5t1.013-2.488T12 6t2.488 1.013T15.5 9.5t-1.012 2.488T12 13"
                                        />
                                    </svg>
                                    <div class="text-white text-left">
                                        <div class="text-base font-medium">
                                            {{
                                                $page.props.auth.user.first_name
                                            }}
                                            {{
                                                $page.props.auth.user.last_name
                                            }}
                                        </div>
                                        <div class="text-sm">
                                            {{
                                                $page.props.auth.user
                                                    .user_type === 1
                                                    ? "Admin"
                                                    : "Driver"
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"
                                    >Profile</DropdownLink
                                >
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div
                    v-show="showingNavigationDropdown"
                    class="sm:hidden mt-2 space-y-1 pb-3"
                >
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Dashboard
                    </ResponsiveNavLink>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="px-4 text-gray-700">
                            <div class="font-medium text-base">
                                {{ $page.props.auth.user.first_name }}
                            </div>
                            <div class="text-sm">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"
                                >Profile</ResponsiveNavLink
                            >
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu Bar -->
        <nav class="bg-white border-b border-gray-200">
            <div class="mx-4 sm:mx-12">
                <div class="py-3">
                    <Menubar
                        :model="items"
                        class="w-full text-sm sm:text-base"
                    />
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header v-if="$slots.header">
            <div class="mx-4 sm:mx-12 pt-5">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow mx-4 sm:mx-12">
            <slot />
        </main>

        <!-- Footer -->
        <footer
            class="bg-white py-4 border-t text-center text-gray-600 text-sm"
        >
            &copy; 2025 - Penbrooke Inc.
        </footer>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Chat from "@/Pages/Chat.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { router, usePage } from "@inertiajs/vue3";
import Menubar from "primevue/menubar";
import Badge from "primevue/badge";
import Button from "primevue/button";
import Dialog from "primevue/dialog";

// Get the current authenticated user
const user = usePage().props.auth.user;
const isChatOpen = ref(false); // Controls the popup visibility
// Define menu items for Admin (user_type === 1)
const adminItems = ref([
    {
        label: "Operational Management",
        icon: "pi pi-cog",
        items: [
            {
                label: "Dashboard",
                icon: "pi pi-chart-line",
                command: () => {
                    router.get("/dashboard");
                },
            },
            {
                label: "Truck",
                icon: "pi pi-truck",
                items: [
                    {
                        label: "Tractor Head",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/vehicle");
                        },
                        items: [
                            {
                                label: "Add Tractor",
                                icon: "pi pi-plus",
                                command: () => {
                                    router.get("/vehicle/create");
                                },
                            },
                        ],
                    },
                    {
                        label: "Trailer",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/trailer");
                        },
                        items: [
                            {
                                label: "Add Trailer",
                                icon: "pi pi-plus",
                                command: () => {
                                    router.get("/trailer/create");
                                },
                            },
                        ],
                    },
                ],
            },

            {
                label: "Driver List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/driver");
                },
                items: [
                    {
                        label: "Add Driver",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/driver/create");
                        },
                    },
                ],
            },
        ],
    },

    {
        label: "Tracking and Routing",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Location",
                icon: "pi pi-list",
                command: () => {
                    router.get("/location");
                },
                items: [
                    {
                        label: "Add Location",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/location/create");
                        },
                    },
                ],
            },
            {
                label: "Route List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/route");
                },
                items: [
                    {
                        label: "Add Route",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/route/create");
                        },
                    },
                ],
            },
        ],
    },

    {
        label: "Maintenance and Fuel Management",
        icon: "pi pi-gauge",
        items: [
            {
                label: "Maintenance Record",
                icon: "pi pi-list",
                command: () => {
                    router.get("/maintenance");
                },
                items: [
                    {
                        label: "Add Maintenance",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/maintenance/create");
                        },
                    },
                ],
            },
            {
                label: "Fuel Record",
                icon: "pi pi-list",
                command: () => {
                    router.get("/fuel");
                },
                items: [
                    {
                        label: "Add Fuel",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/fuel/create");
                        },
                    },
                ],
            },
        ],
    },

    {
        label: "Fleet & Compliance",
        icon: "pi pi-book",
        items: [
            {
                label: "Truck Registration",
                icon: "pi pi-truck",
                command: () => {
                    router.get("/registration/create");
                },
            },
            {
                label: "Driver Compliance",
                icon: "pi pi-user",
                command: () => {
                    router.get("");
                },
            },
        ],
    },
    {
        label: "Financial Management",
        icon: "pi pi-money-bill",
        items: [
            {
                label: "Expenses",
                icon: "pi pi-list",
                command: () => {
                    router.get("/expenses");
                },
                items: [
                    {
                        label: "Add Expenses",
                        icon: "pi pi-plus",
                        command: () => {
                            router.get("/expenses/create");
                        },
                    },
                ],
            },
            {
                label: "Report",
                icon: "pi pi-book",

                items: [
                    {
                        label: "Route ",
                        icon: "pi pi-folder",
                        command: () => {
                            router.get("/reports/route");
                        },
                    },
                    {
                        label: "Fuel ",
                        icon: "pi pi-folder",
                        command: () => {
                            router.get("/reports/fuel");
                        },
                    },
                    {
                        label: "Maintenance ",
                        icon: "pi pi-folder",
                        command: () => {
                            router.get("/reports/maintenance");
                        },
                    },
                    {
                        label: "Expenses ",
                        icon: "pi pi-folder",
                        command: () => {
                            router.get("/reports/expenses");
                        },
                    },
                ],
            },
        ],
    },
]);

const driverItems = ref([
    {
        label: "Dashboard",
        icon: "pi pi-chart-line",
        command: () => router.get("/dashboard"),
    },
    {
        label: "My Routes",
        icon: "pi pi-car",
        command: () => router.get("/driver/routes"),
    },
    {
        label: "My Profile",
        icon: "pi pi-user",
        command: () => router.get("/driver/profile"),
    },
]);

const items = computed(() => {
    return user.user_type === 1 ? adminItems.value : driverItems.value;
});

const showingNavigationDropdown = ref(false);
</script>

<style scoped>
.menubar {
    height: 54px;
    border: 0;
    position: relative;
    z-index: 999; /* Higher than cover-picture */
}

.footer {
    height: 64px;
}

.dropdown {
    z-index: 9999;
}
</style>
