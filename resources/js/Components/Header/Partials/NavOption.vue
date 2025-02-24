<script setup>
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        route: String,
        icon: String,
        mobileView: Boolean
    });
</script>

<template>
    <Link v-if="!props.mobileView" :href="props.route" class="flex justify-center h-full px-2 border-b-4 place-items-center hover:text-blue-500 hover:border-blue-500">
        <li class="flex justify-center gap-1 place-items-center">
            <span class="material-symbols-outlined">
                {{ props.icon }}
            </span>
            <span>
                <slot/>
            </span>
        </li>
    </Link>
    <Link v-else :href="props.route" class="hover:text-blue-500 hover:border-blue-500 hover:font-bold">
        <li class="flex justify-center py-0.5 hover:bg-white place-items-center">
            <span class="mr-1 material-symbols-outlined">
                {{ props.icon }}
            </span>
            <slot/>
        </li>
    </Link>
</template>
