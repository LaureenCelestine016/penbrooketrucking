<template>
    <Head title="Truck Registration" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Update Truck Registration
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="">
                            <div class="flex flex-row gap-x-8 mb-6">
                                <div class="flex items-center gap-2">
                                    <RadioButton
                                        v-model="truck"
                                        inputId="ingredient1"
                                        name="truck"
                                        value="1"
                                    />
                                    <label for="ingredient1"
                                        >TRACTOR HEAD</label
                                    >
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton
                                        v-model="truck"
                                        inputId="ingredient2"
                                        name="truck"
                                        value="2"
                                    />
                                    <label for="ingredient2">TRAILER</label>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 mb-6">
                                <div class="w-full">
                                    <label
                                        for="tructor"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Tractor Truck<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="tructor"
                                        name="tructor"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="tructor"
                                            class="w-full"
                                            :suggestions="tructors"
                                            @complete="tructorNameSearch"
                                            @item-select="onTructorSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Plate no."
                                            :disabled="truck !== '1'"
                                        />
                                    </FormField>
                                </div>
                                <div class="w-full">
                                    <label
                                        for="trailer"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Trailer Truck<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FormField
                                        id="trailer"
                                        name="trailer"
                                        class="flex flex-col gap-1"
                                    >
                                        <AutoComplete
                                            id="trailer"
                                            class="w-full"
                                            :suggestions="trailers"
                                            @complete="trailerNameSearch"
                                            @item-select="onTrailerSelect"
                                            optionLabel="name"
                                            dropdown
                                            placeholder="Plate no."
                                            :disabled="truck !== '2'"
                                        />
                                    </FormField>
                                </div>
                            </div>
                            <div
                                v-if="!truck"
                                class="h-[150px] border-2 border-dashed border-surface mb-7 flex items-center justify-center text-gray-600 text-2xl font-medium"
                            >
                                SELECT TRUCK TYPE
                            </div>
                            <div class="mt-5 mb-11" v-else-if="truck === '1'">
                                <div class="">
                                    <label
                                        for="Plate_number"
                                        class="text-gray-700 dark:text-surface-0 text-2xl font-medium mb-4 block"
                                        >Registration Details
                                    </label>
                                    <div
                                        class="grid grid-cols-2 gap-8 mb-1"
                                        disabled=""
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
                                                >LTO Registered Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="ltoRegDate"
                                                name="ltoRegDate"
                                                class="flex flex-col gap-1"
                                            >
                                                <DatePicker
                                                    id="calibDate"
                                                    v-model="form.lto_reg_date"
                                                    showIcon
                                                    fluid
                                                    :showOnFocus="false"
                                                    inputId="registrationExp"
                                                    placeholder="LTO Registration Date"
                                                    :disabled="!tructorId"
                                                />
                                                <Message
                                                    v-if="
                                                        form.errors.lto_reg_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors.lto_reg_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <!-- LTO Expired date -->
                                        <div
                                            v-if="isLtoTractorExpired"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="LTOExpDate"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >LTO Expired Date<span
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
                                                    v-model="form.lto_exp_date"
                                                    class="!border-red-500 !bg-gray-50"
                                                />
                                                <Message
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                >
                                                    Updating LTO expiration date
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
                                                >LTO Expired Date<span
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
                                                    v-model="form.lto_exp_date"
                                                    class="!bg-gray-50"
                                                />
                                                <Message
                                                    v-if="
                                                        form.errors.lto_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                >
                                                    {{
                                                        form.errors.lto_exp_date
                                                    }}
                                                </Message>
                                            </FormField>
                                        </div>
                                    </div>
                                    <!-- Conveyance -->
                                    <div class="grid grid-cols-2 gap-8 mb-1">
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
                                                >Conveyance Registered Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="conveyDate"
                                                name="conveyDate"
                                                class="flex flex-col gap-1"
                                            >
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="conveyDate"
                                                        v-model="
                                                            form.conveyance_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="conveyDate"
                                                        placeholder="Conveyance Date"
                                                        :disabled="!tructorId"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="
                                                        form.errors
                                                            .conveyance_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .conveyance_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <!-- Conveyance Expired date -->
                                        <div
                                            v-if="isconveyanceExpired"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="conExpdate"
                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                >Conveyance Expired Date<span
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
                                                    Updating Conveyance
                                                    expiration date
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
                                                >Conveyance Expired Date<span
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
                                                        form.errors
                                                            .conveyance_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .conveyance_exp_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                    </div>
                                    <!-- Filcom Fab -->
                                    <div class="grid grid-cols-2 gap-8 mb-1">
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
                                                >Filcom Fab Registered Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="filcomFab"
                                                name="filcomFab"
                                                class="flex flex-col gap-1"
                                            >
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="filcomFab"
                                                        v-model="
                                                            form.filcom_fab_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="filcomFab"
                                                        placeholder="Filcom Fab Date"
                                                        :disabled="!tructorId"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="
                                                        form.errors
                                                            .conveyance_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .conveyance_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <div
                                            v-if="isFilcomExpired"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="filcomFab"
                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                >Filcom Fab Expired Date<span
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
                                                    Updating Filcom expiration
                                                    date
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
                                                >Filcom Fab Expired Date<span
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
                                                        form.errors
                                                            .filcon_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .filcon_exp_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                    </div>
                                    <!-- LTFRB -->
                                    <div class="grid grid-cols-2 gap-8 mb-1">
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
                                                >LTFRB Registered Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="LTFRBReg"
                                                name="LTFRBReg"
                                                class="flex flex-col gap-1"
                                            >
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="LTFRBReg"
                                                        v-model="
                                                            form.ltfrb_reg_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="LTFRBReg"
                                                        placeholder="LTFRB Date"
                                                        :disabled="!tructorId"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="
                                                        form.errors
                                                            .ltfrb_reg_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .ltfrb_reg_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <div
                                            v-if="isLftbExpired"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="LTFRBExp"
                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                >LTFRB Expired Date<span
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
                                                    Updating LTFRB expiration
                                                    date
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
                                                >LTFRB Expired Date<span
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
                                                        form.errors
                                                            .ltfrb_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .ltfrb_exp_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        for="Plate_number"
                                        class="text-gray-700 dark:text-surface-0 text-2xl font-medium mb-4 block"
                                        >Payment Details
                                    </label>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="flex flex-row gap-x-4">
                                            <div class="w-full">
                                                <label
                                                    for="remarks"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Cost<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="remarks"
                                                    name="remarks"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputNumber
                                                        v-model="form.cost"
                                                        placeholder="Cost"
                                                        mode="currency"
                                                        currency="PHP"
                                                        class="w-full"
                                                    />
                                                    <Message
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                    }}</Message>
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="ltoRegDate"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Expense Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="ltoRegDate"
                                                    name="ltoRegDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <DatePicker
                                                        id="calibDate"
                                                        v-model="
                                                            form.expenses_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="registrationExp"
                                                        placeholder="Expense Date"
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .expenses_date
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .expenses_date
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label
                                                for="remarks"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Remarks<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="remarks"
                                                name="remarks"
                                                class="flex flex-col gap-1"
                                            >
                                                <Textarea
                                                    v-model="form.remarks"
                                                    variant="filled"
                                                    rows="2"
                                                    cols="30"
                                                    placeholder="Remarks"
                                                />
                                                <Message
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                }}</Message>
                                            </FormField>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <label
                                        for="remarks"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Upload Scan Documents<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FileUpload
                                        name="demo[]"
                                        url="/api/upload"
                                        @upload="onAdvancedUpload($event)"
                                        :multiple="true"
                                        accept="image/*"
                                        :maxFileSize="1000000"
                                    >
                                        <template #empty>
                                            <span
                                                >Drag and drop files to here to
                                                upload.</span
                                            >
                                        </template>
                                    </FileUpload>
                                </div>
                            </div>
                            <div class="mt-11 mb-11" v-else-if="truck === '2'">
                                <div>
                                    <label
                                        for="Plate_number"
                                        class="text-gray-700 dark:text-surface-0 text-2xl font-medium mb-4 block"
                                        >Registration Details
                                    </label>
                                    <div class="grid grid-cols-2 gap-8 mb-1">
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
                                                >LTO Registered Date<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="ltoRegDate"
                                                name="ltoRegDate"
                                                class="flex flex-col gap-1"
                                            >
                                                <DatePicker
                                                    id="calibDate"
                                                    v-model="form.lto_reg_date"
                                                    showIcon
                                                    fluid
                                                    :showOnFocus="false"
                                                    inputId="registrationExp"
                                                    placeholder="LTO Registration Date"
                                                    :disabled="!trailerId"
                                                />
                                                <Message
                                                    v-if="
                                                        form.errors.lto_reg_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors.lto_reg_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <!-- LTO Expired date -->
                                        <div
                                            v-if="isLtoTrailerExpired === 1"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="LTOExpDate"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >LTO Expired Date<span
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
                                                    v-model="form.lto_exp_date"
                                                    class="!border-red-500 !bg-gray-50"
                                                />
                                                <Message
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                >
                                                    Updating LTO expiration date
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
                                                >LTO Expired Date<span
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
                                                    v-model="form.lto_exp_date"
                                                    class="!bg-gray-50"
                                                />
                                                <Message
                                                    v-if="
                                                        form.errors.lto_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                >
                                                    {{
                                                        form.errors.lto_exp_date
                                                    }}
                                                </Message>
                                            </FormField>
                                        </div>
                                    </div>
                                    <!-- Calibration -->
                                    <div class="grid grid-cols-2 gap-8 mb-1">
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
                                                >Calibration Registered
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
                                                <div class="flex-auto">
                                                    <DatePicker
                                                        id="conveyDate"
                                                        v-model="
                                                            form.calibration_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="conveyDate"
                                                        placeholder="Calibraton Expired Date"
                                                        :disabled="!trailerId"
                                                    />
                                                </div>
                                                <Message
                                                    v-if="
                                                        form.errors
                                                            .calibration_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .calibration_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                        <!-- Calibration Expired date -->
                                        <div
                                            v-if="isCalibrationExpired === 1"
                                            class="w-full mb-2"
                                        >
                                            <label
                                                for="conExpdate"
                                                class="text-gray-700 dark:text-surface-50 text-sm font-medium mb-2 block"
                                                >Calibration Expired Date<span
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
                                                    placeholder="Calibration Expired Date"
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
                                                    Updating Calibration
                                                    expiration date
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
                                                >Calibration Expired Date<span
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
                                                    placeholder="Calibration Expired Date"
                                                    v-model="
                                                        form.calibration_exp_date
                                                    "
                                                    class="!bg-gray-50"
                                                />
                                                <Message
                                                    v-if="
                                                        form.errors
                                                            .calibration_exp_date
                                                    "
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                        form.errors
                                                            .calibration_exp_date
                                                    }}</Message
                                                >
                                            </FormField>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        for="Plate_number"
                                        class="text-gray-700 dark:text-surface-0 text-2xl font-medium mb-4 block"
                                        >Payment Details
                                    </label>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="flex flex-row gap-x-4">
                                            <div class="w-full">
                                                <label
                                                    for="remarks"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Cost<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="remarks"
                                                    name="remarks"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <InputNumber
                                                        v-model="form.cost"
                                                        placeholder="Cost"
                                                        mode="currency"
                                                        currency="PHP"
                                                        class="w-full"
                                                    />
                                                    <Message
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                    }}</Message>
                                                </FormField>
                                            </div>
                                            <div class="w-full">
                                                <label
                                                    for="ltoRegDate"
                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                    >Expense Date<span
                                                        class="ml-1 text-red-400"
                                                        >*</span
                                                    ></label
                                                >
                                                <FormField
                                                    id="ltoRegDate"
                                                    name="ltoRegDate"
                                                    class="flex flex-col gap-1"
                                                >
                                                    <DatePicker
                                                        id="calibDate"
                                                        v-model="
                                                            form.expenses_date
                                                        "
                                                        showIcon
                                                        fluid
                                                        :showOnFocus="false"
                                                        inputId="registrationExp"
                                                        placeholder="Expense Date"
                                                    />
                                                    <Message
                                                        v-if="
                                                            form.errors
                                                                .expenses_date
                                                        "
                                                        severity="error"
                                                        size="small"
                                                        variant="simple"
                                                        >{{
                                                            form.errors
                                                                .expenses_date
                                                        }}</Message
                                                    >
                                                </FormField>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label
                                                for="remarks"
                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                >Remarks<span
                                                    class="ml-1 text-red-400"
                                                    >*</span
                                                ></label
                                            >
                                            <FormField
                                                id="remarks"
                                                name="remarks"
                                                class="flex flex-col gap-1"
                                            >
                                                <Textarea
                                                    v-model="form.remarks"
                                                    variant="filled"
                                                    rows="2"
                                                    cols="30"
                                                    placeholder="Remarks"
                                                />
                                                <Message
                                                    severity="error"
                                                    size="small"
                                                    variant="simple"
                                                    >{{
                                                }}</Message>
                                            </FormField>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <label
                                        for="remarks"
                                        class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                        >Upload Scan Documents<span
                                            class="ml-1 text-red-400"
                                            >*</span
                                        ></label
                                    >
                                    <FileUpload
                                        name="demo[]"
                                        url="/api/upload"
                                        @upload="onAdvancedUpload($event)"
                                        :multiple="true"
                                        accept="image/*"
                                        :maxFileSize="1000000"
                                    >
                                        <template #empty>
                                            <span
                                                >Drag and drop files to here to
                                                upload.</span
                                            >
                                        </template>
                                    </FileUpload>
                                </div>
                            </div>
                        </div>
                        <Button
                            label="UPDATE"
                            type="submit"
                            icon="pi pi-pencil"
                            class="w-full"
                        />
                    </form>
                </div>
            </div></div
    ></AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, watch, nextTick, computed } from "vue";
