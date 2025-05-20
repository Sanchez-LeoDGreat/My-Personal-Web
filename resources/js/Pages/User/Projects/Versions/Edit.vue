<script setup>
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, IconInput, LabelText, TextInput, FieldMessage, FileInput, RichTextEditorInput } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { onMounted, ref } from 'vue';
    import { formatToCompactNumber } from '@/Utils/StringUtils';
    import { calculateRatings } from '@/Utils/AppUtils';

    const props = defineProps({
        downloadable: {
            type: Object,
            required: true,
        }
    });
    const icon = STORAGE_PATH + props.downloadable.project.icon_path;
    const rate = ref(0);
    const ratings = props.downloadable.project.reviews.map((review) => review.rating, 0);

    const form = useForm({
        project_id: props.downloadable.project.id,
        downloadable_id: props.downloadable.id,
        version: props.downloadable.version,
        what_is_new: props.downloadable.what_is_new,
        downloadable_file: null,
    });

    const updateProjectVersion = () => {
        form.post(route('projects.update-version'), {
            forceFormData: true,
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success, { type: 'success' });
            }
        });
    }

    onMounted(() => {
        rate.value = calculateRatings(ratings);
    })
</script>

<template>
    <Head title="Edit Project Version"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Edit <span class="text-green-500">Version</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.edit', downloadable.project.id)" class="inline-block">
                    <PrimaryButton class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'angle-left']"/>
                        <span>Go Back</span>
                    </PrimaryButton>
                </Link>
            </div>
            <div>
                <div class="flex gap-2">
                    <IconInput :defaultIcon="icon"/>
                    <div class="flex-grow">
                        <div v-text="downloadable.project.name" class="text-2xl font-medium"></div>
                        <div class="flex flex-row gap-2">
                            <div class="flex gap-1 text-sm place-items-center" title="Ratings">
                                <span v-text="rate.toFixed(1)"></span>
                                <font-awesome-icon :icon="['fas', 'star']"/>
                            </div>
                            <span>|</span>
                            <div class="flex gap-1 text-sm place-items-center" title="Views">
                                <span v-text="formatToCompactNumber(downloadable.project.view_count)"></span>
                                <font-awesome-icon :icon="['fas', 'eye']"/>
                            </div>
                        </div>
                    </div>
                </div>
                <form @submit.prevent="updateProjectVersion">
                    <div>
                        <LabelText for="version">Version</LabelText>
                        <TextInput id="version" v-model="form.version" placeholder="v1.0.0"/>
                        <FieldMessage v-if="form.errors.version" status="error">{{ form.errors.version }}</FieldMessage>
                    </div>
                    <div>
                        <LabelText for="downloadable_file">Downloadable File</LabelText>
                        <FileInput id="downloadable_file" v-model="form.downloadable_file"/>
                        <FieldMessage v-if="form.errors.downloadable_file" status="error">{{ form.errors.downloadable_file }}</FieldMessage>
                    </div>
                    <div>
                        <LabelText for="what_is_new">What's New</LabelText>
                        <RichTextEditorInput v-model="form.what_is_new"/>
                        <FieldMessage v-if="form.errors.what_is_new" status="error">{{ form.errors.what_is_new }}</FieldMessage>
                    </div>
                    <div class="my-4">
                        <PrimaryButton type="submit" :disabled="form.processing" class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'save']"/>
                            <span>Save</span>
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </DarkGlass>
</template>