<script setup lang = "ts">
import { useRoute } from 'vue-router';
import Navbar from '../../navbar/components/Navbar.vue';
import UserForm from '../components/UserForm.vue';
import { getUserByID, updateUser } from '../store/users';
import { IUser } from '../types/user';
import { router } from '../../router';
import { getUser, setUser } from '../store/user';

const user = getUserByID(+useRoute().params.userID);

const updateUserFunc = async (user: IUser) => {
    await updateUser(user);
    if(user.id == getUser().value?.id)
    {
        await setUser(user);
    }
    router.push({name: "userOverview"});
};
</script>

<template>
    <Navbar />
    <UserForm :user = "user" :needPassword = "false" :needIs_admin = "true" @submit-form = "updateUserFunc" v-if = "user"/>
</template>