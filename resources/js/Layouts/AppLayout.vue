<script setup>
import { reactive, onMounted } from 'vue';
import * as bootstrap from 'bootstrap';
import { router, usePage } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/toast.vue'; // karena tost di pake di semua halaman, maka di import di layout ini

const state = reactive({
    modalRef: null, // untuk muncul toast
    toastMessage: '' // utk custom text
});

const page = usePage();

onMounted(() => {
    state.modalRef = new bootstrap.Toast('#toast-app', {
        delay: 3000
    });
});

router.on('finish', () => {
    state.toastMessage = page.props.toast.success

    showToast();
})


const showToast = () => {
    state.modalRef.show();
}
</script>
<template>
    <!-- navbart -->
    <Navbar />
    <!-- <button class="btn btn-primary" @click="showToast">show toast</button> -->
    <!-- end navbar -->
    <main class="py-4">
        <slot />
    </main>
    <Toast id="toast-app" :message="state.toastMessage" />
</template>
