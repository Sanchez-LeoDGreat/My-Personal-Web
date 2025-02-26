<script setup>
    import UserNav from '@/Components/Header/UserNav.vue';
    import Footer from '@/Components/Footer.vue';
    import LoadingScreen from '@/Components/LoadingScreen.vue';

    defineProps({
        user: {
            type: Object,
            required: true
        }
    });
</script>

<template>
    <main class="relative flex flex-col w-full min-h-screen bg-slate-900">
        <header class="p-7">
            <UserNav :user="user"/>
        </header>
        <div id="content-container" class="flex-grow px-4 py-2 text-white">
            <slot/>
        </div>
        <Footer/>
        <LoadingScreen/>
    </main>
</template>
