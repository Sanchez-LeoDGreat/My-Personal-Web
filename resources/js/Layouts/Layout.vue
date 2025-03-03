<script setup>
    import Nav from '@/Components/Header/Nav.vue';
    import UserNav from '@/Components/Header/UserNav.vue';
    import UserSidebar from '@/Components/Sidebar/User/UserSidebar.vue';
    import Footer from '@/Components/Footer/Footer.vue';
    import LoadingScreen from '@/Components/LoadingScreen.vue';
    import StaticAsset from '@/Utils/StaticAsset';
    import { usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    defineProps({
        user: Object
    });

    const page = usePage();
    const isUserPage = computed(() => page.component.startsWith('User/'));
</script>
<template>
    <main class="relative">
        <div class="flex flex-col w-full min-h-screen bg-slate-900" :class="{'pl-14' : isUserPage}">
            <header class="p-7">
                <UserNav v-if="isUserPage" :user="user"/>
                <Nav v-else/>
            </header>
            <UserSidebar v-if="isUserPage"/>
            <div v-if="isUserPage" id="content-container" class="flex-grow text-white">
                <slot/>
            </div>
            <div v-else id="content-container" :style="{ backgroundImage: `url(${StaticAsset.img.bg1})` }" class="flex flex-grow text-white bg-center bg-no-repeat bg-cover">
                <slot/>
            </div>
            <Footer/>
        </div>
        <LoadingScreen/>
    </main>
</template>
