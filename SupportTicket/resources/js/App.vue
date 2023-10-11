<script setup lang="ts">
import { getLoggedInUser } from "./user/store/user";
import { onMounted } from "vue";

onMounted(async () => {
    await getLoggedInUser();
});
</script>

<template>
    <router-view />
</template>