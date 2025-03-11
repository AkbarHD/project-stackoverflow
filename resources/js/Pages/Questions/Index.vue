<template>
    <!-- extends -->
    <AppLayout>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="page-header">All Questions</h1>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">

                            <!-- question summary -->
                            <QuestionSummary v-for="question in questions.data" :key="question.id" :question="question"
                                @edit="editQuestion" @remove="deleteQuestion" />
                        </ul>
                    </div>

                    <!-- pagination -->
                    <Pagination :meta="questions.meta" position="center" />

                </div>
                <div class="col-md-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" @click="askQuestion" data-bs-toggle="modal"
                            data-bs-target="#new-question-modal">Ask
                            Question</button>
                    </div>

                    <!-- filter questions -->
                    <QuestionFilter :filter="filter" />

                    <h2 class="fs-5 mt-5">Related Tags</h2>
                    <ul class="tags-list mt-3">
                        <li><a href="#" class="tag mb-2">Javascript</a></li>
                        <li><a href="#" class="tag mb-2">JQuery</a></li>
                        <li><a href="#" class="tag mb-2">Vue.js</a></li>
                        <li><a href="#" class="tag mb-2">React.js</a></li>
                        <li><a href="#" class="tag mb-2">Inertia.js</a></li>
                        <li><a href="#" class="tag mb-2">PHP</a></li>
                        <li><a href="#" class="tag mb-2">Laravel</a></li>
                        <li><a href="#" class="tag mb-2">Bootstrap</a></li>
                        <li><a href="#" class="tag mb-2">Tailwind</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- modal -->
        <Modal id="question-modal" :title="modalTitle" size="large" @hidden="editing = false" scrollable>
            <!-- <EditQuestionForm :question="question" @success="hideModal"  v-if="editing"/>
            <CreateQuestionForm :question="question" @success="hideModal" v-else /> -->
            <component :is="editing ? EditQuestionForm : CreateQuestionForm" :question="question"
                @success="hideModal" />
        </Modal>

    </AppLayout>

    <Head title="All Questions" />

    <!-- <div>
        <div v-for="question in questions" :key="question.id">
            <Link :href="route('questions.show', question.id)">
            {{ question.title }}

        </div>
    </div> -->
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
// pindahkan ke useModal.js
import AppLayout from '../../Layouts/AppLayout.vue';
import QuestionSummary from '../../Components/Question/QuestionSummary.vue';
import QuestionFilter from '../../Components/Question/QuestionFilter.vue';
import Pagination from '../../Components/Pagination.vue';
// pindahkan ke useModal.js
// import QuestionForm from '../../Components/Question/QuestionForm.vue';
import CreateQuestionForm from '../../Components/Question/CreateQuestionForm.vue';
import EditQuestionForm from '../../Components/Question/EditQuestionForm.vue';
import useModal from '../../Composables/useModal';

const {showModal, hideModal, modalTitle, Modal} = useModal('#question-modal');

defineProps({
    questions: {
        type: Object,
        required: true
    },
    filter:String
});

// const state = reactive({
//     modalRef: null,
//     modalTitle: ''
// });

const question = {
    title: null,
    body: null,
    id: null,
}

const editing = ref(false);

// onMounted dan showmodal, hidemodal ktia pindahkan ke useModal.js

const editQuestion = (payload) => {
    editing.value = true;
    modalTitle.value = 'Edit Question';

    question.title = payload.title;
    question.body = payload.body;
    question.id = payload.id;
    showModal();
}

const deleteQuestion = (payload) => {
    // jika belum login akan di arahkan ke login

    if(confirm('Are you sure you want to delete this question?')){
        router.delete(route('questions.destroy', payload.id), {
            preserveScroll: true
        })
    }
}

const askQuestion = () => {
    editing.value = false;
    modalTitle.value = 'Ask Question';
    showModal();
}
</script>
