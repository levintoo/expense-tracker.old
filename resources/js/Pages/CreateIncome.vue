<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from "@inertiajs/vue3";
import CreateCashFlowForm from "@/Components/CreateCashFlowForm.vue";

const formdata = {
    amount: Math.floor(Math.random()*10000),
    entry_date: '12/12/1020',
    description: ['Paid by Omollo', 'Cookie Business', 'Salary', 'Bank interest'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
    category: ['home', 'work', 'school', 'gov'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
};
</script>

<template>
    <Head title="Create Income" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Income</h2>
        </template>

        <CreateCashFlowForm postroute="income" :formdata="formdata"/>

    </AuthenticatedLayout>
</template>
