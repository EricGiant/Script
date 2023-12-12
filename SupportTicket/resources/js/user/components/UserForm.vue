<script setup lang="ts">
import { computed, ref } from "vue";
import { IUser } from "../types/user";

const props = defineProps<{
    user: IUser;
    needPassword: boolean;
    needIs_admin: boolean;
}>();

const emits = defineEmits(["submitForm"]);

// TODO: ref toevoegen, want je gebruikt een v-model op user, dus deze moet reactive zijn
const user = ref({ ...props.user });

const setIs_adminChangeChecked = computed(() => {
    if (user.value.is_admin) {
        return true;
    } else {
        return false;
    }
});
</script>

<template>
    <form>
        <label for="first_name">FIRST NAME</label>
        <input type="text" id="first_name" v-model="user.first_name" />
        <label for="last_name">LAST NAME</label>
        <input type="text" id="last_name" v-model="user.last_name" />
        <label for="email">EMAIL</label>
        <input type="email" v-model="user.email" />
        <label for="telephone_number">TELEPHONE NUMBER</label>
        <input
            type="tel"
            id="telephone_number"
            v-model="user.telephone_number"
        />
        <label v-if="props.needPassword" for="password">PASSWORD</label>
        <input
            v-if="props.needPassword"
            type="password"
            id="password"
            v-model="user.password"
        />
        <label v-if="props.needIs_admin" for="is_admin">IS ADMIN</label>
        <input
            v-if="props.needIs_admin"
            type="checkbox"
            id="is_admin"
            @click="user.is_admin = !user.is_admin"
            :checked="setIs_adminChangeChecked"
        />
        <input type="submit" @click.prevent="$emit('submitForm', user)" />
    </form>
</template>
