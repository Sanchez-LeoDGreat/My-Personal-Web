<script setup>
    import { faGithub, faFacebook, faYoutube, faTiktok } from '@fortawesome/free-brands-svg-icons';
    import FooterIcon from './Partials/FooterIcon.vue';
    import { faCopyright } from '@fortawesome/free-solid-svg-icons';
</script>

<template>
    <footer class="py-2 text-white bg-slate-950">
        <div class="justify-between mx-2 md:flex">
            <div class="text-sm text-center md:flex place-items-center">
                <p>
                    <FontAwesomeIcon :icon="faCopyright"/>
                    <span><span class="font-bold"> Developed by:</span> Sanchez, Leonard Paulo G.</span>
                </p>
            </div>
            <div class="flex justify-center gap-2">
                <FooterIcon route="" :icon="faGithub"/>
                <FooterIcon route="" :icon="faFacebook"/>
                <FooterIcon route="" :icon="faYoutube"/>
                <FooterIcon route="" :icon="faTiktok"/>
            </div>
        </div>

    </footer>
</template>
