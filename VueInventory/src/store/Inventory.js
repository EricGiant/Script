import { ref } from "vue";
import { router } from "../router/index";

let id  = 7;
export const inventory = ref([
    {
        id: 0,
        name: "potatoe",
        actualAmount: 5,
        miniumAmount: 10
    },
    {
        id: 1,
        name: "salade",
        actualAmount: 12,
        miniumAmount: 4
    },
    {
        id: 2,
        name: "steak",
        actualAmount: 7,
        miniumAmount: 10
    },
    {
        id: 3,
        name: "ice",
        actualAmount: 20,
        miniumAmount: 8
    },
    {
        id: 4,
        name: "rice",
        actualAmount: 8,
        miniumAmount: 15
    },
    {
        id: 5,
        name: "ketchup",
        actualAmount: 3,
        miniumAmount: 8
    },
    {
        id: 6,
        name: "beer",
        actualAmount: 5,
        miniumAmount: 20
    }
]);

export const addProduct = (product) =>
{
    product.id = id;
    inventory.value.push({...product});
    id++;
    router.push("/");
}

export const editProduct = (product) => {
    const index = inventory.value.findIndex((item) => item.id == product.id);
    inventory.value[index] = product;
    router.push("/");
}

export const getProductById = (productId) => inventory.value.find((item) => item.id == productId);

export const getProductsToOrder = () => inventory.value.filter(product => product.actualAmount < product.miniumAmount);