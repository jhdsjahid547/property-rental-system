<script setup>
import { Link } from '@inertiajs/vue3';
const baseUrl = '/lara-vue/public';
</script>

<template>
    <h2>Show me something</h2>
    <Link :href="baseUrl">Home</Link>
</template>
