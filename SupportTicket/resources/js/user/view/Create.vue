<script setup lang = "ts">
import UserForm from '../components/UserForm.vue';
import { User, IUser } from '../types/user';
import { createUser } from '../store/users';
import { router } from '../../router';
import { authenticateUser } from '../../login/store/authentication';
import { setUser } from '../store/user';

const user: IUser = new User();

const createUserFunc = async (user: IUser) => {
    await createUser(user);
    const response = await authenticateUser({email: user.email, password: user.password});
    if(typeof response == "object")
    {
        setUser(response);
        router.push({name: "ticketOverview"});
    }
    else
    {
        router.push({name: "login"});
    }
};
</script>

<template>
    <UserForm :user = user :needPassword = "true" :needIs_admin = "false" @submit-form = "createUserFunc" />
</template>