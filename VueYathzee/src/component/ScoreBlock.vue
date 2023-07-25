<script setup>
import { defineProps, computed, ref, watch } from 'vue';

const props = defineProps({
    dices: Array
});

const countedDice = computed(() => {
    let count = {
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
    }

    for(const key in count)
    {
        count[key] = props.dices.filter(dice => dice == key).length;
    }
    return count
})
const threeOfAKind = computed(() => sameKind(3));
const fourOfAKind = computed(() => sameKind(4));
const fullHouse = computed(() => {
    const found = duplicationAmountFinder(3, 0);
    if(found[0])
    {
        const found2 = duplicationAmountFinder(2, found[1]);
        if(found2[0])
        {
            return 25;
        }
    }
    return 0;
});
const smallStraight = computed(() => straight(4));
const largeStraight = computed(() => straight(5));
const yathzee = computed(() => {
    const found = duplicationAmountFinder(5);
    if(found[0])
    {
        return 50;
    }
    return 0;
});
const chance = computed(() => props.dices.reduce((acc, current) => acc += current, 0));

const part1Total = computed(() => {
    let total = Object.keys(countedDice.value).reduce((acc, current) => acc += countedDice.value[current] * current, 0);
    if(total >= 63)
    {
        total += 35;
    }
    return total;
});
const part2Total = computed(() => threeOfAKind.value + fourOfAKind.value + fullHouse.value + smallStraight.value + largeStraight.value + yathzee.value + chance.value);

const sameKind = (amount) => {
    const found = duplicationAmountFinder(amount, 0);
    if(found[0])
    {
        return props.dices.reduce((acc, current) => acc += current, 0);
    }
    return 0;
}

const straight = (length) => {
    const found = orderChecker(length);
    if(found && length == 4)
    {
        return 30;
    }
    else if(found && length == 5)
    {
        return 40;
    }
    return 0
}

function duplicationAmountFinder(amount, skipValue) {
  for (let i = 0; i < 6; i++) {
    let valueChecker = i + 1;
    let valueAmount = 0;

    //skip value
    if (valueChecker == skipValue) {
      continue;
    }

    //find how many times 1 number is found
    for (var x = 0; x < 5; x++) {
      if (props.dices[x] == valueChecker) {
        valueAmount++;
      }
    }

    //check if the amount of times a number is found is equal to the needed amount
    if (valueAmount >= amount) {
      return [true, valueChecker];
    }
  }
  return [false, 0];
}

function orderChecker(length) {
  //sort values so lowest number is first
  props.dices.sort();

  let startValue = props.dices[0];
  let amount = 1;

  for (let i = 1; i < length; i++) {
    startValue++;
    if (startValue == props.dices[i]) {
      amount++;
    } else {
      break;
    }

    if (amount == length) {
      return true;
    }
  }
  return false;
}
</script>


<template>
    <table id="scoreBlock">
      <tr>
        <th>PART 1</th>
        <th>POINTS</th>
      </tr>
      <tr v-for="(dice, index) in countedDice" :key="index" >
        <th>{{ index }}</th>
        <th>{{ countedDice[index] * index }}</th>
      </tr>
      
      <tr>
        <th>Total Points</th>
        <th>{{ part1Total }}</th>
      </tr>
      <tr>
        <th>PART 2</th>
        <th>POINTS</th>
      </tr>
      <tr>
        <th>Three Of A Kind</th>
        <th>{{ threeOfAKind }}</th>
      </tr>
      <tr>
        <th>Four Of A Kind</th>
        <th>{{ fourOfAKind }}</th>
      </tr>
      <tr>
        <th>Full House</th>
        <th>{{ fullHouse }}</th>
      </tr>
      <tr>
        <th>Small Straight</th>
        <th>{{ smallStraight }}</th>
      </tr>
      <tr>
        <th>Large Straight</th>
        <th>{{ largeStraight }}</th>
      </tr>
      <tr>
        <th>Yathzee</th>
        <th>{{ yathzee }}</th>
      </tr>
      <tr>
        <th>Chance</th>
        <th>{{ chance }}</th>
      </tr>
      <tr>
        <th>Total Points</th>
        <th>{{ part2Total }}</th>
      </tr>
    </table>
</template>

<style scoped>
th {
  border: 1px solid black;
  padding: 2px;
}

#scoreBlock {
  display: inline-block;
  padding: 10px;
  border: 2px solid black;
  text-align: center;
}
</style>