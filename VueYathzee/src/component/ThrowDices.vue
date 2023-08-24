<script setup>
import { defineProps } from "vue";

const props = defineProps({
  dices: Array,
});

const diceAmount = 5;

function throwDices() {
  for (let i = 0; i < diceAmount; i++) {
    // TODO: schrijf nooit naar properties van een component, maar maak een deep-copy en emit deze waarde
    // naar de parent
    props.dices[i] = Math.floor(Math.random() * 6) + 1;
  }
}
</script>

<template>
  <button @click="throwDices()" style="display: block; margin: auto">
    THROW
  </button>
  <div>
    <!-- TODO: gebruik bij voorkeur geen hard-coded bereiken in for loops, dus gebruik ipv 5 liever  props.dices.length 
        zodat je code schaalbaar blijft-->
    <div v-for="index in 5" style="display: inline-block; padding: 5px">
      {{ props.dices[index - 1] }}
    </div>
  </div>
</template>
