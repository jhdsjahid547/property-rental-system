<script setup>
import { computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import BorderBox from '../../Components/UI/BorderBox.vue';
import ListingPrice from '../../Components/ListingPrice.vue';
import { debounce } from 'lodash';

const props = defineProps({
    listingId: Number,
    price: Number
});
const emits = defineEmits([
    'offerUpdated'
]);
const form = useForm({
    amount: props.price
});
watch(() => form.amount, debounce((value) => emits('offerUpdated', value), 200));
const offer = () => form.post(route('listing.offer.store', { listing: props.listingId }), {
    preserveScroll: true,
    preserveState: true
});
const difference = computed(() => form.amount - props.price);
const max = computed(() => Math.round(props.price * 2));
const min = computed(() => Math.round(props.price / 2));
</script>

<template>
    <border-box>
        <template #header>Make an offer</template>
        <div>
            <form @submit.prevent="offer">
                <v-text-field
                v-model.number="form.amount"
                :error="!!form.errors.amount"
                :error-messages="form.errors.amount"
                @input="form.clearErrors('amount')"
                type="number"
                label="Amount" 
                variant="outlined" 
                density="compact"
                ></v-text-field>
                <v-slider
                v-model.number="form.amount"
                @update:focused="form.clearErrors('amount')"
                :max="max"
                :min="min"
                step="10000"
                thumb-label
                ></v-slider>
                <v-btn type="submit" variant="outlined" block>Make an offer</v-btn>
            </form>
        </div>
        <div class="d-flex justify-space-between text-grey mt-2">
            <div>Difference</div>
            <div>
                <listing-price :price="difference"></listing-price>
            </div>
        </div>
    </border-box>
</template>