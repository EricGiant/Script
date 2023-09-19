<script setup lang = "ts">
import { computed } from 'vue';
import { getStatusByID } from '../../status/store/status';
import { getUser } from '../../user/store/user';
import { getUserByID } from '../../user/store/users';
import { getTickets } from '../store/ticket';
import { printCategoriesByID } from '../../category/store/category';

const allTickets = getTickets();
const user = getUser();

//manually build ticket list since it wont deep copy and otherwise it get live edited
const allTickets_NEWCOPY = computed(() => {
    if(allTickets.value)
    {
        const array = [];
        for(let i = 0; i < allTickets.value?.length; i++)
        {
            
            array.push(allTickets.value[i]);
        }
        return array.reverse();
    }
    return;
});
// const tickets = computed(() => { //for some reason this is live editing the store....... temporarily make a deep copy because this is bad
//     if(user.value?.is_admin)
//     {
//         const temp = {...allTickets}; //deep copy wont work
//         return temp.value?.reverse();
//         // return allTickets.value?.reverse();
//     }
//     else
//     {
//         const temp = {...allTickets};
//         return temp.value?.reverse();
//         // return allTickets.value?.filter((ticket) => ticket.user_id == user.value?.id).reverse();
//     }
// });

const appointedUserCheck = (id: number) => {
    if(id == null)
    {
        return "NOT APPOINTED YET"
    }
    else
    {
        return getUserByID(id).value?.full_name;
    }
}
</script>

<template>
    SHOULD THIS REALLY BE A COMPONENT?
    <table>
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>CATEGORIEËN</th>
            <th>STATUS</th>
            <th>AANGEMAAKT DOOR</th>
            <th>AANGEMAAKT OP</th>
            <th>LAATSE UPDATE OP</th>
            <th>TOEGEWEZEN AAN</th>
        </tr>
        <tr v-for = "ticket in allTickets_NEWCOPY">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ printCategoriesByID(ticket.category_ids) }}</td>
            <td>{{ getStatusByID(ticket.status_id).value?.title }}</td>
            <td>{{ getUserByID(ticket.user_id).value?.full_name }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ appointedUserCheck(ticket.appointed_to_id) }}</td>
            <td><router-link :to = "{name: 'ticketView', params: {ticketID: ticket.id}}">VIEW TICKET</router-link></td>
            <td><router-link :to = "{name: 'ticketEdit', params: {ticketID: ticket.id}}">EDIT TICKET</router-link></td>
        </tr>
    </table>
</template>

<style scoped>
table{
    text-align: center;
    margin: auto;
}
</style>