<template>
    <Head title="Vehicle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add Truck
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-4">
                        <!-- Tructor Infomation -->
                        <Accordion :value="['0']" multiple="">
                            <AccordionPanel value="0">
                                <AccordionHeader class="title"
                                    >Tructor Information</AccordionHeader
                                >
                                <AccordionContent>
                                    <div class="mb-4">
                                        <!-- <label
                                            class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                            >Tructor Information</label
                                        > -->
                                        <div class="grid grid-cols-2 gap-10">
                                            <!-- Plate no -->
                                            <div class="w-full">
                                                <label
                                                    for="Plate_number"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Plate Number<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="Plate_number"
                                                    name="Plate_number"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        type="text"
                                                        placeholder="Plate no."
                                                        class="user--input firstName"
                                                        v-model="
                                                            form.plateNumber
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .plateNumber
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .plateNumber
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- Brand / Model -->
                                            <div class="w-full">
                                                <label
                                                    for="model"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Brand/Model<span
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
                                                        v-model="form.model"
                                                    />
                                                    <Message
                                                        v-if="form.errors.model"
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors.model
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <!-- Capacity -->
                                            <div class="w-full">
                                                <label
                                                    for="capacity"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Capacity<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="Plate_number"
                                                    name="Plate_number"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        type="text"
                                                        placeholder="Capacity"
                                                        class="user--input firstName"
                                                        v-model="form.capacity"
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors.capacity
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors.capacity
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- Status -->
                                            <div class="w-full">
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
                                                        v-model="form.status"
                                                        :suggestions="
                                                            vehicleStatus
                                                        "
                                                        @complete="statusSearch"
                                                        dropdown
                                                        placeholder="Status"
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors.status
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors.status
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                            <AccordionPanel value="1">
                                <AccordionHeader class="title"
                                    >Registration Details</AccordionHeader
                                >
                                <AccordionContent>
                                    <!-- Registration Details -->
                                    <div class="mb-11">
                                        <!-- <label
                                            class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                            >Registration Details</label
                                        > -->
                                        <div class="grid grid-cols-2 gap-10">
                                            <!-- Calibration -->
                                            <div class="w-full">
                                                <label
                                                    for="calibrationDate"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Calibration Registered
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="calibrationDate"
                                                    name="calibrationDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="calibrationDate"
                                                            v-model="
                                                                form.calibrationDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="calibrationDate"
                                                            placeholder="Calibration Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .calibrationDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .calibrationDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="calibExpDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >Calibration Expiration
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="calibExpDate"
                                                    name="calibExpDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="calibExpDate"
                                                            v-model="
                                                                form.calibrationExpDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="calibExpDate"
                                                            placeholder="Calibration Expired Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .registrationExp
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .registrationExp
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <!-- LTO Regig date -->
                                            <div class="w-full">
                                                <label
                                                    for="LTORegDate"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >LTO Registered Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="LTORegDate"
                                                    name="LTORegDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="LTORegDate"
                                                            v-model="
                                                                form.LTOregDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="LTORegDate"
                                                            placeholder="LTO Registration Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .LTOregDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .LTOregDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- LTO Exp date -->
                                            <div class="w-full">
                                                <label
                                                    for="LTOExpDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >LTO Expiration Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="LTOExpDate"
                                                    name="LTOExpDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="LTOExpDate"
                                                            v-model="
                                                                form.LTOExpDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="LTOExpDate"
                                                            placeholder="LTO Expired Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .LTOExpDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .LTOExpDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <!-- Conveyance Date -->
                                            <div class="w-full">
                                                <label
                                                    for="ConveyanceDate"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Conveyance Registered
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="ConveyanceDate"
                                                    name="ConveyanceDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="ConveyanceDate"
                                                            v-model="
                                                                form.conveyanceDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="ConveyanceDate"
                                                            placeholder="Conveyance Registration Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .conveyanceDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .conveyanceDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- Conveyance Exp date -->
                                            <div class="w-full">
                                                <label
                                                    for="ConExpDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >Conveyance Expiration
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="ConExpDate"
                                                    name="ConExpDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="ConExpDate"
                                                            v-model="
                                                                form.conveyanceExpDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="ConExpDate"
                                                            placeholder="Conveyance Expired Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .conveyanceExpDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .conveyanceExpDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <!-- Filcomfab -->
                                            <div class="w-full">
                                                <label
                                                    for="Filcomfab"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Filcon Fab Registered
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="Filcomfab"
                                                    name="Filcomfab"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="Filcomfab"
                                                            v-model="
                                                                form.filcomFabDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="Filcomfab"
                                                            placeholder="Filcon Registration Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .filcomFabDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .filcomFabDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- Filcon Exp date -->
                                            <div class="w-full">
                                                <label
                                                    for="FilconExpDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >Filcon Fab Expiration
                                                    Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="FilconExpDate"
                                                    name="FilconExpDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="FilconExpDate"
                                                            v-model="
                                                                form.filconExpDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="FilconExpDate"
                                                            placeholder="Filcon Expired Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .filconExpDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .filconExpDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <!-- LTFRB -->
                                            <div class="w-full">
                                                <label
                                                    for="LTFRB"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >LTFRB Registered Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="LTFRB"
                                                    name="LTFRB"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="LTFRB"
                                                            v-model="
                                                                form.LTFRBRegDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="LTFRB"
                                                            placeholder="LTFRB Registration Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .LTFRBRegDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .LTFRBRegDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <!-- Filcon Exp date -->
                                            <div class="w-full">
                                                <label
                                                    for="LTFRBDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >LTFRB Expiration Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="LTFRBDate"
                                                    name="LTFRBDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="LTFRBDate"
                                                            v-model="
                                                                form.LTFRBExpDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="FilconExpDate"
                                                            placeholder="LTFRB Expired Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .LTFRBExpDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .LTFRBExpDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                            <AccordionPanel value="2">
                                <AccordionHeader class="title"
                                    >Technical Specifications</AccordionHeader
                                >
                                <AccordionContent>
                                    <!-- Technical Specifications -->
                                    <div class="mb-4">
                                        <!-- <label
                                            class="text-gray-900 dark:text-surface-0 text-xl font-medium mb-4 block"
                                            >Technical Specifications</label
                                        > -->

                                        <div class="grid grid-cols-2 gap-10">
                                            <div class="w-full">
                                                <label
                                                    for="engine_number"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Engine Number<span
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
                                                            form.engineNumber
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .engineNumber
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .engineNumber
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="PMSDate"
                                                    class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                    >Last PMS Mileage Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="PMSDate"
                                                    name="PMSDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <div class="flex-auto">
                                                        <DatePicker
                                                            id="PMSDate"
                                                            v-model="
                                                                form.PMSRegDate
                                                            "
                                                            showIcon
                                                            fluid
                                                            :showOnFocus="false"
                                                            inputId="PMSDate"
                                                            placeholder="Last PMS Date"
                                                        />
                                                    </div>
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .PMSRegDate
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .PMSRegDate
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <div class="w-full">
                                                <label
                                                    for="PMSMileage"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Last PMS Mileage<span
                                                        class="text-xs font-thin ml-1"
                                                        >(km)</span
                                                    ><span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    >
                                                </label>
                                                <FormField
                                                    id="PMSMileage"
                                                    name="PMSMileage"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        id="PMSMileage"
                                                        type="text"
                                                        placeholder="Last PMS"
                                                        v-model="
                                                            form.PMSLastMileAge
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .manufacture
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .manufacture
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="PMSMileage"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Current Reading<span
                                                        class="text-xs font-thin ml-1"
                                                        >(km)</span
                                                    ><span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    >
                                                </label>
                                                <FormField
                                                    id="manufacturer_year"
                                                    name="manufacturer_year"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        id="manufacturer_year"
                                                        type="text"
                                                        placeholder="Current Reading"
                                                        v-model="
                                                            form.PMSCurrentReading
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .manufactureYear
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .manufactureYear
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div
                                            :class="[
                                                'grid grid-cols-2 gap-10 ',
                                                form.hasErrors
                                                    ? 'mt-3'
                                                    : 'mt-6',
                                            ]"
                                        >
                                            <div class="w-full">
                                                <label
                                                    for="PMSMileage"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Consumed Mileage<span
                                                        class="text-xs font-thin ml-1"
                                                        >(km)</span
                                                    ><span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    >
                                                </label>
                                                <FormField
                                                    id="PMSMileage"
                                                    name="PMSMileage"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        id="PMSMileage"
                                                        type="text"
                                                        placeholder="Consumed PMS"
                                                        v-model="
                                                            form.consumeMileage
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .consumeMileage
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .consumeMileage
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="PMSMileage"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Next PMS Mileage<span
                                                        class="text-xs font-thin ml-1"
                                                        >(km)</span
                                                    ><span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    >
                                                </label>
                                                <FormField
                                                    id="manufacturer_year"
                                                    name="manufacturer_year"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputText
                                                        id="manufacturer_year"
                                                        type="text"
                                                        placeholder="Next Mileage"
                                                        v-model="
                                                            form.nextPMSMileage
                                                        "
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .nextPMSMileage
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .nextPMSMileage
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                    </div>
                                </AccordionContent>
                            </AccordionPanel>
                        </Accordion>

                        <!-- <div class="w-full mt-8">
                            <label
                                for="image_upload"
                                class="text-slate-800 dark:text-surface-0 text-sm font-medium mb-2 block"
                                >Image Upload</label
                            >
                            <Toast />

                            <FileUpload
                                for="image_upload"
                                url="/image/upload"
                                @upload="onAdvancedUpload($event)"
                                :multiple="true"
                                accept="image/*"
                                :maxFileSize="1000000"
                                :headers="csrfHeaders"
                            >
                                <template #empty>
                                    <span
                                        >Drag and drop files to here to
                                        upload.</span
                                    >
                                </template>
                            </FileUpload>
                        </div> -->
                        <Button
                            label="SUBMIT"
                            type="submit"
                            icon="pi pi-send"
                            class="w-full mt-8"
                        />
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import dayjs from "dayjs";

