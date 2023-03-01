<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import IncomeTable from "@/Components/IncomeTable.vue";

defineProps({
    incomes: Array,
});

</script>

<template>
    <Head title="Income" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Income</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 relative overflow-x-auto shadow-md sm:rounded-lg">

                       <IncomeTable :incomes="incomes"/>

                      </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
