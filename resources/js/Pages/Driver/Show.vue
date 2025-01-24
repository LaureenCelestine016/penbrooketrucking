<template>
    <Head title="Show" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{}}
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-12">
                <Card class="custom-card">
                    <template #header>
                        <Avatar
                            image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png"
                            class="profile-avatar"
                            size="xlarge"
                            shape="circle"
                        />
                        <h4
                            class="absolute left-52 top-14 text-4xl font-black tracking-wider"
                        >
                            {{ toUpperCase(Driver.first_name) }}
                            {{ toUpperCase(Driver.middle_name) }}
                            {{ toUpperCase(Driver.last_name) }}
                        </h4>
                        <span
                            class="text-xl font-medium tracking-widest absolute left-52 top-24 ml-1"
                            >Driver</span
                        >
                    </template>
                    <template #content>
                        <div class="grid-container">
                            <Card class="profile">
                                <template #content>
                                    <label
                                        class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                        >Account Details</label
                                    >
                                    <div class="flex flex-row gap-4">
                                        <label for="" class="font-semibold mr-5"
                                            >Username:</label
                                        >
                                        <span>{{ User.username }}</span>
                                    </div>
                                </template>
                            </Card>
                            <Card class="col-span-2 custom-account">
                                <template #content>
                                    <Tabs value="0">
                                        <TabList>
                                            <Tab
                                                value="0"
                                                as="div"
                                                class="flex items-center gap-2"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="32"
                                                    height="32"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        fill="#8c8c8c"
                                                        d="M9 20H5q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v14q0 .825-.587 1.413T19 20h-4l-2.3 2.3q-.15.15-.325.213t-.375.062t-.375-.062t-.325-.213zm3-8q1.45 0 2.475-1.025T15.5 8.5t-1.025-2.475T12 5T9.525 6.025T8.5 8.5t1.025 2.475T12 12m-7 6h14v-1.15q-1.35-1.325-3.137-2.087T12 14t-3.863.763T5 16.85z"
                                                    />
                                                </svg>
                                                <span
                                                    class="font-bold whitespace-nowrap"
                                                    >Personal Information</span
                                                >
                                            </Tab>
                                            <Tab
                                                value="1"
                                                as="div"
                                                class="flex items-center gap-2"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="32"
                                                    height="32"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        fill="#8c8c8c"
                                                        d="M12 13q-1.25 0-2.125-.875T9 10t.875-2.125T12 7t2.125.875T15 10t-.875 2.125T12 13m0 8l-4.675 1.55q-.5.175-.913-.125t-.412-.8v-6.35q-.95-1.05-1.475-2.4T4 10q0-3.35 2.325-5.675T12 2t5.675 2.325T20 10q0 1.525-.525 2.875T18 15.275v6.35q0 .5-.413.8t-.912.125zm0-5q2.5 0 4.25-1.75T18 10t-1.75-4.25T12 4T7.75 5.75T6 10t1.75 4.25T12 16"
                                                    />
                                                </svg>
                                                <span
                                                    class="font-bold whitespace-nowrap"
                                                    >License Information</span
                                                >
                                            </Tab>
                                            <Tab
                                                v-slot="slotProps"
                                                value="2"
                                                asChild
                                            >
                                                <div
                                                    :class="[
                                                        'flex items-center gap-2',
                                                        slotProps.class,
                                                    ]"
                                                    @click="slotProps.onClick"
                                                    v-bind="slotProps.a11yAttrs"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="32"
                                                        height="32"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            fill="#8c8c8c"
                                                            d="M1.75 13.325q-.425 0-.712-.287t-.288-.713t.288-.712t.712-.288h3.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zM7 20q-1.25 0-2.125-.875T4 17H2.75q-.5 0-.8-.375t-.175-.85l.225-.95h3.125q1.05 0 1.775-.725t.725-1.775q0-.325-.075-.6t-.2-.55h.95q1.05 0 1.775-.725t.725-1.775t-.725-1.775T8.3 6.175H4.5l.15-.6q.15-.7.688-1.137T6.6 4h10.15q.5 0 .8.375t.175.85L17.075 8H19q.475 0 .9.213t.7.587l1.875 2.475q.275.35.35.763t0 .837L22.15 16.2q-.075.35-.35.575t-.625.225H20q0 1.25-.875 2.125T17 20t-2.125-.875T14 17h-4q0 1.25-.875 2.125T7 20M3.75 9.675q-.425 0-.712-.288t-.288-.712t.288-.712t.712-.288h4.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zM7 18q.425 0 .713-.288T8 17t-.288-.712T7 16t-.712.288T6 17t.288.713T7 18m10 0q.425 0 .713-.288T18 17t-.288-.712T17 16t-.712.288T16 17t.288.713T17 18m-1.075-5h4.825l.1-.525L19 10h-2.375z"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="font-bold whitespace-nowrap"
                                                        >Truck Used</span
                                                    >
                                                    <Badge value="2" />
                                                </div>
                                            </Tab>
                                        </TabList>
                                        <TabPanels>
                                            <TabPanel
                                                value="0"
                                                as="p"
                                                class="m-0"
                                            >
                                                Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit, sed
                                                do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                                Ut enim ad minim veniam, quis
                                                nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea
                                                commodo consequat. Duis aute
                                                irure dolor in reprehenderit in
                                                voluptate velit esse cillum
                                                dolore eu fugiat nulla pariatur.
                                                Excepteur sint occaecat
                                                cupidatat non proident, sunt in
                                                culpa qui officia deserunt
                                                mollit anim id est laborum.
                                            </TabPanel>
                                            <TabPanel
                                                value="1"
                                                as="p"
                                                class="m-0"
                                            >
                                                Sed ut perspiciatis unde omnis
                                                iste natus error sit voluptatem
                                                accusantium doloremque
                                                laudantium, totam rem aperiam,
                                                eaque ipsa quae ab illo
                                                inventore veritatis et quasi
                                                architecto beatae vitae dicta
                                                sunt explicabo. Nemo enim ipsam
                                                voluptatem quia voluptas sit
                                                aspernatur aut odit aut fugit,
                                                sed quia consequuntur magni
                                                dolores eos qui ratione
                                                voluptatem sequi nesciunt.
                                                Consectetur, adipisci velit, sed
                                                quia non numquam eius modi.
                                            </TabPanel>
                                            <TabPanel
                                                v-slot="slotProps"
                                                value="2"
                                                asChild
                                            >
                                                <div
                                                    v-show="slotProps.active"
                                                    :class="slotProps.class"
                                                    v-bind="slotProps.a11yAttrs"
                                                >
                                                    <p class="m-0">
                                                        At vero eos et accusamus
                                                        et iusto odio
                                                        dignissimos ducimus qui
                                                        blanditiis praesentium
                                                        voluptatum deleniti
                                                        atque corrupti quos
                                                        dolores et quas
                                                        molestias excepturi sint
                                                        occaecati cupiditate non
                                                        provident, similique
                                                        sunt in culpa qui
                                                        officia deserunt
                                                        mollitia animi, id est
                                                        laborum et dolorum fuga.
                                                        Et harum quidem rerum
                                                        facilis est et expedita
                                                        distinctio. Nam libero
                                                        tempore, cum soluta
                                                        nobis est eligendi optio
                                                        cumque nihil impedit quo
                                                        minus.
                                                    </p>
                                                </div>
                                            </TabPanel>
                                        </TabPanels>
                                    </Tabs>
                                </template>
                            </Card>
                        </div>
                    </template>
                </Card>
            </div>
        </div></AuthenticatedLayout
    >
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

