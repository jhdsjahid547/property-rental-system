<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import BorderBox from '../../Components/UI/BorderBox.vue';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import OfferResource from './OfferResource.vue';

const props = defineProps({
    listing: Object
});
const hasOffers = computed(() => props.listing.offers.length);
</script>

<template>
    <section class="mb-4">
        <Link 
        :href="route('realtor.listing.index')" 
        class="text-decoration-none text-black"
        ><v-icon icon="mdi-keyboard-backspace"></v-icon>Go back to listings</Link>
    </section>
    <section>
        <v-row>
            <v-col cols="12" order-md="1" md="5">
                <border-box>
                    <template #header>Basic Info</template>
                    <listing-price :price="listing.price" class="text-h5 font-weight-bold"></listing-price>
                    <listing-space :listing="listing" class="text-h6"></listing-space>
                    <listing-address :listing="listing" class="text-grey"></listing-address>
                </border-box>
            </v-col>
            <v-col cols="12" md="7" class="pa-3">
                <v-card v-if="!hasOffers" class="text-center d-flex flex-column justify-center" elevation="3" height="100%">
                    No offers
                </v-card>
                <div v-else>
                    <offer-resource 
                    v-for="offer in listing.offers" 
                    :key="offer.id" 
                    :offer="offer"
                    :listing-price="listing.price"
                    :is-sold="listing.sold_at != null"
                    ></offer-resource>
                </div>
            </v-col>
        </v-row>
    </section>
</template>