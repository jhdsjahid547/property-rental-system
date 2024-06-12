<script setup>
import { computed } from 'vue';

const props = defineProps({
    price: [Number, String]
});
const formattedPrice = computed(() => Number(props.price).toLocaleString("bn-BD", { style: "currency", currency: "BDT" }));
</script>

<template>
    <span>{{ formattedPrice }}</span>
</template>