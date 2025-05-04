<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton } from '@/Utils/MyComponents';
</script>

<template>
    <Head title="Projects"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Manage <span class="text-green-500 ">Projects</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.add')">
                    <PrimaryButton class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'add']"/>
                        <span>Add New</span>
                    </PrimaryButton>
                </Link>
            </div>
        </div>
    </DarkGlass>
</template>