import Toolbar from "primevue/toolbar";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Message from "primevue/message";
import { FormField } from "@primevue/forms";
import Accordion from "primevue/accordion";
import AccordionPanel from "primevue/accordionpanel";
import AccordionHeader from "primevue/accordionheader";
import AccordionContent from "primevue/accordioncontent";

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const toast = useToast();
const vehicleTypeArr = ref([]);
const vehicleStatus = ref([]);
const csrfHeaders = ref({
    "X-CSRF-TOKEN": csrfToken,
});

const form = useForm({
    plateNumber: "",
    model: "",
    capacity: "",
    status: "",
    calibrationDate: "",
    calibrationExpDate: "",
    LTOregDate: "",
    LTOExpDate: "",
    conveyanceDate: "",
    conveyanceExpDate: "",
    filcomFabDate: "",
    filconExpDate: "",
    LTFRBRegDate: "",
    LTFRBExpDate: "",
    engineNumber: "",
    PMSRegDate: "",
    PMSLastMileAge: "",
    PMSCurrentReading: "",
    consumeMileage: "",
    nextPMSMileage: "",
});

const submit = () => {
    form.post(route("vehicle.store"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Vehicle created successfully!",
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
    });
};

watch(
    form,
    function (old, newForm) {
        form.calibrationDate = form.calibrationDate
            ? dayjs(newForm.calibrationDate).format("YYYY-MM-DD")
            : "";
        form.calibrationExpDate = form.calibrationDate
            ? dayjs(form.calibrationDate).add(1, "year").format("YYYY-MM-DD")
            : old.calibrationExpDate;
        form.LTOregDate = form.LTOregDate
            ? dayjs(newForm.LTOregDate).format("YYYY-MM-DD")
            : "";
        form.LTOExpDate = form.LTOregDate
            ? dayjs(form.LTOregDate).add(1, "year").format("YYYY-MM-DD")
            : old.LTOExpDate;
        form.conveyanceDate = form.conveyanceDate
            ? dayjs(newForm.conveyanceDate).format("YYYY-MM-DD")
            : "";
        form.conveyanceExpDate = form.conveyanceDate
            ? dayjs(form.conveyanceDate).add(1, "year").format("YYYY-MM-DD")
            : old.conveyanceExpDate;
        form.filcomFabDate = form.filcomFabDate
            ? dayjs(newForm.filcomFabDate).format("YYYY-MM-DD")
            : "";
        form.filconExpDate = form.filcomFabDate
            ? dayjs(form.filcomFabDate).add(1, "year").format("YYYY-MM-DD")
            : old.filconExpDate;
        form.LTFRBRegDate = form.LTFRBRegDate
            ? dayjs(newForm.LTFRBRegDate).format("YYYY-MM-DD")
            : "";
        form.LTFRBExpDate = form.LTFRBRegDate
            ? dayjs(form.LTFRBRegDate).add(1, "year").format("YYYY-MM-DD")
            : old.LTFRBExpDate;

        form.consumeMileage = form.PMSCurrentReading - form.PMSLastMileAge;
        form.nextPMSMileage = Number(form.PMSLastMileAge) + 10000;
    },
    { deep: true }
);

const vehicleTypeSearch = () => {
    vehicleTypeArr.value = ["Truck"];
};

const statusSearch = () => {
    vehicleStatus.value = ["Operational", "Non-Operational", "Maintenance"];
};

const goBack = () => {
    history.back();
};
</script>

<style scoped>
.btn--back {
    margin-right: 8px;
    display: flex;
    gap: 6px;
    background-color: #0813ad;
    color: #ebfbee;
    padding: 8px 12px 8px 12px;
    border-radius: 6px;
    font-weight: 600;
}

.title {
    font-size: 22px;
    color: #213555;
}
</style>

<!-- Registration number: HR26DQ5551
Vehicle Name : Truck
Vehicle Type : Truck
Model : 2016 GMC Canyon
Plate no. PAQ323
Chassis no. WDB1290601F012345
Engine no. 52WVC10338
Manufacture : Western Star Trucks
Manufacture Year: 1990 -->
