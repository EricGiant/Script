<script setup>
import { reactive } from 'vue';

const diceValues = reactive([]);
const diceAmount = 8;

function throwDice()
{
    diceValues.splice(0);
    for(var i = 0; i < diceAmount; i++)
    {
        diceValues.push(Math.floor(Math.random() * 6) + 1);
    }
}

</script>
<template>
    <button @click = "throwDice()">THROW</button>
    <table v-if = "diceValues.length != 0">
        <tr>
            <th>Dice</th>
            <th>Value</th>
        </tr>
        <tr v-for = "(item, index) in diceValues">
            <th>{{index}}</th>
            <th>{{item}}</th>
        </tr>
    </table>
</template>