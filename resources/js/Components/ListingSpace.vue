<script setup>
defineProps({
    listing: Object
});
</script>

<template>
    <div>
        <span class="font-weight-bold">{{ listing.beds }}</span> bds <span class="text-blue-grey-lighten-2">| </span>
        <span class="font-weight-bold">{{ listing.baths }}</span> ba <span class="text-blue-grey-lighten-2">| </span>
        <span class="font-weight-bold">{{ listing.area }}</span> m²
    </div>
</template>