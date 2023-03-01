<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ExpensesTable from "@/Components/ExpensesTable.vue";

defineProps({
    expenses: Array,
});
</script>

<template>
    <Head title="Expenses" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Expenses</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                        <ExpensesTable :expenses="expenses"/>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
