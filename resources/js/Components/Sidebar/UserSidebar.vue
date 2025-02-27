<script setup>
    import ClickableLogo from '@/Components/ClickableLogo.vue';
</script>

<template>
    <div class="fixed top-0 left-0 z-20 h-screen text-white transition-all min-w-14 w-14 hover:w-[75vw] md:hover:w-80 bg-slate-950">
        <div class="flex max-h-14 max-w-14">
            <ClickableLogo :href="route('user.dashboard')"/>
        </div>
        <hr>
    </div>
</template>
