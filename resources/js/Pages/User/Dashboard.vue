<script setup>
    import HeaderText from '@/Components/Texts/Headertext.vue';
    // import UserLayout from '@/Layouts/UserLayout.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { Head } from '@inertiajs/vue3';

    // defineOptions({
    //     layout: UserLayout,
    // })

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
