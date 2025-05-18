<script setup>
    import { Head } from '@inertiajs/vue3';
    import { DarkGlass, ProjectPreviews, PrimaryButton, IconInput, HeaderText, Prose, VersionList } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { onMounted, ref } from 'vue';
    import { formatToCompactNumber } from '@/Utils/StringUtils';
    import { calculateRatings } from '@/Utils/AppUtils';

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        },
        downloadable_id: String,
    });
    const icon = STORAGE_PATH + props.project.icon_path;
    const rate = ref(0);
    const ratings = props.project.reviews.map((review) => review.rating, 0);
    const selectedVersion = props.project.downloadables?.find(downloadable => downloadable.id == props.downloadable_id) || null;
    const downloadCount = selectedVersion?.download_count;
    const previews = JSON.parse(props.project.previews).map((preview) => {
        return STORAGE_PATH + preview;
    });

    onMounted(() => {
        rate.value = calculateRatings(ratings);
    })
</script>

<template>
    <Head title="Add Project Version"/>
    <DarkGlass class="min-h-screen p-2">
        <div class="p-4">
            <div>
                <div class="flex gap-2">
                    <IconInput :defaultIcon="icon"/>
                    <div class="flex flex-col justify-between flex-grow">
                        <div>
                            <div v-text="project.name" class="text-2xl font-medium"></div>
                            <div v-text="selectedVersion?.version" class="text-sm "></div>
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
                                <span>|</span>
                                <div class="flex gap-1 text-sm place-items-center" title="Downloads">
                                    <span v-text="formatToCompactNumber(downloadCount)"></span>
                                    <font-awesome-icon :icon="['fas', 'download']"/>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            <PrimaryButton class="flex gap-1 place-items-center">
                                <font-awesome-icon :icon="['fas', 'download']"/>
                                <span>Download</span>
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    <div>
                        <ProjectPreviews :previews="previews"/>
                    </div>
                    <div>
                        <div v-if="selectedVersion?.what_is_new" class="mb-10">
                            <HeaderText>What's New</HeaderText>
                            <Prose v-html="selectedVersion?.what_is_new"/>
                        </div>
                        <div v-if="project.about" class="mb-10">
                            <HeaderText>About</HeaderText>
                            <Prose v-html="project.about"/>
                        </div>
                        <div v-if="project.summary" class="mb-10">
                            <HeaderText>Summary</HeaderText>
                            <Prose v-html="project.summary"/>
                        </div>
                        <div v-if="project.description" class="mb-10">
                            <HeaderText>Description</HeaderText>
                            <Prose v-html="project.description"/>
                        </div>
                        <div v-if="project.downloadable && project.downloadables" class="mb-10 md:w-96">
                            <HeaderText>Other Versions</HeaderText>
                            <VersionList :projectId="project.id" :versions="project.downloadables"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DarkGlass>
</template>