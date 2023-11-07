<script setup lang="ts">
import { onMounted } from "vue";
import { reloadData } from "./login/store/authentication";

onMounted(async () => {
    await reloadData();
});
</script>

<template>
    <router-view />
</template>
