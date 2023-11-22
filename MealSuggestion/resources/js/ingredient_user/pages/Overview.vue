<script setup lang="ts">
import IngredientTable from '@/ingredient/components/IngredientTable.vue';
import Navbar from '@/navbar/components/Navbar.vue';
import {deleteIngredient, getUser, updateIngredient} from '@/user/store/user';

const user = getUser();
</script>

<template>
    <Navbar />

    <IngredientTable
        v-if="user"
        :ingredients="user?.ingredients"
        @update-ingredient="updateIngredient"
        @delete-ingredient="deleteIngredient"
    />
</template>
