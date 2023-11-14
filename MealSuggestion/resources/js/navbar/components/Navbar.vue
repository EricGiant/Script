<script setup lang="ts">
import {logout, unloadAssets} from '@/login/store/authentication';
import {router} from '@/router';

const logUserOut = async () => {
    await logout();
    unloadAssets();
    router.push({name: 'loginView'});
};
</script>

<template>
    <nav>
        <router-link :to="{name: 'homeOverview'}">HOME</router-link>

        <router-link :to="{name: 'ingredientCreate'}">CREATE INGREDIENT</router-link>

        <router-link :to="{name: 'recipeCreate'}">CREATE RECIPE</router-link>

        <router-link :to="{name: 'ingredient_userCreate'}">ADD TO STOCKLIST</router-link>

        <button @click="logUserOut()">LOGOUT</button>
    </nav>
</template>

<style scoped>
nav {
    text-align: center;
}
a {
    padding-left: 5px;
    padding-right: 5px;
}
</style>
