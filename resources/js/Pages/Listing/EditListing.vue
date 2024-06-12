<script setup>
import { useForm } from '@inertiajs/vue3';
import ListingForm from '../../Components/ListingForm.vue';

const props = defineProps({
    listing: Object
});

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price
});
const update = () => form.put(route('listing.update', {listing: props.listing.id}));

</script>

<template>
    <form @submit.prevent="update">
        <v-card color="deep-purple" variant="outlined">
            <listing-form :form="form"></listing-form>
            <v-card-actions>
            <v-btn type="submit" class="font-weight-bold">Update Listing</v-btn>
            </v-card-actions>
        </v-card>
    </form>
</template>
