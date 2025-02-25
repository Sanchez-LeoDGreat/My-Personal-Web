<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="bg-black hover:border-white active:bg-gray-800">
        <slot/>
    </MyButton>
</template>
