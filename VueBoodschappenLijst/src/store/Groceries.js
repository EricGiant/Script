import { computed, ref } from "vue";

export const products = ref([
  {
    id: 0,
    name: "potatoe",
    price: 5,
    amount: 5,
  },
  {
    id: 1,
    name: "steak",
    price: 4,
    amount: 10,
  },
  {
    id: 2,
    name: "milk",
    price: 50,
    amount: 1,
  },
]);

export const addProduct = (product) => {
  product.id = products.value.length;
  console.log(products);
};

export const editProduct = (product) => {
  const index = products.value.findIndex((item) => item.id == product.id);
  products.value[index] = product;
};

export const deleteProduct = (product) => {
  const index = products.value.findIndex((item) => item.id == product.id);
  products.value.splice(index, 1);
};

export const getProductById = (productId) =>
  computed(() => products.value.find((item) => item.id == productId));

export const totalPrice = computed(() =>
  products.value.reduce(
    (acc, current) => (acc += current.amount * current.price),
    0
  )
);
