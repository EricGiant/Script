<script setup lang="ts">
import { getAllResponses } from "./responses/store/response";
import { getLoggedInUser } from "./user/store/user";
import { onMounted } from "vue";

onMounted(async () => {
    await getLoggedInUser();
    // await getAllResponses();
});
</script>

<template>
    <router-view />
</template>