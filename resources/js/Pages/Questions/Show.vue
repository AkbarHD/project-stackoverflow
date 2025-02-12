<template>
    <h1>Question</h1>
    <p>{{ question.id }}</p>
    <p>{{ question.title }}</p>
</template>

<script setup>
    defineProps({
        question:{
            type: Object,
            required: true
        }
    })
</script>
