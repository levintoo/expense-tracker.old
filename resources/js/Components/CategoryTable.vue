<script setup>
import DangerLink from "@/Components/DangerLink.vue";
import Pagination from "@/Components/Pagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import {reactive, watch} from "vue";
import TableHeadLabel from "@/Components/TableHeadLabel.vue";
import {debounce, pickBy} from "lodash";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
    name: String,
    postRoute: String,
    filters: Object,
})

const params = reactive(pickBy(props.filters))

const sort = (field) => {
    params.field = field
    params.direction = params.direction === 'asc' ? 'desc' : 'asc'
}

watch(params, debounce((params) => {
    router.get(route(props.postRoute), {
        search: params.search,
        field: params.field,
        direction: params.direction
    }, {preserveScroll: true, replace: true, preserveState: true},)
}, 150))
</script>

<template>

    <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">

        <PrimaryLink :href="route(postRoute+'.create') ?? '#'">
            Add {{ name ?? '-' }}
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
            <TextInput v-model="params.search" type="text" id="table-search-users"
                       class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       :placeholder="`Search for ${name ?? '-'}`"></TextInput>
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

            <TableHeadLabel  @click.prevent="sort('name')" field="name" :params="params" class="px-6 py-3">
                Name
            </TableHeadLabel>

            <TableHeadLabel  @click.prevent="sort('created')" field="created" :params="params" class="px-6 py-3">
                Created
            </TableHeadLabel>

            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
        </thead>
        <tbody v-if="data.data.length > 0">
        <tr v-for="datum in data.data"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <Checkbox/>
                </div>
            </td>
            <td class="px-6 py-4">
                {{ datum.name ?? '-' }}
            </td>

            <td class="px-6 py-4">
                {{ datum.created ?? '-' }}
            </td>

            <td class="px-6 py-4">

                <PrimaryLink class="m-1" :href="route(postRoute+'.edit', datum.id) ?? '#e'">
                    Edit({{ datum.id ?? null }})
                </PrimaryLink>

                <DangerLink as="button" method="delete" :href="route(postRoute+'.delete', datum.id) ?? '#'" class="m-1">
                    Delete me({{ datum.id ?? null }})
                </DangerLink>

            </td>
        </tr>
        </tbody>
        <tbody v-else>
        <tr>
            <td class="px-6 py-4 text-center text-gray-400" colspan="6">
                There is nothing to show here
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :links="data.links"/>
</template>
