<script setup>
    import { Head } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
</script>

<template>
    <Head title="Projects"/>
    <MarginLayout>
        <DarkGlass class="p-2">
            <HeaderText>Projects</HeaderText>
        </DarkGlass>
    </MarginLayout>
</template>
