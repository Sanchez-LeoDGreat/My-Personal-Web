<script setup>
    import { ref } from 'vue';
    import { Modal, ModalMessage, ModalButtons, SecondaryButton } from '@/Utils/MyComponents';

    const modal = ref({
        show: false,
        type: null,
        caption: null,
        message: null,
        onYes: null,
        onNo: null,
    });

    const showConfirmationModal = (message, { type = '', caption = '', onYes = null, onNo = null } = {}) => {
        modal.value.message = message;
        modal.value.type = type,
        modal.value.caption = caption;
        modal.value.onYes = typeof onYes === 'function' ? onYes : null;
        modal.value.onNo = typeof onNo === 'function' ? onNo : null;
        modal.value.show = true;
    }

    const handleYes = () => {
        if (typeof modal.value.onYes === 'function') modal.value.onYes();
        modal.value.show = false;
    };

    const handleNo = () => {
        if (typeof modal.value.onNo === 'function') modal.value.onNo();
        modal.value.show = false;
    };

    defineExpose({
        showConfirmationModal
    });
</script>

<template>
    <Modal v-model:show="modal.show" :type="modal.type" :caption="modal.caption">
        <ModalMessage :message="modal.message"/>
        <ModalButtons>
            <SecondaryButton @click="handleYes" focus-on-show>Yes</SecondaryButton>
            <SecondaryButton @click="handleNo">No</SecondaryButton>
        </ModalButtons>
    </Modal>
</template>