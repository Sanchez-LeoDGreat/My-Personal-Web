<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="bg-red-600 hover:border-white active:bg-red-600/70">
        <slot/>
    </MyButton>
</template>
