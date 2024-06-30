<script setup>
import { computed } from 'vue';
import NProgress from 'nprogress'
import { useForm, router, Link } from '@inertiajs/vue3';
import BorderBox from '../../Components/UI/BorderBox.vue';

const props = defineProps({
    listing: Object,
    baseUrl: String
});
router.on('progress', (event) => {
  if (event.detail.progress.percentage) {
    NProgress.set((event.detail.progress.percentage / 100) * 0.9)
  }
});
const form = useForm({
    images: []
});
const removeError = () => {
    Object.keys(form.errors).forEach(key => {
        if (key.startsWith('images.')) {
            delete form.errors[key];
        }
    });
};
const imageErrorsMessages = computed(() => {
    let messages = [];
    if (!!form.errors.images) {
        messages.push(form.errors.images);
        removeError();
    }
    Object.keys(form.errors).forEach(key => {
        if (key.startsWith('images.')) {
            messages.push('Image ' + (Number((key).replace('images.', '')) + 1) + form.errors[key].replace(/^The images\..* field/, ''));
        }
    });
    return messages;
});
const removeImageErrors = () => {
    if (!!form.errors.images) {
        form.clearErrors('images')
    }
    removeError();
};
const canUpload = computed(() => form.images.length);
const upload = () => form.post(route('realtor.listing.image.store', { listing: props.listing.id }), {
    onSuccess: () => form.reset('images')
});
</script>

<template>
    <border-box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <div class="d-flex">
                <v-file-input
                v-model="form.images"
                :error="!!imageErrorsMessages.length"
                :error-messages="imageErrorsMessages.join(' || ')"
                @input="removeImageErrors"
                @click:clear="removeImageErrors"
                label="Select Image"
                prepend-icon="mdi-camera"
                accept="image/png, image/jpeg"
                density="compact"
                clearable
                counter
                chips
                multiple
                show-size
                ></v-file-input>
                <v-btn type="submit" :disabled="!canUpload">Upload</v-btn>
            </div>
        </form>
    </border-box>
    <border-box v-if="listing.images.length">
        <template #header>Current Listing Images</template>
        <div class="mt-2">
            <v-row no-gutters>
                <v-col cols="4" v-for="image in listing.images" :key="image.id">
                    <v-img class="mx-auto border-lg" max-height="200" rounded="lg" :src="image.src">
                        <template v-slot:error>
                            <v-img class="mx-auto" 
                                :src="props.baseUrl + 'storage/images/2lO29Y3LMNyv964UeCGvHcKdmaQAOYkT4PufGLKg.png'"
                            ></v-img>
                        </template>
                    </v-img>
                    <div class="mb-2 ms-2">
                        <Link :href="route('realtor.listing.image.destroy', { listing: props.listing.id, image: image.id })" as="button" method="DELETE">
                            <v-btn color="red">Delete</v-btn>
                        </Link>
                    </div>
                </v-col>
            </v-row>
        </div>
    </border-box>
</template>