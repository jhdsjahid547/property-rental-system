<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    latest: String
});
</script>

<template>
    <p>{{ latest }}</p>
    <h2 class="bg-red">Hello</h2>
    <v-icon icon="mdi-home" />
    <Link href="public/show">Show</Link>
</template>