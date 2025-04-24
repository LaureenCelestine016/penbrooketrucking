<template>
    <Head title="Show" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{}}
            </h2>

            <div class="px-4 sm:px-2 lg:px-2">
                <div class="cover-pictue-container">
                    <Card class="cover-picture">
                        <template #content>
                            <div
                                class="flex flex-row justify-between items-center"
                            >
                                <div class="flex items-center gap-4 mx-6 my-2">
                                    <Avatar
                                        image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png"
                                        class="avatar"
                                        size="xlarge"
                                        shape="circle"
                                    />
                                    <div>
                                        <h1
                                            class="text-white text-3xl font-black tracking-wider"
                                        >
                                            {{ Vehicle.model }}
                                        </h1>
                                        <span
                                            class="text-white text-xl font-medium tracking-widest"
                                            >{{ Vehicle.license_plate }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Card>
                    <div class="grid-container">
                        <div class="transparent-head">
                            <h3></h3>
                        </div>
                        <div class="transparent-head">
                            <h3></h3>
                        </div>

                        <Card class="accounts">
                            <template #content>
                                <div class="relative">
                                    <Button
                                        label="View Truck Location"
                                        class="btn-loc"
                                        @click="openModal"
                                    />
                                    <Tabs value="0" class="tab-container">
                                        <TabList>
                                            <Tab
                                                value="0"
                                                as="div"
                                                class="flex items-center gap-2"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 48 48"
                                                >
                                                    <g
                                                        fill="none"
                                                        stroke="#8c8c8c"
                                                        stroke-linejoin="round"
                                                        stroke-width="4"
                                                    >
                                                        <path
                                                            d="M12 39a4 4 0 1 0 0-8a4 4 0 0 0 0 8Zm23 0a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            d="M8 35H2V11h29v24H16m15 0V18h8.571L46 26.5V35h-6.189"
                                                        />
                                                    </g>
                                                </svg>
                                                <span
                                                    class="font-bold whitespace-nowrap"
                                                    >Profile</span
                                                >
                                            </Tab>
                                            <Tab
                                                value="1"
                                                as="div"
                                                class="flex items-center gap-2 relative"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        fill="#8c8c8c"
                                                        d="M6 20q-.825 0-1.412-.587T4 18t.588-1.412T6 16t1.413.588T8 18t-.587 1.413T6 20m0-6q-.825 0-1.412-.587T4 12t.588-1.412T6 10t1.413.588T8 12t-.587 1.413T6 14m0-6q-.825 0-1.412-.587T4 6t.588-1.412T6 4t1.413.588T8 6t-.587 1.413T6 8m6 0q-.825 0-1.412-.587T10 6t.588-1.412T12 4t1.413.588T14 6t-.587 1.413T12 8m6 0q-.825 0-1.412-.587T16 6t.588-1.412T18 4t1.413.588T20 6t-.587 1.413T18 8m-6 6q-.825 0-1.412-.587T10 12t.588-1.412T12 10t1.413.588T14 12t-.587 1.413T12 14m1 6v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm6.575-5.6l.925-.975l-.925-.925l-.95.95z"
                                                    />
                                                </svg>
                                                <span
                                                    class="font-bold whitespace-nowrap"
                                                    >Registration Details
                                                </span>
                                                <Badge
                                                    v-if="
                                                        props.notification >= 1
                                                    "
                                                    class="absolute right-1 top-2"
                                                    :value="props.notification"
                                                    severity="danger"
                                                ></Badge>
                                            </Tab>
                                            <Tab v-slot="slotProps" value="2">
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
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            fill="#8c8c8c"
                                                            d="M4 21q-1.25 0-2.125-.875T1 18q0-.975.563-1.75T3 15.175v-6.35q-.875-.3-1.437-1.075T1 6q0-1.25.875-2.125T4 3t2.125.875T7 6q0 .975-.562 1.75T5 8.825V11h6V8.825q-.875-.3-1.437-1.075T9 6q0-1.25.875-2.125T12 3t2.125.875T15 6q0 .975-.562 1.75T13 8.825V11h5q.425 0 .713-.287T19 10V8.825q-.875-.3-1.437-1.075T17 6q0-1.25.875-2.125T20 3t2.125.875T23 6q0 .975-.562 1.75T21 8.825V10q0 1.25-.875 2.125T18 13h-5v2.175q.875.3 1.438 1.075T15 18q0 1.25-.875 2.125T12 21t-2.125-.875T9 18q0-.975.563-1.75T11 15.175V13H5v2.175q.875.3 1.438 1.075T7 18q0 1.25-.875 2.125T4 21m0-2q.425 0 .713-.288T5 18t-.288-.712T4 17t-.712.288T3 18t.288.713T4 19M4 7q.425 0 .713-.288T5 6t-.288-.712T4 5t-.712.288T3 6t.288.713T4 7m8 12q.425 0 .713-.288T13 18t-.288-.712T12 17t-.712.288T11 18t.288.713T12 19m0-12q.425 0 .713-.288T13 6t-.288-.712T12 5t-.712.288T11 6t.288.713T12 7m8 0q.425 0 .713-.288T21 6t-.288-.712T20 5t-.712.288T19 6t.288.713T20 7m0-1"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="font-bold whitespace-nowrap"
                                                        >Technical
                                                        Specifications</span
                                                    >
                                                </div>
                                            </Tab>
                                            <Tab v-slot="slotProps" value="3">
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
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill="#8c8c8c"
                                                            d="M8.39 1c.699 0 1.4.2 2 .7l2.1 1.8c.1.1.1.3 0 .4s-.1.3 0 .4l.51.45c.098.094.259.08.388-.05c.158-.158.2-.173.399 0l1 .911c.185.181.196.289.096.389l-1.6 1.9c-.11.139-.27.198-.4.1l-.897-.8c-.1-.1-.088-.276 0-.4s.107-.304 0-.4l-.522-.431c-.156-.121-.226-.148-.45.031c-.15.121-.251.105-.351.031c-.1-.073-.086-.062-.195-.152c-.135-.11-.238-.132-.38.021l-2.6 3.2c.3.2.3.6.1.9l-3.79 4.5c-.398.3-.798.5-1.2.5s-.698-.1-.997-.4c-.7-.6-.7-1.5-.2-2.2l3.79-4.5c.1-.1.299-.2.499-.2c.1 0 .299 0 .399.1l2.2-2.6c.399-.4.25-.9-.15-1.3l-.23-.215C7.412 3.185 6.69 3 5.89 3h-.398c-.1 0-.154-.12-.1-.2l.599-.7c.599-.7 1.5-1.1 2.4-1.1zm0-1c-1.2 0-2.4.5-3.09 1.5l-.599.7c-.299.3-.399.8-.2 1.2c.2.4.599.6.998.6h.499c.499 0 .998.2 1.3.5l.2.2l-1.8 2h-.1q-.748 0-1.2.6l-3.79 4.5c-.898 1.1-.799 2.7.3 3.6c.498.4.997.6 1.7.6c.798 0 1.5-.3 1.9-.9l3.79-4.5c.298-.4.398-.9.298-1.4l1.9-2.2c.105-.119.3-.113.3 0c0 .3.2.7.5.9l.897.8q.45.3.898.3c.4 0 .8-.2.998-.5l1.6-1.9c.5-.5.33-1.32-.2-1.8l-.898-.8q-.3-.3-.898-.3h-.1c0-.3-.2-.7-.499-.9l-2.1-1.8c-.699-.7-1.6-1-2.6-1z"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="font-bold whitespace-nowrap"
                                                        >Maintenance
                                                        History</span
                                                    >
                                                </div>
                                            </Tab>
                                            <Tab v-slot="slotProps" value="4">
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
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <!-- Icon from All by undefined - undefined -->
                                                        <g fill="#8c8c8c">
                                                            <path
                                                                d="M3 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5z"
                                                            />
                                                            <path
                                                                d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907c.295.655.294 1.465.294 2.081v3.175a.5.5 0 0 1-.5.501H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm9 0a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h8z"
                                                            />
                                                        </g>
                                                    </svg>
                                                    <span
                                                        class="font-bold whitespace-nowrap"
                                                        >Fuel History</span
                                                    >
                                                </div>
                                            </Tab>
                                        </TabList>
                                        <form @submit.prevent="submit" class="">
                                            <TabPanels>
                                                <!-- Profile -->
                                                <TabPanel
                                                    value="0"
                                                    as="p"
                                                    class="m-0"
                                                >
                                                    <div class="mb-6">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 mb-6 block"
                                                            >Tructor
                                                            Information</label
                                                        >
                                                        <!-- Model -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="Model"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Model<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="Model"
                                                                    name="Model"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        type="text"
                                                                        placeholder="Model"
                                                                        v-model="
                                                                            form.model
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .model
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .model
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- platenumber -->
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="platenumber"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Plate
                                                                    number<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="platenumber"
                                                                    name="platenumber"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        type="text"
                                                                        placeholder="Plate number"
                                                                        v-model="
                                                                            form.license_plate
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .license_plate
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .license_plate
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    form.hasErrors
                                                                        ? 'mb-3'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="capacity"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Capacity<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="capacity"
                                                                    name="capacity"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        type="text"
                                                                        placeholder="Capacity"
                                                                        v-model="
                                                                            form.capacity
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .capacity
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .capacity
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- Status -->
                                                            <div
                                                                :class="[
                                                                    form.hasErrors
                                                                        ? 'mb-3'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="status"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Status<span
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
                                                                        class="drop-status"
                                                                        v-model="
                                                                            form.status
                                                                        "
                                                                        :suggestions="
                                                                            vehicleStatus
                                                                        "
                                                                        @complete="
                                                                            statusSearch
                                                                        "
                                                                        dropdown
                                                                        placeholder="Status"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .status
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .status
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <!-- capacity -->
                                                    </div>
                                                    <Button
                                                        label="UPDATE CHANGE"
                                                        type="submit"
                                                        icon="pi pi-pencil"
                                                        class="w-full mt-10"
                                                    />
                                                </TabPanel>
                                                <!-- Registration Details -->
                                                <TabPanel
                                                    value="1"
                                                    as="p"
                                                    class="m-0"
                                                >
                                                    <div class="mb-6">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 mb-6 block"
                                                            >Registration
                                                        </label>
                                                        <!-- LTO -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <!-- LTO Reg date -->
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="ltoRegDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >LTO
                                                                    Registered
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="ltoRegDate"
                                                                    name="ltoRegDate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTO Expired Date"
                                                                        v-model="
                                                                            form.lto_reg_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .lto_reg_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .lto_reg_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- LTO Expired date -->
                                                            <div
                                                                v-if="
                                                                    props
                                                                        .Vehicle
                                                                        .lto_is_Expired ===
                                                                    1
                                                                "
                                                                class="w-full mb-2"
                                                            >
                                                                <label
                                                                    for="LTOExpDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >LTO Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*
                                                                    </span></label
                                                                >

                                                                <FormField
                                                                    id="LTOExpDate"
                                                                    name="LTOExpDate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTO Expired Date"
                                                                        v-model="
                                                                            form.lto_exp_date
                                                                        "
                                                                        class="!border-red-500 !bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        LTO is
                                                                        about to
                                                                        expire.
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-else
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="LTOExpDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >LTO Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*
                                                                    </span></label
                                                                >

                                                                <FormField
                                                                    id="LTOExpDate"
                                                                    name="LTOExpDate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTO Expired Date"
                                                                        v-model="
                                                                            form.lto_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .lto_exp_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        {{
                                                                            form
                                                                                .errors
                                                                                .lto_exp_date
                                                                        }}
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                        </div>

                                                        <!-- Conveyance -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="conveyDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Conveyance
                                                                    Registered
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="conveyDate"
                                                                    name="conveyDate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Conveyance Expired Date"
                                                                        v-model="
                                                                            form.conveyance_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .conveyance_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .conveyance_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- Conveyance Expired date -->
                                                            <div
                                                                v-if="
                                                                    props
                                                                        .Vehicle
                                                                        .conveyance_is_Expired ===
                                                                    1
                                                                "
                                                                class="w-full mb-2"
                                                            >
                                                                <label
                                                                    for="conExpdate"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Conveyance
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="conExpdate"
                                                                    name="conExpdate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Conveyance Expired Date"
                                                                        v-model="
                                                                            form.conveyance_exp_date
                                                                        "
                                                                        class="!border-red-500 !bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        Conveyance
                                                                        is about
                                                                        to
                                                                        expire.
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-else
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="conExpdate"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Conveyance
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="conExpdate"
                                                                    name="conExpdate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Conveyance Expired Date"
                                                                        v-model="
                                                                            form.conveyance_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .conveyance_exp_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .conveyance_exp_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <!-- Filcom Fab -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="filcomFab"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Filcom Fab
                                                                    Registered
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="filcomFab"
                                                                    name="filcomFab"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Filcon Fab Expired Date"
                                                                        v-model="
                                                                            form.filcon_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .conveyance_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .conveyance_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-if="
                                                                    props
                                                                        .Vehicle
                                                                        .filcon_is_Expired ===
                                                                    1
                                                                "
                                                                class="w-full mb-2"
                                                            >
                                                                <label
                                                                    for="filcomFab"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Filcom Fab
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="filcomFab"
                                                                    name="filcomFab"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Filcon Fab Expired Date"
                                                                        v-model="
                                                                            form.filcon_exp_date
                                                                        "
                                                                        class="!border-red-500 !bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        Filcom
                                                                        is about
                                                                        to
                                                                        expire.
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-else
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="filcomFab"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Filcom Fab
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="conExpdate"
                                                                    name="conExpdate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="Filcon Fab Expired Date"
                                                                        v-model="
                                                                            form.filcon_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .filcon_exp_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .filcon_exp_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <!-- LTFRB -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="LTFRBReg"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >LTFRB
                                                                    Registered
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="LTFRBReg"
                                                                    name="LTFRBReg"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTFRB Expired Date"
                                                                        v-model="
                                                                            form.ltfrb_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .ltfrb_reg_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .ltfrb_reg_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-if="
                                                                    props
                                                                        .Vehicle
                                                                        .ltfrb_is_Expired ===
                                                                    1
                                                                "
                                                                class="w-full mb-2"
                                                            >
                                                                <label
                                                                    for="LTFRBExp"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >LTFRB
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="LTFRBExp"
                                                                    name="LTFRBExp"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTFRB Expired Date"
                                                                        v-model="
                                                                            form.ltfrb_exp_date
                                                                        "
                                                                        class="!border-red-500 !bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        LTFRB is
                                                                        about to
                                                                        expire.
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                v-else
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="LTFRBExp"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >LTFRB
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="LTFRBExp"
                                                                    name="LTFRBExp"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        disabled=""
                                                                        type="text"
                                                                        placeholder="LTFRB Expired Date"
                                                                        v-model="
                                                                            form.ltfrb_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .ltfrb_exp_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .ltfrb_exp_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </TabPanel>
                                                <!-- Technical Specifications -->
                                                <TabPanel
                                                    v-slot="slotProps"
                                                    value="2"
                                                >
                                                    <div class="mb-6">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Technical
                                                        </label>
                                                        <!-- Engine number -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="engine_number"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Engine
                                                                    Number<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="engine_number"
                                                                    name="engine_number"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="engine_number"
                                                                        type="text"
                                                                        placeholder="Engine No."
                                                                        v-model="
                                                                            form.engine_number
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .engine_number
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .engine_number
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- PMS Reg Date -->
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="PMSRegDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >PMS
                                                                    Registered
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="PMSRegDate"
                                                                    name="PMSRegDate"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <DatePicker
                                                                        id="PMSRegDate"
                                                                        v-model="
                                                                            form.pms_reg_date
                                                                        "
                                                                        showIcon
                                                                        fluid
                                                                        :showOnFocus="
                                                                            false
                                                                        "
                                                                        inputId="PMSRegDate"
                                                                        placeholder="PMS Registered Date"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .pms_reg_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .pms_reg_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>

                                                        <!-- PMSLastMileage -->
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="PMSLastMileage"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >PMS Last
                                                                    Mileage
                                                                    <span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="PMSLastMileage"
                                                                    name="PMSLastMileage"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="PMSLastMileagecturer"
                                                                        type="text"
                                                                        placeholder="PMS Last mileage"
                                                                        v-model="
                                                                            form.pms_last_mileage
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .pms_last_mileage
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .pms_last_mileage
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- Current Mileage -->
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="currentmileages"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >PMS Current
                                                                    Mileage<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="currentmileages"
                                                                    name="currentmileages"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="currentmileages"
                                                                        type="text"
                                                                        placeholder="Current mileages"
                                                                        v-model="
                                                                            form.pms_current_reading
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .pms_current_reading
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .pms_current_reading
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="grid grid-cols-2 gap-8 mb-1"
                                                        >
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="consumeMileage"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Consume
                                                                    Mileage
                                                                    <span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="consumeMileage"
                                                                    name="consumeMileage"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="consumeMileage"
                                                                        type="text"
                                                                        placeholder="Consume mileage"
                                                                        v-model="
                                                                            form.consume_mileage
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .consume_mileage
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .consume_mileage
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- Next PMS Mileage -->
                                                            <div
                                                                :class="[
                                                                    'w-100',
                                                                    form.hasErrors
                                                                        ? 'mb-4'
                                                                        : 'mb-6',
                                                                ]"
                                                            >
                                                                <label
                                                                    for="nextmileage"
                                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                    >Next PMS
                                                                    Mileage<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="nextmileage"
                                                                    name="nextmileage"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="nextmileage"
                                                                        type="text"
                                                                        placeholder="Next mileage"
                                                                        v-model="
                                                                            form.next_pms_mileage
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .next_pms_mileage
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .next_pms_mileage
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <Button
                                                        label="UPDATE CHANGE"
                                                        type="submit"
                                                        icon="pi pi-pencil"
                                                        class="w-full"
                                                    />
                                                </TabPanel>
                                                <!-- Maintenance History -->
                                                <TabPanel value="3">
                                                    <div class="border mt-5">
                                                        <DataTable
                                                            :value="Maintenance"
                                                            paginator
                                                            :rows="5"
                                                            :rowsPerPageOptions="[
                                                                5, 10, 20, 50,
                                                            ]"
                                                            tableStyle="min-width: 50rem"
                                                            ref="dt"
                                                        >
                                                            <Column
                                                                field="item_description"
                                                                header="Item and Description"
                                                                style="
                                                                    width: 10%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="quantity"
                                                                header="Quantity"
                                                                style="
                                                                    width: 2%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="price"
                                                                header="Price"
                                                                style="
                                                                    width: 2%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="total"
                                                                header="Total"
                                                                style="
                                                                    width: 2%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="odometer"
                                                                header="Odometer"
                                                                style="
                                                                    width: 2%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="supplier"
                                                                header="Supplier"
                                                                style="
                                                                    width: 5%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="breakdown_date"
                                                                header="Breakdown Date"
                                                                style="
                                                                    width: 5%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="up_date"
                                                                header="Up Date"
                                                                style="
                                                                    width: 5%;
                                                                "
                                                            ></Column>
                                                        </DataTable>
                                                    </div>
                                                </TabPanel>
                                                <!-- Fuel History -->
                                                <TabPanel value="4">
                                                    <div class="border mt-5">
                                                        <DataTable
                                                            :value="fuel"
                                                            paginator
                                                            :rows="5"
                                                            :rowsPerPageOptions="[
                                                                5, 10, 20, 50,
                                                            ]"
                                                            tableStyle="min-width: 50rem"
                                                            ref="dt"
                                                        >
                                                            <Column
                                                                field="current_odometer"
                                                                header="Current Odometer"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="previous_odometer"
                                                                header="Previous Odometer"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="total_distance"
                                                                header="Distance"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="total_refuel"
                                                                header="Liters"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="avg_fuel_consumption"
                                                                header="Avg. Fuel"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="amount"
                                                                header="Amount"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="refueling_date"
                                                                header="Date Refilled"
                                                                style="
                                                                    width: 15%;
                                                                "
                                                            ></Column>
                                                        </DataTable>
                                                    </div>
                                                </TabPanel>
                                            </TabPanels>
                                        </form>
                                    </Tabs>
                                </div>
                            </template>
                        </Card>
                        <Dialog
                            v-model:visible="visible"
                            maximizable
                            modal
                            header="Truck Current Location"
                            :style="{ width: '80rem', height: '50rem' }"
                            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
                        >
                            <div id="map" style="height: 550px; width: 100%" />
                        </Dialog>
                    </div>
                </div>
            </div> </template
    ></AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { onMounted, ref, watch, onBeforeUnmount } from "vue";
