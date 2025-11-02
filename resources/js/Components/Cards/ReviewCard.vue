<script setup>
    import { StarRating } from '@/Utils/MyComponents';
    import { formattedDate } from '@/Utils/StringUtils';
    import { generateAvatar } from '@/Utils/AppUtils';

    const props = defineProps({
        review: {
            type: Object,
            required: true,
        }
    })
</script>

<template>
    <div>
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
        <hr class="mt-2">
    </div>
</template>