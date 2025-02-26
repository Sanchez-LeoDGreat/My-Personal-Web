<script setup>
    import Triangle from '@/Components/SVG/Triangle.vue';
    import { onMounted, onUnmounted, ref } from 'vue';

    const ul = ref(null);
    const hoveredOnFirstChild = ref(false);
    let firstChild = null;

    onMounted(() => {
        if (ul.value && ul.value.children.length > 0){
            firstChild = $(ul.value.children[0]);

            firstChild.on('mouseenter', () => {
                hoveredOnFirstChild.value = true;
            });

            firstChild.on('mouseleave', () => {
                hoveredOnFirstChild.value = false;
            });
        }
    });

    onUnmounted(() => {
        if (firstChild) {
            firstChild.off();
        }
    });
</script>

<template>
    <div class="absolute z-20 text-black">
        <div class="relative">
            <ul ref="ul" class="overflow-hidden bg-white rounded-b-md rounded-l-md">
                <slot/>
            </ul>
            <div class="absolute right-0 z-10 w-3 h-3 -top-3" :class="hoveredOnFirstChild ? 'text-blue-500' : 'text-white'">
                <Triangle/>
            </div>
        </div>
    </div>
</template>
