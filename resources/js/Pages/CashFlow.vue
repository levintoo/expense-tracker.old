<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
    data: Object,
})
</script>

<template>
    <Head title="Cash Flow" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cash Flow</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 relative overflow-x-auto shadow-md sm:rounded-lg">


                            <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">

                                <PrimaryLink href="">
                                    Add {{ category ?? '-' }}
                                </PrimaryLink>

                                <label class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <TextInput type="text" id="table-search-users"
                                               class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               :placeholder="`Search for `"></TextInput>
                                </div>
                            </div>
{{ data ?? '-'}}

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <Checkbox/>
                                        </div>
                                    </th>

                                    <TableHeadLabel class="px-6 py-3">
                                        Amount
                                    </TableHeadLabel>

                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody >
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <Checkbox/>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        hello
                                    </td>
                                    <td class="px-6 py-4">
                                        hello
                                    </td>

                                </tr>
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
