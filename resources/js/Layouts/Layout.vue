<script setup>
    import Nav from '@/Components/Header/Nav.vue';
    import UserNav from '@/Components/Header/UserNav.vue';
    import UserSidebar from '@/Components/Sidebar/User/UserSidebar.vue';
    import Footer from '@/Components/Footer/Footer.vue';
    import LoadingScreen from '@/Components/Loading/LoadingScreen.vue';
    import StaticAsset from '@/Utils/StaticAsset';
    import MessageModal from '@/Layouts/Partials/MessageModal.vue';
    import ConfirmationModal from '@/Layouts/Partials/ConfirmationModal.vue';
    import { usePage } from '@inertiajs/vue3';
    import { computed, onMounted, ref } from 'vue';

    defineProps({
        user: Object
    });

    const msgModalRef = ref(null);
    const confirmationModalRef = ref(null);

    const page = usePage();
    const isUserPage = computed(() => page.component.startsWith('User/'));

    onMounted(() => {
        window.showModalMessage = msgModalRef.value.showModalMessage;
        window.showConfirmationModal = confirmationModalRef.value.showConfirmationModal;
    });
</script>
<template>
    <main class="relative">
        <div class="flex flex-col w-full min-h-screen bg-slate-900" :class="{'pl-14' : isUserPage}">
            <header class="p-7">
                <UserNav v-if="isUserPage" :user="user"/>
                <Nav v-else/>
            </header>
            <UserSidebar v-if="isUserPage"/>
            <div id="content-container" :style="{ backgroundImage: `url(${StaticAsset.img.bg1})` }" class="flex flex-grow text-white bg-center bg-no-repeat bg-cover">
                <slot/>
            </div>
            <Footer/>
        </div>
        <MessageModal ref="msgModalRef"/>
        <ConfirmationModal ref="confirmationModalRef"/>
        <LoadingScreen/>
    </main>
</template>
