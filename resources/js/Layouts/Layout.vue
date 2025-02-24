<script setup>
    import Nav from '@/Components/Header/Nav.vue';
    import Footer from '@/Components/Footer.vue';
    import LoadingScreen from '@/Components/LoadingScreen.vue';
</script>
<template>
    <main class="relative flex flex-col w-full min-h-screen">
        <header class="p-7">
            <Nav/>
        </header>
        <div class="flex-grow">
            <slot/>
        </div>
        <Footer/>
        <LoadingScreen/>
    </main>
</template>
