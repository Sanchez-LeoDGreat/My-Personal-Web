<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="text-blue-500 underline">
        <slot/>
    </MyButton>
</template>
