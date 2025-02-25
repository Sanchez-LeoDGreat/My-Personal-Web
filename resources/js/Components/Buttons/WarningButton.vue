<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="text-black bg-yellow-500 hover:border-white active:bg-yellow-500/70">
        <slot/>
    </MyButton>
</template>
