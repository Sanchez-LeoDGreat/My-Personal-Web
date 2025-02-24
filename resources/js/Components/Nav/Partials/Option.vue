<script setup>
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        route: String,
        icon: String,
    });
</script>

<template>
    <Link :href="props.route" class="flex justify-center h-full px-2 border-b-4 place-items-center hover:text-blue-500 hover:border-blue-500">
        <li class="flex justify-center gap-1 place-items-center">
            <span class="material-symbols-outlined">
                {{ icon }}
            </span>
            <span>
                <slot></slot>
            </span>
        </li>
    </Link>
</template>
