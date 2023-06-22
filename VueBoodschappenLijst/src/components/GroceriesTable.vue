<script setup>
import { computed } from "@vue/reactivity";
import { ref } from "vue";

const props = defineProps({
  productList: Array,
});

// TODO: properies hoeven geen ref te zijn
const products = ref(props.productList);

const newProduct = ref({
  name: "",
  price: undefined,
  amount: undefined,
});

const totalPrice = computed(() =>
  products.value.reduce(
    (acc, current) => (acc += current.amount * current.price),
    0
  )
);

const addProduct = () => {
  products.value.push({ ...newProduct.value });
};
</script>

<template>
  <table>
    <tr>
      <th>NAME</th>
      <th>PRICE</th>
      <th>AMOUNT</th>
      <th>TOTAL</th>
    </tr>
    <tr v-for="product in products">
      <td>{{ product.name }}</td>
      <td>{{ product.price }}</td>
      <!-- TODO: je mag properties nooit updated, deze zijn altijd read-only om onverwachte updates naar de parent data te voorkomen
    zodat debuggen ingewikkeld wordt. Als je een v-model gebruikt op de property mag dat dus niet. Maak daarom een deepcopy van de data 
    voordat deze bewerkt mag worden -->
      <td><input type="number" v-model="product.amount" /></td>
      <td>{{ product.price * product.amount }}</td>
    </tr>
    <tr>
      <td>TOTAL</td>
      <td></td>
      <td></td>
      <td v-if="products.length != 0">{{ totalPrice }}</td>
    </tr>
  </table>
  <p>ADD PRODUCT HERE</p>
  <form>
    <label for="name">NAME</label>
    <input type="text" v-model="newProduct.name" />
    <label for="price">PRICE</label>
    <input type="number" v-model="newProduct.price" />
    <label for="amount">AMOUNT</label>
    <input type="number" v-model="newProduct.amount" /><br />
    <button type="button" @click="addProduct()">ADD PRODUCT</button>
  </form>
</template>

<style scoped>
table {
  margin: auto;
  text-align: center;
}
p {
  margin: auto;
  text-align: center;
}
form {
  text-align: center;
}
label {
  padding-top: 5px;
}
label,
input {
  display: block;
  margin: auto;
  width: 100px;
}
</style>
