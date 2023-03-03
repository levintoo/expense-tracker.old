<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryLink from "@/Components/SecondaryLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, Head} from "@inertiajs/vue3";

const form = useForm({
    amount: Math.floor(Math.random()*10000),
    entry_date: '12/12/1020',
    description: ['Paid by Omollo', 'Cookie Business', 'Salary', 'Bank interest'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
    category: ['home', 'work', 'school', 'gov'][Math.floor(Math.random() * ['Elephant', 'Lion', 'Zebra', 'Croc'].length)],
});

// const form = useForm({
//     amount: '',
//     entry_date: '',
//     description: '',
//     category: '',
// });

const submit = () => {
    form.post(route('income.store'));
};
</script>

<template>
    <Head title="Create Income" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Income</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <SecondaryLink :href="route('income')" >Back</SecondaryLink>

                        <form  @submit.prevent="submit" class="mt-4">
                            <div class="mt-3">
                                <InputLabel for="amount" >Amount</InputLabel>

                                <TextInput
                                    id="amount"
                                    type="text"
                                    class="mt-2 block w-full"
                                    v-model="form.amount"
                                    autofocus
                                    autocomplete="amount"
                                    placeholder="100"
                                />

                                <InputError class="mt-2" :message="form.errors.amount" />

                            </div>
                            <div class="mt-3">
                                <InputLabel for="entry_date" >Entry Date</InputLabel>

                                <TextInput
                                    id="entry_date"
                                    type="text"
                                    class="mt-2 block w-full"
                                    v-model="form.entry_date"
                                    autofocus
                                    autocomplete="entry_date"
                                    placeholder="12/12/2021"
                                />

                                <InputError class="mt-2" :message="form.errors.entry_date" />

                            </div>
                            <div class="mt-3">
                                <InputLabel for="description" >Description</InputLabel>

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-2 block w-full"
                                    v-model="form.description"
                                    autofocus
                                    autocomplete="description"
                                    placeholder="brief description"
                                />

                                <InputError class="mt-2" :message="form.errors.description" />

                            </div>
                            <div class="mt-3">
                                <InputLabel for="category" >Category</InputLabel>

                                <TextInput
                                    id="category"
                                    type="text"
                                    class="mt-2 block w-full"
                                    v-model="form.category"
                                    autofocus
                                    autocomplete="category"
                                    placeholder="work"
                                />

                                <InputError class="mt-2" :message="form.errors.category" />

                            </div>
                            <div class="flex items-center mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
