<script setup>
    import ClickableLogo from '@/Components/ClickableLogo.vue';
    import SidebarOption from './Partials/SidebarOption.vue';
    import { faChartColumn } from '@fortawesome/free-solid-svg-icons';
    import { computed, onMounted, onUnmounted, ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';

    const sidebarRef = ref(null);
    const showSlot = ref(false);

    onMounted(() => {
        const sidebar = $(sidebarRef.value);

        sidebar.on('mouseenter', () => (showSlot.value = true));
        sidebar.on('mouseleave', () => (showSlot.value = false));
    });

    onUnmounted(() => {
        const sidebar = $(sidebarRef.value);

        sidebar.off();
    });

    const page = usePage();
    const component = computed(() => page.component);
</script>

<template>
    <div ref="sidebarRef" class="fixed flex flex-col top-0 left-0 z-20 h-screen text-white overflow-hidden transition-all min-w-14 w-14 hover:w-[75vw] md:hover:w-80 bg-slate-950">
        <ClickableLogo :route="route('user.dashboard')"/>
        <hr>
        <ul class="flex flex-col flex-grow gap-1 py-2 overflow-y-auto">
            <SidebarOption :route="route('user.dashboard')" :icon="faChartColumn" :isActive="component == 'User/Dashboard'" :showSlot="showSlot">Dashboard</SidebarOption>
        </ul>
    </div>
</template>
