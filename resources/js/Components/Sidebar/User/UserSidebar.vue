<script setup>
    import ClickableLogo from '@/Components/ClickableLogo.vue';
    import SidebarOption from './Partials/SidebarOption.vue';
    import { computed, onMounted, onUnmounted, ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';

    const sidebarRef = ref(null);
    const showTitle = ref(false);

    onMounted(() => {
        const sidebar = $(sidebarRef.value);

        sidebar.on('mouseenter', () => (showTitle.value = true));
        sidebar.on('mouseleave', () => (showTitle.value = false));
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
        <ul class="flex flex-col flex-grow gap-2 py-2 overflow-y-auto select-none">
            <SidebarOption :route="route('user.dashboard')" :icon="['fas', 'chart-column']" :isActive="component == 'User/Dashboard'" :showTitle="showTitle" title="Dashboard"/>
            <SidebarOption :isDropDown="true" :icon="['fas', 'pager']" :showTitle="showTitle" :isActive="component.startsWith('User/Pages')" title="Page Contents">
                <SidebarOption :route="route('home.edit')" :icon="['fas', 'house']" :isActive="component == 'User/Pages/Home'" :showTitle="showTitle" :isDropDownOption="true" title="Home"/>
                <SidebarOption :route="route('about.edit')" :icon="['fas', 'info']" :isActive="component == 'User/Pages/About'" :showTitle="showTitle" :isDropDownOption="true" title="About"/>
            </SidebarOption>
            <SidebarOption :route="route('projects.edit')" :icon="['fas', 'folder-open']" :isActive="component == 'User/Projects/Edit'" :showTitle="showTitle" title="Projects"/>
        </ul>
    </div>
</template>
