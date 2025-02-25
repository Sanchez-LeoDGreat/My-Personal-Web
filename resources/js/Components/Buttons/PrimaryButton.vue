<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="text-white bg-blue-500 hover:border-white active:bg-blue-500/70">
        <slot/>
    </MyButton>
</template>
