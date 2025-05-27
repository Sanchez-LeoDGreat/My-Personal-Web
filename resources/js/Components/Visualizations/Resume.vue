<script setup>
    import StaticAsset from '@/Utils/StaticAsset';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { Prose } from '@/Utils/MyComponents';

    const props = defineProps({
        modelValue: Object
    });

    const resumePic = props.modelValue?.image ? STORAGE_PATH + props.modelValue.image : StaticAsset.img.resumeDefaultImg;
</script>

<template>
    <div class="a4-page text-slate-950">
        <div class="absolute top-0 left-0 z-0 w-40 bg-slate-950 h-44"></div>
        <div class="absolute flex gap-2">
            <div class="p-3 bg-white border-[6px] rounded-full border-slate-950 outline outline-white outline-8">
                <img :src="resumePic" alt="My Picture" class="rounded-full w-44 h-44 min-h-44 min-w-44">
            </div>
            <div>
                <div v-text="modelValue?.name || 'Leonard Paulo Sanchez'" class="font-bold text-7xl"></div>
            </div>
        </div>
        <div class="h-full pt-56">
            <div class="h-full columns-2">
                <div class="break-inside-avoid-column">
                    <div class="text-xl text-center">About Me</div>
                    <div class="text-justify">{{ modelValue?.about_me || 'About Me Content' }}</div>
                    <div class="flex flex-col gap-2 my-2">
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'phone-volume']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <span v-text="modelValue?.contact || 'Contact No.'"></span>
                        </div>
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'envelope']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <span v-text="modelValue?.email || 'Email'"></span>
                        </div>
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'home']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <span v-text="modelValue?.address || 'Address'"></span>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div v-for="(category, index) in modelValue?.categories" :key="index">
                                <div class="py-1 text-center text-white uppercase bg-slate-950">{{ category.title }}</div>
                                <Prose v-html="category.content"></Prose>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .a4-page {
        width: 794px;
        height: 1123px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin: auto;
        padding: 40px;
        position: relative;
    }

    @media print {
        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 0;
            box-shadow: none;
            page-break-after: always;
        }

        body {
            margin: 0;
        }
    }
</style>