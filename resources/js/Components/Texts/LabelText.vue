<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
  status: {
    type: String,
    default: "normal",
  },
});

const setStatusColor = () => {
  switch (props.status) {
    case "success":
      return "text-green-700 dark:text-green-500";
    case "error":
      return "text-red-700 dark:text-red-500";
    case "warning":
      return "text-yellow-700 dark:text-yellow-500";
    default:
      return "";
  }
};
</script>

<template>
  <label for="" class="block mb-1 font-medium" :class="setStatusColor()">
    <slot />
  </label>
</template>
