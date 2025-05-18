<script setup>
    import NavOption from '@/Components/Header/Partials/NavOption.vue';
    import { router, usePage } from '@inertiajs/vue3';
    import { ref, onMounted, computed } from 'vue';
    import ClickableLogo from '@/Components/ClickableLogo.vue';

    const show = ref(true);

    const closeMenu = () => {
        show.value = false;
    };

    onMounted(() => {
        router.on('navigate', closeMenu);
    });

    const page = usePage();
    const component = computed(() => page.component);
</script>

<template>
    <nav class="fixed top-0 left-0 z-10 w-full text-white bg-slate-950">
        <div class="flex justify-between mr-1">
            <ClickableLogo/>
            <div class="hidden md:block">
                <ul class="flex h-full gap-2 list-none">
                    <NavOption :route="route('home')" :icon="['fas', 'house']" :class="{'active' : component === 'Home'}">Home</NavOption>
                    <NavOption :route="route('about')" :icon="['fas', 'circle-info']" :class="{'active' : component === 'About'}">About</NavOption>
                    <NavOption :route="route('contact')" :icon="['fas', 'phone']" :class="{'active' : component === 'Contact'}">Contact</NavOption>
                    <NavOption :route="route('projects')" :icon="['fas', 'folder-open']" :class="{'active' : component.startsWith('Projects')}">Projects</NavOption>
                    <NavOption :route="route('login')" :icon="['fas', 'right-to-bracket']" :class="{'active' : component === 'Auth/Login'}">Login</NavOption>
                </ul>
            </div>
            <div class="block md:hidden">
                <button @click="show=!show" class="h-full mx-2 text-2xl hover:text-green-500 active:text-blue-500">
                    <font-awesome-icon :icon="['fas', 'bars']"/>
                </button>
            </div>
        </div>
        <div class="overflow-hidden transition-all duration-300 md:hidden" :class="{'h-[145px]': show, 'h-0': !show}">
            <hr/>
            <ul class="text-center list-none">
                <NavOption :route="route('home')" :icon="['fas', 'house']" :mobileView="true" :class="{'active' : component === 'Home'}">Home</NavOption>
                <NavOption :route="route('about')" :icon="['fas', 'circle-info']" :mobileView="true" :class="{'active' : component === 'About'}">About</NavOption>
                <NavOption :route="route('contact')" :icon="['fas', 'phone']" :mobileView="true" :class="{'active' : component === 'Contact'}">Contact</NavOption>
                <NavOption :route="route('projects')" :icon="['fas', 'folder-open']" :mobileView="true" :class="{'active' : component.startsWith('Projects')}">Projects</NavOption>
                <NavOption :route="route('login')" :icon="['fas', 'right-to-bracket']" :mobileView="true" :class="{'active' : component === 'Auth/Login'}">Login</NavOption>
            </ul>
        </div>
    </nav>
</template>

<style scoped>
    .active{
        @apply hover:text-blue-500 hover:border-blue-500 text-green-500 border-green-500
    }
</style>
