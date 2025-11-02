<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { nextTick, onMounted, reactive, watch, computed } from 'vue';
    import { DarkGlass, ReviewCard, Loading, PaginationControls } from '@/Utils/MyComponents';
    import { STORAGE_PATH } from '@/Utils/AppUtils';

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        },
    });
    const icon = STORAGE_PATH + props.project.icon_path;

    const reviews = reactive({
        loading: {
            finished: false,
            status: 'loading',
        },
        data: [],
        links: [],
    });
    const options = reactive({
        project_id: props.project.id,
        filter: 'all',
        page: 1,
    });

    const fetchReviews = async () => {
        try{
            reviews.loading.finished = false;
            reviews.loading.status = 'loading';
            const response = await axios.post(route('api.fetch-reviews'), options);
            const data = response.data;
            if (data.success){
                reviews.data = data.reviews.data;
                reviews.links = data.reviews.links;
            } else {
                throw new Error(data.message || 'Unable to fetch reviews.');
            }
        } catch (err) {
            showModalMessage(`Error: ${err.message}`, { type: 'error' });
            reviews.loading.status = 'error';
        } finally {
            reviews.loading.finished = true;
        }
    }

    const isLoading = computed(() => {
        const loadingVal = reviews.loading;
        if (loadingVal.finished){
            if (loadingVal.status =='error'){
                return true;
            }
            return false;
        }
        return true;
    });

    onMounted(async () => {
        await nextTick();
        await fetchReviews();
    });

    watch(options, async () => {
        await nextTick();
        await fetchReviews();
    });
</script>

<template>
    <Head title="Reviews"/>
    <DarkGlass class="min-h-[90vh] flex flex-col">
        <div class="flex bg-slate-950 place-items-center">
            <div>
                <Link :href="route('projects.view', { project_id: project.id })" class="inline-block m-3 text-2xl text-white hover:text-green-500 active:text-blue-500">
                    <font-awesome-icon :icon="['fas', 'angle-left']"/>
                </Link>
            </div>
            <div class="flex items-center flex-grow min-w-0 gap-2">
                <div class="w-10">
                    <img :src="icon" alt="Project Icon" class="w-10">
                </div>
                <div class="w-full overflow-hidden">
                    <div class="w-full pr-4 truncate whitespace-nowrap" v-text="project.name"></div>
                    <div class="text-xs">Rating and Reviews</div>
                </div>
            </div>
        </div>
        <div class="flex gap-2 px-2 py-2 overflow-x-auto text-sm bg-slate-950">
            <button @click="options.filter = 'all'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == 'all'}">
                <font-awesome-icon v-if="options.filter == 'all'" :icon="['fas', 'check']"/>
                <span>All</span>
            </button>
            <button @click="options.filter = '5stars'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == '5stars'}">
                <font-awesome-icon v-if="options.filter == '5stars'" :icon="['fas', 'check']"/>
                <span>5</span>
                <font-awesome-icon :icon="['fas', 'star']" class="text-xs"/>
            </button>
            <button @click="options.filter = '4stars'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == '4stars'}">
                <font-awesome-icon v-if="options.filter == '4stars'" :icon="['fas', 'check']"/>
                <span>4</span>
                <font-awesome-icon :icon="['fas', 'star']" class="text-xs"/>
            </button>
            <button @click="options.filter = '3stars'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == '3stars'}">
                <font-awesome-icon v-if="options.filter == '3stars'" :icon="['fas', 'check']"/>
                <span>3</span>
                <font-awesome-icon :icon="['fas', 'star']" class="text-xs"/>
            </button>
            <button @click="options.filter = '2stars'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == '2stars'}">
                <font-awesome-icon v-if="options.filter == '2stars'" :icon="['fas', 'check']"/>
                <span>2</span>
                <font-awesome-icon :icon="['fas', 'star']" class="text-xs"/>
            </button>
            <button @click="options.filter = '1star'" class="flex gap-2 px-2 py-1 border-2 rounded-md place-items-center" :class="{'active': options.filter == '1star'}">
                <font-awesome-icon v-if="options.filter == '1star'" :icon="['fas', 'check']"/>
                <span>1</span>
                <font-awesome-icon :icon="['fas', 'star']" class="text-xs"/>
            </button>
        </div>
        <div class="flex flex-col flex-grow max-h-full p-4 overflow-y-auto">
            <Loading v-if="isLoading" :finished="reviews.loading.finished" :status="reviews.loading.status" class="flex justify-center flex-grow place-items-center"/>
            <div v-else class="flex flex-col flex-grow gap-4 mb-2">
                <template v-if="reviews.data.length">
                    <div v-for="review in reviews.data" :key="review.id">
                        <ReviewCard :review="review" class="w-full max-w-full"/>
                    </div>
                </template>
                <div v-else class="flex justify-center flex-grow">
                    <span class="my-10">No result</span>
                </div>
            </div>
            <div>
                <PaginationControls v-model="options.page" :links="reviews.links" class="my-2"/>
            </div>
        </div>
    </DarkGlass>
</template>

<style scoped>
    button.active{
        @apply border-green-500 text-green-500
    }
</style>