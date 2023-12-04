<script setup lang="ts">
import {Login} from '../types/login';

const emit = defineEmits<{
    (event: 'submitForm', login: Login): void;
}>();

const login = new Login();
</script>

<template>
    <form>
        <div class="col-sm-2 m-auto text-center">
            <label for="name" class="h3">NAME</label>

            <input id="name" v-model="login.name" type="email" class="form-control" />
        </div>

        <div class="col-sm-2 m-auto mt-3 text-center">
            <label for="name" class="h3">PASSWORD</label>

            <input id="password" v-model="login.password" type="password" class="form-control" />
        </div>

        <div class="m-auto mt-3">
            <button type="submit" class="btn btn-primary fs-4" @click.prevent="emit('submitForm', login)">
                SIGN IN
            </button>
        </div>
    </form>
</template>
