<script setup>
    import Triangle from '@/Components/SVG/Triangle.vue';
    import { Transition } from 'vue';

    defineProps({
        show: {
            type: Boolean,
            default: false
        }
    });
</script>

<template>
    <Transition>
        <div v-if="show" class="absolute z-20 text-black">
            <div class="relative">
                <ul class="overflow-hidden bg-white rounded-b-md rounded-l-md">
                    <slot/>
                </ul>
                <div class="absolute right-0 z-10 w-3 h-3 text-white -top-3">
                    <Triangle/>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
    .v-enter-active,
    .v-leave-active {
        transition: opacity 0.3s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>
