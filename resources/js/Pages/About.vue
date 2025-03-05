<script setup>
    import { Head } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import Timeline from '@/Components/Timeline.vue';
    import IconCard from '@/Components/IconCard.vue';
    import StaticAsset from '@/Utils/StaticAsset.js';
    import { faHtml5, faCss3Alt, faJs, faPhp, faWordpress, faLaravel, faVuejs } from '@fortawesome/free-brands-svg-icons';

    const timeLineRows = [
        {
            timespan: "2021-2022",
            title: "1st Year College",
            content: "When I started college, I had no idea what programming actually was since I came from a STEM background in senior high school. Our professors expected us to already know how to write code, but I didn't. However, that didn't stop me. Instead, I used my lack of knowledge as motivation to start learning. This mindset helped me tackle our activities, such as building console applications using C and C#.",
        },
        {
            timespan: "2022-2023",
            title: "2nd Year College",
            content: "In my 2nd year, we were required to develop a Windows application using the .NET Framework as part of our capstone project. My group members chose me as the system's developer while they focused on the research papers. This was the moment when my programming skills, which I had honed through self-learning, were finally recognized. During this time, I also helped many of my classmates with their systems, further making my skills known to others.",
        },
        {
            timespan: "2023-2024",
            title: "3rd Year College",
            content: "In my 3rd year, we started learning web development, and since my programming skills were well-known, I began taking on fellow students as clients. After completing my own web project, I helped others by debugging their code, adding features, and even developing entire projects for them. Around this time, I also started learning the Godot Game Engine for game development.",
        },
        {
            timespan: "2024-2025",
            title: "4th Year College",
            content: "During 4th year... TO BE CONTINUED",
        },
    ];
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
                    <IconCard :icon="StaticAsset.svg.c" class="text-blue-500 shadow-blue-300">C Language</IconCard>
                    <IconCard :icon="StaticAsset.svg.cSharp" class="text-purple-500 shadow-purple-300">C# Language</IconCard>
                    <IconCard :icon="faHtml5" class="text-orange-500 shadow-orange-300">HTML5</IconCard>
                    <IconCard :icon="faCss3Alt" class="text-blue-500 shadow-blue-300">CSS</IconCard>
                    <IconCard :icon="StaticAsset.svg.tailwindCss" class="shadow-cyan-300">Tailwind CSS</IconCard>
                    <IconCard :icon="faJs" class="text-yellow-500 shadow-yellow-300">JavaScript</IconCard>
                    <IconCard :icon="faPhp" class="text-blue-500 shadow-blue-300">PHP</IconCard>
                    <IconCard :icon="StaticAsset.svg.python" class="shadow-yellow-300" iconClass="w-6">Python</IconCard>

                    <!-- Frameworks/Enginges etc. -->
                    <IconCard :icon="StaticAsset.svg.dotNet" class="shadow-purple-300">.NET Framework</IconCard>
                    <IconCard :icon="faWordpress" class="text-cyan-500 shadow-cyan-300">WordPress</IconCard>
                    <IconCard :icon="StaticAsset.svg.godot" class="shadow-blue-300">Godot</IconCard>
                    <IconCard :icon="StaticAsset.svg.odoo" class="shadow-purple-300" iconClass="w-10">Odoo</IconCard>
                    <IconCard :icon="faLaravel" class="text-orange-500 shadow-orange-300">Laravel</IconCard>
                    <IconCard :icon="faVuejs" class="text-green-500 shadow-green-300">VueJS</IconCard>
                </div>
            </div>
            <div>
                <HeaderText class="mb-2">My <span class="text-green-500">Experience</span></HeaderText>
                <Timeline :rows="timeLineRows"/>
            </div>
        </DarkGlass>
    </MarginLayout>
</template>
