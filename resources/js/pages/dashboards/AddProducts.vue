<template>
    <div class="bg-gray-100 h-full w-full animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog relative w-25 pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800"
                        id="exampleModalLabel">
                        Add product
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
<!--                    v-bind:class="{ 'border-red-400': errors['name'] }"-->
                    <input id="name" type="text" v-model="product.name"
                           class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                           placeholder="Name"/>
<!--                    <pre class="hidden">{{errors['name']}}</pre>-->
                    <label for="categories"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Category
                    </label>
                    <select id="categories" v-model="categoryId"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option v-for="category in categories"
                                 :value="category.id">
                            {{ category.name }}</option>
                    </select>
                    <label for="price"
                           class="pt-5 text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Price
                    </label>
                    <input id="price" type="number" v-model="product.price"
                           class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                           placeholder="Price"/>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end space-x-4 p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                            class="px-6 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                            @click="$emit('close')">
                        Close
                    </button>
                    <button type="submit" @click=addProduct()
                            class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import * as Yup from "yup";


export default{
  name:'AddProducts.vue',

    props: [
        'categories',
    ],

    data() {
        //  Yup.object().shape({
        //     name:Yup.string()
        //         .min(3, "Name should be less than 3 characters")
        //         .max(100, "Name should not exceed 35 characters")
        //         .required("Name is required"),
        //     price: Yup.string()
        //         .required("Please enter the required field")
        //         .matches(/^[0-9](\.[0-9][0-9][0-9])$/,"Only alphabets are allowed for this field")
        // });

        return {
            showModal: false,
            categoryId:null,
            product: {
                'name': '',
                'price': '',
            },
            // errors: {
            //     name: "2222222222222",
            //     price: "jjjjjjjjjjjjjjjjj",
            // },
        }
    },

    methods: {
        toggleModal () {
            this.showModal = !this.showModal;
        },

        addProduct() {
            this.product.category_id = this.categoryId;
            axios.post('/add-products', this.product)
                .then(res => {
                    this.$emit('productAdd', res.data.product);
                })
                .catch(
                    error => {
                        console.log('500 Internal Server Error');
                 })
        },
    }
}

</script>
