<template>
    <th scope="col">
        <div class="flex justify-between" >
            <span class="cursor-pointer" >
                <slot />
            </span>
            <span>
                <svg v-if="params.field === field && params.direction === 'asc' " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/> </svg>
                <svg v-if="params.field === field && params.direction === 'desc' " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg>
            </span>
        </div>
    </th>
</template>

<script setup>

const props = defineProps({
    field: String,
    params: Object,
})
</script>
