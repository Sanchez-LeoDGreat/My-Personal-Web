<script setup>
    import UserMenu from '@/Components/Header/Partials/Profile/UserMenu.vue';
    defineProps({
        user: {
            type: Object,
            required: true,
        }
    });
</script>

<template>
    <nav class="fixed top-0 left-0 w-full text-white bg-slate-950 z-10">
        <div class="flex justify-end">
            <UserMenu :user="user"/>
        </div>
    </nav>
</template>
