<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-navyblue border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="mx-12">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <h2
                                    class="text-2xl font-bold tracking-widest text-white"
                                >
                                    Penbrooke Inc.
                                </h2>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div
                                class="ms-3 relative flex flex-row items-center gap-4"
                            >
                                <!-- <div class="relative">
                                    <Badge
                                        value="1"
                                        severity="info"
                                        size="small"
                                        class="absolute -top-1 -right-0"
                                    ></Badge>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="#ecebef"
                                            d="M5 18.77v-1h1.616V9.845q0-1.96 1.24-3.447T11 4.546V3h2v1.546q1.904.366 3.144 1.853t1.24 3.447v7.923H19v1zm6.997 2.615q-.668 0-1.14-.475t-.472-1.14h3.23q0 .67-.475 1.142q-.476.472-1.143.472M7.616 17.77h8.769V9.846q0-1.823-1.281-3.104T12 5.462t-3.104 1.28t-1.28 3.104z"
                                        />
                                    </svg>
                                </div> -->

                                <Dropdown
                                    align="right"
                                    width="48"
                                    class="dropdown"
                                >
                                    <template #trigger>
                                        <div
                                            class="flex flex-row gap-1 items-center justify-center"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="40"
                                                height="40"
                                                viewBox="0 0 24 24"
                                                class="cursor-pointer"
                                            >
                                                <path
                                                    fill="#b8bdf9"
                                                    d="M5.85 17.1q1.275-.975 2.85-1.537T12 15t3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4T6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5t1.013-2.488T12 6t2.488 1.013T15.5 9.5t-1.012 2.488T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"
                                                />
                                            </svg>
                                            <span
                                                class="inline-flex flex-col rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center border border-transparent text-base leading-4 font-sans text-white hover:text-blue-300 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{
                                                        $page.props.auth.user
                                                            .first_name
                                                    }}

                                                    {{
                                                        $page.props.auth.user
                                                            .last_name
                                                    }}
                                                </button>

                                                <span
                                                    v-if="
                                                        $page.props.auth.user
                                                            .user_type === 1
                                                    "
                                                    class="text-sm text-white cursor-pointer"
                                                    >Admin</span
                                                >
                                                <span
                                                    v-else
                                                    class="text-sm text-white cursor-pointer"
                                                    >Driver</span
                                                >
                                            </span>
                                        </div>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
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
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
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
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.first_name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
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
            </nav>
            <nav class="bg-white border-b border-gray-100 w-100">
                <!-- Primary Navigation Menu -->
                <div class="mx-12">
                    <div class="card w-100 font-semibold">
                        <Menubar :model="items" class="menubar" />
                    </div>
                </div>
            </nav>
            <!-- Page Heading -->
            <header v-if="$slots.header">
                <div class="mx-12 pt-5">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <footer class="footer flex items-center justify-center">
            <p class="text-gray-600">
                Copyright <span class="mx-1">&#169;</span> 2025 - Penbrooke Inc.
            </p>
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
