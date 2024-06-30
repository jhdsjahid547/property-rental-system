<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
});
</script>

<template>
    <div class="d-flex flex-wrap ga-1">
        <Link v-for="(link, index) in links"
        class="text-decoration-none text-black py-2 px-4 rounded-lg"
        :key="index"
        :href="link.url ? link.url : '#'"
        :class="{'bg-blue-darken-1 text-white': link.active}"
        v-html="link.label.replaceAll('Previous', '').replaceAll('Next', '')"
        ></Link>
    </div>
</template>