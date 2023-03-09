<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    data: Array,
    category: String,
    postroute: String,
});

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route(props.postroute+'.delete', id));
    }
}

</script>

<template>

    <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">

        <PrimaryLink :href="route(postroute+'.create')">
            Add {{ category }}
        </PrimaryLink>

        <label class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :placeholder="`Search for ${category}`">
        </div>
    </div>


    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <Checkbox/>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
            <th scope="col" class="px-6 py-3">
                Entry Date
            </th>
            <th scope="col" class="px-6 py-3">
                description
            </th>
            <th scope="col" class="px-6 py-3">
                Category
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="datum in data.data"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <Checkbox/>
                </div>
            </td>
            <th scope="row" class=" items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="pl-3">
                    <div class="text-base font-semibold">${{ datum.amount }}</div>
                </div>
            </th>
            <td class="px-6 py-4">
                {{ datum.entry_date }}
            </td>
            <td class="px-6 py-4">
                {{ datum.description }}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                    {{ datum.category }}
                </div>
            </td>
            <td class="px-6 py-4">
                <SecondaryButton class="m-1">View({{ datum.id }})</SecondaryButton>
                <PrimaryLink class="m-1" :href="route(postroute+'.edit', datum.id)">Edit({{ datum.id }})</PrimaryLink>
                <DangerButton class="m-1" @click="destroy(datum.id)">Delete me({{ datum.id }})</DangerButton>
            </td>
        </tr>
        </tbody>
        <Pagination class="mt-6" :links="data.links" />
    </table>
</template>