import dayjs from "dayjs";

import RadioButton from "primevue/radiobutton";
import AutoComplete from "primevue/autocomplete";
import DatePicker from "primevue/datepicker";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Message from "primevue/message";
import InputNumber from "primevue/inputnumber";
import Textarea from "primevue/textarea";
import FileUpload from "primevue/fileupload";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";

const props = defineProps({
    tructor: {
        type: Array,
        required: true,
    },
    trailer: {
        type: Array,
        required: true,
    },
});

const toast = useToast();
const truck = ref(""); // Tracks selected vehicle type
const tructors = ref([]);
const trailers = ref([]);

const tructorId = ref(null);
const trailerId = ref(null);
const cost = ref(0);
const remarks = ref("");
const expenses_date = ref(null);

const form = useForm({
    id: null,
    lto_reg_date: null,
    lto_exp_date: null,
    conveyance_date: null,
    conveyance_exp_date: null,
    filcom_fab_date: null,
    filcon_exp_date: null,
    ltfrb_reg_date: null,
    ltfrb_exp_date: null,
    calibration_date: null,
    calibration_exp_date: null,
    cost: 0,
    remarks: "",
    expenses_date: null,
    truckId: null,
});

const isLtoTractorExpired = computed(() => {
    const selectedTractor = props.tructor.find((v) => v.id === tructorId.value);
    return selectedTractor ? selectedTractor.lto_is_Expired === 1 : false;
});

