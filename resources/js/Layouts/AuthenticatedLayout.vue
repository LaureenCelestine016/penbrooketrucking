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
                        <!-- Notification Bell -->
                        <div>
                            <form @submit.prevent="generateKey">
                                <div
                                    v-if="$page.props.auth.user.user_type === 1"
                                    logi
                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-900 hover:bg-blue-700 rounded-full cursor-pointer"
                                    @click="generateKey"
                                >
                                    <i
                                        class="pi pi-key text-white text-2xl"
                                    ></i>
                                </div>
                            </form>
                        </div>

                        <!-- Message Icon -->
                        <div v-if="$page.props.auth.user.user_type === 1">
                            <div
                                @click="toggleChatSidebar"
                                class="relative cursor-pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="32"
                                    height="32"
                                    viewBox="0 0 24 24"
                                    style="color: whitesmoke"
                                >
                                    <!-- Icon from Mage Icons by MageIcons - https://github.com/Mage-Icons/mage-icons/blob/main/License.txt -->
                                    <g
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                    >
                                        <path
                                            d="M12.686 18.222q.603.117 1.218.123a7.3 7.3 0 0 0 2.992-.64l3.095.455a1.03 1.03 0 0 0 1.032-1.135l-.372-3.126a7.2 7.2 0 0 0 .599-2.9a7.304 7.304 0 0 0-7.336-7.284a7.295 7.295 0 0 0-7.109 5.654"
                                        />
                                        <path
                                            d="M13.904 14.745a5.66 5.66 0 0 1-1.218 3.477a5.61 5.61 0 0 1-4.375 2.063a5.7 5.7 0 0 1-2.29-.495l-2.311.413a.754.754 0 0 1-.826-.877l.32-2.363a5.5 5.5 0 0 1-.454-2.219A5.58 5.58 0 0 1 6.805 9.37a5.2 5.2 0 0 1 1.517-.217a5.59 5.59 0 0 1 5.582 5.593"
                                        />
                                    </g>
                                </svg>
                                <span
                                    v-if="totalUnread > 0"
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] leading-none px-1.5 py-0.5 rounded-full font-bold"
                                >
                                    {{ totalUnread }}
                                </span>
                            </div>

                            <!-- Chat Sidebar -->
                            <div
                                v-if="showChatSidebar"
                                class="fixed right-0 top-20 h-[calc(100vh-5rem)] w-80 bg-white shadow-xl z-50 p-4 overflow-y-auto border-l border-gray-200 sidebar"
                            >
                                <!-- Header -->
                                <div
                                    class="flex justify-between items-center mb-4"
                                >
                                    <h2 class="text-xl font-bold text-gray-800">
                                        Chat
                                    </h2>
                                    <button
                                        @click="toggleChatSidebar"
                                        class="text-gray-400 hover:text-red-500 text-2xl"
                                    >
                                        ✖
                                    </button>
                                </div>

                                <!-- Chat User List -->
                                <ul class="space-y-2">
                                    <li
                                        v-for="driver in chatDriver"
                                        :key="driver.id"
                                        @click="openChat(driver)"
                                        class="flex items-center gap-3 py-2 px-3 hover:bg-blue-50 rounded-lg cursor-pointer transition duration-150"
                                    >
                                        <!-- Profile Picture or Initials -->
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-gray-600 font-semibold text-sm"
                                        >
                                            <img
                                                v-if="driver.avatar"
                                                :src="driver.avatar"
                                                alt="avatar"
                                                class="w-full h-full object-cover"
                                            />
                                            <span v-else>
                                                {{
                                                    getInitials(
                                                        driver.first_name,
                                                        driver.last_name
                                                    )
                                                }}
                                            </span>
                                        </div>

                                        <!-- Name -->
                                        <div class="flex-1">
                                            <p
                                                class="text-sm font-medium text-gray-800"
                                            >
                                                {{ driver.first_name }}
                                                {{ driver.last_name }}
                                            </p>
                                        </div>

                                        <!-- Chat Icon -->
                                        <span class="relative">
                                            💬
                                            <span
                                                v-if="
                                                    unreadDrivers[driver.id] > 0
                                                "
                                                class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full border border-white"
                                            ></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Popup Chat Boxes -->
                            <div
                                v-for="(chat, index) in activeChats"
                                :key="chat.id"
                                class="fixed bottom-4 w-80 bg-white shadow-xl rounded-lg border border-gray-300 z-50 overflow-hidden"
                                :style="{ right: `${1 + index * 21}rem` }"
                            >
                                <!-- Header -->
                                <div
                                    class="bg-navyblue text-white px-4 py-2 flex justify-between items-center"
                                    @click="markAsRead(chat)"
                                >
                                    <span class="font-semibold text-sm">
                                        {{ chat.first_name }}
                                        {{ chat.last_name }}
                                    </span>
                                    <button
                                        @click="closeChat(chat)"
                                        class="text-white hover:text-gray-200"
                                    >
                                        ✖
                                    </button>
                                </div>

                                <!-- Message Area -->

                                <div
                                    class="p-3 text-sm text-gray-600 h-64 overflow-y-auto"
                                >
                                    <div
                                        v-for="(msg, idx) in chat.messages"
                                        :key="idx"
                                        class="mb-2"
                                    >
                                        <div
                                            :class="[
                                                'px-3 py-2 rounded w-fit',
                                                msg.from === 'me'
                                                    ? 'ml-auto bg-blue-500 text-white'
                                                    : 'bg-gray-200 text-black',
                                            ]"
                                        >
                                            {{ msg.text }}
                                        </div>
                                        <div
                                            class="text-xs text-gray-400 mt-1"
                                            :class="{
                                                'text-right': msg.from === 'me',
                                            }"
                                        >
                                            {{ msg.time }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Input & Send -->
                                <div class="px-3 py-2 border-t">
                                    <div class="flex items-center space-x-2">
                                        <input
                                            v-model="chat.message"
                                            @focus="focusChat(chat)"
                                            type="text"
                                            class="flex-1 text-sm px-3 py-2 border rounded focus:outline-none focus:ring"
                                            placeholder="Type a message..."
                                            @keyup.enter="sendMessage(chat)"
                                        />
                                        <button
                                            @click="sendMessage(chat)"
                                            class="bg-navyblue text-white px-3 py-2 text-sm rounded hover:bg-blue-900 transition"
                                        >
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <!-- Header Icon (toggle chat) -->
                            <div
                                @click="toggleChatBox"
                                class="relative cursor-pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="32"
                                    height="32"
                                    viewBox="0 0 24 24"
                                    style="color: whitesmoke"
                                >
                                    <g
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                    >
                                        <path
                                            d="M12.686 18.222q.603.117 1.218.123a7.3 7.3 0 0 0 2.992-.64l3.095.455a1.03 1.03 0 0 0 1.032-1.135l-.372-3.126a7.2 7.2 0 0 0 .599-2.9a7.304 7.304 0 0 0-7.336-7.284a7.295 7.295 0 0 0-7.109 5.654"
                                        />
                                        <path
                                            d="M13.904 14.745a5.66 5.66 0 0 1-1.218 3.477a5.61 5.61 0 0 1-4.375 2.063a5.7 5.7 0 0 1-2.29-.495l-2.311.413a.754.754 0 0 1-.826-.877l.32-2.363a5.5 5.5 0 0 1-.454-2.219A5.58 5.58 0 0 1 6.805 9.37a5.2 5.2 0 0 1 1.517-.217a5.59 5.59 0 0 1 5.582 5.593"
                                        />
                                    </g>
                                </svg>
                                <span
                                    v-if="unreadAdmin"
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] leading-none px-1.5 py-0.5 rounded-full font-bold"
                                >
                                    ●
                                </span>
                            </div>
                            <!-- Driver Chat Box -->
                            <div
                                v-if="showChat"
                                class="fixed bottom-4 right-4 w-80 bg-white shadow-xl rounded-lg border border-gray-300 z-50 overflow-hidden"
                            >
                                <!-- Header -->
                                <div
                                    class="bg-navyblue text-white px-4 py-2 flex justify-between items-center"
                                >
                                    <span class="font-semibold text-sm"
                                        >Chat with Admin</span
                                    >
                                    <button
                                        @click="toggleChatBox"
                                        class="text-white hover:text-gray-300 text-lg"
                                    >
                                        ✖
                                    </button>
                                </div>

                                <!-- Messages -->
                                <div
                                    class="p-3 text-sm text-gray-600 h-64 overflow-y-auto"
                                    ref="messagesContainer"
                                >
                                    <div
                                        v-for="(msg, index) in messages"
                                        :key="index"
                                        class="mb-2"
                                    >
                                        <div
                                            :class="[
                                                'px-3 py-2 rounded w-fit',
                                                msg.from === 'me'
                                                    ? 'ml-auto bg-blue-500 text-white'
                                                    : 'bg-gray-200 text-black',
                                            ]"
                                        >
                                            {{ msg.text }}
                                        </div>
                                        <div
                                            class="text-xs text-gray-400 mt-1"
                                            :class="{
                                                'text-right': msg.from === 'me',
                                            }"
                                        >
                                            {{ msg.time }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Input -->
                                <div class="px-3 py-2 border-t">
                                    <div class="flex items-center space-x-2">
                                        <input
                                            v-model="message"
                                            type="text"
                                            class="flex-1 text-sm px-3 py-2 border rounded focus:outline-none focus:ring"
                                            placeholder="Type a message..."
                                            @keyup.enter="sendMessage"
                                        />
                                        <button
                                            @click="sendMessage"
                                            class="bg-navyblue text-white px-3 py-2 text-sm rounded hover:bg-blue-900 transition"
                                        >
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                <!-- <DropdownLink :href="route('profile.edit')"
                                    >Profile</DropdownLink
                                > -->
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
        <Dialog
            v-model:visible="visible"
            modal
            header="Generated Key"
            :style="{ width: '25rem' }"
        >
            <div class="flex items-center gap-2 mb-4">
                <InputText
                    id="generatedKey"
                    v-model="generatedKey"
                    class="flex-auto"
                    readonly
                />
                <Button
                    icon="pi pi-copy"
                    class="p-button-secondary"
                    @click="copyToClipboard"
                    v-tooltip="'Copy to clipboard'"
                />
            </div>
        </Dialog>

        <!-- Menu Bar -->
        <nav class="bg-white border-b border-gray-200">
            <div class="mx-4 sm:mx-6">
                <div class="py-3">
                    <Menubar
                        :model="items"
                        class="menubar w-full text-xs md:text-sm lg:text-base"
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
import { computed, onMounted, ref, nextTick, onBeforeUnmount } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Chat from "@/Pages/Chat.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { router, usePage } from "@inertiajs/vue3";
import Menubar from "primevue/menubar";
import Badge from "primevue/badge";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import InputText from "primevue/inputtext";
import { useToast } from "primevue/usetoast";

// Get the current authenticated user
const user = usePage().props.auth.user;
const currentUserId = user.id;

window.Pusher = Pusher;

let pollingInterval = null;

const { chatDriver } = usePage().props;
const { adminId } = usePage().props;
const showChatSidebar = ref(false);
const activeChats = ref([]);
const showChat = ref(false);
const messages = ref([]);
const message = ref("");
const messagesContainer = ref(null);
const unreadDrivers = ref({});
const loading = ref(false);
const unreadAdmin = ref(false); // for drivers
const visible = ref(false);
const generatedKey = ref(""); // Assign this value when key is generated
const toast = useToast();

const totalUnread = computed(() => {
    return Object.values(unreadDrivers.value).reduce(
        (sum, val) => sum + val,
        0
    );
});

// nav bar
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
            // {
            //     label: "Driver Compliance",
            //     icon: "pi pi-user",
            //     command: () => {
            //         router.get("");
            //     },
            // },
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
                // items: [
                //     {
                //         label: "Add Expenses",
                //         icon: "pi pi-plus",
                //         command: () => {
                //             router.get("/expenses/create");
                //         },
                //     },
                // ],
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

const toggleChatSidebar = () => {
    if (user.user_type === 1) {
        showChatSidebar.value = !showChatSidebar.value;
    }
};

const toggleChatBox = () => {
    if (user.user_type !== 1) {
        showChat.value = !showChat.value;
        if (showChat.value) {
            fetchMessages();
        }
    }
};

const openChat = (driver) => {
    let existingChat = activeChats.value.find((c) => c.id === driver.id);

    if (!existingChat) {
        existingChat = {
            ...driver,
            messages: [],
            message: "",
            unreadCount: 0,
            unread: false,
            focused: true,
        };
        activeChats.value.push(existingChat);
    } else {
        existingChat.focused = true;
        existingChat.unread = false;
        existingChat.unreadCount = 0;
    }

    unreadDrivers.value[driver.id] = 0; // store count instead of true/false

    fetchMessages(driver.id);
    showChatSidebar.value = false;
};

const closeChat = (chat) => {
    const index = activeChats.value.findIndex((c) => c.id === chat.id);
    if (index !== -1) {
        activeChats.value.splice(index, 1); // Remove the chat box
    }
};

const getInitials = (firstName, lastName) => {
    return `${firstName?.[0] || ""}${lastName?.[0] || ""}`.toUpperCase();
};

const sendMessage = async (chat = null) => {
    const isAdmin = user.user_type === 1;
    let targetId = isAdmin ? chat?.id : adminId;
    let msgText = isAdmin ? chat?.message : message.value;

    if (!msgText?.trim()) return;

    try {
        // Send message to backend
        await axios.post("/chat/send", {
            receiver_id: targetId,
            message: msgText,
        });

        // Update frontend chat for admin or driver
        if (isAdmin) {
            chat.messages.push({
                from: "me",
                text: msgText,
                time: new Date().toLocaleTimeString(),
            });
            chat.message = ""; // Clear input for admin
            scrollToBottom(chat); // Optional: Scroll to the bottom for admin chat
        } else {
            messages.value.push({
                from: "me",
                text: msgText,
                time: new Date().toLocaleTimeString(),
            });
            message.value = ""; // Clear input for driver
            scrollToBottom(); // Scroll to the bottom for driver chat
        }
    } catch (error) {
        console.error("Send failed:", error);
    }
};

const fetchMessages = async (id = null, preventScroll = false) => {
    const isAdmin = user.user_type === 1;
    const targetId = isAdmin ? id || activeChats.value[0]?.id : adminId;

    try {
        const res = await axios.get(`/chat/messages/${targetId}`);
        const msgs = res.data.map((msg) => ({
            from: msg.sender_id === currentUserId ? "me" : "them",
            text: msg.message,
            time: new Date(msg.created_at).toLocaleTimeString(),
        }));

        if (isAdmin) {
            const chat = activeChats.value.find((c) => c.id === targetId);

            if (chat) {
                const isNew =
                    JSON.stringify(chat.messages) !== JSON.stringify(msgs);

                if (isNew) {
                    if (!chat.focused) {
                        chat.unread = true;
                        chat.unreadCount =
                            (chat.unreadCount || 0) +
                            (msgs.length - chat.messages.length);
                    }

                    chat.messages = msgs;

                    if (!preventScroll) scrollToBottom(chat);
                }
            }
        } else {
            const isNew =
                JSON.stringify(messages.value) !== JSON.stringify(msgs);

            if (isNew) {
                // 👇 Add this check to show badge only when chat is closed
                if (!showChat.value) {
                    unreadAdmin.value = true;
                }

                messages.value = msgs;
            }

            if (!preventScroll) scrollToBottom();
        }
    } catch (error) {
        console.error("Error fetching messages:", error);
    }
};

const fetchUnreadCounts = async () => {
    if (user.user_type === 1) {
        try {
            loading.value = true;
            const response = await axios.get("/chat/unread-counts");
            unreadDrivers.value = response.data.counts; // access counts directly

            // Apply counts only to chats that are NOT focused
            activeChats.value.forEach((chat) => {
                if (!chat.focused) {
                    chat.unreadCount = unreadDrivers.value[chat.id] || 0;
                } else {
                    chat.unreadCount = 0; // reset if chat is open
                }
            });

            // Wait for DOM updates to apply
            await nextTick();
        } catch (error) {
            console.error("Failed to fetch unread counts", error);
        } finally {
            loading.value = false;
        }
    }
};

const fetchUnreadFromAdmin = async () => {
    if (user.user_type !== 1) {
        try {
            const res = await axios.get("/chat/unread-counts");
            const count = res.data.from_admin || 0;

            if (!showChat.value && count > 0) {
                unreadAdmin.value = true;
            } else {
                unreadAdmin.value = false;
            }
        } catch (error) {
            console.error("Failed to fetch driver's unread messages", error);
        }
    }
};

onMounted(() => {
    setInterval(() => {
        fetchUnreadCounts();
    }, 5000); // every 5 seconds
});

const scrollToBottom = (chat = null) => {
    nextTick(() => {
        if (chat) {
            const containers = document.querySelectorAll(".chat-box");
            const element =
                containers[
                    activeChats.value.findIndex((c) => c.id === chat.id)
                ];
            if (element) {
                const innerBox = element.querySelector(".messages-container"); // make sure this class exists
                if (innerBox) {
                    innerBox.scrollTop = innerBox.scrollHeight;
                }
            }
        } else if (messagesContainer.value) {
            messagesContainer.value.scrollTop =
                messagesContainer.value.scrollHeight;
        }
    });
};

onMounted(() => {
    setTimeout(() => {
        fetchUnreadCounts(); // Admin unread counts
    }, 500); // 0.5s delay for fetching admin unread counts

    setTimeout(() => {
        fetchUnreadFromAdmin(); // Driver unread count from admin
    }, 500); // Ensure the driver gets updated too

    startPolling();

    window.Echo = new Echo({
        broadcaster: "pusher",
        key: "1a215997760520209b35",
        cluster: "ap1",
        forceTLS: true,
        encrypted: false,
        authEndpoint: "/broadcasting/auth",
        auth: {
            headers: {
                "X-CSRF-TOKEN": document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        },
    });

    window.Echo.private(`chat.${currentUserId}`).listen("MessageSent", (e) => {
        console.log("New message received:", e);
        if (user.user_type === 1) {
            // Admin
            const chat = activeChats.value.find((c) => c.id === e.sender.id);
            if (chat) {
                chat.messages.push({
                    from: "them",
                    text: e.message.message,
                    time: new Date(e.message.created_at).toLocaleTimeString(),
                });
                // Increment unread count for admin chat
                if (!chat.focused) {
                    chat.unreadCount = (chat.unreadCount || 0) + 1;
                }
                scrollToBottom(chat);
            }
        } else {
            // Driver
            if (e.sender.id === adminId) {
                messages.value.push({
                    from: "them",
                    text: e.message.message,
                    time: new Date(e.message.created_at).toLocaleTimeString(),
                });
                // Increment unread count for driver if chat is not focused
                if (!document.hasFocus()) {
                    unreadAdmin.value = true; // Trigger badge or notification for unread messages
                }
                scrollToBottom();
            }
        }
    });
});

const markAsRead = async (chat) => {
    chat.unread = false;
    chat.focused = true;
    unreadDrivers.value[chat.id] = 0;

    try {
        await axios.post(`/chat/mark-as-read`, { sender_id: chat.id });
    } catch (e) {
        console.error("Failed to mark as read", e);
    }
};

const startPolling = () => {
    pollingInterval = setInterval(() => {
        activeChats.value.forEach((chat) => {
            if (!chat.focused) {
                fetchUnreadCounts();
                fetchMessages(chat.id, true); // Prevent auto-scroll
            }
        });
    }, 5000);
};

const stopPolling = () => {
    if (pollingInterval) {
        clearInterval(pollingInterval);
        pollingInterval = null;
    }
};

const focusChat = (chat) => {
    chat.focused = true;
    chat.unread = false;
    chat.unreadCount = 0; // Clear count
    unreadDrivers.value[chat.id] = 0;

    // Optionally mark messages as read on server
    markAsRead(chat);
};

onBeforeUnmount(() => {
    stopPolling();
});

const generateKey = async () => {
    try {
        const response = await axios.post("/admin/generate-key");
        generatedKey.value = response.data.key;
        visible.value = true;
    } catch (error) {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Failed to generate key",
            life: 2000,
        });
    }
};

const copyToClipboard = () => {
    navigator.clipboard.writeText(generatedKey.value).then(() => {
        toast.add({
            severity: "success",
            summary: "Copied!",
            detail: "Key copied to clipboard",
            life: 2000,
        });
    });
};
</script>

<style scoped>
.menubar {
    height: auto;
    position: relative;
    z-index: 999;
}

.footer {
    height: 64px;
}

.dropdown {
    z-index: 9999;
}

.sidebar {
    z-index: 9999;
    scroll-behavior: smooth;
}
</style>
