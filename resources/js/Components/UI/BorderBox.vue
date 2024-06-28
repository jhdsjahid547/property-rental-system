<template>
    <div>
        <v-card class="ma-3 pa-3" elevation="5">
            <v-card-item>
                <v-card-title class="text-blue-grey-lighten-1 font-weight-medium">
                    <slot name="header"></slot>
                </v-card-title>
            </v-card-item>
            <v-card-text>
                <slot></slot>
            </v-card-text>
        </v-card>
    </div>
</template>