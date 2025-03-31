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
                                            {{ trailer.license_plate }}
                                        </h1>
                                        <span
                                            class="text-white text-xl font-medium tracking-widest"
                                            >{{ trailer.body_number }}
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

                            <Card class="accounts"
                                ><template #content>
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
                                                    v-if="
                                                        props.notification >= 1
                                                    "
                                                    class="absolute right-1 top-2"
                                                    :value="props.notification"
                                                    severity="danger"
                                                ></Badge>
                                            </Tab>
                                            <Tab
                                                value="2"
                                                as="div"
                                                class="flex items-center gap-2 relative"
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
                                                    >Maintenance History</span
                                                >
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
                                                            >Trailer
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
                                                                    >License
                                                                    Number<span
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
                                                                        placeholder="Plate no."
                                                                        class="!bg-gray-100"
                                                                        v-model="
                                                                            form.license_plate
                                                                        "
                                                                        disabled=""
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
                                                                    for="bodynumber"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Plate
                                                                    number<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="bodynumber"
                                                                    name="bodynumber"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        type="text"
                                                                        placeholder="Body number"
                                                                        v-model="
                                                                            form.body_number
                                                                        "
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .body_number
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .body_number
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <div class="">
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
                                                        class="w-full mt-11"
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
                                                                        .trailer
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
                                                        <!-- Calibration -->
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
                                                                    >Calibration
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
                                                                            form.calibration_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .calibration_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .calibration_date
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- LTO Expired date -->
                                                            <div
                                                                v-if="
                                                                    props
                                                                        .trailer
                                                                        .calibration_is_Expired ===
                                                                    1
                                                                "
                                                                class="w-full mb-2"
                                                            >
                                                                <label
                                                                    for="LTOExpDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Calibration
                                                                    Expired
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
                                                                            form.calibration_exp_date
                                                                        "
                                                                        class="!border-red-500 !bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        Calibration
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
                                                                    for="LTOExpDate"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >Calibration
                                                                    Expired
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
                                                                            form.calibration_exp_date
                                                                        "
                                                                        class="!bg-gray-50"
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .calibration_exp_date
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                    >
                                                                        {{
                                                                            form
                                                                                .errors
                                                                                .calibration_exp_date
                                                                        }}
                                                                    </Message>
                                                                </FormField>
                                                            </div>
                                                        </div>
                                                        <!-- Conveyance -->
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
                                                    <div class="border mt-5">
                                                        <DataTable
                                                            v-model:selection="
                                                                selectedProduct
                                                            "
                                                            :value="maintenance"
                                                            dataKey="id"
                                                            tableStyle="min-width: 50rem"
                                                            class="h-[20rem]"
                                                        >
                                                            <Column
                                                                field="item_description"
                                                                header="Item and Description"
                                                            ></Column>
                                                            <Column
                                                                field="quantity"
                                                                header="Quantity"
                                                            ></Column>
                                                            <Column
                                                                field="price"
                                                                header="Price"
                                                            ></Column>
                                                            <Column
                                                                field="total"
                                                                header="Total"
                                                            ></Column>

                                                            <Column
                                                                field="supplier"
                                                                header="Supplier"
                                                            ></Column>
                                                            <Column
                                                                field="breakdown_date"
                                                                header="Breakdown Date"
                                                            ></Column>
                                                            <Column
                                                                field="up_date"
                                                                header="Up Date"
                                                            ></Column>
                                                        </DataTable>
                                                    </div>
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
                                        </form> </Tabs
                                ></template>
                            </Card>
                            <!-- <Card class="card">
                                <template #content> </template>
                            </Card> -->
                        </div>
                    </div>
                </div>
            </div>
        </template></AuthenticatedLayout
    >
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
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

const toast = useToast();
const vehicleStatus = ref([]);

const props = defineProps({
    trailer: {
        type: Object,
        required: true,
    },
    maintenance: {
        type: Object,
        required: true,
    },

    notification: {
        type: Number,
        required: true,
    },
});

const form = useForm({
    ...props.trailer,
    // Bind all vehicle fields to the form
});

const submit = () => {
    form.put(route("trailer.update", props.trailer.id), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Trailer updated successfully!",
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
    () => form.calibration_date,
    (newValue) => {
        if (newValue) {
            form.calibration_date = dayjs(newValue).format("YYYY-MM-DD");
            form.calibration_exp_date = dayjs(newValue)
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
</style>
