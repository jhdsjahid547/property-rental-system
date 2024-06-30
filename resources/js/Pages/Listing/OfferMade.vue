<script setup>
import { computed } from 'vue';
import BorderBox from '../../Components/UI/BorderBox.vue';
import ListingPrice from '../../Components/ListingPrice.vue';

const props = defineProps({
    offer: Object
});
const offerMadeOn = computed(() => new Date(props.offer.created_at).toDateString())
</script>

<template>
    <border-box>
        <template #header>Offer Made</template>
        <listing-price :price="offer.amount" class="text-h4 font-weight-bold"></listing-price>
        <section class="mt-2 d-flex flex-column flex-md-row justify-space-between text-grey">
            <div>Made on</div>
            <div class="font-weight-bold">
                {{ offerMadeOn }}
            </div>
        </section>
    </border-box>
</template>