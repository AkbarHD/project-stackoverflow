<script setup>
import Navbar from '../Components/Navbar.vue';
</script>
<template>
    <!-- navbart -->
    <Navbar/>
    <!-- end navbar -->
    <main class="py-4">
       <slot/>
    </main>
</template>
