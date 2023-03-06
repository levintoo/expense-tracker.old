<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from "@inertiajs/vue3";
import CreateCashFlowForm from "@/Components/CreateCashFlowForm.vue";

defineProps({
   categories: Array,
});
</script>

<template>
    <Head title="Create Income" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Income</h2>
        </template>

        <CreateCashFlowForm postroute="income" :categories="categories"/>

    </AuthenticatedLayout>
</template>
