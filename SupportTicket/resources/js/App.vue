<script setup lang = "ts">
import { getAllTickets } from './ticket/store/ticket';

getAllTickets();
</script>

<template>
    <router-view />
</template>