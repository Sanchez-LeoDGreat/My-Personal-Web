<script setup>
    import { Head, useForm } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import Timeline from '@/Components/Timeline.vue';
    import IconCard from '@/Components/IconCard.vue';
    import StaticAsset from '@/Utils/StaticAsset.js';
    import Modal from '@/Components/Modal/Modal.vue';
    import ModalMessage from '@/Components/Modal/Partials/ModalMessage.vue';
    import ModalButtons from '@/Components/Modal/Partials/ModalButtons.vue';
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
    import { faHtml5, faCss3Alt, faJs, faPhp, faWordpress, faLaravel, faVuejs } from '@fortawesome/free-brands-svg-icons';
    import { onMounted, ref } from 'vue';

    const expTimeline = ref({
        loading: {
            finished: false,
            status: 'loading',
            error: null,
        },
        rows: [],
    });

    const modal = ref({
        show: false,
        type: null,
        message: null,
    });

    const showModal = (type, msg) => {
        modal.value.show = true;
        modal.value.type = type;
        modal.value.message = msg;
    }

    const getExperienceTimeline = async () => {
        try{
            const response = await axios.get(route('api.get-timeline'), {
                params: {
                    name: 'experience_timeline',
                },
            });
            const data = response.data;
            if (data.success){
                expTimeline.value.rows = data.timeline;
                expTimeline.value.loading.finished = true;
            }
            else{
                showModal('error', "<b>Error: </b>" + data.message);
                expTimeline.value.loading.status = 'error';
            }
        }
        catch (err){
            showModal("error", "<b>Error: </b>" + err.message);
            expTimeline.value.loading.status = 'error';
        }
    }

    onMounted(async () => {
        getExperienceTimeline();
    });
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
                <Timeline :rows="expTimeline.rows" :loading="expTimeline.loading"/>
            </div>
        </DarkGlass>
    </MarginLayout>
    <Modal v-model:show="modal.show" :type="modal.type">
        <ModalMessage :message="modal.message"/>
        <ModalButtons>
            <SecondaryButton @click="modal.show=false" focus-on-show>OK</SecondaryButton>
        </ModalButtons>
    </Modal>
</template>
