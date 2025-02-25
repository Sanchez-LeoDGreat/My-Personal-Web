<script setup>
    import { ref, watch, onMounted, onUnmounted } from 'vue';

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
    <dialog v-show="show" ref="dialog" @click="closeOnBackdropClick" class="fixed inset-0 z-40 flex justify-center bg-transparent place-items-center">
        <div class="min-h-[20vh] min-w-[20vw] max-h-[75vh] max-w-[80vh] flex flex-col rounded-lg overflow-hidden">
            <div class="px-2 py-1 text-xl font-bold" :class="captionBgColor()">{{ captionText() }}</div>
            <div class="flex flex-col flex-grow px-2 py-1 bg-white">
                <slot/>
            </div>
        </div>
    </dialog>
</template>

<style scoped>
    dialog::backdrop {
        background: rgba(50, 50, 50, 0.4);
    }
</style>
