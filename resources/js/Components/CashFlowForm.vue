<script setup>
import SecondaryLink from "@/Components/SecondaryLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from "@inertiajs/vue3";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    postRoute: String,
    categories: Array,
});

const form = useForm({
    amount: '',
    entry_date: '',
    description: '',
    category: '',
});

const submit = () => {
    form.post(route(props.postRoute+'.store'));
};
</script>

<template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <SecondaryLink :href="route(props.postRoute)" >Back</SecondaryLink>

                        <form  @submit.prevent="submit" class="mt-4">
                            <div class="mt-3">
                                <InputLabel for="amount" >Amount</InputLabel>

                                <TextInput
                                    id="amount"
                                    type="number"
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
                                    type="date"
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

                                <SelectInput
                                    id="category"
                                    class="mt-2 block w-full"
                                    v-model="form.category"
                                    autofocus
                                >
                                    <option value="">Select</option>
                                    <option v-for="category_option in categories" :value="`${ categories.indexOf(category_option) }`">{{ category_option }}</option>
                                </SelectInput>


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
</template>
