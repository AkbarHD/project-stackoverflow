<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps({
    meta: {
        type: Object,
        required: true
    },
    position:{
        type:String,
        position:'center'
    }
})

const classes = computed(() => {
    return {
        'pagination pagination-sm':true,
        'justify-content-center' : props.position === 'center',
        'justify-content-start' : props.position === 'start',
        'justify-content-end' : props.position === 'end'

    }
})
</script>
<template>
    <nav class="mt-4" aria-label="Pagination">
        <ul :class="classes">
            <li class="page-item " v-for="(link, index) in meta.links" :key="index"
                :class="{ active: link.active, disabled: !link.url }">
                <Link class="page-link" :href="link.url" preserve-scroll>{{ link.label }}</Link>
            </li>
        </ul>
    </nav>
</template>
