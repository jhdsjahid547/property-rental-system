<script setup>
import AllListing from './AllListing.vue';
import ListingPagination from '../../Components/UI/ListingPagination.vue';
import ListingFilters from '../Index/ListingFilters.vue';

const props = defineProps({
    listings: Object,
    filters: Object
});

</script>

<template>
    <section>
        <listing-filters :filters="filters"></listing-filters>
    </section>
    <section>
        <v-row no-gutters>
            <v-col cols="12" md="4" sm="6" v-for="listing in listings.data" :key="listing.id">
                <all-listing :listing="listing"></all-listing>
            </v-col>
        </v-row>
    </section>
    <section v-if="listings.data.length">
        <div class="d-flex align-center flex-column">
            <listing-pagination :links="listings.links"></listing-pagination>
        </div>
    </section>
</template>