<script setup>
import { useForm } from '@inertiajs/vue3';

// kita pengen dinamis bisa post dan juga update
const props = defineProps({
    question: {
        type: Object,
        required: true
    },
    method: String, // methiod utk update, jika ada, jika tidak ada maka post
    action:{
        type: String,
        required: true
    }
})

const formData =  {
    title: props.question.title,
    body: props.question.body,
    id: props.question.id
}

if(props.method) {
    formData._method = props.method
}

const form = useForm(formData);
// const form = useForm({
//     title: '',
//     body: ''
// });
const emit = defineEmits(['success']);
const submit = () => {
    form.post(props.action, { // jadi ini bisa edit atau create keren, yg menjadi acuan itu "form"
        onSuccess: () => {
            emit('success');
            form.reset();
        }
    })
}

// const submit = () => {
//     form.post(route('questions.store'), {
//         onSuccess: () => {
//             emit('success');
//             form.reset();
//         }
//     })
// }
</script>

<template>
    <form @submit.prevent="submit">
        <div class="row mb-3">
            <div class="col-7">
                <label for="question-title" class="form-label">Question title</label>
                <input type="text" class="form-control" :class="{'is-invalid' : form.errors.title}" name="title" v-model="form.title" id="question-title">
                <div class="invalid-feedback" v-if="form.errors.title" v-text="form.errors.title"></div>
            </div>
            <div class="col-5">
                <label for="question-tags" class="form-label">Tags</label>
                <input type="text" class="form-control" name="tags" id="question-tags">
            </div>
        </div>
        <div class="mb-3">
            <label for="question-body" class="form-label">Explain your question</label>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#write" type="button"
                                role="tab" href="#">Write</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#preview" type="button"
                                role="tab">Preview</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="write" role="tabpanel" aria-labelledby="write-tab"
                            tabindex="0">
                            <textarea rows="7" class="form-control" :class="{'is-invalid' : form.errors.body}" name="body" v-model="form.body"></textarea>
                            <div class="invalid-feedback" v-if="form.errors.body" v-text="form.errors.body"></div>
                        </div>
                        <div class="tab-pane fade show" id="preview" role="tabpanel" aria-labelledby="preivew-tab"
                            tabindex="0">
                            <div class="preview-body">
                                hi there
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">{{ question.id ? 'update' : 'Post' }}</button>
        </div>
    </form>
</template>
