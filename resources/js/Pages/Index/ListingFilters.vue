<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
const options = computed(() => {
    let values = [];
    for (let i=1; i<=5; i++) {
        values.push(i);
    }
    values.push('6+');
    return values;
});
const props = defineProps({
    filters: Object
});
const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null
});
const filter = () => filterForm.get(route('listing.index'), {
    preserveState: true,
    preserveScroll: true
});
const clear = () => {
    filterForm.priceFrom = null;
    filterForm.priceTo = null;
    filterForm.beds = null;
    filterForm.baths = null;
    filterForm.areaFrom = null;
    filterForm.areaTo = null;
    filter();
};
</script>

<template>
    <form @submit.prevent="filter">
        <div class="d-flex flex-wrap mb-4 mt-4 ga-2">
            <div class="d-flex flex-nowrap align-center">
                <v-text-field
                v-model.number="filterForm.priceFrom"
                rounded="0 s-lg"
                width="150"
                type="number"
                label="Price from"
                variant="outlined"
                density="compact"
                placeholder="Enter amount"
                ></v-text-field>
                <v-text-field
                v-model.number="filterForm.priceTo"
                rounded="0 e-lg"
                width="150"
                type="number"
                label="Price to"
                variant="outlined"
                density="compact"
                placeholder="Enter amount"
                ></v-text-field>
            </div>
            <div class="d-flex flex-nowrap align-center">
                <v-select
                v-model.number="filterForm.beds"
                rounded="0 s-lg"
                width="100"
                placeholder="Select"
                label="Beds"
                variant="outlined"
                density="compact"
                :items="options"
                ></v-select>
                <v-select
                v-model.number="filterForm.baths"
                width="104"
                rounded="0 e-lg"
                placeholder="Select"
                label="Baths"
                variant="outlined"
                density="compact"
                :items="options"
                ></v-select>
            </div>
            <div class="d-flex flex-nowrap align-center">
                <v-text-field
                v-model.number="filterForm.areaFrom"
                rounded="0 s-lg"
                width="180"
                type="number"
                label="Area from"
                variant="outlined"
                density="compact"
                placeholder="Area name"
                ></v-text-field>
                <v-text-field
                v-model.number="filterForm.areaTo"
                rounded="0 e-lg"
                width="180"
                type="number"
                label="Area to"
                variant="outlined"
                density="compact"
                placeholder="Area name"
                ></v-text-field>
            </div>
            <v-btn type="submit" variant="tonal" color="green">filter</v-btn>
            <v-btn type="reset" @click="clear">clear</v-btn>
        </div>
    </form>
</template>