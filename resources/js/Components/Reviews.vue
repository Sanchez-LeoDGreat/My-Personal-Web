<script setup>
    import { Link } from '@inertiajs/vue3';
    import { ReviewCard } from '@/Utils/MyComponents';

    const props = defineProps({
        reviews: Array,
        projectId: Number,
    });
</script>

<template>
    <div>
        <div class="flex flex-col gap-6">
            <div v-for="review in reviews" :key="review.id" class="flex flex-col gap-1">
                <ReviewCard :review="review"/>
            </div>
        </div>
        <div class="my-4">
            <Link :href="route('projects.reviews', { project_id: projectId })" class="py-1 font-medium text-green-500 hover:underline">See all reviews</Link>
        </div>
    </div>
</template>