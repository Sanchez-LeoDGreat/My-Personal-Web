<script setup>
    import { Head } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import Timeline from '@/Components/Timeline/Timeline.vue';
    import IconCard from '@/Components/IconCard.vue';
    import asset from '@/utils/asset.js';
    import { faHtml5, faCss3Alt, faJs, faPhp, faWordpress, faLaravel, faVuejs } from '@fortawesome/free-brands-svg-icons';
</script>
<template>
    <Head title="About"/>
    <MarginLayout class="flex flex-grow">
        <DarkGlass class="border-white py-6 my-2 px-10 border-[1px] flex-col flex gap-6">
            <div>
                <HeaderText class="mb-1">About <span class="text-green-500 ">Me</span></HeaderText>
                <p class="text-justify">
                    I'm a hobbyist programmer with a passion for building things and solving problems.
                    I love working on software projects, constantly exploring new ideas, and learning something new.
                    Most of the time, I work solo on my projects as a student, but lately, I’ve been eager
                    to collaborate with a team of fellow developers. Sometimes, it feels like I’m just a big fish
                    in a small pond—I know there’s so much more to learn, and working with others is the best
                    way to grow. I believe that every developer has something valuable to share, and I’m excited
                    to be part of a team where we can learn from each other and build amazing things together.
                </p>
            </div>
            <div>
                <HeaderText class="mb-2">My <span class="text-green-500">Skills</span></HeaderText>
                <div class="flex flex-wrap justify-start gap-2">
                    <!-- Languges and Stylesheets -->
                    <IconCard :icon="asset.svg.c" class="text-blue-500 shadow-blue-300">C Language</IconCard>
                    <IconCard :icon="asset.svg.cSharp" class="text-purple-500 shadow-purple-300">C# Language</IconCard>
                    <IconCard :icon="faHtml5" class="text-orange-500 shadow-orange-300">HTML5</IconCard>
                    <IconCard :icon="faCss3Alt" class="text-blue-500 shadow-blue-300">CSS</IconCard>
                    <IconCard :icon="asset.svg.tailwindCss" class="shadow-cyan-300">Tailwind CSS</IconCard>
                    <IconCard :icon="faJs" class="text-yellow-500 shadow-yellow-300">JavaScript</IconCard>
                    <IconCard :icon="faPhp" class="text-blue-500 shadow-blue-300">PHP</IconCard>
                    <IconCard :icon="asset.svg.python" class="shadow-yellow-300" iconClass="w-6">Python</IconCard>

                    <!-- Frameworks/Enginges etc. -->
                    <IconCard :icon="asset.svg.dotNet" class="shadow-purple-300">.NET Framework</IconCard>
                    <IconCard :icon="faWordpress" class="text-cyan-500 shadow-cyan-300">WordPress</IconCard>
                    <IconCard :icon="asset.svg.godot" class="shadow-blue-300">Godot</IconCard>
                    <IconCard :icon="asset.svg.odoo" class="shadow-purple-300" iconClass="w-10">Odoo</IconCard>
                    <IconCard :icon="faLaravel" class="text-orange-500 shadow-orange-300">Laravel</IconCard>
                    <IconCard :icon="faVuejs" class="text-green-500 shadow-green-300">VueJS</IconCard>
                </div>
            </div>
            <div>
                <HeaderText>My <span class="text-green-500">Experience</span></HeaderText>
                <Timeline/>
            </div>
        </DarkGlass>
    </MarginLayout>
</template>