const isconveyanceExpired = computed(() => {
    const selectedTractor = props.tructor.find((v) => v.id === tructorId.value);
    return selectedTractor
        ? selectedTractor.conveyance_is_Expired === 1
        : false;
});

const isFilcomExpired = computed(() => {
    const selectedTractor = props.tructor.find((v) => v.id === tructorId.value);
    return selectedTractor ? selectedTractor.filcon_is_Expired === 1 : false;
});

const isLftbExpired = computed(() => {
    const selectedTractor = props.tructor.find((v) => v.id === tructorId.value);
    return selectedTractor ? selectedTractor.ltfrb_is_Expired === 1 : false;
});

const isLtoTrailerExpired = computed(() => {
    const selectedTrailer = props.trailer.find((v) => v.id === trailerId.value);
    console.log(selectedTrailer);

    return selectedTrailer ? selectedTrailer.lto_is_Expired === 1 : false;
});

console.log(isLtoTrailerExpired.value);

const isCalibrationExpired = computed(() => {
    const selectedTrailer = props.trailer.find((v) => v.id === trailerId.value);
    return selectedTrailer
        ? selectedTrailer.calibration_is_Expired === 1
        : false;
});

// Populate dropdowns
const tructorNameSearch = () => {
    tructors.value = props.tructor.map((tructor) => ({
        id: tructor.id,
        name: tructor.license_plate,
    }));
};

