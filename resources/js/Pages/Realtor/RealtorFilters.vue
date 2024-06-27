<script setup>
import { reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';

const filterForm = reactive({
    deleted: false
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
                <v-switch label="Drafts" color="indigo"></v-switch>
                <v-switch v-model="filterForm.deleted" label="Deleted" color="indigo"></v-switch>
            </div>
        </div>
    </form>
</template>