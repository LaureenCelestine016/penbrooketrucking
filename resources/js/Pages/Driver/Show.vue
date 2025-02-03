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
                                            {{ toUpperCase(Driver.first_name) }}
                                            {{
                                                toUpperCase(Driver.middle_name)
                                            }}
                                            {{ toUpperCase(Driver.last_name) }}
                                        </h1>
                                        <span
                                            class="text-white text-xl font-medium tracking-widest"
                                            >DRIVER
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
                                    <label
                                        class="text-gray-900 dark:text-surface-0 text-xl font-semibold mb-4 block"
                                        >Account Information</label
                                    >
                                    <div class="p-1">
                                        <div class="grid grid-cols-2 mb-4">
                                            <label
                                                for=""
                                                class="font-semibold mr-5"
                                                >Username:</label
                                            >
                                            <span class="">{{
                                                User?.username
                                            }}</span>
                                        </div>

                                        <div class="grid grid-cols-2 mb-4">
                                            <label
                                                for=""
                                                class="font-semibold mr-5"
                                                >Fullname:</label
                                            >
                                            <span class=""
                                                >{{ Driver.first_name }}
                                                {{ Driver.middle_name }}
                                                {{ Driver.last_name }}</span
                                            >
                                        </div>
                                        <div class="grid grid-cols-2 mb-4">
                                            <label
                                                for=""
                                                class="font-semibold mr-5"
                                                >Contact:</label
                                            >
                                            <span
                                                >{{
                                                    replaceFirstnum(
                                                        Driver.contact_number
                                                    )
                                                }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 mb-4">
                                            <label
                                                for=""
                                                class="font-semibold mr-5"
                                                >Email Address:</label
                                            >
                                            <span class=""
                                                >{{ User?.email }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 mb-4">
                                            <label
                                                for=""
                                                class="font-semibold mr-5"
                                                >Created Date:</label
                                            >
                                            <span class=""
                                                >{{
                                                    formatDate(User?.created_at)
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                </template>
                                <template #footer
                                    ><Button
                                        v-if="Driver.status === 'Active'"
                                        label="Active"
                                        severity="success"
                                        variant="outlined"
                                        icon="pi pi-unlock"
                                        class="btn-active"
                                        @click="
                                            status('Inactive', Driver.id)
                                        " />
                                    <Button
                                        v-else
                                        label="Inactive"
                                        severity="danger"
                                        variant="outlined"
                                        icon="pi pi-lock"
                                        class="btn-inactive"
                                        @click="status('Active', Driver.id)"
                                /></template>
                            </Card>
                            <Card class="card">
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
                                                    >License</span
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
                                                        >Truck Used</span
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
                                                        >Conversation</span
                                                    >
                                                    <Badge value="2" />
                                                </div>
                                            </Tab>
                                        </TabList>
                                        <form @submit.prevent="submit" class="">
                                            <TabPanels>
                                                <TabPanel
                                                    value="0"
                                                    as="p"
                                                    class="m-0"
                                                >
                                                    <Accordion
                                                        :value="['0']"
                                                        multiple
                                                    >
                                                        <AccordionPanel
                                                            value="0"
                                                        >
                                                            <AccordionHeader
                                                                class="title"
                                                                >Personal
                                                                Information</AccordionHeader
                                                            >
                                                            <AccordionContent>
                                                                <div
                                                                    class="grid grid-cols-3 gap-10 mb-4"
                                                                >
                                                                    <!-- firstName -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="First_name"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >First
                                                                            name<span
                                                                                class="ml-1 text-red-400"
                                                                                >*</span
                                                                            ></label
                                                                        >
                                                                        <FormField
                                                                            id="First_name"
                                                                            name="First_name"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.first_name
                                                                                "
                                                                                class="user--input firstName"
                                                                                placeholder="First name"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .first_name
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .first_name
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- middlename -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="Middle_name"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Middle
                                                                            Name
                                                                        </label>
                                                                        <FormField
                                                                            id="Middle_name"
                                                                            name="Middle_name"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.middle_name
                                                                                "
                                                                                placeholder="Middle name"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .middle_name
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .middle_name
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- lastname -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="Last_name"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Last
                                                                            name<span
                                                                                class="ml-1 text-red-400"
                                                                                >*</span
                                                                            ></label
                                                                        >
                                                                        <FormField
                                                                            id="Last_name"
                                                                            name="Last_name"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                placeholder="Last name"
                                                                                class="user--input firstName"
                                                                                v-model="
                                                                                    form.last_name
                                                                                "
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .last_name
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .last_name
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="grid grid-cols-3 gap-10 items-start"
                                                                >
                                                                    <!-- Civil Status -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="civil_status"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Civil
                                                                            Status<span
                                                                                class="ml-1 text-red-400"
                                                                                >*</span
                                                                            ></label
                                                                        >
                                                                        <FormField
                                                                            id="civil_status"
                                                                            name="civil_status"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <AutoComplete
                                                                                id="status"
                                                                                class="w-full"
                                                                                v-model="
                                                                                    form.civil_status
                                                                                "
                                                                                :suggestions="
                                                                                    civilStatus
                                                                                "
                                                                                @complete="
                                                                                    civilStatusSearch
                                                                                "
                                                                                dropdown
                                                                                placeholder="Civil Status"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .civil_status
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .civil_status
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- Birthday && Age -->
                                                                    <div
                                                                        class="flex flex-rows gap-3"
                                                                    >
                                                                        <div
                                                                            class="w-100"
                                                                        >
                                                                            <label
                                                                                for="birthday"
                                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                                >Birthday<span
                                                                                    class="ml-1 text-red-400"
                                                                                    >*</span
                                                                                >
                                                                            </label>
                                                                            <FormField
                                                                                id="birthday"
                                                                                name="birthday"
                                                                                class="flex flex-col gap-1"
                                                                            >
                                                                                <div
                                                                                    class="flex-auto"
                                                                                >
                                                                                    <DatePicker
                                                                                        id="registration_expired"
                                                                                        v-model="
                                                                                            form.birthday
                                                                                        "
                                                                                        showIcon
                                                                                        fluid
                                                                                        :showOnFocus="
                                                                                            false
                                                                                        "
                                                                                        inputId="birthday"
                                                                                        placeholder="Birthday"
                                                                                    />
                                                                                </div>
                                                                                <Message
                                                                                    v-if="
                                                                                        form
                                                                                            .errors
                                                                                            .birthday
                                                                                    "
                                                                                    severity="error"
                                                                                    size="small"
                                                                                    variant="simple"
                                                                                    >{{
                                                                                        form
                                                                                            .errors
                                                                                            .birthday
                                                                                    }}</Message
                                                                                >
                                                                            </FormField>
                                                                        </div>
                                                                        <!-- age -->
                                                                        <div
                                                                            class="w-100"
                                                                        >
                                                                            <label
                                                                                for="age"
                                                                                class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                                >Age<span
                                                                                    class="ml-1 text-red-400"
                                                                                    >*</span
                                                                                ></label
                                                                            >
                                                                            <FormField
                                                                                id="age"
                                                                                name="age"
                                                                                class="flex flex-col gap-1"
                                                                            >
                                                                                <InputText
                                                                                    type="text"
                                                                                    class="class-age"
                                                                                    v-model="
                                                                                        form.age
                                                                                    "
                                                                                    placeholder="Age"
                                                                                />
                                                                                <Message
                                                                                    v-if="
                                                                                        form
                                                                                            .errors
                                                                                            .age
                                                                                    "
                                                                                    severity="error"
                                                                                    size="small"
                                                                                    variant="simple"
                                                                                    >{{
                                                                                        form
                                                                                            .errors
                                                                                            .age
                                                                                    }}</Message
                                                                                >
                                                                            </FormField>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="address"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Address<span
                                                                                class="ml-1 text-red-400"
                                                                                >*</span
                                                                            ></label
                                                                        >
                                                                        <FormField
                                                                            id="address"
                                                                            name="address"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <Textarea
                                                                                v-model="
                                                                                    form.address
                                                                                "
                                                                                variant="filled"
                                                                                rows="2"
                                                                                cols="30"
                                                                                placeholder="Address"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .address
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .address
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>
                                                            </AccordionContent>
                                                        </AccordionPanel>
                                                        <AccordionPanel
                                                            value="1"
                                                        >
                                                            <AccordionHeader
                                                                class="title"
                                                                >Contact
                                                                Information</AccordionHeader
                                                            >
                                                            <AccordionContent>
                                                                <div
                                                                    class="grid grid-cols-2 gap-10 mb-4"
                                                                >
                                                                    <!-- contact_number -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="contact_number"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Contact
                                                                            no.</label
                                                                        >
                                                                        <FormField
                                                                            id="contact_number"
                                                                            name="contact_number"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.contact_number
                                                                                "
                                                                                class="user--input firstName"
                                                                                placeholder="Contact no."
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .contact_number
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .contact_number
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- contact_person -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="contact_person"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Contact
                                                                            Person
                                                                            <span
                                                                                class="text-xs font-thin"
                                                                                >(Incase
                                                                                of
                                                                                Emergency)</span
                                                                            >
                                                                        </label>
                                                                        <FormField
                                                                            id="contact_person"
                                                                            name="contact_person"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.contact_person
                                                                                "
                                                                                placeholder="Contact Person"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .contact_person
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .contact_person
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="grid grid-cols-2 gap-10"
                                                                >
                                                                    <!-- contact_#_person -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="contact_#_person"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Contact
                                                                            no.
                                                                            <span
                                                                                class="text-xs font-thin"
                                                                                >(of
                                                                                Person
                                                                                Incase
                                                                                of
                                                                                Emergency)</span
                                                                            >
                                                                        </label>
                                                                        <FormField
                                                                            id="contact_#_person"
                                                                            name="contact_#_person"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                placeholder="Last name"
                                                                                class="user--input firstName"
                                                                                v-model="
                                                                                    form.contact_no_person
                                                                                "
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .contact_no_person
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .contact_no_person
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="relation"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Relation<span
                                                                                class="ml-1 text-red-400"
                                                                                >*</span
                                                                            ></label
                                                                        >
                                                                        <FormField
                                                                            id="relation"
                                                                            name="relation"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <AutoComplete
                                                                                id="status"
                                                                                class="w-full"
                                                                                v-model="
                                                                                    form.relation
                                                                                "
                                                                                :suggestions="
                                                                                    relation
                                                                                "
                                                                                @complete="
                                                                                    relationSearch
                                                                                "
                                                                                dropdown
                                                                                placeholder="Relation"
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .relation
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .relation
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>
                                                            </AccordionContent>
                                                        </AccordionPanel>
                                                        <AccordionPanel
                                                            value="2"
                                                        >
                                                            <AccordionHeader
                                                                class="title"
                                                                >Government
                                                                Id's</AccordionHeader
                                                            >
                                                            <AccordionContent>
                                                                <div
                                                                    class="grid grid-cols-2 gap-10 mb-4"
                                                                >
                                                                    <!-- Philhealth no. -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="philhealth"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Philhealth
                                                                            no.</label
                                                                        >
                                                                        <FormField
                                                                            id="philhealth"
                                                                            name="philhealth"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                id="philhealth"
                                                                                type="text"
                                                                                v-model="
                                                                                    form.philhealth_no
                                                                                "
                                                                                placeholder="Philhealth no."
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .philhealth_no
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .philhealth_no
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- Pagibig no. -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="pagibig"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >Pagibig
                                                                            no.
                                                                        </label>
                                                                        <FormField
                                                                            id="pagibig"
                                                                            name="pagibig"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.pagibig_no
                                                                                "
                                                                                placeholder="Pagibig no."
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .pagibig_no
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .pagibig_no
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="grid grid-cols-2 gap-10 mb-4"
                                                                >
                                                                    <!-- SSS no. -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="sss_no"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >SSS
                                                                            no.</label
                                                                        >
                                                                        <FormField
                                                                            id="sss_no"
                                                                            name="sss_no"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                id="plate_no"
                                                                                type="text"
                                                                                v-model="
                                                                                    form.sss_no
                                                                                "
                                                                                placeholder="SSS no."
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .sss_no
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .sss_no
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                    <!-- TIN no. -->
                                                                    <div
                                                                        class="w-100"
                                                                    >
                                                                        <label
                                                                            for="tin_no"
                                                                            class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                            >TIN
                                                                            no.
                                                                        </label>
                                                                        <FormField
                                                                            id="tin_no"
                                                                            name="tin_no"
                                                                            class="flex flex-col gap-1"
                                                                        >
                                                                            <InputText
                                                                                type="text"
                                                                                v-model="
                                                                                    form.tin_no
                                                                                "
                                                                                placeholder="TIN no."
                                                                            />
                                                                            <Message
                                                                                v-if="
                                                                                    form
                                                                                        .errors
                                                                                        .tin_no
                                                                                "
                                                                                severity="error"
                                                                                size="small"
                                                                                variant="simple"
                                                                                >{{
                                                                                    form
                                                                                        .errors
                                                                                        .tin_no
                                                                                }}</Message
                                                                            >
                                                                        </FormField>
                                                                    </div>
                                                                </div>
                                                            </AccordionContent>
                                                        </AccordionPanel>
                                                    </Accordion>
                                                </TabPanel>
                                                <TabPanel
                                                    value="1"
                                                    as="p"
                                                    class="m-0 p-4"
                                                >
                                                    <div>
                                                        <label
                                                            class="text-customblue dark:text-surface-0 text-xl font-semibold mb-4 block"
                                                            >License
                                                            Detail</label
                                                        >

                                                        <div
                                                            class="grid grid-cols-2 gap-10 mb-4 items-center"
                                                        >
                                                            <!-- License no.-->
                                                            <div class="w-100">
                                                                <label
                                                                    for="license_no"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >License
                                                                    no.<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    ></label
                                                                >
                                                                <FormField
                                                                    id="license_no"
                                                                    name="license_no"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <InputText
                                                                        id="license_no"
                                                                        type="text"
                                                                        v-model="
                                                                            form.license_number
                                                                        "
                                                                        placeholder="License no."
                                                                    />
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .license_number
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .license_number
                                                                        }}</Message
                                                                    >
                                                                </FormField>
                                                            </div>
                                                            <!-- License Expired Date. -->
                                                            <div class="w-100">
                                                                <label
                                                                    for="license_expired_date"
                                                                    class="text-gray-700 dark:text-surface-0 text-sm font-medium mb-2 block"
                                                                    >License
                                                                    Expired
                                                                    Date<span
                                                                        class="ml-1 text-red-400"
                                                                        >*</span
                                                                    >
                                                                </label>
                                                                <FormField
                                                                    id="license_expired_date"
                                                                    name="license_expired_date"
                                                                    class="flex flex-col gap-1"
                                                                >
                                                                    <div
                                                                        class="flex-auto"
                                                                    >
                                                                        <DatePicker
                                                                            id="registration_expired"
                                                                            v-model="
                                                                                form.license_expired
                                                                            "
                                                                            showIcon
                                                                            fluid
                                                                            :showOnFocus="
                                                                                false
                                                                            "
                                                                            inputId="license_expired"
                                                                            placeholder="Expiration Date"
                                                                        />
                                                                    </div>
                                                                    <Message
                                                                        v-if="
                                                                            form
                                                                                .errors
                                                                                .license_expired
                                                                        "
                                                                        severity="error"
                                                                        size="small"
                                                                        variant="simple"
                                                                        >{{
                                                                            form
                                                                                .errors
                                                                                .license_expired
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
                                                    <div class="card">
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
    Driver: {
        type: Object,
        required: true,
    },
    User: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    ...props.Driver,
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
    grid-template-columns: 350px 1fr;
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
    height: 300px;
}

.card {
    border-radius: 4px;
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
