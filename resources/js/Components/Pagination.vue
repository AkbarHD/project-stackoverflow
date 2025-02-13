<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    meta: {
        type: Object,
        required: true
    }
})
</script>
<template>
    <nav class="mt-4" aria-label="Pagination">
        <ul class="pagination pagination-sm justify-content-center">
            <li class="page-item " v-for="(link, index) in meta.links" :key="index"
                :class="{ active: link.active, disabled: !link.url }">
                <Link class="page-link" :href="link.url" preserve-scroll>{{ link.label }}</Link>
            </li>
        </ul>
    </nav>
</template>
