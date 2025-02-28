<script setup>
    defineProps({
        icon: Object,
        route: String,
    })
</script>

<template>
    <a :href="route" target="_blank" class="h-full hover:text-green-500 active:text-blue-500">
        <font-awesome-icon :icon="icon" class="text-xl"/>
    </a>
</template>
