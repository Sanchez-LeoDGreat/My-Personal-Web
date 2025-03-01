<script setup>
    import { ref, watch, onMounted, onUnmounted, Transition } from 'vue';

    const props = defineProps({
        show: {
            type: Boolean,
            default: false,
        },
        closeable: {
            type: Boolean,
            default: true,
        },
        type: {
            type: String,
            default: 'info'
        },
        caption: {
            type: String,
            default: ''
        },
    });

    const emit = defineEmits(['update:show']);
    const dialog = ref(null);

    const captionBgColor = () => {
        switch (props.type) {
            case 'success':
                return 'bg-green-600 text-white';
            case 'error':
                return 'bg-red-600 text-white';
            case 'warning':
                return 'bg-yellow-500 text-black';
            default:
                return 'bg-blue-500 text-white';
        }
    };

    const close = () => {
        if (props.closeable) {
            emit('update:show', false);
        }
    };

    const captionText = () => {
        if (!props.caption) {
            switch (props.type) {
                case 'success': return "Success!";
                case 'error': return "Error!";
                case 'warning': return "Warning!";
                default: return "Message";
            }
        }
        return props.caption;
    };

    const closeOnBackdropClick = (e) => {
        if (props.closeable && e.target === dialog.value) {
            close();
        }
    };

    const closeOnEscape = (e) => {
        if (e.key === 'Escape' && props.show) {
            e.preventDefault();
            close();
        }
    };

    onMounted(() => {
        $(document).on('keydown', closeOnEscape);
    });

    onUnmounted(() => {
        $(document).off('keydown', closeOnEscape);
    });

    watch(() => props.show, (newVal) => {
        if (newVal) {
            if (!dialog.value?.open) {
                dialog.value?.showModal();
            }
        } else {
            dialog.value?.close();
        }
    });
</script>

<template>
    <dialog ref="dialog" @click="closeOnBackdropClick" @cancel.prevent="close" class="fixed inset-0 z-40 flex justify-center bg-transparent place-items-center">
        <Transition>
            <div v-if="show" class="md:min-w-[25vw] min-w-[50vw] max-h-[75vh] max-w-[80vw] flex flex-col rounded-lg overflow-hidden">
                <div class="px-4 py-2 text-2xl font-bold" :class="captionBgColor()">{{ captionText() }}</div>
                <div class="flex flex-col flex-grow px-4 py-2 overflow-auto text-xl bg-white min-h-28">
                    <slot/>
                </div>
            </div>
        </Transition>
    </dialog>
</template>

<style scoped>
    dialog::backdrop {
        background: rgba(50, 50, 50, 0.4);
    }

    .v-enter-active,
    .v-leave-active {
        transition: opacity 0.3s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>
