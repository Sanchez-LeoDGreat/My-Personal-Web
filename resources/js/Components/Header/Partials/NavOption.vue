<script setup>
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        route: String,
        icon: {
            type: [String, Array],
            required: true,
        },
        mobileView: Boolean
    });
</script>

<template>
    <Link v-if="!props.mobileView" :href="props.route" class="flex justify-center h-full px-2 border-b-4 place-items-center hover:text-blue-500 hover:border-blue-500">
        <li class="flex justify-center gap-1 place-items-center">
            <font-awesome-icon :icon="icon"/>
            <span>
                <slot/>
            </span>
        </li>
    </Link>
    <Link v-else :href="props.route" class="hover:text-blue-500 hover:border-blue-500 hover:font-bold">
        <li class="flex justify-center py-0.5 gap-2 hover:bg-white place-items-center">
            <font-awesome-icon :icon="icon"/>
            <span>
                <slot/>
            </span>
        </li>
    </Link>
</template>
