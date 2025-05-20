<script setup>
    import StaticAsset from '@/Utils/StaticAsset';
    import { DarkGlass, StarRating, TextAreaInput, LabelText, TextInput, PrimaryButton } from '@/Utils/MyComponents';
    import { onMounted, ref, Transition, watch } from 'vue';
    import { useForm, usePage } from '@inertiajs/vue3';
    import { generateAvatar, STORAGE_PATH } from '@/Utils/AppUtils';
    import { debounce } from 'lodash';
    import { ucwords } from '@/Utils/StringUtils';

    const props = defineProps({
        show: {
            type: Boolean,
            default: false,
        },
        project: {
            type: Object,
            required: true,
        },
        rating: {
            type: Number,
            default: 0,
        }
    });

    const icon = STORAGE_PATH + props.project.icon_path;
    const avatar = ref(null);
    const emit = defineEmits(['update:show', 'update:rating']);
    const setAvatar = debounce((e) => {
        const value = ucwords(e.target.value.trim()) || 'Anonymous';
        avatar.value = generateAvatar(value);
    }, 1000);

    const form = useForm({
        project_id: props.project.id,
        name: null,
        rating: props.rating,
        comment: null,
    });

    const hideWriteReview = () => {
        emit('update:show', false);
        emit('update:rating', 0);
    }

    const submitReview = () => {
        form.post(route('projects.reviews.store'), {
            preserveState: false,
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success, { type: 'success' });
            },
            onError: () => {
                if (form.errors.project_id){
                    showModalMessage(`Error: ${form.errors.project_id}`, { type: 'error'});
                } else if (form.errors.review) {
                    showModalMessage(`Error: ${form.errors.review}`, { type: 'error'});
                }
            },
        });
    }

    watch(() => props.rating, (newVal) => {
        emit('update:rating', newVal);
        form.rating = newVal;
    });

    onMounted(() => {
        avatar.value = generateAvatar('Anonymous');
    });
</script>

<template>
    <Transition name="slide-width">
        <div v-if="show" class="fixed flex-col z-10 flex w-full h-screen top-0 right-0 overflow-hidden">
            <div class="bg-slate-950 flex place-items-center">
                <div>
                    <button @click="hideWriteReview" class="text-white text-2xl m-3 hover:text-green-500 active:text-blue-500">
                        <font-awesome-icon :icon="['fas', 'close']"/>
                    </button>
                </div>
                <div class="flex-grow flex gap-2 items-center min-w-0">
                    <div class="w-10">
                        <img :src="icon" alt="Project Icon" class="w-10">
                    </div>
                    <div class="overflow-hidden w-full">
                        <div class="truncate whitespace-nowrap pr-4 w-full" v-text="project.name"></div>
                        <div class="text-xs">Rate this project</div>
                    </div>
                </div>
            </div>
            <div class="bg-white flex-grow bg-cover bg-center bg-no-repeat" :style="{ backgroundImage: `url(${StaticAsset.img.bg1})` }">
                <DarkGlass class="h-full w-full">
                    <form @submit.prevent="submitReview" class="p-4 flex flex-col gap-4">
                        <div class="flex gap-2">
                            <div>
                                <img :src="avatar" alt="Avatar" class="w-16 rounded-sm h-16">
                            </div>
                            <div class="flex-grow">
                                <LabelText for="name">Name</LabelText>
                                <TextInput id="name" v-model="form.name" @input="setAvatar" placeholder="Input your name here (optional)"/>
                            </div>
                        </div>
                        <div>
                            <LabelText>Rating</LabelText>
                            <StarRating v-model:rating="form.rating" :rateable="true" :projectId="project.id" :max="5" size="text-4xl"/>
                        </div>
                        <div>
                            <LabelText for="comment">Comment</LabelText>
                            <TextAreaInput id="comment" v-model="form.comment" placeholder="Describe your experience here (optional)"/>
                        </div>
                        <div>
                            <PrimaryButton type="submit" :disabled="form.processing || !form.rating">Post</PrimaryButton>
                        </div>
                    </form>
                </DarkGlass>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
    .slide-width-enter-active,
    .slide-width-leave-active {
        transition: width 0.3s ease;
    }

    .slide-width-enter-from,
    .slide-width-leave-to {
        width: 0%;
    }

    .slide-width-enter-to,
    .slide-width-leave-from {
        width: 100%;
    }
</style>