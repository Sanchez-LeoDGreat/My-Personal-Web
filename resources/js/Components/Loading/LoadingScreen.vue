<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import Logo from '@/Components/SVG/Logo.vue';

    const show = ref(false);
    let timeout = null;

    const startLoading = () => (show.value = true);
    const stopLoading = () => {
        show.value = false
        clearTimeout(timeout);
    };
    const routingFinished = () => {
        timeout = setTimeout(stopLoading, 200)
    };

    onMounted(() => {
        router.on('start', startLoading);
        router.on('finish', routingFinished);
    });
</script>

<template>
    <div class="fixed inset-0 z-50 flex justify-center overflow-hidden transition-all bg-blue-600 place-items-center" :class="{'w-screen': show, 'w-0': !show}">
        <div class="text-white">
            <div>
                <Logo class="h-32 animate-spin"/>
            </div>
        </div>
    </div>
</template>
