<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const visible = ref(false);
const form = useForm({
    email: null,
    password: null
});
const login = () => form.post(route('login.store'));
</script>

<template>
    <div>
        <v-card class="mx-auto px-6 py-8" max-width="450" elevation="6">
            <v-form @submit.prevent="login">
                    <v-text-field
                    class="mb-2"
                    label="Email"
                    type="email"
                    prepend-icon="mdi-at"
                    placeholder="Enter your email"
                    v-model="form.email"
                    :error="form.errors.email"
                    :error-messages="form.errors.email"
                    @input="form.clearErrors('email')"
                    ></v-text-field>

                    <v-text-field
                    label="Password"
                    :type="visible ? 'text' : 'password'"
                    prepend-icon="mdi-lock"
                    :append-inner-icon="visible ? 'mdi-eye' : 'mdi-eye-off'"
                    placeholder="Enter your password"
                    v-model="form.password"
                    :error="form.errors.password"
                    :error-messages="form.errors.password"
                    @input="form.clearErrors('password')"
                    @click:appendInner="visible = !visible"
                    ></v-text-field>
                    <br>
                    <v-btn
                    color="success"
                    size="large"
                    type="submit"
                    variant="elevated"
                    block>
                    Sign In
                    </v-btn>
                    <div class="text-center mt-2">
                        Need an account?
                        <Link :href="route('account.create')" class="text-decoration-none font-weight-bold">Click here</Link>
                    </div>
            </v-form>
        </v-card>
    </div>
</template>