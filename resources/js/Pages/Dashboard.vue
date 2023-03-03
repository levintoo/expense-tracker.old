<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted} from "vue";
import DashboardBriefReport from "@/Components/DashboardBriefReport.vue";

const props = defineProps({
    report: Array,
});

onMounted(() => {
    console.log(props.report)
});
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
            <DashboardBriefReport>
                You received income <span class="font-bold">{{ props.report.income_count }}</span>
                times this month
            </DashboardBriefReport>
            <DashboardBriefReport>
                You incurred expenses <span class="font-bold">{{ props.report.expenses_count }}</span>
                times this month
            </DashboardBriefReport>
            <DashboardBriefReport>
                You earned a total of <span class="font-bold">{{ props.report.income }}$</span>
                this month
            </DashboardBriefReport>
            <DashboardBriefReport>
                You spent a total of <span class="font-bold">{{ props.report.expenses }}$</span>
                this month
            </DashboardBriefReport>
            <DashboardBriefReport>
                You earned a total of <span class="font-bold">{{ props.report.net_earning }}$</span>
                after expenses this month
            </DashboardBriefReport>
        </div>

    </AuthenticatedLayout>
</template>
