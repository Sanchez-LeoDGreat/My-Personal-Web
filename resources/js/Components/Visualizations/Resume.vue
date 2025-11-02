<script setup>
    import StaticAsset from '@/Utils/StaticAsset';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { Prose, TextAreaInput, TextInput, PrimaryButton } from '@/Utils/MyComponents';
    import { useForm } from '@inertiajs/vue3';
    import { watch } from 'vue';

    const props = defineProps({
        modelValue: Object,
        editable: {
            type: Boolean,
            default: false
        }
    });

    const form = useForm({
        about_me: '',
        contact: '',
        email: '',
        address: '',
        categories: [],
    });

    watch(() => props.modelValue,
        (val) => {
            form.about_me = val.about_me;
            form.contact = val.contact;
            form.email = val.email;
            form.address = val.address;
            form.categories = val.categories;
        },
    );

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
                    <div v-if="editable">
                        <TextAreaInput autoresize name="about_me" id="about_me" v-model="form.about_me"></TextAreaInput>
                    </div>
                    <div v-else class="text-justify">{{ modelValue?.about_me || 'About Me Content' }}</div>

                    <div class="flex flex-col gap-2 my-2">
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'phone-volume']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <TextInput v-if="editable" v-model="form.contact"/>
                            <span v-else v-text="modelValue?.contact || 'Contact No.'"></span>
                        </div>
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'envelope']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <TextInput v-if="editable" v-model="form.email"/>
                            <span v-else v-text="modelValue?.email || 'Email'"></span>
                        </div>
                        <div class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'home']" class="p-2 text-white rounded-full bg-slate-950"/>
                            <TextInput v-if="editable" v-model="form.address"/>
                            <span v-else v-text="modelValue?.address || 'Address'"></span>
                        </div>

                        <div v-if="editable" class="flex flex-col gap-4">
                            <div v-for="(category, index) in modelValue?.categories" :key="index">
                                <div class="py-1 text-center text-white bg-slate-950">
                                    <input type="text" class="w-full text-center uppercase bg-transparent outline-none" v-model="form.categories[index].title">
                                </div>
                                <TextAreaInput v-model="form.categories[index].content" autoresize class="min-h-0 rounded-none"/>
                            </div>
                        </div>
                        <div v-else class="flex flex-col gap-4">
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
    <div class="flex justify-center w-full py-4">
        <PrimaryButton class="flex gap-2 place-items-center">
            <font-awesome-icon :icon="['fas', 'save']"/>
            <span>Save</span>
        </PrimaryButton>
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