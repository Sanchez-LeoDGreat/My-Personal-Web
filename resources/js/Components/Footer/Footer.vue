<script setup>
    import FooterIcon from './Partials/FooterIcon.vue';
    import { faCopyright } from '@fortawesome/free-solid-svg-icons';
</script>

<template>
    <footer class="py-2 text-white bg-slate-950">
        <div class="justify-between mx-2 md:flex">
            <div class="text-sm text-center md:flex place-items-center">
                <p>
                    <font-awesome-icon :icon="faCopyright"/>
                    <span><span class="font-bold"> Developed by:</span> Sanchez, Leonard Paulo G.</span>
                </p>
            </div>
            <div class="flex justify-center gap-2">
                <FooterIcon route="" :icon="['fab', 'github']"/>
                <FooterIcon route="" :icon="['fab', 'facebook']"/>
                <FooterIcon route="" :icon="['fab', 'youtube']"/>
                <FooterIcon route="" :icon="['fab', 'tiktok']"/>
            </div>
        </div>

    </footer>
</template>
