<script setup>
    import { createAvatar } from '@dicebear/core';
    import { initials } from '@dicebear/collection';
    import Dropdown from '@/Components/Header/Partials/Dropdown/Dropdown.vue';
    import DropdownOption from '@/Components/Header/Partials/Dropdown/DropdownOption.vue';
    import { ref } from 'vue';

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
            <font-awesome-icon :icon="['fas', 'caret-down']" class="mx-2"/>
            <Dropdown :show="show" class="right-2.5 -bottom-24">
                <DropdownOption route="" :icon="['fas', 'user']">Profile</DropdownOption>
                <DropdownOption route="" :icon="['fas', 'gear']">Settings</DropdownOption>
                <DropdownOption :route="route('logout')" :icon="['fas', 'right-from-bracket']">Logout</DropdownOption>
            </Dropdown>
        </div>
    </button>
</template>
