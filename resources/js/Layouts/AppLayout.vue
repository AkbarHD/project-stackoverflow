<script setup>
import { reactive, onMounted } from 'vue';
import * as bootstrap from 'bootstrap';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/toast.vue'; // karena tost di pake di semua halaman, maka di import di layout ini

const state = reactive({
    modalRef: null
});

onMounted(() => {
    state.modalRef = new bootstrap.Toast('#toast-app', {
        delay: 3000
    });
});

const showToast = () => {
    state.modalRef.show();
}
</script>
<template>
    <!-- navbart -->
    <Navbar/>
    <button class="btn btn-primary" @click="showToast">show toast</button>
    <!-- end navbar -->
    <main class="py-4">
       <slot/>
    </main>
    <Toast id="toast-app"/>
</template>
