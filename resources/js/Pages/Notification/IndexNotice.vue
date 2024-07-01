<script setup>
import { Link } from '@inertiajs/vue3';
import ListingPrice from '../../Components/ListingPrice.vue';
import ListingPagination from '../../Components/UI/ListingPagination.vue';

defineProps({
    notifications: Object
});
</script>

<template>
    <section>
        <h3 class="font-weight-bold mb-4">Notifications</h3>
        <div 
        v-if="notifications.data.length" 
        v-for="notification in notifications.data" 
        :key="notification.id"
        class="mb-4">
        <div class="d-flex flex-row justify-space-between pb-2">
            <div>
                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer <listing-price :price="notification.data.amount"></listing-price> for 
                    <Link class="text-decoration-none" :href="route('realtor.listing.show', { listing: notification.data.listing_id })">listing</Link> was made!
                </span>
            </div>
            <div>
                <Link 
                v-if="!notification.read_at" 
                :href="route('notification.read', { notification: notification.id })"
                as="button"
                method="PUT">
                    <v-btn>Mark as Read</v-btn>
                </Link>
            </div>
        </div>
            <v-divider />
        </div>
        <div v-else>
            <p>No notifications.</p>
            <v-divider />
        </div>
        <div v-if="notifications.data.length" class="d-flex align-center flex-column mt-4 mb-4">
            <listing-pagination :links="notifications.links"></listing-pagination>
        </div>
    </section>
</template>