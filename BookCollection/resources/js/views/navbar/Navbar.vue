<script setup>
</script>

<template>
    <nav>
        <router-link :to = "{name: 'home'}">HOME</router-link>
        <router-link :to = "{name: 'bookCreate'}">ADD BOOK</router-link>
        <router-link :to = "{name: 'reviewCreate'}">ADD REVIEW</router-link>
        <router-link :to = "{name: 'authorCreate'}">ADD AUTHOR</router-link>
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