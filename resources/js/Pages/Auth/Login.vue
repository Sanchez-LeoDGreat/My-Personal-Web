<script setup>
    import { Head } from '@inertiajs/vue3';
    import LoginForm from '@/Pages/Auth/Partials/LoginForm.vue';
    import AuthLayout from '@/Layouts/Child/AuthLayout.vue';
</script>

<template>
    <Head title="Login"></Head>
    <AuthLayout>
        <LoginForm/>
    </AuthLayout>
</template>

<style>
    #content-container{
        @apply flex flex-col
    }
</style>
