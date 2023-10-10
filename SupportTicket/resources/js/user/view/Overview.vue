<script setup lang = "ts">
import Navbar from '../../navbar/components/Navbar.vue';
import { getUser } from '../store/user';
import { getUsers, getRollByBool, deleteUser } from '../store/users';

const users = getUsers();

const deleteUserFunc = async (id: number) => {
    if(confirm("ARE U SURE U WANT TO DELETE THIS USER?"))
    {
        await deleteUser(id);
    }
}
</script>

<template>
    <Navbar />
    <table>
        {{ getUser().value }}
        <tr>
            <th>VOORNAAM</th>
            <th>ACHTERNAAAM</th>
            <th>EMAIL-ADRES</th>
            <th>ROL</th>
            <th>TELEFOONNUMMER</th>
        </tr>
        <tr v-for = "user in users">
            <td>{{ user.first_name }}</td>
            <td>{{ user.last_name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ getRollByBool(user.is_admin) }}</td>
            <td>{{ user.telephone_number }}</td>
            <td><router-link :to = "{name: 'userEdit', params: {userID: user.id}}">EDIT USER</router-link></td>
            <td><button @click = "deleteUserFunc(user.id)">DELETE</button></td>
        </tr>
    </table>
</template>