const trailerNameSearch = () => {
    trailers.value = props.trailer.map((trailer) => ({
        id: trailer.id,
        name: trailer.license_plate,
    }));
};

// When a tractor is selected
const onTructorSelect = async (event) => {
    const selectedTractor = props.tructor.find((v) => v.id === event.value.id);

    if (selectedTractor) {
        tructorId.value = selectedTractor.id;

        // Reset form and assign only the selected tractor
        Object.assign(
            form,
            useForm({
                id: selectedTractor.id,
                lto_reg_date: selectedTractor.lto_reg_date,
                conveyance_date: selectedTractor.conveyance_date,
                filcom_fab_date: selectedTractor.filcom_fab_date,
                ltfrb_reg_date: selectedTractor.ltfrb_reg_date,
                lto_exp_date: selectedTractor.lto_exp_date,
                conveyance_exp_date: selectedTractor.conveyance_exp_date,
                filcon_exp_date: selectedTractor.filcon_exp_date,
                ltfrb_exp_date: selectedTractor.ltfrb_exp_date,
                cost: cost.value,
                expenses_date: expenses_date.value,
                remarks: remarks.value,
                truckId: truck.value,
            })
        );
        await nextTick(); // Ensures UI updates reactively
    }
};

// When a trailer is selected
const onTrailerSelect = async (event) => {
    const selectedTrailer = props.trailer.find((v) => v.id === event.value.id);

    if (selectedTrailer) {
        trailerId.value = selectedTrailer.id;

        // Reset form and assign only the selected trailer
        Object.assign(
            form,
            useForm({
                id: selectedTrailer.id,
                lto_reg_date: selectedTrailer.lto_reg_date,
                calibration_date: selectedTrailer.calibration_date,
                lto_exp_date: selectedTrailer.lto_exp_date,
                calibration_exp_date: selectedTrailer.calibration_exp_date,
                cost: cost.value,
                expenses_date: expenses_date.value,
                remarks: remarks.value,
                truckId: truck.value,
            })
        );
        await nextTick();
    }
};

// Submit function (ensuring only the selected vehicle is sent)
const submit = () => {
    console.log("Submitting Form Data:", form); // Debugging output

    form.put(route("registration.update", form.id), {
        preserveState: true,
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Registration updated successfully!",
                life: 3000,
            });
        },
        onError: (errors) => {
            console.error(errors); // Debugging
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
    () => form.expenses_date,
    (newValue) => {
        if (newValue) {
            form.expenses_date = dayjs(newValue).format("YYYY-MM-DD");
        }
    }
);

watch(truck, (newVal) => {
    if (newVal !== "1") {
        tructorId.value = "";

        if (tructors.value.length > 0) {
            tructors.value[0].name = "";
        }
    } else if (newVal !== "2") {
        trailerId.value = "";

        if (trailers.value.length > 0) {
            trailers.value[0].name = "";
        }
    }
});
</script>
