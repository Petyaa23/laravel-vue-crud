<template>
    <Form :validation-schema="schema" v-slot="{ errors }">
    <div class="bg-gray-100 h-full w-full animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog relative w-25 pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800"
                        id="exampleModalLabel">
                        Edit product
                    </h5>
                    <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            @click="$emit('close')">
                    </button>
                </div>
                <div class="modal-body relative p-4">
                    <label for="name"
                           class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Name
                    </label>
                    <Field id="name" type="text" v-model="selectedProduct.name"
                           class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                           placeholder="Name"
                           :class="{ 'is-invalid': errors}">
                    </Field>
                    <div class="invalid-feedback">{{errors.name}}</div>
                    <div class="mb-5"></div>

                    <label for="categories"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Category
                    </label>

                    <Field id="categories" v-model="categoryId"
                           :class="{ 'is-invalid': errors.category}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option v-for="category in categories"
                                :value="category.id">
                            {{ category.name }}</option>
                    </Field>
                    <div class="invalid-feedback">{{errors.category}}</div>
                    <div class="mb-5"></div>

                    <label for="price"
                           class="pt-5 text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Price
                    </label>
                    <Field id="price" type="number" v-model="selectedProduct.price"
                           :class="{ 'is-invalid': errors}"
                           class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                           placeholder="Price">
                    </Field>
                    <div class="invalid-feedback ">{{errors.price}}</div>
                    <div class="mb-5"></div>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end space-x-4 p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                            class="px-6 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                            @click="$emit('close')">
                        Close
                    </button>
                    <button type="submit" @click=changeProduct(product)
                            class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    </Form>
</template>

<script>
import { Form, Field } from 'vee-validate';
import * as yup from "yup";

export default {
    name: "EditProduct.vue",
    components: {
        Form,
        Field,
    },

    props: [
        'selectedProduct',
        'changesProduct',
        'categories',
    ],

    data() {
        const schema = yup.object().shape({
            name:yup.string()
                .min(3, "Name should be less than 3 characters")
                .max(35, "Name should not exceed 35 characters")
                .required("Name is required"),
            category: yup.string()
                .required("Please enter the category field"),
            price: yup.string()
                .required("Please enter the required field")
                .matches(/^[0-9](\.[0-9][0-9][0-9])$/,"Only number are allowed for this field example 1.111")
        });

        return {
            schema,
            openEditProductModal: false,
            categoryId:null,
            // showModal: false,
            product: {
                'name': '',
                'price': '',
                'category': '',
            },
        }
    },
    methods: {
        changeProduct(product) {
            this.selectedProduct.category_id = this.categoryId
            axios.post('/update-product', this.selectedProduct)
                .then(res => {
                    if (res.data.product) {
                        this.$emit('moveProduct', res.data.product);
                    }
                })
        },
    }
}
</script>

<style scoped>

</style>
