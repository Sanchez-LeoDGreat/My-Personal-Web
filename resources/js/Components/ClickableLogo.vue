<script setup>
    import { Link } from '@inertiajs/vue3';
    import Logo from '@/Components/SVG/Logo.vue';

    const props = defineProps({
        route: {
            type: String,
            default: route('home'),
        }
    })
</script>

<template>
    <Link :href="props.route" class="flex max-h-14 hover:text-green-500">
        <div class="flex max-w-full max-h-full place-items-center">
            <Logo class="w-12 m-1"/>
        </div>
        <div class="my-auto font-bold text-nowrap">
            Leo D' Great
        </div>
    </Link>
</template>
