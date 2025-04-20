<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Expenses Report
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md p-4">
                <div class="card flex gap-4 justify-between mb-5">
                    <DatePicker
                        v-model="dates"
                        selectionMode="range"
                        :manualInput="false"
                        placeholder="Select Date Range"
                        showIcon
                    />
                    <Button
                        icon="pi pi-refresh"
                        label="Refresh"
                        class="w-[100px]"
                        @click="refresh"
                    />
                </div>
                <div class="flex flex-row gap-x-8 mb-6">
                    <div class="flex items-center gap-2">
                        <RadioButton
                            v-model="truck"
                            inputId="ingredient1"
                            name="truck"
                            value="1"
                        />
                        <label for="ingredient1">TRACTOR HEAD</label>
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
                <div class="mb-4">
                    <!-- Vehicle Selection -->
                    <AutoComplete
                        v-if="truck === '1'"
                        v-model="vehicle"
                        dropdown
                        :suggestions="vehicles"
                        optionLabel="license_plate"
                        @complete="searchVehicles"
                        placeholder="Select Tractor"
                        class="w-full"
                    />
                    <AutoComplete
                        v-else
                        v-model="trailer"
                        dropdown
                        :suggestions="trailers"
                        optionLabel="license_plate"
                        @complete="searchTrailer"
                        placeholder="Select Trailer"
                        class="w-full"
                    />

                    <!-- Generate Report Button -->
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Vehicle Selection -->
                    <InputNumber
                        v-model="form.min_cost"
                        placeholder="Min Amount"
                        mode="currency"
                        currency="PHP"
                        class="w-full"
                    />

                    <!-- Max Cost -->
                    <InputNumber
                        v-model="form.max_cost"
                        placeholder="Max Amount"
                        mode="currency"
                        currency="PHP"
                        class="w-full"
                    />
                    <!-- Generate Report Button -->
                </div>
                <div class="w-full">
                    <AutoComplete
                        dropdown
                        :suggestions="categories"
                        optionLabel="name"
                        @item-select="onCategorySelect"
                        @complete="searchCategory"
                        placeholder="Select Category"
                        class="w-full"
                    />
                </div>
                <Button
                    @click="submitForm"
                    label="Generate Report"
                    class="p-button-primary w-full my-5"
                />

                <Dialog
                    v-model:visible="visible"
                    modal
                    header="Paper Setup"
                    :style="{ width: '22rem' }"
                >
                    <div class="flex flex-col gap-3">
                        <!-- Paper Size Dropdown -->
                        <AutoComplete
                            dropdown
                            v-model="papersize"
                            :suggestions="size"
                            @complete="paperSize"
                            placeholder="Select Paper Size"
                            class="w-full"
                        />

                        <!-- Orientation Fieldset -->
                        <Fieldset legend="Orientation" class="mt-2">
                            <div
                                class="grid grid-cols-2 gap-4 items-center justify-center text-center"
                            >
                                <!-- Portrait -->
                                <div
                                    @click="selectedOrientation = 'portrait'"
                                    :class="[
                                        'flex flex-col items-center cursor-pointer transition border rounded-lg p-2',
                                        selectedOrientation === 'portrait'
                                            ? 'border-blue-500 ring-2 ring-blue-300 bg-blue-50'
                                            : 'border-gray-300',
                                    ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 16 16"
                                    >
                                        <!-- Icon from Qlementine Icons by Olivier Cléro - https://github.com/oclero/qlementine-icons/blob/master/LICENSE -->
                                        <path
                                            fill="currentColor"
                                            fill-rule="evenodd"
                                            d="M8 6c.233 0 .442.134.525.338l2.44 5.95c.111.271-.034.574-.324.678s-.615-.032-.726-.303l-.665-1.66H6.76l-.665 1.66c-.111.271-.436.406-.726.303s-.435-.407-.324-.678l2.44-5.95A.56.56 0 0 1 8.01 6zm0 1.88L8.847 10h-1.69l.847-2.12z"
                                            clip-rule="evenodd"
                                        />
                                        <path
                                            fill="currentColor"
                                            fill-rule="evenodd"
                                            d="M2.33 1.64c-.327.642-.327 1.48-.327 3.16v6.4c0 1.68 0 2.52.327 3.16a3.02 3.02 0 0 0 1.31 1.31c.642.327 1.48.327 3.16.327h2.4c1.68 0 2.52 0 3.16-.327a3 3 0 0 0 1.31-1.31c.327-.642.327-1.48.327-3.16V4.83c0-.489 0-.734-.055-.964a2 2 0 0 0-.24-.578c-.123-.202-.296-.375-.642-.721L11.43.937c-.346-.346-.52-.519-.721-.643a2 2 0 0 0-.578-.239C9.9 0 9.656 0 9.167 0h-2.37c-1.68 0-2.52 0-3.16.327a3.02 3.02 0 0 0-1.31 1.31zm2.58 13.3c.45.037 1.03.038 1.89.038h2.4c.857 0 1.44-.001 1.89-.038c.438-.036.663-.101.819-.18c.376-.192.682-.498.874-.874c.08-.156.145-.381.18-.819c.037-.45.038-1.03.038-1.89v-6.2H9.5a.5.5 0 0 1-.5-.5v-3.5H6.8c-.857 0-1.44 0-1.89.038c-.438.035-.663.1-.82.18a2 2 0 0 0-.873.874c-.08.156-.145.38-.18.819C3 3.338 3 3.918 3 4.778v6.4c0 .857 0 1.44.038 1.89c.035.438.1.663.18.819c.192.376.498.682.874.874c.156.08.38.145.819.18zm7.94-11.2a1 1 0 0 1 .092.194h-2.94V.994a1 1 0 0 1 .194.092c.077.047.156.117.536.497l1.63 1.63c.38.38.45.459.497.536z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span class="text-xs mt-1">PORTRAIT</span>
                                </div>

                                <!-- Landscape -->
                                <div
                                    @click="selectedOrientation = 'landscape'"
                                    :class="[
                                        'flex flex-col items-center cursor-pointer transition border rounded-lg p-2',
                                        selectedOrientation === 'landscape'
                                            ? 'border-blue-500 ring-2 ring-blue-300 bg-blue-50'
                                            : 'border-gray-300',
                                    ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 16 16"
                                    >
                                        <!-- Icon from Qlementine Icons by Olivier Cléro - https://github.com/oclero/qlementine-icons/blob/master/LICENSE -->
                                        <path
                                            fill="currentColor"
                                            fill-rule="evenodd"
                                            d="M6 5c.233 0 .442.134.525.338l2.44 5.95c.111.271-.034.574-.324.678s-.615-.032-.726-.303l-.665-1.66H4.76l-.665 1.66c-.111.271-.436.406-.726.303s-.435-.407-.324-.678l2.44-5.95A.56.56 0 0 1 6.01 5zm0 1.88L6.847 9h-1.69l.847-2.12z"
                                            clip-rule="evenodd"
                                        />
                                        <path
                                            fill="currentColor"
                                            fill-rule="evenodd"
                                            d="M14.4 2.33c-.642-.327-1.48-.327-3.16-.327h-6.4c-1.68 0-2.52 0-3.16.327A3.02 3.02 0 0 0 .37 3.64C.043 4.282.043 5.12.043 6.8v2.4c0 1.68 0 2.52.327 3.16a3.02 3.02 0 0 0 1.31 1.31c.642.327 1.48.327 3.16.327h6.37c.489 0 .734 0 .964-.055q.308-.075.578-.24c.202-.123.375-.296.721-.642l1.63-1.63c.346-.346.519-.52.643-.721q.165-.271.239-.578c.055-.23.055-.475.055-.964v-2.37c0-1.68 0-2.52-.327-3.16a3 3 0 0 0-1.31-1.31zM1 6.8v2.4c0 .857 0 1.44.038 1.89c.035.438.1.663.18.819c.192.376.498.682.874.874c.156.08.38.145.819.18c.45.037 1.03.038 1.89.038H11V9.5a.5.5 0 0 1 .5-.5H15V6.8c0-.857-.001-1.44-.038-1.89c-.036-.438-.101-.663-.18-.82a2 2 0 0 0-.874-.873c-.156-.08-.381-.145-.819-.18C12.64 3 12.06 3 11.2 3H4.8c-.857 0-1.44 0-1.89.038c-.438.035-.663.1-.819.18a2 2 0 0 0-.874.874c-.08.156-.145.38-.18.819C1 5.36.999 5.94.999 6.8zm11.2 6.05a1 1 0 0 1-.194.092v-2.94h2.94a1 1 0 0 1-.092.194c-.047.077-.117.156-.497.536l-1.63 1.63c-.38.38-.459.45-.536.497z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span class="text-xs mt-1">LANDSCAPE</span>
                                </div>
                            </div>
                        </Fieldset>

                        <!-- Proceed Button -->
                        <Button
                            type="button"
                            label="Proceed"
                            class="w-full mt-4"
                            @click="exportPDF(selectedOrientation, papersize)"
                        />
                    </div>
                </Dialog>

                <!-- Data Table -->
                <DataTable
                    :value="expensesFilter"
                    paginator
                    :rows="5"
                    :rowsPerPageOptions="[5, 10, 20, 50]"
                    tableStyle="min-width: 50rem"
                    ref="dt"
                >
                    <template #header>
                        <div class="flex flex-row gap-2 justify-end pb-4">
                            <Button
                                icon="pi pi-file-pdf"
                                label="PDF"
                                severity="danger"
                                class="w-[100px]"
                                @click="visible = true"
                            />
                            <Button
                                icon="pi pi-external-link"
                                label="Export"
                                @click="exportCSV($event)"
                            />
                        </div>
                    </template>
                    <Column
                        :field="
                            truck === '1'
                                ? 'tractor.license_plate'
                                : 'trailer.license_plate'
                        "
                        :header="truck === '1' ? 'Tractor' : 'Trailer'"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="category.name"
                        header="Category"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="amount"
                        header="Amount"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="expense_date"
                        header="Expense Date"
                        style="width: 15%"
                    ></Column>
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";
import DatePicker from "primevue/datepicker";
import AutoComplete from "primevue/autocomplete";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import InputNumber from "primevue/inputnumber";
import InputText from "primevue/inputtext";
import RadioButton from "primevue/radiobutton";
import Dialog from "primevue/dialog";
import Fieldset from "primevue/fieldset";

