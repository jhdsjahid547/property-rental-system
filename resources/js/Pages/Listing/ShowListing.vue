<script setup>
import { ref } from 'vue';
import { useMonthlyPayment } from '../../Composable/useMonthlyPayment';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import BorderBox from '../../Components/UI/BorderBox.vue';

const props = defineProps({
    listing: Object
});

const interestRate = ref(2.5);
const duration = ref(25);
const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration);
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
                    <label>Interest rate ({{ interestRate }}%)</label>
                    <v-slider
                        v-model.number="interestRate"
                         min="0.1" 
                         max="30" 
                         step="0.1"
                        thumb-label
                    ></v-slider>
                </div>
                <div>
                    <label>Duration ({{ duration }} years)</label>
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
                <v-row>
                    <v-col cols="6">
                        Total Paid:
                    </v-col>
                    <v-col cols="6">
                        <listing-price :price="totalPaid"></listing-price>
                    </v-col>
                    <v-col cols="6">
                        Principle Paid:
                    </v-col>
                    <v-col cols="6">
                        <listing-price :price="listing.price"></listing-price>
                    </v-col>
                    <v-col cols="6">
                        Total Interest:
                    </v-col>
                    <v-col cols="6">
                        <listing-price :price="totalInterest"></listing-price>
                    </v-col>
                </v-row>
            </border-box>
        </v-col>
        <v-col cols="12" md="7" class="pa-3">
            <v-card class="text-center d-flex flex-column justify-center" elevation="3" height="100%">
                No image
            </v-card>
        </v-col>
    </v-row>
</template>