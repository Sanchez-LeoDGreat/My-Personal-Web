<script setup>
    import { Head } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import selfLogo from '@/assets/img/self-logo.png';
    import TypeWriter from '@/Components/Effects/TextEffect/TypeWriter.vue';

    const greenText = (txt) => `<span class="text-green-500">${txt}</span>`;

    const mySkills = [
        `a ${greenText('Hobbyist Programmer.')}`,
        `a ${greenText('Software Developer.')}`,
        `a ${greenText('Web Developer.')}`,
        `a ${greenText('Digital Artist.')}`,
        `a ${greenText('System UI/UX Designer.')}`,
        `also ${greenText('Handsome! &#128521;')}`
    ];
</script>

<template>
    <Head title="Home"/>
    <MarginLayout class="flex flex-grow">
        <DarkGlass class="flex flex-grow my-2 border-white border-[1px] md:place-items-center">
            <div class="flex flex-col gap-8 m-10 md:gap-0 md:flex-row md:place-items-center">
                <div class="md:w-[55%]">
                    <HeaderText class="text-3xl">Leonard Paulo Sanchez</HeaderText>
                    <HeaderText class="">
                        <span>I'm </span><TypeWriter class="inline" :strings="mySkills"/>
                    </HeaderText>
                    <div class="flex flex-col gap-2 text-justify">
                        <p>"Sharpen first, cut fast."</p>
                        <p>
                            Success isn't just about hard work—it's about working smart.
                            Whether it's crafting efficient solutions, refining ideas,
                            or building innovative projects, I believe preparation
                            is the key to excellence. Here, you'll find my journey,
                            skills, and insights, all shaped by a commitment to sharpening
                            my craft before taking action.
                        </p>
                        <p>Let's create something great together.</p>
                    </div>
                    <button class="px-4 py-2 my-2 font-medium text-black transition-all bg-white rounded-full hover:shadow-green-500 hover:shadow-md active:shadow-blue-500 active:text-blue-500">Download CV</button>
                </div>
                <div class="md:w-[45%]">
                    <img :src="selfLogo" alt="self-logo.png" class="">
                </div>
            </div>
        </DarkGlass>
    </MarginLayout>
</template>
