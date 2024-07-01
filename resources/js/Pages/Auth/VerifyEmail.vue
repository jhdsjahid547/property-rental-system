<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="d-flex flex-column justiy-space-between">
        <div>You need to verify to see this page.</div>
        <div>
            <Link :href="route('verification.send')" method="POST" as="button">
                <v-btn variant="tonal">Resend</v-btn>
            </Link>
        </div>
    </section>
</template>