const { filters } = usePage().props;

// Reactive form data
const form = useForm({
    start_date: filters?.start_date || null,
    end_date: filters?.end_date || null,
    vehicle: filters?.vehicle || null,
    trailer: filters?.trailer || null,
    categoryId: filters?.categoryId || null,
    min_cost: filters?.min_cost || null,
    max_cost: filters?.max_cost || null,
});
// Variables for input fields
const dt = ref();
const vehicle = ref(null);
const truck = ref("1");
const trailer = ref(null);
const categoryId = ref(null);
const dates = ref(null);
const visible = ref(false);
const size = ref([]);
const papersize = ref(null);
const selectedOrientation = ref(null);

const props = defineProps({
    expensesFilter: {
        type: Object,
        required: true,
    },
    tractor: {
        type: Array,
        required: true,
    },
    trailer: {
        type: Array,
        required: true,
    },
    category: {
        type: Object,
        required: true,
    },
});

const submitForm = () => {
    if (dates.value && dates.value.length === 2) {
        form.start_date = dates.value[0]; // First selected date
        form.end_date = dates.value[1]; // Last selected date
    } else {
        form.start_date = null;
        form.end_date = null;
    }

    form.vehicle = vehicle.value;
    form.trailer = trailer.value;
    form.categoryId = categoryId.value;

    // Send request to fetch filtered data
    form.get(route("reports.expensesfilter"), {
        preserveState: true,
        preserveScroll: true,
    });
};