import L from "leaflet";
import axios from "axios";
// import { CustomerService } from "@/service/CustomerService";

import dayjs from "dayjs";
import Avatar from "primevue/avatar";
import Card from "primevue/card";
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Message from "primevue/message";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import Badge from "primevue/badge";
import Dialog from "primevue/dialog";

const toast = useToast();
const vehicleStatus = ref([]);
const visible = ref(false);
const map = ref(null);
const marker = ref(null);
const location = ref({ lat: 0, lng: 0 });
const loading = ref(false);
const previousCoords = ref([]); // 🧭 for route trail
const routeLine = ref(null);
const endMarker = ref(null); // ✅ Add this
let intervalId = null;

const props = defineProps({
    Vehicle: {
        type: Object,
        required: true,
    },

    Maintenance: {
        type: Array,
        required: true,
    },
    fuel: {
        type: Array,
        required: true,
    },
    notification: {
        type: Number,
        required: true,
    },
    location: {
        type: Object,
        required: true,
    },
});

const truckIcon = L.icon({
    iconUrl: "/storage/images/trucks.png",
    iconSize: [50, 50], // size of the icon
    iconAnchor: [20, 40], // point of the icon which will correspond to marker's location
    popupAnchor: [0, -40], // point from which the popup should open relative to the iconAnchor
});

const startIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/64/2776/2776067.png",
    iconSize: [20, 20],
    iconAnchor: [15, 30],
});

const endIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/64/2776/2776061.png",
    iconSize: [20, 20],
    iconAnchor: [15, 30],
});

const form = useForm({
    ...props.Vehicle,
    // Bind all vehicle fields to the form
});

const openModal = async () => {
    visible.value = true;

    try {
        const tokenResponse = await axios.post("/vehicle/get-token");
        const accessToken = tokenResponse.data.accessToken;

        if (!accessToken) {
            alert("Access token is missing.");
            return;
        }

        await getTruckLocation(accessToken);

        intervalId = setInterval(() => {
            getTruckLocation(accessToken);
        }, 5000);
    } catch (error) {
        console.error("Token fetch error:", error);
        alert("Failed to retrieve access token");
    }
};

const getTruckLocation = async (accessToken) => {
    const imei = props.Vehicle.imei;

    try {
        const response = await axios.post("/vehicle/get-location", {
            accessToken,
            imei,
        });

        const item = response.data?.location?.[0];
        if (!item) {
            alert("No location data found.");
            return;
        }

        const lat = parseFloat(item.lat);
        const lng = parseFloat(item.lng);
        const speed = parseFloat(item.speed || 0);

        location.value = { lat, lng };
        previousCoords.value.push([lat, lng]);

        // Initial map setup
        if (!map.value) {
            initMap(lat, lng);
        }

        // Add start marker
        if (previousCoords.value.length === 1) {
            L.marker([lat, lng], { icon: startIcon })
                .addTo(map.value)
                .bindPopup("Start");
        }

        // Update truck marker
        if (!marker.value) {
            marker.value = L.marker([lat, lng], { icon: truckIcon }).addTo(
                map.value
            );
        } else {
            marker.value.setLatLng([lat, lng]);
        }

        // Pan to current location
        map.value.panTo([lat, lng]);

        // Update or create end marker
        if (!endMarker.value) {
            endMarker.value = L.marker([lat, lng], { icon: endIcon })
                .addTo(map.value)
                .bindPopup("Current Location");
        } else {
            endMarker.value.setLatLng([lat, lng]);
        }

        // Draw colored segment from previous point
        if (previousCoords.value.length >= 2) {
            const [prevLat, prevLng] =
                previousCoords.value[previousCoords.value.length - 2];
            const color = speed < 5 ? "red" : "blue";

            L.polyline(
                [
                    [prevLat, prevLng],
                    [lat, lng],
                ],
                {
                    color,
                    weight: 5,
                }
            ).addTo(map.value);
        }

        // Total distance (console)
        let totalDistance = 0;
        for (let i = 1; i < previousCoords.value.length; i++) {
            const [lat1, lon1] = previousCoords.value[i - 1];
            const [lat2, lon2] = previousCoords.value[i];
            totalDistance += getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2);
        }

        console.log(`Total Distance: ${totalDistance.toFixed(2)} km`);
    } catch (error) {
        console.error("Failed to get location:", error);
    }
};

