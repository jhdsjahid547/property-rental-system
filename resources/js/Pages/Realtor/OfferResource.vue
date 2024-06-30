<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import BorderBox from '../../Components/UI/BorderBox.vue';
import ListingPrice from '../../Components/ListingPrice.vue';

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean
});
const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());

</script>

<template>
    <border-box>
        <template #header>Offer #{{ offer.id }} 
            <v-badge
            v-if="offer.accepted_at"
            color="success"
            content="Accepted"
            inline
            ></v-badge>
        </template>
        <section class="d-flex justify-space-between">
            <div>
                <listing-price :price="offer.amount" class="text-h5 font-weight-bold"></listing-price>
                <div class="text-h6 text-grey ">
                    Difference <listing-price :price="difference"></listing-price>
                </div>
                <div class="text-grey">
                    Deal by {{ offer.bidder.name }}
                </div>
                <div class="text-grey">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div v-if="!isSold" class="mt-6">
                <Link :href="route('realtor.offer.accept', { offer: offer.id })" as="button" method="PUT">
                    <v-btn density="comfortable" variant="tonal">Accept</v-btn>
                </Link>
            </div>
        </section>
    </border-box>
</template>