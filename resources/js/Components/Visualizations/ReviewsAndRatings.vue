<script setup>
    import { onMounted, ref } from 'vue';
    import { calculateRatings } from '@/Utils/AppUtils';
    import { StarRating } from '@/Utils/MyComponents';

    const props = defineProps({
        reviews: {
            type: Array,
            required: true,
        }
    });

    const rate = ref(0);
    const stars = [5, 4, 3, 2, 1];
    const reviewStarCounts = ref([]);
    const ratings = props.reviews.map((review) => review.rating, 0);

    const getReviewStarCount = (rating) => {
        const matchingReviews = props.reviews.filter(review => Math.round(review.rating) == rating);
        return {
            star: rating,
            value: matchingReviews.length,
            max: props.reviews.length,
        };
    };

    onMounted(() => {
        rate.value = calculateRatings(ratings);
        stars.forEach((star) => {
            reviewStarCounts.value.push(getReviewStarCount(star));
        });
    })
</script>

<template>
    <div class="flex gap-4">
        <div class="flex flex-col justify-between">
            <div>
                <div class="mb-3 text-center">
                    <div v-text="rate.toFixed(1)" class="text-6xl"></div>
                </div>
                <div>
                    <StarRating :rating="rate" :max="5" size="text-xs"/>
                </div>
            </div>
            <div>
                <div v-text="reviews.length.toLocaleString()"></div>
            </div>
        </div>
        <div class="flex-grow">
            <div v-for="count in reviewStarCounts" :key="count" class="flex gap-2 place-items-center">
                <span>{{ count.star }}</span>
                <progress class="w-full overflow-hidden rounded [&::-webkit-progress-value]:bg-green-500 [&::-webkit-progress-bar]:bg-slate-950/75 outline-1 outline outline-white" :value="count.value" :max="count.max"></progress>
            </div>
        </div>
    </div>
</template>