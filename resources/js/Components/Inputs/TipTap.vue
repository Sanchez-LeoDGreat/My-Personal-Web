<script setup>
    import { useEditor, EditorContent } from '@tiptap/vue-3'
    import Prose from '../Prose.vue';
    import StarterKit from '@tiptap/starter-kit';
    import Underline from '@tiptap/extension-underline';
    import Heading from '@tiptap/extension-heading';

    const props = defineProps({
        modelValue: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const editor = useEditor({
        onUpdate: ({editor}) => {
            emit('update:modelValue', editor.getHTML())
        },
        editorProps: {
            attributes: {
                class: 'border-white w-full focus:outline-none backdrop-blur-md bg-slate-950/70 border-2 px-4 min-h-[10rem] max-h-[14rem] overflow-auto'
            },
        },
        content: props.modelValue,
        extensions: [
            StarterKit,
            Underline,
            Heading.configure({
                levels: [1, 2]
            }),
        ],
    })
</script>

<template>
    <Prose class="m-2 text-white">
        <section v-if="editor" class="bg-slate-950 flex gap-2 flex-wrap border-white border-t-2 border-l-2 border-r-2 p-2">
            <button @click="editor.chain().focus().toggleBold().run()" title="Bold" :class="{ 'is-active': editor.isActive('bold') }">
                <font-awesome-icon :icon="['fas', 'bold']"/>
            </button>
            <button @click="editor.chain().focus().toggleItalic().run()" title="Italic" :class="{ 'is-active': editor.isActive('italic') }">
                <font-awesome-icon :icon="['fas', 'italic']"/>
            </button>
            <button @click="editor.chain().focus().toggleUnderline().run()" title="Underline" :class="{ 'is-active': editor.isActive('underline') }">
                <font-awesome-icon :icon="['fas', 'underline']"/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({level: 1}).run()" title="H1" :class="{ 'is-active': editor.isActive('heading', {level: 1}) }">
                <div class="font-bold">H1</div>
            </button>
            <button @click="editor.chain().focus().toggleHeading({level: 2}).run()" title="H2" :class="{ 'is-active': editor.isActive('heading', {level: 2}) }">
                <div class="font-bold">H2</div>
            </button>
            <button @click="editor.chain().focus().toggleBulletList().run();" title="Bullet List" :class="{ 'is-active': editor.isActive('bulletList') }">
                <font-awesome-icon :icon="['fas', 'list-ul']"/>
            </button>
            <button @click="editor.chain().focus().toggleOrderedList().run();" title="Ordered List" :class="{ 'is-active': editor.isActive('orderedList') }">
                <font-awesome-icon :icon="['fas', 'list']"/>
            </button>
            <button @click="editor.chain().focus().toggleBlockquote().run()" title="Blockquote" :class="{ 'is-active': editor.isActive('blockquote') }">
                <font-awesome-icon :icon="['fas', 'quote-left']"/>
            </button>
            <button @click="editor.chain().focus().toggleCode().run()" title="Code" :class="{ 'is-active': editor.isActive('code') }">
                <font-awesome-icon :icon="['fas', 'code']"/>
            </button>
            <button @click="editor.chain().focus().toggleStrike().run()" title="Strikethrough" :class="{ 'is-active': editor.isActive('strike') }">
                <font-awesome-icon :icon="['fas', 'strikethrough']"/>
            </button>
            <button @click="editor.chain().focus().undo().run()" title="Undo" :disabled="!editor.can().undo()">
                <font-awesome-icon :icon="['fas', 'rotate-left']"/>
            </button>
            <button @click="editor.chain().focus().redo().run()" title="Redo" :disabled="!editor.can().redo()">
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
        @apply bg-white text-black
    }
</style>
