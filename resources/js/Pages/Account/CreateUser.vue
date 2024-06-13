<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const visible = ref(false);
const visibleConfirm = ref(false);
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
const register = () => form.post(route('account.store'));
</script>

<template>
    <div>
        <v-card class="mx-auto px-6 py-8" max-width="450" elevation="6">
            <v-form @submit.prevent="register">
                    <v-text-field
                    class="mb-2"
                    label="Full Name"
                    prepend-icon="mdi-account"
                    placeholder="Enter your full name"
                    v-model="form.name"
                    :error="!!form.errors.name"
                    :error-messages="form.errors.name"
                    @input="form.clearErrors('name')"
                    ></v-text-field>
                    <v-text-field
                    class="mb-2"
                    label="Email"
                    type="email"
                    prepend-icon="mdi-at"
                    placeholder="Enter your email"
                    v-model="form.email"
                    :error="!!form.errors.email"
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
                    :error="!!form.errors.password"
                    :error-messages="form.errors.password"
                    @input="form.clearErrors('password')"
                    @click:appendInner="visible = !visible"
                    ></v-text-field>
                    <v-text-field
                    label="Confirm Password"
                    :type="visibleConfirm ? 'text' : 'password'"
                    prepend-icon="mdi-lock-check"
                    :append-inner-icon="visibleConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                    placeholder="Enter same password again"
                    v-model="form.password_confirmation"
                    :error="!!form.errors.password_confirmation"
                    :error-messages="form.errors.password_confirmation"
                    @input="form.clearErrors('password_confirmation')"
                    @click:appendInner="visibleConfirm = !visibleConfirm"
                    ></v-text-field>
                    <br>
                    <v-btn
                    color="success"
                    size="large"
                    type="submit"
                    variant="elevated"
                    block>
                    Sign Up
                    </v-btn>
            </v-form>
        </v-card>
    </div>
</template>