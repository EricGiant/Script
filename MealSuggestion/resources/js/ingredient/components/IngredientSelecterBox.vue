<script setup lang="ts">
import { computed, ref } from "vue";
import { searchIngredients } from "../store/ingredient";

defineEmits(["pressIngredient"]);

const ingredients = computed(() => searchIngredients(search.value));
const search = ref("");
</script>

<template>
    <div id="box">
        <input type="text" v-model="search" placeholder="SEARCH" />
        <div id="content">
            <div v-for="ingredient in ingredients">
                <label :for="ingredient.name">{{ ingredient.name }}</label>
                <input
                    type="radio"
                    name="ingredient"
                    :id="ingredient.name"
                    @click="$emit('pressIngredient', ingredient)"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
#box {
    height: fit-content;
    width: fit-content;
    margin: auto;
    border: 2px solid black;
    text-align: left;
}
input[type="text"] {
    overflow: hidden;
    outline: none;
    border: 1px solid black;
}
#content {
    overflow-y: scroll;
    max-height: 120px;
}
#content label {
    padding-left: 5px;
}
</style>