// Driver and Vehicle lists
const trailers = ref([]);
const vehicles = ref([]);
const categories = ref([]);

// Search filters
const searchDrivers = (event) => {
    const query = event.query.toLowerCase();
    drivers.value = ["Rigor Dimayuga", "Jonas Smitman", "Luis Manzano"].filter(
        (d) => d.toLowerCase().includes(query)
    );
};

const searchVehicles = (event) => {
    const query = event.query.toLowerCase();
    vehicles.value = props.tractor.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const searchTrailer = (event) => {
    const query = event.query.toLowerCase();
    trailers.value = props.trailer.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const searchCategory = (event) => {
    const query = event.query.toLowerCase();

    if (Array.isArray(props.category) && props.category.length > 0) {
        categories.value = props.category
            .filter((cat) => cat.name.toLowerCase().includes(query))
            .map((cat) => ({
                id: cat.id,
                name: cat.name,
            }));
    }
};

const onCategorySelect = (event) => {
    categoryId.value = event.value.id;
};

const exportCSV = () => {
    dt.value.exportCSV();
};

const exportPDF = (orientation, paperSize) => {
    const rawOrientation =
        typeof orientation === "object" ? orientation.value : orientation;
    const rawPaperSize =
        typeof papersize === "object" ? papersize.value : paperSize;

    if (!rawOrientation || !rawPaperSize) {
        alert("Please select orientation and paper size.");
        return;
    }

    const expensesData = props.expensesFilter.map((expenses) => ({
        vehicle: expenses.tractor?.license_plate ?? "",
        trailer: expenses.trailer?.license_plate ?? "",
        category: expenses.category?.name ?? "",
        amount: expenses?.amount ?? "",
        expenses_date: expenses?.expense_date ?? "",
    }));

    visible.value = false;

    axios
        .post(
            route("reports.expensespdf"),
            {
                expenses: expensesData,
                orientation: rawOrientation,
                papersize: rawPaperSize,
            },

            { responseType: "blob" }
        )
        .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "expenses_report.pdf");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch((error) => {
            console.error("PDF export failed", error);
        });
};

const paperSize = () => {
    size.value = ["a4", "letter", "legal"];
};

const refresh = () => {
    router.get("/reports/expenses");
};
</script>
