<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DashboardBriefReport from "@/Components/DashboardBriefReport.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {onMounted} from "vue";

const props = defineProps({
    data: Array,
});

const form = useForm({
    start_date: '',
    end_date: '',
});

const submit = () => {
    console.log("submitting...",form.start_date,form.end_date)
};

onMounted(() => {
    console.log(props.data.categories.income.work)
});
</script>
<template>
    <Head title="Monthly Report"/>

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h3>
        </template>

        <DashboardBriefReport>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Filter Report</h1>

            <form  @submit.prevent="submit" class="mt-4 flex">
            <div class="m-3">
                <InputLabel for="start_date" >Start Date</InputLabel>

                <TextInput
                    id="start_date"
                    type="date"
                    class="mt-2 block w-full"
                    v-model="form.start_date"
                    autofocus
                    autocomplete="start_date"
                    placeholder="12/12/2021"
                />

                <InputError class="mt-2" :message="form.errors.start_date" />

            </div>
            <div class="m-3">
                <InputLabel for="end_date" >End Date</InputLabel>

                <TextInput
                    id="end_date"
                    type="date"
                    class="mt-2 block w-full"
                    v-model="form.end_date"
                    autofocus
                    autocomplete="end_date"
                    placeholder="12/12/2021"
                />

                <InputError class="mt-2" :message="form.errors.end_date" />

            </div>
                <div class="m-3 flex  pt-7">

                <PrimaryButton class="justify-end">Search</PrimaryButton>

                </div>
            </form>
        </DashboardBriefReport>

        <DashboardBriefReport>
            <div class="p-6 text-gray-900">Income: <span class="p-3 text-green-500">{{ props.data.income }}$</span></div>
            <div class="p-6 text-gray-900">Expenses: <span class="p-3 text-red-500">{{ props.data.expenses }}$</span></div>
            <div class="p-6 text-gray-900">Profit: <span class="p-3 text-gray-500">{{ props.data.profit }}$</span></div>
        </DashboardBriefReport>


        <DashboardBriefReport>
            <div class="p-6 text-gray-900">
                Income by category
                <span class="p-3 text-gray-500">
                    ({{ props.data.income_categories_count }} categories)
                </span>
            </div>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Records
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="income_category in props.data.categories.income"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="px-6 py-4">
                        {{ income_category.count }}
                    </td>
                    <td class="px-6 py-4">
                        {{ income_category.name }}
                    </td> <td class="px-6 py-4">
                        {{ income_category.amount }}

                    </td>
                </tr>
                </tbody>
            </table>
        </DashboardBriefReport>

        <DashboardBriefReport>
            <div class="p-6 text-gray-900">
                Expenses by category
                <span class="p-3 text-gray-500">
                    ({{ props.data.expenses_categories_count }} categories)
                </span>
            </div>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Records
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="expense_category in props.data.categories.expenses"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="px-6 py-4">
                        {{ expense_category.count }}
                    </td>
                    <td class="px-6 py-4">
                        {{ expense_category.name }}
                    </td> <td class="px-6 py-4">
                    {{ expense_category.amount }}

                </td>
                </tr>
                </tbody>
            </table>
        </DashboardBriefReport>


    </AuthenticatedLayout>
</template>
