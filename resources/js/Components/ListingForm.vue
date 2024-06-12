<script setup>
defineProps({
    form: Object
});
</script>

<template>
    <v-card-item>
    <div class="text-overline mb-1">Listing Form</div>
    <v-row class="text-blue-grey">
        <v-col cols="6" md="4">
            <v-text-field 
            type="number" 
            label="Beds" 
            placeholder="Enter number of beds" 
            v-model.number="form.beds"
            :error="form.errors.beds" 
            :error-messages="form.errors.beds"
            @input="form.clearErrors('beds')"
            ></v-text-field>
        </v-col>
        <v-col cols="6" md=4>
            <v-text-field 
            type="number" 
            label="Baths" 
            placeholder="Enter number of baths" 
            v-model.number="form.baths"
            :error="form.errors.baths" 
            :error-messages="form.errors.baths"
            @input="form.clearErrors('baths')"
            ></v-text-field>
        </v-col>
        <v-col cols="4" md="4">                    
            <v-text-field 
            type="number" 
            label="Area" 
            placeholder="Enter area as squire feet" 
            v-model.number="form.area"
            :error="form.errors.area" 
            :error-messages="form.errors.area"
            @input="form.clearErrors('area')"
            ></v-text-field>
        </v-col>
        <v-col cols="8">                      
            <v-text-field 
            label="City" 
            placeholder="Enter city" 
            v-model.number="form.city"
            :error="form.errors.city" 
            :error-messages="form.errors.city"
            @input="form.clearErrors('city')"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field 
            type="number" 
            label="Post Code" 
            placeholder="Enter post code" 
            v-model.number="form.code"
            :error="form.errors.code" 
            :error-messages="form.errors.code"
            @input="form.clearErrors('code')"
            ></v-text-field>
        </v-col>
        <v-col cols="8">
            <v-text-field 
            label="Street" 
            placeholder="Enter street address" 
            v-model="form.street"
            :error="form.errors.street" 
            :error-messages="form.errors.street"
            @input="form.clearErrors('street')"
            ></v-text-field>
        </v-col>
        <v-col cols="4">
            <v-text-field 
            type="number" 
            label="Street No." 
            placeholder="Enter street number" 
            v-model.number="form.street_nr"
            :error="form.errors.street_nr" 
            :error-messages="form.errors.street_nr"
            @input="form.clearErrors('street_nr')"
            ></v-text-field>
        </v-col>
        <v-col cols="8" md="12">
            <v-text-field 
            type="number" 
            label="Price"
            placeholder="Enter price" 
            v-model.number="form.price"
            :error="form.errors.price" 
            :error-messages="form.errors.price"
            @input="form.clearErrors('price')"
            ></v-text-field>
        </v-col>
    </v-row>
</v-card-item>
</template>