import Card from "primevue/card";
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";
import Avatar from "primevue/avatar";

const props = defineProps({
    Driver: {
        type: Object,
        required: true,
    },
    User: {
        type: Object,
        required: true,
    },
});

const toUpperCase = (name) => {
    return name.toUpperCase();
};
</script>

<style scoped>
.custom-card {
    background: linear-gradient(rgba(33, 53, 85, 0.9), rgba(33, 53, 85, 0.9)),
        /* Dark blue overlay */ url("/storage/images/Truck.jpg"); /* Replace with your image path */
    background-size: cover; /* Ensure the image covers the entire area */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Avoid repeating the image */
    height: 350px; /* Set header height */
    display: flex; /* Align content inside the header */
    align-items: center; /* Center content vertically */
    padding: 0 20px; /* Add padding for the logo */
    color: white; /* Text color */
    border-radius: 5px;
    position: relative;
}

.custom-menubar {
    background: transparent;
    border: 0;
    position: absolute;
    left: 0; /* Align to the left */
    bottom: 0;
}

.grid-container {
    display: grid;
    grid-template-columns: 350px auto auto;
    gap: 30px;
    position: absolute;
    left: 0;
    top: 200px;
    margin: 22px;
}

.profile {
    border-radius: 4px;
}

.profile-avatar {
    position: absolute;
    top: 42px;
    left: 43px;
    width: 150px;
    height: 150px;
    border: 4px solid white;
}

.custom-account {
    border-radius: 5px;
}
</style>
