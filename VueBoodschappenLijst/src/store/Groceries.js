import { computed, ref } from "vue";
import { router } from "../router/index"

export let id = 3;
export const products = ref([
{
    id: 0,
    name: "test",
    price: 5,
    amount: 5
},
{
    id: 1,
    name: "test2",
    price: 4,
    amount: 10
},
{
    id: 2,
    name: "test3",
    price: 50,
    amount: 1
}]);

export const addProduct = (product) => { 
    product.id = id; 
    products.value.push({...product});
    id++;
    router.push("/");
}

export const editProduct = (product) => {
    const index = products.value.findIndex((item) => item.id == product.id);
    products.value[index] = product;
    router.push("/");
}

export const deleteProduct = (product) => {
    const index = products.value.findIndex((item) => item.id == product.id);
    products.value.splice(index, 1);
}

export const getProductById = (productId) => computed(() => products.value.find((item) => item.id == productId));

export const totalPrice = computed(() => products.value.reduce((acc, current) => acc += (current.amount * current.price), 0));