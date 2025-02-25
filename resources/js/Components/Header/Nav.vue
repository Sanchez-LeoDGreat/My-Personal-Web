<script setup>
    import Logo from '@/Components/SVG/Logo.vue';
    import NavOption from '@/Components/Header/Partials/NavOption.vue';
    import { Link, router } from '@inertiajs/vue3';
    import { ref, onMounted, onUnmounted } from 'vue';

    const show = ref(false);

    const closeMenu = () => {
        show.value = false;
    };

    onMounted(() => {
        router.on('navigate', closeMenu);
    });

    onUnmounted(() => {
        router.off('navigate', closeMenu);
    });
</script>

<template>
    <nav class="fixed top-0 left-0 w-full text-white bg-slate-950">
        <div class="flex justify-between mr-1">
            <Link :href="route('home')" class="w-12 m-1 hover:text-green-500">
                <Logo/>
            </Link>
            <div class="hidden md:block">
                <ul class="flex h-full gap-2 list-none">
                    <NavOption :route="route('home')" icon="home" :class="{'active' : $page.component === 'Home'}">Home</NavOption>
                    <NavOption :route="route('about')" icon="info" :class="{'active' : $page.component === 'About'}">About</NavOption>
                    <NavOption :route="route('contact')" icon="call" :class="{'active' : $page.component === 'Contact'}">Contact</NavOption>
                    <NavOption :route="route('projects')" icon="docs" :class="{'active' : $page.component === 'Projects'}">Projects</NavOption>
                </ul>
            </div>
            <div class="block md:hidden">
                <button @click="show=!show" class="h-full text-3xl material-symbols-outlined hover:text-green-500">
                    menu
                </button>
            </div>
        </div>
        <div class="overflow-hidden transition-all duration-300 md:hidden" :class="{'h-[115px]': show, 'h-0': !show}">
            <hr/>
            <ul class="text-center list-none">
                <NavOption :route="route('home')" icon="home" :mobileView="true" :class="{'active' : $page.component === 'Home'}">Home</NavOption>
                <NavOption :route="route('about')" icon="info" :mobileView="true" :class="{'active' : $page.component === 'About'}">About</NavOption>
                <NavOption :route="route('contact')" icon="call" :mobileView="true" :class="{'active' : $page.component === 'Contact'}">Contact</NavOption>
                <NavOption :route="route('projects')" icon="docs" :mobileView="true" :class="{'active' : $page.component === 'Projects'}">Projects</NavOption>
            </ul>
        </div>
    </nav>
</template>

<style scoped>
    .active{
        @apply hover:text-blue-500 hover:border-blue-500 text-green-500 border-green-500
    }
</style>
