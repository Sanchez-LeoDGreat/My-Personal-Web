<script setup>
    import { Head } from '@inertiajs/vue3';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { HeaderText, DarkGlass } from '@/Utils/MyComponents';
</script>

<template>
    <Head title="Projects"/>
    <MarginLayout>
        <DarkGlass class="p-2">
            <HeaderText>Projects</HeaderText>
        </DarkGlass>
    </MarginLayout>
</template>
