<script setup>
    import Logo from '@/Components/SVG/Logo.vue';
    import Option from '@/Components/Nav/Partials/Option.vue';
    import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home"></Head>
    <nav class="fixed top-0 left-0 w-full text-white bg-slate-950">
        <div class="flex justify-between mr-1">
            <Link :href="route('home')" class="w-12 m-1 hover:text-green-500">
                <Logo></Logo>
            </Link>
            <div class="hidden md:block">
                <ul class="flex h-full gap-2 list-none">
                    <Option :route="route('home')" icon="home" :class="{'active' : $page.component === 'Home'}">Home</Option>
                    <Option :route="route('about')" icon="info" :class="{'active' : $page.component === 'About'}">About</Option>
                    <Option :route="route('contact')" icon="call" :class="{'active' : $page.component === 'Contact'}">Contact</Option>
                    <Option :route="route('projects')" icon="docs" :class="{'active' : $page.component === 'Projects'}">Projects</Option>
                </ul>
            </div>
            <div class="block md:hidden">
                <button class="h-full text-3xl material-symbols-outlined">
                    menu
                </button>
            </div>
        </div>
        <div class="block md:hidden" x-show="active" x-transition>
            <hr/>
            <ul class="text-center list-none">
                <a href=""
                    class="{{ $item->active ? 'font-medium text-green-500' : 'hover:font-medium' }}">
                    <li class="flex justify-center py-0.5 hover:bg-slate-600 place-items-center">
                        <span class="mr-1 material-symbols-outlined">
                            <!-- {{ $item->icon }} -->
                        </span>
                        <!-- <span>{{ $item->name }}</span> -->
                    </li>
                </a>
            </ul>
        </div>
    </nav>
</template>

<style scoped>
    .active{
        @apply hover:text-blue-500 hover:border-blue-500 text-green-500 border-green-500
    }
</style>
