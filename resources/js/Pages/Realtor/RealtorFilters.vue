<script setup>
import { reactive, computed, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';

const sort = {
    element: [
        { title: 'List', value: 'created_at' },
        { title: 'Price', value: 'price' }
    ],
};
const sortLabels = {
    created_at: [
        { title: 'Latest', value: 'desc' },
        { title: 'Oldest', value: 'asc' }
    ],
    price: [
        { title: 'High to low', value: 'desc' },
        { title: 'Low to high', value: 'asc' }
    ]
};
const sortOptions = computed(() => sortLabels[filterForm.by]);
const props = defineProps({
    filters: Object
})
const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc'
});
watch(filterForm, debounce(() => router.get(
        route('realtor.listing.index'), 
        filterForm,  
        { preserveState: true, preserveScroll: true }
    ), 1000)
);
</script>

<template>
    <form>
        <div class="mb-4 mt-0 d-flex flex-wrap ga-2">
            <div class="d-flex flex-nowrap align-content-center ga-2">
                <v-switch v-model="filterForm.deleted" label="Deleted" color="indigo"></v-switch>
                <div class="d-flex">
                    <v-select
                    v-model="filterForm.by"
                    rounded="0 s-lg"
                    width="120"
                    placeholder="Select"
                    label="Order By"
                    variant="outlined"
                    density="compact"
                    :items="sort.element"
                    ></v-select>
                    <v-select
                    v-model="filterForm.order"
                    width="132"
                    rounded="0 e-lg"
                    placeholder="Select"
                    label="Serialize"
                    variant="outlined"
                    density="compact"
                    :items="sortOptions"
                    ></v-select>
                </div>
            </div>
        </div>
    </form>
</template>