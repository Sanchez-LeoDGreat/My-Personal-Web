<script setup>
    import { Head } from '@inertiajs/vue3';
    import LoginForm from '@/Pages/Auth/Partials/LoginForm.vue';
</script>

<template>
    <Head title="Login"></Head>
    <div class="flex justify-center flex-grow w-full place-items-center">
        <LoginForm/>
    </div>
</template>

<style>
    #content-container{
        @apply flex flex-col
    }
</style>
