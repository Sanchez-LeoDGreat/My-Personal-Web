<script setup>
    import UserNav from '@/Components/Header/UserNav.vue';
    import Footer from '@/Components/Footer/Footer.vue';
    import LoadingScreen from '@/Components/LoadingScreen.vue';
    import UserSidebar from '@/Components/Sidebar/User/UserSidebar.vue';

    defineProps({
        user: {
            type: Object,
            required: true
        }
    });
</script>

<template>
    <main class="relative">
        <div class="flex flex-col w-full min-h-screen pl-14 bg-slate-900">
            <header class="p-7">
                <UserNav :user="user"/>
            </header>
            <UserSidebar/>
            <div id="content-container" class="flex-grow text-white">
                <slot/>
            </div>
            <Footer/>
        </div>
        <LoadingScreen/>
    </main>
</template>
