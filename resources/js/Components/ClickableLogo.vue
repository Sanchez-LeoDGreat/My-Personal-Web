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
    <Link :href="props.route" class="w-12 m-1 hover:text-green-500">
        <Logo/>
    </Link>
</template>
