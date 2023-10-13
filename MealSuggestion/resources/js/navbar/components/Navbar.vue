<script setup lang="ts"></script>

<template>
    <nav>
        <router-link :to="{ name: 'homeOverview' }">HOME</router-link>
        <router-link :to="{ name: 'ingredientCreate' }"
            >CREATE INGREDIENT</router-link
        >
    </nav>
</template>

<style scoped>
a {
    padding-left: 5px;
    padding-right: 5px;
}
</style>
