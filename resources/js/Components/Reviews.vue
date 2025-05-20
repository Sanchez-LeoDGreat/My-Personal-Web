<script setup>
    import { Link } from '@inertiajs/vue3';
    import { StarRating } from '@/Utils/MyComponents';
    import { formattedDate } from '@/Utils/StringUtils';
    import { generateAvatar } from '@/Utils/AppUtils';

    const props = defineProps({
        reviews: Array
    });
</script>

<template>
    <div>
        <div class="flex flex-col gap-6">
            <div v-for="review in reviews" :key="review.id" class="flex flex-col gap-1">
                <div class="flex gap-1 place-items-center">
                    <div>
                        <img :src="generateAvatar(review.name || 'Anonymous')" alt="Avatar" class="w-10 h-10 rounded-sm max-h-10 max-w-10">
                    </div>
                    <div v-text="review.name || 'Anonymous'"></div>
                </div>
                <div class="flex gap-2 place-items-center">
                    <StarRating :rating="review.rating" :max="5" size="text-xs"/>
                    <div v-text="formattedDate(review.created_at)" class="text-sm text-gray-500"></div>
                </div>
                <div v-if="review.comment" v-text="review.comment"></div>
            </div>
        </div>
        <div class="my-4">
            <Link href="#" class="py-1 font-medium text-green-500 hover:underline">See all reviews</Link>
        </div>
    </div>
</template>