const initMap = (lat, lng) => {
    map.value = L.map("map").setView([lat, lng], 15);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map.value);
};

const getDistanceFromLatLonInKm = (lat1, lon1, lat2, lon2) => {
    const R = 6371; // km
    const dLat = ((lat2 - lat1) * Math.PI) / 180;
    const dLon = ((lon2 - lon1) * Math.PI) / 180;
    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos((lat1 * Math.PI) / 180) *
            Math.cos((lat2 * Math.PI) / 180) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
};

watch(visible, (val) => {
    if (!val) {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }

        if (map.value) {
            map.value.remove();
            map.value = null;
        }

        marker.value = null;
        endMarker.value = null;
        previousCoords.value = [];
        routeLine.value = null;
    }
});

const submit = () => {
    form.put(route("vehicle.update", props.Vehicle.id), {
        preserveState: true,
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Tractor updated successfully!",
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

const statusSearch = () => {
    vehicleStatus.value = ["Operational", "Non-Operational", "Maintenance"];
};

watch(
    () => form.lto_reg_date, // Only watch this field
    (newValue) => {
        if (newValue) {
            form.lto_reg_date = dayjs(newValue).format("YYYY-MM-DD");
            form.lto_exp_date = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.conveyance_date,
    (newValue) => {
        if (newValue) {
            form.conveyance_date = dayjs(newValue).format("YYYY-MM-DD");
            form.conveyance_exp_date = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.filcom_fab_date,
    (newValue) => {
        if (newValue) {
            form.filcom_fab_date = dayjs(newValue).format("YYYY-MM-DD");
            form.filcon_exp_date = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.ltfrb_reg_date,
    (newValue) => {
        if (newValue) {
            form.ltfrb_reg_date = dayjs(newValue).format("YYYY-MM-DD");
            form.ltfrb_exp_date = dayjs(newValue)
                .add(1, "year")
                .format("YYYY-MM-DD");
        }
    }
);

watch(
    () => form.pms_current_reading,
    () => {
        form.consume_mileage = form.pms_current_reading - form.pms_last_mileage;
    }
);

watch(
    () => form.pms_last_mileage,
    () => {
        form.consume_mileage = form.pms_current_reading - form.pms_last_mileage;
        form.next_pms_mileage = Number(form.pms_last_mileage) + 10000;
    }
);
</script>

<style scoped>
.cover-pictue-container {
    position: relative;
}

.cover-picture {
    height: 250px;
    position: absolute;
    margin-top: 8px;
    top: 80;
    left: 0;
    z-index: 1;
    width: 100%;
    border-radius: 6px;

    background: linear-gradient(rgba(33, 53, 85, 0.9), rgba(33, 53, 85, 0.9)),
        url("/storage/images/Truck.jpg"); /* Replace with your image path */
    background-size: cover; /* Ensure the image covers the entire area */
    background-position: center; /* Center the image */
    background-repeat: no-repeat;
}

.grid-container {
    display: grid;
    position: relative;
    grid-template-columns: 1fr 1fr;
    margin: auto;
    width: 97%;
    z-index: 15;
    column-gap: 24px;
}

.transparent-head {
    background-color: transparent;
    height: 170px;
}

.tab-container {
    padding: none !important;
}

.accounts {
    border-radius: 4px;
    grid-column: 1 / span 3;
}

.card {
    border-radius: 4px;
    height: 500px;
    grid-column: 1 / span 3;
}

.card .p-card-body {
    padding: 1px !important;
}

.profile {
    background-color: green;
    height: 300px;
}

.avatar {
    height: 6rem;
    width: 6rem;
    border: wheat 6px solid;
}

.class-age {
    width: 116px;
}

.title {
    font-size: 18px;
    color: #213555;
}

.btn-active {
    width: 350px;
    margin-left: -20px;
    margin-top: 32px;
    border: #69db7c solid 1px !important;
}

.btn-active:hover {
    background-color: #69db7c !important;
    color: #ebfbee !important;
}

.btn-inactive {
    width: 350px;
    margin-left: -20px;
    margin-top: 32px;
    border: #ff6b6b solid 1px !important;
}

.btn-inactive:hover {
    background-color: #ff8787 !important;
    color: #fff5f5 !important;
}

.class {
    background-color: whitesmoke !important;
}

.p-datatable .p-datatable-thead > tr > th {
    text-align: center !important;
}

.btn-loc {
    position: absolute;
    /* Adjust as needed */
    right: 20px; /* Aligns the button to the right */
    z-index: 10;
    background-color: #8fbcc7;
    color: #213555;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-loc:hover {
    background-color: #5ca6b9;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    transform: translateY(-1px);
}
</style>
