<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from "@inertiajs/vue3";
import CreateCashFlowForm from "@/Components/CreateCashFlowForm.vue";

const formdata = {
    amount: Math.floor(Math.random() * 10000),
    entry_date: '12/12/1020',
    description: ['Bought ice cream', 'Groceries', 'Paid the chief', 'Paid taxes'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
    category: ['home', 'work', 'school', 'gov'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
};

// const form = useForm({
//     amount: '',
//     entry_date: '',
//     description: '',
//     category: '',
// });

const submit = () => {
    form.post(route('expenses.store'));
};
</script>

<template>
    <Head title="Create Expense" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Expense</h2>
        </template>

        <CreateCashFlowForm postroute="expenses" :formdata="formdata"/>
    </AuthenticatedLayout>
</template>
