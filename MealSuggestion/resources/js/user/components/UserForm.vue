<script setup lang="ts">
import type {UserAccount} from '../types/userAccount';

const props = defineProps<{
    userAccount: UserAccount;
}>();

const emit = defineEmits<{
    (event: 'submitForm', userAccount: UserAccount): void;
}>();

const userAccount = {...props.userAccount};
</script>

<template>
    <form class="col-sm-3 m-auto text-center">
        <label for="name" class="h3">NAME</label>

        <input v-model="userAccount.name" type="text" class="form-control m-auto w-75" />

        <label for="email" class="h3 mt-2">EMAIL</label>

        <input v-model="userAccount.email" type="email" class="form-control m-auto w-75" />

        <label for="password" class="h3 mt-2">PASSWORD</label>

        <input v-model="userAccount.password" type="password" class="form-control m-auto w-75" />

        <input
            type="submit"
            class="btn btn-primary fs-4 mt-3"
            value="CREATE ACCOUNT"
            @click.prevent="emit('submitForm', userAccount)"
        />
    </form>
</template>
