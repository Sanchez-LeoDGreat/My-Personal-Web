<script setup>
    import HeaderText from '@/Components/Texts/Headertext.vue';
    import UserLayout from '@/Layouts/UserLayout.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { Head } from '@inertiajs/vue3';

    defineOptions({
        layout: UserLayout,
    })
</script>

<template>
    <Head title="Dashboard"></Head>
    <MarginLayout class="flex-grow">
        <HeaderText>Logged In</HeaderText>
    </MarginLayout>
</template>
