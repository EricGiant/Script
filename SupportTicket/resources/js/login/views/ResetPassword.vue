<script setup lang = "ts">
import { ref } from 'vue';
import { updatePassword } from '../store/authentication';
import { useRoute } from 'vue-router';
import { router } from '../../router';

const password = ref();
const token = useRoute().params.token as string;

const updatePasswordFunc = async () => {
    await updatePassword(password.value, token);
    alert("YOUR PASSWORD HAS BEEN CHANGED, U WILL NOW BE REDIRECTED TO THE LOGIN PAGE");
    router.push({name: "login"});
}
</script>

<template>
    <form>
        <label for = "password">PASSWORD</label>
        <input type = "password" id = "password" v-model = "password">
        <input type = "submit" @click.prevent = "updatePasswordFunc()">
    </form>
</template>