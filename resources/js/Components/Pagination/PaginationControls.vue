<script setup>
    import { nextTick, ref, watch } from 'vue';

    const props = defineProps({
        modelValue: {
            type: Number,
            required: true,
        },
        links: {
            type: Array,
            required: true,
        }
    });

    const containerRef = ref(null);

    const emit = defineEmits(['update:modelValue']);

    const gotoPage = (url) => {
        const page = parseInt(new URL(url).searchParams.get('page'));
        emit('update:modelValue', page);
    }

    watch(() => props.links, async () => {
        await nextTick();
        const container = containerRef.value;
        const active = $(container).find('button.active').parent()[0];

        if (container && active) {
            const scrollOffset = active.offsetLeft - container.offsetWidth / 2 + active.offsetWidth / 2;
            container.scrollTo({
                left: scrollOffset,
                behavior: 'smooth'
            });
        }
    });
</script>

<template>
    <div class="flex justify-between">
        <div v-if="links[0]">
            <button @click="gotoPage(links[0].url)" :disabled="!links[0].url">
                <span v-html="links[0].label"></span>
            </button>
        </div>

        <div class="relative overflow-x-hidden">
            <div class="flex max-w-full gap-1 overflow-x-auto scrollbar-hide" ref="containerRef">
                <div v-for="(link, index) in links" :key="index">
                    <button v-if="index != 0 && index != links.length - 1" @click="gotoPage(link.url)" :disabled="!link.url" class="min-w-8" :class="{'active': link.active}">
                        <span v-html="link.label"></span>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="links[links.length - 1]">
            <button @click="gotoPage(links[links.length - 1].url)" :disabled="!links[links.length - 1].url">
                <span v-html="links[links.length - 1].label"></span>
            </button>
        </div>
    </div>
</template>

<style scoped>
    button{
        @apply px-2 py-1 bg-slate-950 rounded-sm border-2 text-nowrap
    }

    button:hover{
        @apply text-blue-500 border-blue-500
    }

    button.active{
        @apply underline font-bold text-green-500 border-green-500
    }

    button:disabled{
        @apply text-gray-300 bg-slate-900
    }

    button:disabled:hover{
        @apply border-white
    }
</style>