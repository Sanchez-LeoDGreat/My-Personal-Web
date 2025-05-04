<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton } from '@/Utils/MyComponents';
</script>

<template>
    <Head title="Projects"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Add <span class="text-green-500 ">Project</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.manage')">
                    <PrimaryButton class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'angle-left']"/>
                        <span>Go Back</span>
                    </PrimaryButton>
                </Link>
            </div>
        </div>
    </DarkGlass>
</template>