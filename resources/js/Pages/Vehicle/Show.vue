<template>
    <Head title="Show" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{}}
            </h2>

            <div class="py-8">
                <div class="">
                    <div class="cover-pictue-container">
                        <Card class="cover-picture">
                            <template #content>
                                <div class="flex items-center gap-4 mx-6 my-8">
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
                                                    >Profile</span
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
                                                    >Registration Details</span
                                                >
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
                                                        >Technical
                                                        Specifications</span
                                                    >
                                                    <Badge value="2" />
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
                                                        >Maintenance
                                                        History</span
                                                    >
                                                    <Badge value="2" />
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
                                                <TabPanel
                                                    value="0"
                                                    as="p"
                                                    class="m-0"
                                                >
                                                    <div class="mb-7">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Vehicle
                                                            Information</label
                                                        >

                                                        <div class="mt-4">
                                                            <div
                                                                class="w-100 mb-6"
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
                                                            <div
                                                                class="w-100 mb-6"
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
                                                        </div>

                                                        <div
                                                            :class="[
                                                                form.hasErrors
                                                                    ? 'mt-3'
                                                                    : 'mt-6',
                                                            ]"
                                                        >
                                                            <div
                                                                class="w-100 mb-6"
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
                                                                                .vehicleType
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .vehicleType
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div class="w-100">
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
                                                                        class="w-full"
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
                                                    </div>
                                                </TabPanel>
                                                <TabPanel
                                                    value="1"
                                                    as="p"
                                                    class="m-0"
                                                >
                                                    <div class="mb-7">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Registration
                                                        </label>

                                                        <div class="mt-4">
                                                            <div
                                                                class="w-100 mb-6"
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
                                                                                .registrationNumber
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .registrationNumber
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                class="w-100 mb-7"
                                                            >
                                                                <label
                                                                    for="license_number"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >License
                                                                    Plate
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
                                                                                .plateNumber
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .plateNumber
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>

                                                        <div
                                                            :class="[
                                                                '',
                                                                form.hasErrors
                                                                    ? 'mt-3'
                                                                    : 'mt-6',
                                                            ]"
                                                        >
                                                            <div
                                                                class="w-100 mb-7"
                                                            >
                                                                <label
                                                                    for="vehicle_name"
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
                                                                                .registrationDate
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .registrationDate
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div class="w-100">
                                                                <label
                                                                    for="vehicle_type"
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
                                                                                .registrationExp
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .registrationExp
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </TabPanel>
                                                <TabPanel
                                                    v-slot="slotProps"
                                                    value="2"
                                                >
                                                    <div class="mb-7">
                                                        <label
                                                            class="text-gray-900 dark:text-surface-0 text-xl font-bold my-4 block"
                                                            >Technical
                                                        </label>

                                                        <div class="mt-4">
                                                            <div
                                                                class="w-100 mb-6"
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
                                                                                .engineNumber
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .engineNumber
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div
                                                                class="w-100 mb-6"
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
                                                                                .chassisNumber
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .chassisNumber
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>

                                                        <div
                                                            :class="[
                                                                ' ',
                                                                form.hasErrors
                                                                    ? 'mt-3'
                                                                    : 'mt-6',
                                                            ]"
                                                        >
                                                            <div
                                                                class="w-100 mb-6"
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
                                                                                .manufacture
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .manufacture
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <div class="w-100">
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
                                                                                .manufactureYear
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .manufactureYear
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </TabPanel>
                                                <TabPanel
                                                    v-slot="slotProps"
                                                    value="3"
                                                >
                                                    <Textarea
                                                        v-model="value"
                                                        variant="filled"
                                                        rows="5"
                                                        cols="30"
                                                        class="w-full"
                                                    />
                                                </TabPanel>
                                            </TabPanels>
                                            <Button
                                                label="UPDATE CHANGE"
                                                type="submit"
                                                icon="pi pi-pencil"
                                                class="w-full"
                                            />
                                        </form>
                                    </Tabs>
                                </template>
                            </Card>
                            <Card class="card">
                                <template #content>
                                    <div class="flex flex-col gap-4">
                                        <h2
                                            class="text-xl font-semibold text-gray-800"
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
import Textarea from "primevue/textarea";
import Button from "primevue/button";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Message from "primevue/message";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import Dialog from "primevue/dialog";

const civilStatus = ref([]);
const relation = ref([]);
const toast = useToast();
const statusDialog = ref(false);

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
    console.log(props.Driver.id);

    form.put(route("driver.update", props.Driver.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Driver updated successfully!",
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

const toUpperCase = (name) => {
    return name.toUpperCase();
};

const formatDate = (createDate) => {
    return dayjs(createDate).format("DD/MM/YYYY");
};

const replaceFirstnum = (number) => {
    return number.replace("+63", "0");
};

const civilStatusSearch = () => {
    civilStatus.value = ["Single", "Married", "Widowed", "Divorced"];
};

const relationSearch = () => {
    relation.value = [
        "Spouse",
        "Father",
        "Mother",
        "Children",
        "Sibling",
        "Other",
    ];
};

const status = (status, id) => {
    alert(
        `Are you sure you want to ${
            status === "Active" ? "Activate" : "Deactivate"
        } this user?`
    );
    router.post(
        route("driver.status"),
        { status, id },
        {
            onSuccess: () => {
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: "Status changed successfully!",
                    life: 3000,
                });
            },
        }
    );
};
</script>

<style scoped>
.cover-pictue-container {
    position: relative;
}

.cover-picture {
    height: 250px;
    position: absolute;
    margin-top: 14px;
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
    height: 200px;
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
