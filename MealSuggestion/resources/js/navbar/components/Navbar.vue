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
    <nav class="navbar navbar-expand">
        <ul class="mx-auto navbar-nav text-center">
            <li class="h5 nav-item">
                <router-link :to="{name: 'homeOverview'}" class="nav-link">Home</router-link>
            </li>

            <li class="h5 nav-item">
                <router-link :to="{name: 'ingredientCreate'}" class="nav-link">Add Ingredient</router-link>
            </li>

            <li class="h5 nav-item">
                <router-link :to="{name: 'recipeCreate'}" class="nav-link">Add Recipe</router-link>
            </li>

            <li class="h5 nav-item">
                <router-link :to="{name: 'ingredient_userCreate'}" class="nav-link">Add To Stocklist</router-link>
            </li>

            <li class="h5 nav-item">
                <router-link :to="{name: 'ingredient_userOverview'}" class="nav-link">See Stocklist</router-link>
            </li>

            <li class="h5 m-1 nav-item">
                <button class="btn btn-primary" @click="logUserOut()">LOGOUT</button>
            </li>
        </ul>
    </nav>
</template>
