<template>
    <Head title="Show" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{}}
            </h2>

            <div class="py-8">
                <div class="">
                    <div class="cover-pictue-container">
                        <Card class="cover-picture">
                            <template #content>
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
                                            {{ Vehicle.name }}
                                        </h1>
                                        <span
                                            class="text-white text-xl font-medium tracking-widest"
                                            >{{ Vehicle.license_plate }}
                                        </span>
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
                                                    >Registration Details</span
                                                >
                                                <Badge
                                                    class="absolute right-1 top-2"
                                                    value="3"
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
                                            <!-- <Tab v-slot="slotProps" value="4">
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
                                                            d="m5 8.75l-2.75-3.1q-.425-.5-.162-1.075Q2.35 4 3 4h17q.825 0 1.413.588Q22 5.175 22 6v12q0 .825-.587 1.413Q20.825 20 20 20H7q-.825 0-1.412-.587Q5 18.825 5 18ZM5.225 6ZM9 13h9q.425 0 .712-.288Q19 12.425 19 12t-.288-.713Q18.425 11 18 11H9q-.425 0-.712.287Q8 11.575 8 12t.288.712Q8.575 13 9 13Zm0 3h6q.425 0 .713-.288Q16 15.425 16 15t-.287-.713Q15.425 14 15 14H9q-.425 0-.712.287Q8 14.575 8 15t.288.712Q8.575 16 9 16Zm0-6h9q.425 0 .712-.288Q19 9.425 19 9t-.288-.713Q18.425 8 18 8H9q-.425 0-.712.287Q8 8.575 8 9t.288.712Q8.575 10 9 10ZM7 8v10h13V6H5.225Z"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="font-bold whitespace-nowrap"
                                                        >Tracking</span
                                                    >
                                                    <Badge value="2" />
                                                </div>
                                            </Tab> -->
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
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Vehicle
                                                            Information</label
                                                        >
                                                        <!-- Vehicle name -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="vehicle_name"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Vehicle
                                                                Name<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="vehicle_name"
                                                                name="vehicle_name"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    type="text"
                                                                    placeholder="Vehicle Name"
                                                                    class="user--input firstName"
                                                                    v-model="
                                                                        form.name
                                                                    "
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .name
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .name
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- Model -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="model"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Model<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="model"
                                                                name="model"
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
                                                        <!-- Vehicle type -->
                                                        <div
                                                            :class="[
                                                                form.hasErrors
                                                                    ? 'mt-3'
                                                                    : 'mt-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="vehicle_name"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Vehicle
                                                                Type<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="vehicle_name"
                                                                name="vehicle_name"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <AutoComplete
                                                                    id="vehicle_type"
                                                                    class="w-full"
                                                                    v-model="
                                                                        form.type
                                                                    "
                                                                    :suggestions="
                                                                        vehicleTypeArr
                                                                    "
                                                                    @complete="
                                                                        vehicleTypeSearch
                                                                    "
                                                                    dropdown
                                                                    placeholder="Vehicle Type"
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .type
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .type
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- Status -->
                                                        <div
                                                            :class="[
                                                                form.hasErrors
                                                                    ? 'mt-3'
                                                                    : 'mt-6',
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
                                                    <Button
                                                        label="UPDATE CHANGE"
                                                        type="submit"
                                                        icon="pi pi-pencil"
                                                        class="w-full"
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
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Registration
                                                        </label>
                                                        <!-- Registration Number -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="registration_number"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Registration
                                                                Number<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="registration_number"
                                                                name="registration_number"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    type="text"
                                                                    placeholder="Registration no."
                                                                    class="user--input firstName"
                                                                    v-model="
                                                                        form.registration_number
                                                                    "
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .registration_number
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .registration_number
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- License Plate Number -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="license_number"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >License Plate
                                                                Number<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="license_number"
                                                                name="license_number"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    type="text"
                                                                    placeholder="License Plate no."
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
                                                        <!-- Registration Date -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="registration_date"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Registration
                                                                Date<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="registration_date"
                                                                name="registration_date"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <div
                                                                    class="flex-auto"
                                                                >
                                                                    <DatePicker
                                                                        id="registration_expired"
                                                                        v-model="
                                                                            form.registration_date
                                                                        "
                                                                        showIcon
                                                                        fluid
                                                                        :showOnFocus="
                                                                            false
                                                                        "
                                                                        inputId="registrationExp"
                                                                        placeholder="Registration Expired Date"
                                                                    />
                                                                </div>
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .registration_date
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .registration_date
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- Registration Exp Date -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="registration_expired"
                                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                >Registration
                                                                Expiration
                                                                Date<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="registration_expired"
                                                                name="registration_expired"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <div
                                                                    class="flex-auto"
                                                                >
                                                                    <DatePicker
                                                                        id="registration_expired"
                                                                        v-model="
                                                                            form.registration_expiration_date
                                                                        "
                                                                        showIcon
                                                                        fluid
                                                                        :showOnFocus="
                                                                            false
                                                                        "
                                                                        inputId="registrationExp"
                                                                        placeholder="Registration Expired Date"
                                                                    />
                                                                </div>
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .registration_expiration_date
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .registration_expiration_date
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                    </div>
                                                    <Button
                                                        label="UPDATE CHANGE"
                                                        type="submit"
                                                        icon="pi pi-pencil"
                                                        class="w-full"
                                                    />
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
                                                        <!-- Chassis number -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="chassis_number"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Chassis
                                                                Number<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="chassis_number"
                                                                name="chassis_number"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    id="chassis_number"
                                                                    type="text"
                                                                    placeholder="Chassis No."
                                                                    v-model="
                                                                        form.chassis_number
                                                                    "
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .chassis_number
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .chassis_number
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- Manufacturer -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="manufacturer"
                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                >Manufacturer<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="manufacturer"
                                                                name="manufacturer"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    id="manufacturer"
                                                                    type="text"
                                                                    placeholder="Manufacture"
                                                                    v-model="
                                                                        form.manufacturer
                                                                    "
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .manufacturer
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .manufacturer
                                                                    }}</Message
                                                                >
                                                            </FormField>
                                                        </div>
                                                        <!-- Manufacturer year -->
                                                        <div
                                                            :class="[
                                                                'w-100',
                                                                form.hasErrors
                                                                    ? 'mb-4'
                                                                    : 'mb-6',
                                                            ]"
                                                        >
                                                            <label
                                                                for="manufacturer_year"
                                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                                >Manufacture
                                                                Year<span
                                                                    class="ml-1 text-red-400"
                                                                    >*</span
                                                                ></label
                                                            >
                                                            <FormField
                                                                id="manufacturer_year"
                                                                name="manufacturer_year"
                                                                class="flex flex-col gap-1"
                                                            >
                                                                <InputText
                                                                    id="manufacturer_year"
                                                                    type="number"
                                                                    placeholder="Manufacture Year"
                                                                    v-model="
                                                                        form.manufacture_year
                                                                    "
                                                                />
                                                                <Message
                                                                    v-if="
                                                                        form
                                                                            .errors
                                                                            .manufacture_year
                                                                    "
                                                                    severity="error"
                                                                    size="small"
                                                                    variant="simple"
                                                                    >{{
                                                                        form
                                                                            .errors
                                                                            .manufacture_year
                                                                    }}</Message
                                                                >
                                                            </FormField>
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
                                                    <div class="cards">
                                                        <DataTable
                                                            :value="customers"
                                                            paginator
                                                            :rows="5"
                                                            :rowsPerPageOptions="[
                                                                5, 10, 20, 50,
                                                            ]"
                                                            tableStyle="min-width: 50rem"
                                                        >
                                                            <Column
                                                                field="name"
                                                                header="Name"
                                                                style="
                                                                    width: 25%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="country.name"
                                                                header="Country"
                                                                style="
                                                                    width: 25%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="company"
                                                                header="Company"
                                                                style="
                                                                    width: 25%;
                                                                "
                                                            ></Column>
                                                            <Column
                                                                field="representative.name"
                                                                header="Representative"
                                                                style="
                                                                    width: 25%;
                                                                "
                                                            ></Column>
                                                            <template
                                                                #paginatorcontainer="{
                                                                    first,
                                                                    last,
                                                                    page,
                                                                    pageCount,
                                                                    prevPageCallback,
                                                                    nextPageCallback,
                                                                    totalRecords,
                                                                }"
                                                            >
                                                                <div
                                                                    class="flex items-center gap-4 border border-primary bg-transparent rounded-full w-full py-1 px-2 justify-between"
                                                                >
                                                                    <Button
                                                                        icon="pi pi-chevron-left"
                                                                        rounded
                                                                        text
                                                                        @click="
                                                                            prevPageCallback
                                                                        "
                                                                        :disabled="
                                                                            page ===
                                                                            0
                                                                        "
                                                                    />
                                                                    <div
                                                                        class="text-color font-medium"
                                                                    >
                                                                        <span
                                                                            class="hidden sm:block"
                                                                            >Showing
                                                                            {{
                                                                                first
                                                                            }}
                                                                            to
                                                                            {{
                                                                                last
                                                                            }}
                                                                            of
                                                                            {{
                                                                                totalRecords
                                                                            }}</span
                                                                        >
                                                                        <span
                                                                            class="block sm:hidden"
                                                                            >Page
                                                                            {{
                                                                                page +
                                                                                1
                                                                            }}
                                                                            of
                                                                            {{
                                                                                pageCount
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                    <Button
                                                                        icon="pi pi-chevron-right"
                                                                        rounded
                                                                        text
                                                                        @click="
                                                                            nextPageCallback
                                                                        "
                                                                        :disabled="
                                                                            page ===
                                                                            pageCount -
                                                                                1
                                                                        "
                                                                    />
                                                                </div>
                                                            </template>
                                                        </DataTable>
                                                    </div>
                                                </TabPanel>
                                            </TabPanels>
                                        </form>
                                    </Tabs>
                                </template>
                            </Card>
                            <Card class="card">
                                <template #content>
                                    <div class="flex flex-col gap-4">
                                        <h2
                                            class="text-xl font-semibold text-gray-500"
                                        >
                                            Tracking location
                                        </h2>
                                        <div
                                            class="h-[400px] border-2 border-dashed border-surface flex items-center justify-center"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 512 512"
                                            >
                                                <path
                                                    fill="#8c8c8c"
                                                    d="M448 80c8.8 0 16 7.2 16 16v319.8l-5-6.5l-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3l-83 107.4l-30.5-42.7c-4.5-6.3-11.7-10-19.5-10s-15 3.7-19.5 10.1l-80 112l-4.5 6.2V96c0-8.8 7.2-16 16-16zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm80 192a48 48 0 1 0 0-96a48 48 0 1 0 0 96"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </template>
                            </Card>
                        </div>
                    </div>
                </div>
            </div> </template
    ></AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
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

const vehicleTypeArr = ref([]);
const vehicleStatus = ref([]);
const toast = useToast();

const props = defineProps({
    Vehicle: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    ...props.Vehicle,
    // Bind all vehicle fields to the form
});

const submit = () => {
    form.put(route("vehicle.update", props.Vehicle.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Vehicle updated successfully!",
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

const vehicleTypeSearch = () => {
    vehicleTypeArr.value = ["Truck", "Taxi", "Bus", "Taxi", "Jeep"];
};
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
}

.card {
    border-radius: 4px;
    height: 500px;
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
</style>
