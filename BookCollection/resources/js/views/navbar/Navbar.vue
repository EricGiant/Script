<script setup lang = "ts">
</script>

<template>
    <nav>
        <router-link :to = "{name: 'home'}">HOME</router-link>
        <router-link :to = "{name: 'bookCreate'}">ADD BOOK</router-link>
        <router-link :to = "{name: 'authorOverview'}">SEE AUTHORS</router-link>
    </nav>
</template>

<style scoped>
nav{
    text-align: center;
    width: 80%;
    margin: auto;
}
a{
    padding: 5px;
}
</style>