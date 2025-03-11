<script setup>
import Answer from './Answer.vue';
import Pagination from '../Pagination.vue';
import useModal from '../../Composables/useModal';

const {showModal, hideModal, modalTitle, Modal} = useModal('#update-answer-modal');

defineProps({
    answers: {
        type: Object,
        required: true
    }
})

const editAnswer = (payload) => {
    modalTitle.value = 'Edit Answer';

    showModal();
}
</script>
<template>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mt-4 answer-header">{{ answers.meta.total }} Answers</h2>
        <Pagination :meta="answers.meta" />
    </div>
    <div class="answer-content mt-4">
        <Answer v-for="answer in answers.data" :key="answer.id" :answer="answer" @edit="editAnswer" />
    </div>

    <Modal id="update-answer-modal" :title="modalTitle">
        form
    </Modal>
</template>
