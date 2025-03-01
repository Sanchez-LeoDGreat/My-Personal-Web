<script setup>
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        route: {
            type: String,
            required: true,
        },
        icon: {
            type: [String, Array],
            required: true,
        },
    });
</script>

<template>
    <Link :href="props.route" class="w-full">
        <li class="flex w-full gap-1 px-2 py-1 place-items-center hover:text-white hover:bg-blue-500">
            <font-awesome-icon :icon="icon"/>
            <span class="mr-2">
                <slot/>
            </span>
        </li>
    </Link>
</template>
