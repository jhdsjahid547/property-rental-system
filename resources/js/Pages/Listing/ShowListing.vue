<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useMonthlyPayment } from '../../Composable/useMonthlyPayment';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import BorderBox from '../../Components/UI/BorderBox.vue';
import MakeOffer from './MakeOffer.vue';
import OfferMade from './OfferMade.vue';

const props = defineProps({
    listing: Object,
    offerMade: Object,
    baseUrl: String
});
const user = computed(() => usePage().props.user);
const offer = ref(props.listing.price);
const interestRate = ref(2.5);
const duration = ref(25);
const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(offer, interestRate, duration);
</script>

<template>
    <v-row no-gutters>
        <v-col cols="12" order-md="1" md="5">
            <border-box>
                <template #header>Basic Info</template>
                <listing-price :price="listing.price" class="text-h6 text-black font-weight-bold"></listing-price>
                <listing-space :listing="listing" class="text-black text-subtitle-1"></listing-space>
                <listing-address :listing="listing" class="text-blue-grey-darken-1"></listing-address>
            </border-box>
            <border-box>
                <template #header>Monthly Payment</template>
                <div>
                    <span>Interest rate ({{ interestRate }}%)</span>
                    <v-slider
                        v-model.number="interestRate"
                         min="0.1" 
                         max="30" 
                         step="0.1"
                        thumb-label
                    ></v-slider>
                </div>
                <div>
                    <span>Duration ({{ duration }} years)</span>
                    <v-slider
                        v-model.number="duration"
                        min="3" 
                        max="35" 
                        step="1"
                        thumb-label
                    ></v-slider>
                </div>
                <div>
                    <div class="text-blue-grey-darken-1 font-weight-medium">Your monthly payment</div>
                    <listing-price :price="monthlyPayment" class="text-h5 font-weight-bold"></listing-price>
                </div>
                <div class="d-flex justify-space-between text-grey mt-2">
                    <div>Total Paid:</div>
                    <listing-price :price="totalPaid"></listing-price>
                </div>
                <div class="d-flex justify-space-between text-grey mt-2">
                    <div>Principle Paid:</div>
                    <listing-price :price="listing.price"></listing-price>
                </div>
                <div class="d-flex justify-space-between text-grey mt-2">
                    <div>Total Interest:</div>
                    <listing-price :price="totalInterest"></listing-price>
                </div>
            </border-box>
            <make-offer v-if="user && !offerMade" :listing-id="listing.id" :price="listing.price" @offer-updated="offer = $event"></make-offer>
            <offer-made v-if="user && offerMade" :offer="offerMade"></offer-made>
        </v-col>
        <v-col cols="12" md="7" class="pa-3">
            <v-card class="text-center d-flex flex-column justify-center" elevation="3" height="100%">
                <v-row no-gutters v-if="listing.images.length">
                    <v-col cols="6" v-for="image in listing.images" :key="image.id">
                        <v-img class="mb-2 mx-auto border-lg" rounded="lg" :src="image.src">
                            <template v-slot:error>
                                <v-img class="mx-auto" 
                                    :src="props.baseUrl + 'storage/images/2lO29Y3LMNyv964UeCGvHcKdmaQAOYkT4PufGLKg.png'"
                                ></v-img>
                            </template>
                        </v-img>
                    </v-col>
                </v-row>
                <div v-else>No image found.</div>
            </v-card>
        </v-col>
    </v-row>
</template>