<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
const timeout = ref(3000);
const flashSuccess = computed(() => usePage().props.flash.success);
const snackbar = ref(false);
const hasFlash = computed(() => flashSuccess.value ? snackbar.value = true : snackbar.value = false);
</script>

<template>
    <section>
        <v-toolbar :elevation="3" density="comfortable" color="white">
            <Link :href="route('listing.index')" class="text-indigo-accent-3 text-decoration-none ps-4">
                <v-toolbar-title>Vuetify</v-toolbar-title>
            </Link>
            <v-spacer></v-spacer>
            <Link :href="route('listing.create')" class="pe-4">
                <v-btn prepend-icon="mdi-plus" variant="flat" color="indigo-accent-3">Create Listing</v-btn>
            </Link>
        </v-toolbar>
    </section>
    <v-container>
        <v-snackbar v-if="hasFlash" v-model="snackbar" :timeout="timeout" color="green-lighten-1">
            {{ flashSuccess }}
            <template v-slot:actions>
                <v-btn color="red" variant="text" @click="snackbar = false">X</v-btn>
            </template>
        </v-snackbar>
        <slot></slot> 
    </v-container>
</template>