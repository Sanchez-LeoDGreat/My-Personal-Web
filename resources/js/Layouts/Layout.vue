<script setup>
    import Nav from '@/Components/Header/Nav.vue';
    import Footer from '@/Components/Footer.vue';
</script>
<template>
    <header class="p-7">
        <Nav/>
    </header>
    <main>
        <slot/>
    </main>
    <Footer/>
</template>
