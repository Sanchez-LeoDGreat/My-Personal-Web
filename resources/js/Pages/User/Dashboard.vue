<script setup>
    import { HeaderText } from '@/Utils/MyComponents';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { Head } from '@inertiajs/vue3';

    const props = defineProps({
        user: {
            type: Object,
            required: true
        }
    });
</script>

<template>
    <Head title="Dashboard"></Head>
    <MarginLayout class="flex-grow">
        <HeaderText>Dashboard</HeaderText>
    </MarginLayout>
</template>
