<script setup>
    import Nav from '@/Components/Header/Nav.vue';
    import Footer from '@/Components/Footer.vue';
    import LoadingScreen from '@/Components/LoadingScreen.vue';
</script>
<template>
    <main class="relative flex flex-col w-full min-h-screen bg-slate-900">
        <header class="p-7">
            <Nav/>
        </header>
        <div id="content-container" class="flex-grow px-4 py-2 text-white">
            <slot/>
        </div>
        <Footer/>
        <LoadingScreen/>
    </main>
</template>
