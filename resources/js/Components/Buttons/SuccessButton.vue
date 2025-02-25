<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="bg-green-600 hover:border-white active:bg-green-600/70">
        <slot/>
    </MyButton>
</template>
