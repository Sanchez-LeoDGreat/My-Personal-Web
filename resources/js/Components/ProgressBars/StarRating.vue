<script setup>
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
    });
</script>

<template>
  <div class="flex items-center gap-1">
    <template v-for="i in max" :key="i">
      <!-- Full Star -->
      <font-awesome-icon v-if="rating >= i" :icon="['fas', 'star']" :class="[color, size]"/>
      <!-- Half Star -->
      <font-awesome-icon
        v-else-if="rating >= i - 0.5" :icon="['fas', 'star-half-alt']" :class="[color, size]"/>
      <!-- Empty Star -->
      <font-awesome-icon v-else :icon="['far', 'star']" :class="[color, size]"/>
    </template>
  </div>
</template>
