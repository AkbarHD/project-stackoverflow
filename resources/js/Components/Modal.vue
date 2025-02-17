<script setup>
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    title:{
        type: String,
        required: true
    },
    size:{
        type: String,
        default: ''
    },
    scrollable:{
        type: Boolean,
        default: false
    }
})

const classes = computed(() => {
    return {
        'modal-dialog':true,
        'modal-lg': props.size === 'large',
        'modal-xl': props.size === 'extra-large',
        'modal-sm': props.size === 'small',
        'modal-dialog-scrollable': props.scrollable
    }
});

// ini tidak terlalu penting karena tidak ada pun tetap jalan

const modalRef = ref(null);
const emit = defineEmits(['hidden']);

onMounted(() => {
    modalRef.value.addEventListener('hidden.bs.modal', (event) => {
        // console.log('hidden');
        emit('hidden');
    })
})
</script>

<template>
    <div class="modal fade" ref="modalRef"  tabindex="-1"
        aria-labelledby="new-question-modal-label" aria-hidden="true">
        <!-- <div class="modal-dialog modal-lg modal-dialog-scrollable"> -->
        <div :class="classes">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="new-question-modal-label">{{ title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <slot/>

                </div>
                <!-- saat modal ini di panggil, dan kita sertakan footer. ini akan di render, kalau tidak, maka tidak -->
                <div class="modal-footer" v-if="$slots.footer">

                    <slot/>


                </div>
            </div>
        </div>
    </div>
</template>
