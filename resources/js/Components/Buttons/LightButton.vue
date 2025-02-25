<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="text-black bg-white active:bg-white/70 hover:border-gray-400">
        <slot/>
    </MyButton>
</template>
