<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CategoryTable from "@/Components/CategoryTable.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
    categories: Object,
})
</script>

<template>
        <Head title="Income Categories" />
    <div>

        <AuthenticatedLayout>

            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Income Categories</h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div class="p-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                                <CategoryTable postRoute="income.category" :data="categories" name="income category"/>
                        </div>
                    </div>
                </div>
            </div>

        </AuthenticatedLayout>
    </div>
</template>
