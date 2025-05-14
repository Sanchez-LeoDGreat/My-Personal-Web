<script setup>
    import { useEditor, EditorContent } from '@tiptap/vue-3'
    import Prose from '../Prose.vue';
    import StarterKit from '@tiptap/starter-kit';
    import TextStyle from '@tiptap/extension-text-style';
    import { Color } from '@tiptap/extension-color';
    import { watch } from 'vue';

    const props = defineProps({
        modelValue: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const editor = useEditor({
        onUpdate: ({ editor }) => {
            emit('update:modelValue', editor.getHTML())
        },
        editorProps: {
            attributes: {
                class: 'border-slate-950 w-full focus:outline-none bg-white border-2 px-2'
            },
        },
        content: props.modelValue,
        extensions: [
            StarterKit,
            Color,
            TextStyle,
        ],
    })

    watch(() => props.modelValue, (newValue) => {
        if (editor.value && editor.value.getHTML() !== newValue) {
            editor.value.commands.setContent(newValue, false);
        }
    });
</script>

<template>
    <Prose class="text-black prose-p:my-1">
        <section v-if="editor" class="flex flex-wrap gap-2 p-1 text-white border-t-2 border-l-2 border-r-2 bg-slate-950 border-slate-950">
            <button type="button" @click="editor.chain().focus().setColor('#22c55e').run()" title="Text Color" :class="{ 'is-active': editor.isActive('textStyle', { color: '#22c55e' })}">
                <font-awesome-icon :icon="['fas', 'brush']"/>
            </button>
            <button type="button" @click="editor.chain().focus().unsetColor().run()" title="Unset Text Color">
                <font-awesome-icon :icon="['fas', 'droplet-slash']"/>
            </button>
            <button type="button" @click="editor.chain().focus().undo().run()" title="Undo" :disabled="!editor.can().undo()">
                <font-awesome-icon :icon="['fas', 'rotate-left']"/>
            </button>
            <button type="button" @click="editor.chain().focus().redo().run()" title="Redo" :disabled="!editor.can().redo()">
                <font-awesome-icon :icon="['fas', 'rotate-right']"/>
            </button>
        </section>
        <EditorContent :editor="editor" />
    </Prose>
</template>

<style scoped>
    button{
        @apply min-w-8 rounded-sm
    }

    button.is-active{
        @apply bg-slate-950 text-white
    }
</style>
