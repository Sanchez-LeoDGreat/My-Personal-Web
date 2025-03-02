<script setup>
    defineProps({
        message: {
            type: String,
            required: true,
        },
    });
</script>

<template>
    <div class="flex-grow pb-2 overflow-x-auto" v-html="message"></div>
</template>
