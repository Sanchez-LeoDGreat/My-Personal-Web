<script setup>
    import MyButton from '@/Components/Buttons/MyButton.vue';
</script>

<template>
    <MyButton class="text-black bg-cyan-500 active:bg-cyan-500/70 hover:border-white">
        <slot/>
    </MyButton>
</template>
