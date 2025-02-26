<script setup>
    import HeaderText from '@/Components/Texts/Headertext.vue';
    import UserLayout from '@/Layouts/UserLayout.vue';
    import { Head } from '@inertiajs/vue3';

    defineOptions({
        layout: UserLayout,
    })
</script>

<template>
    <Head title="Dashboard"></Head>
    <HeaderText>Logged In</HeaderText>
</template>
