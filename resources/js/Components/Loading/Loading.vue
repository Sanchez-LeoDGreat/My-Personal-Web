<script setup>
    defineProps({
        finished: {
            type: Boolean,
            default: false,
        },
        status: {
            type: String,
            default: 'loading',
        },
    });
</script>

<template>
    <div>
        <div v-if="status == 'loading'" class="flex justify-center w-full h-full gap-2 my-4 text-center place-items-center">
            <div>
                <font-awesome-icon :icon="['fas', 'spinner']" class="text-3xl animate-spin"/>
            </div>
            <div class="animate-pulse">Loading... Please wait...</div>
        </div>
        <div v-else-if="status == 'error'" class="p-2 bg-red-600 border-2 border-red-300 rounded-md">
            <div>An error occured! Please try again later.</div>
        </div>
    </div>
</template>
