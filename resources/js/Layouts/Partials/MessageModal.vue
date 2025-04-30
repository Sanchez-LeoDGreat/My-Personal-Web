<script setup>
    import { ref } from 'vue';
    import { Modal, ModalMessage, ModalButtons, SecondaryButton } from '@/Utils/MyComponents';

    const modal = ref({
        show: false,
        type: null,
        caption: null,
        message: null,
    });

    const showModalMessage = (message, type = '', caption = '') => {
        modal.value.message = message;
        modal.value.type = type,
        modal.value.caption = caption;
        modal.value.show = true;
    }

    defineExpose({
        showModalMessage
    });
</script>

<template>
    <Modal v-model:show="modal.show" :type="modal.type" :caption="modal.caption">
        <ModalMessage :message="modal.message"/>
        <ModalButtons>
            <SecondaryButton @click="modal.show=false" focus-on-show>OK</SecondaryButton>
        </ModalButtons>
    </Modal>
</template>