<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        rating: {
            type: Number,
            required: true,
        },
        max: {
            type: Number,
            default: 5,
        },
        size: {
            type: String,
            default: 'text-xl'
        },
        color: {
            type: String,
            default: 'text-green-500',
        },
        rateable: {
            type: Boolean,
            default: false,
        }
    });

    const hoveredRating = ref(null);
    const emit = defineEmits(['update:rating']);

    const selectStarRating = (value) => {
        if (props.rateable) {
            hoveredRating.value = value;
        }
    };

    const confirmStarRating = (value) => {
        if (props.rateable) {
            emit('update:rating', value);
            hoveredRating.value = null;
        }
    }

    const resetHover = () => {
        if (props.rateable) {
            hoveredRating.value = null;
        }
    };
</script>

<template>
    <div class="flex items-center justify-between gap-1 md:justify-start" @mouseleave="resetHover">
        <div v-for="(i, index) in max" :key="i" @click="confirmStarRating(index + 1)" @mouseenter="selectStarRating(index + 1)" class="flex place-items-center" :class="{'cursor-pointer': rateable}">
            <!-- Full Star -->
            <font-awesome-icon v-if="(hoveredRating !== null ? hoveredRating : rating) >= index + 1" :icon="['fas', 'star']" :class="[color, size]"/>
            <!-- Half Star -->
            <font-awesome-icon v-else-if="(hoveredRating !== null ? hoveredRating : rating) >= index + 0.5" :icon="['fas', 'star-half-alt']" :class="[color, size]"/>
            <!-- Empty Star -->
            <font-awesome-icon v-else :icon="['far', 'star']" :class="[color, size]"/>
        </div>
    </div>
</template>
