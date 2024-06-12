<script setup>
import AllListing from './AllListing.vue';
const props = defineProps({
    listings: Array,
});

</script>

<template>
    <v-row no-gutters>
        <v-col cols="12" md="4" sm="6" v-for="listing in listings" :key="listing.id">
            <all-listing :listing="listing"></all-listing>
        </v-col>
    </v-row>
</template>