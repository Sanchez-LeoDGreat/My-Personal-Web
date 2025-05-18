<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, IconInput, LabelText, TextInput, FieldMessage } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { onMounted, ref } from 'vue';
    import { formatToCompactNumber } from '@/Utils/StringUtils';
    import { calculateRatings } from '@/Utils/AppUtils';

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        }
    });
    const icon = STORAGE_PATH + props.project.icon_path;
    const rate = ref(0);
    const ratings = props.project.reviews.map((review) => review.rating, 0);

    const form = useForm({
        project_id: props.project.id,
        version: null,
    });

    const addProjectVersion = () => {

    }

    onMounted(() => {
        rate.value = calculateRatings(ratings);
    })
</script>

<template>
    <Head title="Add Project Version"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Add <span class="text-green-500">Version</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.edit', project.id)" class="inline-block">
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
                        <div v-text="project.name" class="text-2xl font-medium"></div>
                        <div class="flex flex-row gap-2">
                            <div class="flex gap-1 text-sm place-items-center" title="Ratings">
                                <span v-text="rate.toFixed(1)"></span>
                                <font-awesome-icon :icon="['fas', 'star']"/>
                            </div>
                            <span>|</span>
                            <div class="flex gap-1 text-sm place-items-center" title="Views">
                                <span v-text="formatToCompactNumber(project.view_count)"></span>
                                <font-awesome-icon :icon="['fas', 'eye']"/>
                            </div>
                        </div>
                    </div>
                </div>
                <form @submit.prevent="addProjectVersion">
                    <div>
                        <LabelText for="version">Version</LabelText>
                        <TextInput id="version" v-model="form.version" placeholder="v1.0.0"/>
                        <FieldMessage v-if="form.errors.version" status="error">{{ form.errors.version }}</FieldMessage>
                    </div>
                    <div>

                    </div>
                    <div class="my-4">
                        <PrimaryButton type="submit" :disabled="form.processing" class="flex gap-1 place-items-center">
                            <font-awesome-icon :icon="['fas', 'add']"/>
                            <span>Add Version</span>
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </DarkGlass>
</template>