<script setup>
import { useForm } from '@inertiajs/vue3';
import ListingForm from '../../Components/ListingForm.vue';

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: 0
});

const create = () => form.post(route('listing.store'));
</script>

<template>
    <form @submit.prevent="create">
        <v-card color="deep-purple" variant="outlined">
            <listing-form :form="form"></listing-form>
            <v-card-actions>
            <v-btn type="submit" class="font-weight-bold">Create Listing</v-btn>
            </v-card-actions>
        </v-card>
    </form>
</template>
