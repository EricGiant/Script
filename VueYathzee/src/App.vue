<script setup>
import { ref } from "vue";
import ScoreBlock from './component/ScoreBlock.vue';
import ThrowDices from './component/ThrowDices.vue';

const dices = ref([0, 0, 0, 0, 0]);
</script>

<template>
    <div style="margin: auto; width: 400px; text-align: center">
        <ScoreBlock :dices="dices"/>
        <ThrowDices :dices="dices"/>  
    </div>
</template>