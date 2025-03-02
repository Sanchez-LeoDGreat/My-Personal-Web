<script setup>
    import { nextTick, onMounted, ref } from 'vue';

    const btnContainer = ref(null);

    onMounted(async () => {
        await nextTick();

        const focusElement = btnContainer.value?.querySelector("[focus-on-show]");

        if (focusElement) {
            focusElement.focus();
        }
    });
</script>

<template>
    <div ref="btnContainer" class="flex justify-end gap-2 pt-2">
        <slot/>
    </div>
</template>
