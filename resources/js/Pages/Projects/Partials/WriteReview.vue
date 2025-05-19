<script setup>
    import { HeaderText } from '@/Utils/MyComponents';
    import { Transition } from 'vue';

    const props = defineProps({
        show: {
            type: Boolean,
            default: false,
        }
    });

    const emit = defineEmits(['update:show']);

    const hideWriteReview = () => {
        emit('update:show', false);
    }
</script>

<template>
    <Transition name="slide-width">
        <div v-if="show" class="fixed flex border-l-2 border-green-500 bg-slate-900 w-full h-[93.5vh] top-13 right-0 overflow-hidden">
            <div>
                <button @click="hideWriteReview">
                    <font-awesome-icon :icon="['fas', 'close']"/>
                </button>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
    .slide-width-enter-active,
    .slide-width-leave-active {
        transition: width 0.5s ease;
    }

    .slide-width-enter-from,
    .slide-width-leave-to {
        width: 0%;
    }

    .slide-width-enter-to,
    .slide-width-leave-from {
        width: 100%;
    }
</style>