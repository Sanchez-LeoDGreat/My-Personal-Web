<script setup>
    import { createAvatar } from '@dicebear/core';
    import { initials } from '@dicebear/collection';
    import Dropdown from '@/Components/Header/Partials/Dropdown/Dropdown.vue';
    import DropdownOption from '@/Components/Header/Partials/Dropdown/DropdownOption.vue';
    import { ref, Transition } from 'vue';

    const props = defineProps({
        user: {
            type: Object,
            required: true,
        }
    });

    const show = ref(false);

    const name = props.user.first_name + ' ' + props.user.last_name;

    const profile_img = () => {
        if (!props.profile_img){
            const avatar = createAvatar(initials, {
                seed: name,
            });
            return avatar.toDataUri();
        }
        return props.profile_img;
    }
</script>

<template>
    <button @click="show=!show" class="relative flex gap-2 mx-2">
        <div class="flex my-2 ml-2 overflow-hidden rounded-full min-h-10 max-h-10 min-w-10 max-w-10 place-items-center">
            <img :src="profile_img()" alt="" class="object-cover w-full h-full max-w-full max-h-full">
        </div>
        <div class="flex place-items-center">
            <span>
                {{ name }}
            </span>
            <span class="material-symbols-outlined">
                arrow_drop_down
            </span>
            <Transition>
                <Dropdown v-if="show" class="right-2.5 -bottom-24">
                    <DropdownOption route="" icon="person">Profile</DropdownOption>
                    <DropdownOption route="" icon="settings">Settings</DropdownOption>
                    <DropdownOption :route="route('logout')" icon="logout">Logout</DropdownOption>
                </Dropdown>
            </Transition>
        </div>
    </button>
</template>

<style scoped>
    .v-enter-active,
    .v-leave-active {
        transition: opacity 0.3s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>
