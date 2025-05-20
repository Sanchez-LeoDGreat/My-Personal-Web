<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { DarkGlass, ProjectPreviews, PrimaryButton, ReviewsAndRatings, IconInput, HeaderText, Prose, VersionList, StarRating, Reviews } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { onMounted, reactive, ref } from 'vue';
    import { formatToCompactNumber } from '@/Utils/StringUtils';
    import { calculateRatings, downloadFromBlob } from '@/Utils/AppUtils';
    import WriteReview from '@/Pages/Projects/Partials/WriteReview.vue';

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        },
        downloadable_id: String,
        latestReviews: Array,
        isReviewed: {
            type: Boolean,
            required: true
        }
    });

    const downloadButton = ref({
        disabled: false,
    });
    const reviews = props.project.reviews;
    const icon = STORAGE_PATH + props.project.icon_path;
    const rate = ref(0);
    const ratings = reviews.map((review) => review.rating, 0);
    const downloadables = props.project.downloadables;
    const selectedVersion = downloadables?.find(downloadable => downloadable.id == props.downloadable_id || downloadables[0].id) || null;
    const downloadCount = ref(0);
    const previews = JSON.parse(props.project.previews).map((preview) => {
        return STORAGE_PATH + preview;
    });
    const writeReview = reactive({
        show: false,
        rating: 0,
    });

    const showWriteReview = (rating) => {
        writeReview.rating = rating;
        writeReview.show = true;
    }

    const downloadProject = async () => {
        try {
            downloadButton.value.disabled = true;
            const response = await axios.post(route('projects.prepare-download'), {
                downloadable_id: selectedVersion.id,
            });
            const data = response.data;
            if (data.success) {
                const fileResponse = await axios.get(data.download_url, {
                    responseType: 'blob',
                });
                downloadFromBlob(fileResponse.data, data.filename);
                downloadCount.value += 1;
            } else {
                throw new Error(data.message || 'Something went wrong.');
            }
        } catch (err) {
            showModalMessage(`Error: ${err.message}`, { type: 'error' });
        } finally {
            downloadButton.value.disabled = false;
        }
    }

    onMounted(() => {
        rate.value = calculateRatings(ratings);
        downloadCount.value = selectedVersion?.download_count || 0;
    })
</script>

<template>
    <Head title="View Project"/>
    <DarkGlass class="min-h-screen p-2">
        <div class="p-4">
            <div>
                <div class="flex gap-2">
                    <IconInput :defaultIcon="icon"/>
                    <div class="flex flex-col justify-between flex-grow">
                        <div>
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
                                <span v-if="project.downloadable">|</span>
                                <div v-if="project.downloadable" class="flex gap-1 text-sm place-items-center" title="Downloads">
                                    <span v-text="formatToCompactNumber(downloadCount)"></span>
                                    <font-awesome-icon :icon="['fas', 'download']"/>
                                </div>
                            </div>
                            <div v-text="selectedVersion?.version" class="text-sm"></div>
                        </div>
                        <div v-if="project.downloadable" class="my-2">
                            <PrimaryButton @click="downloadProject" :disabled="downloadButton.disabled" class="flex gap-1 place-items-center">
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
                        <div v-if="project.downloadable && project.downloadables.length > 1" class="mb-10 md:w-96">
                            <HeaderText>Other Versions</HeaderText>
                            <VersionList :projectId="project.id" :versions="project.downloadables"/>
                        </div>
                    </div>
                </div>
                <div>
                    <HeaderText>Reviews and Ratings</HeaderText>
                    <ReviewsAndRatings :reviews="project.reviews" class="my-1"/>
                    <div class="flex flex-col gap-4 my-2">
                        <Reviews :projectId="project.id" :reviews="latestReviews"/>
                    </div>
                </div>
                <div v-if="isReviewed == false">
                    <HeaderText>Rate this project</HeaderText>
                    <p class="text-sm">Tell others what you think</p>
                    <div class="my-2 select-none">
                        <StarRating @click="showWriteReview(writeReview.rating)" v-model:rating="writeReview.rating" :rateable="true" :max="5" size="text-4xl"/>
                    </div>
                    <div class="my-4 select-none">
                        <button @click="showWriteReview(0)" class="py-1 font-medium text-green-500 hover:underline">Write a review</button>
                    </div>
                </div>
            </div>
        </div>
    </DarkGlass>
    <WriteReview v-if="isReviewed == false" v-model:show="writeReview.show" v-model:rating="writeReview.rating" :project="project"/>
</template>