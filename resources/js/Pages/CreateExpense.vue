<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from "@inertiajs/vue3";
import CreateCashFlowForm from "@/Components/CashFlowForm.vue";

defineProps({
    categories: Array,
});
</script>

<template>
    <Head title="Create Expense" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Expense</h2>
        </template>

        <CreateCashFlowForm postRoute="expenses" :categories="categories"/>
    </AuthenticatedLayout>
</template>
