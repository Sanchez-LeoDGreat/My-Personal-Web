<script setup>
    import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
    import { nextTick, onMounted, ref } from 'vue';
    import { DarkGlass, HeaderText, Resume, LabelText, SelectInput, PrimaryButton, FileInput, FieldMessage } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';

    const props = defineProps({
        config: {
            type: Object,
            required: true,
        }
    });

    const resume = ref({
        show: false,
        data: null,
        uploaded_path: props.config.resume.uploaded_path ? STORAGE_PATH + props.config.resume.uploaded_path : '',
    });

    const fetchResume = async () => {
        try{
            const response = await axios.post(route('api.fetch-resume'));
            const data = response.data;
            if (data.success){
                resume.value.data = data.resume;
            } else {
                throw new Error(data.message || 'Failed to fetch resume');
            }
        } catch (err) {
            showModalMessage(`Error: ${err.message}`, { type: 'error' });
        }
    }

    const options = [
        { value: 'dynamic', text: 'Dynamic' },
        { value: 'uploaded', text: 'Uploaded' }
    ];

    const form = useForm({
        downloadable_resume: props.config.resume.downloadable,
        uploaded_resume: null
    });

    const setDownloadableResume = () => {
        form.post(route('user.resume.set'), {
            onSuccess: async () => {
                await fetchConfig();
                showModalMessage(usePage().props.flash.success, { type: 'success' });
            },
            onError: () => {
                if (form.errors.config){
                    showModalMessage(form.errors.config, { type: 'error' });
                }
            }
        })
    }

    const fetchConfig = async () => {
        try{
            const response = await axios.post(route('api.fetch-config'));
            const data = response.data;
            if (data.success){
                resume.value.uploaded_path = data.config.resume.uploaded_path ? STORAGE_PATH + data.config.resume.uploaded_path : '';
            } else {
                throw new Error(data.message || 'Failed to fetch config');
            }
        } catch (err) {
            showModalMessage(`Error: ${err.message}`, { type: 'error' });
        }
    }

    onMounted(async () => {
        await nextTick();
        await fetchResume();
    });
</script>

<template>
    <Head title="Resume"/>
    <DarkGlass class="min-h-[90vh] p-2 flex flex-col">
        <HeaderText class="mb-2">My <span class="text-green-500 ">Resume</span></HeaderText>
        <div class="px-4">
            <details class="mb-4">
                <summary>Downloadable Resume</summary>
                <p class="pl-10"><b>Dynamic: </b>the visitors will be able to download your dynamic resume generated from this website.</p>
                <p class="pl-10"><b>Uploaded: </b>the visitors will be able to download an uploaded resume you put in this website.</p>
            </details>
            <form @submit.prevent="setDownloadableResume">
                <div class="mb-4">
                    <LabelText for="downloadable_resume">Resume</LabelText>
                    <SelectInput id="downloadable_resume" :options="options" v-model="form.downloadable_resume"/>
                    <FieldMessage v-if="form.errors.downloadable_resume" status="error">{{ form.errors.downloadable_resume }}</FieldMessage>
                </div>
                <div v-if="form.downloadable_resume == 'uploaded'" class="mb-4">
                    <LabelText for="uploaded_resume">Upload Resume</LabelText>
                    <FileInput id="uploaded_resume" v-model="form.uploaded_resume"/>
                    <FieldMessage v-if="form.errors.uploaded_resume" status="error">{{ form.errors.uploaded_resume }}</FieldMessage>
                </div>
                <div>
                    <button type="button" @click="resume.show=!resume.show" class="flex justify-between w-full px-4 py-1 text-lg font-bold border-2 hover:text-green-500 hover:border-green-500 bg-slate-950">
                        <span>Resume (View Mode)</span>
                        <span><font-awesome-icon :icon="['fas', 'angle-down']" class="transition-all duration-700" :class="{'-rotate-180': !resume.show}"/></span>
                    </button>
                    <div class="overflow-hidden transition-all duration-500 bg-slate-950/50" :class="{'max-h-0': !resume.show, 'max-h-[9999px]': resume.show}">
                        <div v-if="form.downloadable_resume == 'dynamic'" class="h-[50vh] relative">
                            <div class="h-full overflow-y-auto">
                                <Resume v-model="resume.data"/>
                            </div>
                            <Link :href="route('user.resume.edit')" class="inline-block">
                                <PrimaryButton type="button" class="absolute flex gap-1 top-4 left-4 place-items-center">
                                    <font-awesome-icon :icon="['fas', 'pen']"/>
                                    <span>Edit</span>
                                </PrimaryButton>
                            </Link>
                        </div>
                        <div v-else-if="form.downloadable_resume == 'uploaded'" class="w-full h-[50vh]">
                            <div v-if="resume.uploaded_path == ''" class="flex justify-center h-full text-lg place-items-center">No resume uploaded!</div>
                            <iframe v-else :src="resume.uploaded_path"  class="w-full h-full"></iframe>
                        </div>
                    </div>
                </div>
                <PrimaryButton type="submit" class="my-4" :disabled="form.processing">Set as Downloadable Resume</PrimaryButton>
            </form>
        </div>
    </DarkGlass>
</template>
