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
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
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
                                                    class="text-sm text- cursor-pointer"
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
                    <div class="card w-100 sm:text-sm font-semibold">
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
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import Icon from "@/Components/Icon.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { Link, router } from "@inertiajs/vue3";

import Menubar from "primevue/menubar";

const items = ref([
    {
        label: "Dashboard",
        icon: "pi pi-chart-line",
    },
    {
        label: "Vehicle",
        icon: "pi pi-truck",
        items: [
            {
                label: "Vehicle List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/vehicle");
                },
            },
            {
                label: "Add Vehicle",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/vehicle/create");
                },
            },
        ],
    },
    {
        label: "Driver",
        icon: "pi pi-users",
        items: [
            {
                label: "Driver List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/driver");
                },
            },
            {
                label: "Add Driver",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/driver/create");
                },
            },
        ],
    },
    {
        label: "Location",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Location List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/location");
                },
            },
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
        label: "Route",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Route List",
                icon: "pi pi-list",
                command: () => {
                    router.get("/route");
                },
            },
            {
                label: "Add Route",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/route/create");
                },
            },
        ],
    },
    {
        label: "Fuel",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Fuel Record",
                icon: "pi pi-list",
                command: () => {
                    router.get("/location");
                },
            },
            {
                label: "Add Fuel",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/location/create");
                },
            },
        ],
    },
    {
        label: "Maintenance",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Vehicle Maintenance Record",
                icon: "pi pi-list",
                command: () => {
                    router.get("/location");
                },
            },
            {
                label: "Add Vehicle Maintenance",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/location/create");
                },
            },
        ],
    },
    {
        label: "Sale & Expenses",
        icon: "pi pi-map-marker",
        items: [
            {
                label: "Sale",
                icon: "pi pi-list",
                command: () => {
                    router.get("/location");
                },
                items: [
                    {
                        label: "Sale Record",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/location");
                        },
                        items: [],
                    },
                    {
                        label: "Add Sale",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/location");
                        },
                        items: [],
                    },
                ],
            },
            {
                label: "Expenses",
                icon: "pi pi-plus",
                command: () => {
                    router.get("/location/create");
                },
                items: [
                    {
                        label: "Sale Record",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/location");
                        },
                        items: [],
                    },
                    {
                        label: "Add Sale",
                        icon: "pi pi-list",
                        command: () => {
                            router.get("/location");
                        },
                        items: [],
                    },
                ],
            },
        ],
    },
    {
        label: "Report",
        icon: "pi pi-book",
    },
]);

const showingNavigationDropdown = ref(false);
</script>

<style scoped>
.menubar {
    height: 54px;
    border: 0;
}

.footer {
    height: 64px;
}
</style>
