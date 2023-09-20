<script setup lang = "ts">
import { getAllTickets } from './ticket/store/ticket';
import { getAllStatuses } from './status/store/status';
import { getAllUsers } from './user/store/users';
import { getAllCategories } from './category/store/category';
import { getAllResponses } from './responses/store/response';
import { getLoggedInUser } from './user/store/user';
import { onMounted } from 'vue';

onMounted(async () => {
    await getAllTickets();
    await getAllStatuses();
    await getAllUsers();
    await getAllCategories();
    await getAllResponses();
    await getLoggedInUser();
});
</script>

<template>
    <router-view />
</template>