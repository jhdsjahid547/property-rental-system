<script setup>
import { Link } from '@inertiajs/vue3';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import ListingPagination from '../../Components/UI/ListingPagination.vue';
import BorderBox from '../../Components/UI/BorderBox.vue';
import RealtorFilters from './RealtorFilters.vue';

defineProps({
    listings: Object,
    filters: Object
})
</script>

<template>
    <h1 class="mb-4">Your Listings</h1>
    <section>
        <realtor-filters :filters="filters"></realtor-filters>
    </section>
    <section class="mb-8">
        <v-row no-gutters>
            <v-col cols="12" md="6" sm="6" v-for="listing in listings.data" :key="listing.id">
                <border-box>
                    <v-row>
                        <v-col cols="12" md="8" sm="8" align-self="start">
                            <div class="d-xl-flex ga-2" :class="{'text-grey': listing.deleted_at}">
                                <listing-price :price="listing.price" class="text-h6 font-weight-bold"></listing-price>
                                <listing-space :listing="listing"></listing-space>
                                <listing-address :listing="listing" class="text-blue-grey-darken-1"></listing-address>
                            </div>
                        </v-col>
                        <v-col cols="12" md="4" sm="4" align-self="end">
                            <div class="d-flex align-self-center ma-2 pa-2">
                                <v-btn density="comfortable" color="light-green-lighten-3" icon="mdi-printer-eye" :href="route('listing.show', { listing: listing.id })" target="_blank"></v-btn>
                                <Link :href="route('realtor.listing.edit', {listing: listing.id})">
                                    <v-btn density="comfortable" color="lime-accent-1" icon="mdi-database-edit"></v-btn>
                                </Link>
                                <Link v-if="!listing.deleted_at" :href="route('realtor.listing.destroy', { listing: listing.id })" as="button" method="DELETE">
                                    <v-btn density="comfortable" color="red-lighten-3" icon="mdi-delete"></v-btn>
                                </Link>  
                                <Link v-else :href="route('realtor.listing.restore', { listing: listing.id })" as="button" method="PUT">
                                    <v-btn density="comfortable" color="purple-lighten-4" icon="mdi-delete-restore"></v-btn>
                                </Link>   
                            </div>
                        </v-col>
                    </v-row>
                </border-box>
            </v-col>
        </v-row>
    </section>
    <section v-if="listings.data.length" class="d-flex align-center flex-column mt-4 mb-4">
        <listing-pagination :links="listings.links"></listing-pagination>
    </section>
</template>