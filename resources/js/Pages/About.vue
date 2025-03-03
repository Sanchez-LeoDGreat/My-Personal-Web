<script setup>
    import { Head } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import OdooLogo from '@/Components/SVG/OdooLogo.vue';
    import PythonLogo from '@/Components/SVG/PythonLogo.vue';
    import DotNetLogo from '@/Components/SVG/DotNetLogo.vue';
    import CLogo from '@/Components/SVG/CLogo.vue';
    import CSharpLogo from '@/Components/SVG/CSharpLogo.vue';
    import GodotLogo from '@/Components/SVG/GodotLogo.vue';
    import TailwindLogo from '@/Components/SVG/TailwindLogo.vue';
    import Timeline from '@/Components/Timeline/Timeline.vue';
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
                    <div class="flex gap-2 px-4 py-2 text-blue-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-blue-300">
                        <div class="w-5">
                            <CLogo/>
                        </div>
                        <div class="text-white">C Language</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-purple-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-purple-300">
                        <div class="w-5">
                            <CSharpLogo/>
                        </div>
                        <div class="text-white">C# Language</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-orange-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-orange-300">
                        <font-awesome-icon :icon="['fab', 'html5']" class="text-xl"/>
                        <div class="text-white">HTML5</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-blue-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-blue-300">
                        <font-awesome-icon :icon="['fab', 'css3-alt']" class="text-xl"/>
                        <div class="text-white">CSS</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 rounded-md shadow-sm text-cyan-500 backdrop-blur-sm bg-slate-950/5 place-items-center shadow-cyan-300">
                        <div class="w-7">
                            <TailwindLogo/>
                        </div>
                        <div class="text-white">Tailwind CSS</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-yellow-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-yellow-300">
                        <font-awesome-icon :icon="['fab', 'js']" class="text-xl"/>
                        <div class="text-white">JavaScript</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-blue-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-blue-300">
                        <font-awesome-icon :icon="['fab', 'php']" class="text-xl"/>
                        <div class="text-white">PHP</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-yellow-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-yellow-300">
                        <div class="w-7">
                            <PythonLogo/>
                        </div>
                        <div class="text-white">Python</div>
                    </div>

                    <!-- Frameworks/Enginges etc. -->
                    <div class="flex gap-2 px-4 py-2 text-purple-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-purple-300">
                        <div class="w-6">
                            <DotNetLogo/>
                        </div>
                        <div class="text-white">.NET Framework</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 rounded-md shadow-sm text-cyan-500 backdrop-blur-sm bg-slate-950/5 place-items-center shadow-cyan-300">
                        <font-awesome-icon :icon="['fab', 'wordpress']" class="text-xl"/>
                        <div class="text-white">WordPress</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-blue-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-blue-300">
                        <div class="w-6">
                            <GodotLogo/>
                        </div>
                        <div class="text-white">Godot</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-purple-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-purple-300">
                        <div class="w-12">
                            <OdooLogo/>
                        </div>
                        <div class="text-white">Odoo</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-orange-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-orange-300">
                        <font-awesome-icon :icon="['fab', 'laravel']" class="text-xl"/>
                        <div class="text-white">Laravel</div>
                    </div>
                    <div class="flex gap-2 px-4 py-2 text-green-500 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center shadow-green-300">
                        <font-awesome-icon :icon="['fab', 'vuejs']" class="text-xl"/>
                        <div class="text-white">VueJS</div>
                    </div>
                </div>
            </div>
            <div>
                <HeaderText>My <span class="text-green-500">Experience</span></HeaderText>
                <Timeline/>
            </div>
        </DarkGlass>
    </MarginLayout>
</template>
