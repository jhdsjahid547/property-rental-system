<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useMonthlyPayment } from '../../Composable/useMonthlyPayment';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import BorderBox from '../../Components/UI/BorderBox.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object,
});
const user = computed(() => usePage().props.user);
const method = computed(() => user.value === null ? 'GET' : 'DELETE');
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>

<template>
    <border-box>
        <Link :href="route('listing.show', {listing: listing.id})" class="text-decoration-none">
            <div>
                <listing-price :price="listing.price" class="text-h6 text-black font-weight-bold"></listing-price>&nbsp;
                <listing-price :price="monthlyPayment" class="text-blue-grey"></listing-price><span class="text-blue-grey"> pm</span>
            </div>
            <listing-space :listing="listing" class="text-black text-subtitle-1"></listing-space>
            <listing-address :listing="listing" class="text-blue-grey-darken-1"></listing-address>
        </Link>
        <div>
            <Link :href="route('listing.edit', {listing: listing.id})" class="text-decoration-none text-black">Edit</Link>
        </div>
    </border-box>
</template>