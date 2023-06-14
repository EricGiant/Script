<script setup>
import { reactive } from 'vue';

const diceAmount = 5;
const diceSize = 6;
const part2Names = ["Three Of A Kind", "Carre", "Full House", " Small Straight", "Large Straight", "Yathzee", "Chance"]
const dices = reactive(document.getElementsByName("dice"));

function throwDices()
{
    //generate dice values
    const values = [];
    for(let i = 0; i < dices.length; i++)
    {
        const value = Math.floor(Math.random() * 6) + 1;
        values.push(value)
        dices[i].innerText = value;
    }
    //start calculating score
    calculateScores(values);
}

function calculateScores(values)
{
    //get all part1 elements
    const part1Elements = document.getElementsByClassName("part1");

    //calculate all part1 scores
    let part1Total = 0;
    for(let i = 0; i < diceSize; i++)
    {
        let score = 0;
        for(let x = 0; x < diceAmount; x++)
        {
            if(values[x] == i + 1)
            {
                score += i + 1;
            }
        }
        part1Elements[i].children[1].innerText = score;
        part1Total += score;
    }

    //check for bonus
    if(part1Total >= 63)
    {
        part1Total += 35;
    }

    //show total score for part1
    document.getElementsByClassName("part1Total")[0].innerText = part1Total;

    //get all part2 elements
    const part2Elements = document.getElementsByClassName("part2");

    //calculate all part2 scores
    let part2Total = 0;
    for(let i = 0 ; i < part2Names.length; i++)
    {
        let score = 0;
        if(i == 0)
        {
            score += threeOfAKind(values);
        }
        else if(i == 1)
        {
            score += fourOfAKind(values);
        }
        else if(i == 2)
        {
            score += fullHouse(values);
        }
        else if(i == 3)
        {
            score += smallStraight(values);
        }
        else if(i == 4)
        {
            score += largeStraight(values);
        }
        else if(i == 5)
        {
            score += yathzee(values);
        }
        else if(i == 6)
        {
            score += chance(values);
        }

        part2Elements[i].children[1].innerText = score;
        part2Total += score;
    }

    //show total score for part2
    document.getElementsByClassName("part2Total")[0].innerText = part2Total;
}

function threeOfAKind(values)
{
    const found = duplicationAmountFinder(values, 3, 0);
    if(found[0])
    {
        let score = 0;
        for(let i = 0; i < values.length; i++)
        {
            score += values[i];
        }
        return score;
    }
    return 0
}

function fourOfAKind(values)
{
    const found = duplicationAmountFinder(values, 4, 0);
    if(found[0])
    {
        let score = 0;
        for(let i = 0; i < values.length; i++)
        {
            score += values[i];
        }
        return score;
    }
    return 0;
}

function fullHouse(values)
{
    const found = duplicationAmountFinder(values, 3, 0)
    if(found[0])
    {
        const found2 = duplicationAmountFinder(values, 2, found[1])
        if(found2[0])
        {
            return 25;
        }
    }
    return 0;
}

function smallStraight(values)
{
    const found = orderChecker(values, 4);
    if(found)
    {
        return 30;
    }
    return 0;
}

function largeStraight(values)
{
    const found = orderChecker(values, 5);
    if(found)
    {
        return 40;
    }
    return 0;
}

function yathzee(values)
{
    const found = duplicationAmountFinder(values, 5, 0);
    if(found[0])
    {
        return 50;
    }
    return 0;
}

function chance(values)
{
    let score = 0;
    for(let i = 0; i < values.length; i++)
    {
        score += values[i];
    }
    return score;
}

function duplicationAmountFinder(values, amount, skipValue)
{
    for(let i = 0; i < diceSize; i++)
    {
        let valueChecker = i + 1;
        let valueAmount = 0;

        //skip value
        if(valueChecker == skipValue)
        {
            continue;
        }

        //find how many times 1 number is found
        for(var x = 0; x < values.length; x++)
        {
            if(values[x] == valueChecker)
            {
                valueAmount++;
            }
        }

        //check if the amount of times a number is found is equal to the needed amount
        if(valueAmount >= amount)
        {
            return [true, valueChecker];
        }
    }
    return [false, 0];
}

function orderChecker(values, length)
{
    //sort values so lowest number is first
    values.sort();
    
    let startValue = values[0];
    let amount = 1;

    for(let i = 1; i < length; i++)
    {
        startValue++;
        if(startValue == values[i])
        {
            amount++;
        }
        else
        {
            break;
        }

        if(amount == length)
        {
            return true;
        }
    }
    return false;
}

</script>

<style scoped>#scoreBlock
{
    display: inline-block;
    padding: 10px;
    border: 2px solid black;
    text-align: center;
}

#dice
{
    display: inline-block;
    vertical-align: top;
    text-align: center;
    margin-left: 50px;
}

th
{
    border: 1px solid black;
    padding: 2px;
}
</style>

<template>
    <div style = "margin: auto; width: 400px; text-align: center;">
        <table id = "scoreBlock">
            <tr>
                <th>PART 1</th>
                <th>POINTS</th>
            </tr>
            <tr v-for = "index in diceSize"  class = "part1">
                <th>{{index}}</th>
                <th></th>
            </tr>
            <tr id = "part1Total">
                <th>Total Points</th>
                <th class = "part1Total"></th>
            </tr>
            <tr>
                <th>PART 2</th>
                <th>POINTS</th>
            </tr>
            <tr v-for = "item in part2Names" class = "part2">
                <th>{{item}}</th>
                <th></th>
            </tr>
            <tr>
                <th>Total Points</th>
                <th class = "part2Total"></th>
            </tr>
        </table>
        <button @click = "throwDices()" style = "display: block; margin: auto;">THROW</button>
        <div id = "dices">
            <div name = "dice" v-for = "index in 5" style = "display: inline-block; padding: 5px;"></div>
        </div>
    </div>
</template>