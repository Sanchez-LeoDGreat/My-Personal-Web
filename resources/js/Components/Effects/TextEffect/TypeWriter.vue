<script setup>
    import { Typed } from '@duskmoon/vue3-typed-js';

    const props = defineProps({
        strings: {
            type: [String, Array],
            required: true,
        },
        loop: {
            type: Boolean,
            default: true,
        },
        typeSpeed: {
            type: Number,
            default: 50,
        },
        backSpeed:{
            type: Number,
            default: 10,
        },
        backDelay: {
            type: Number,
            default: 1000
        },
    });

    const options = {
        strings: props.strings,
        loop: props.loop,
        typeSpeed: props.typeSpeed,
        backSpeed: props.backSpeed,
        backDelay: props.backDelay,
    };
</script>

<template>
    <Typed :options="options">
        <span class="typing"></span>
    </Typed>
</template>
