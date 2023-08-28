<!-- TODO: map "views" zou ik "pages" noemen -->
<script setup lang="ts">
import { getAuthors } from "../../store/authors";

// TODO: het filter op regel 13 zou ik in de store inbouwen en een aparte getter voor
// schrijven
const authors = getAuthors();
</script>

<template>
    <div id="contentBox">
        <router-link
            :to="{ name: 'authorEdit', params: { authorID: author.id } }"
            v-for="author in authors.filter((author) => author.id != 1)"
        >
            <p>{{ author.name }}</p>
        </router-link>
    </div>
</template>

<style scoped>
#contentBox {
    text-align: center;
    width: 80%;
    margin: auto;
}
</style>
