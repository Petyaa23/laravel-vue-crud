<template>
    <AddProducts></AddProducts>
    <div class="container">
        <!--modal-product-open-->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                Products
                            </h1>
                            <button type="button"
                                    class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    data-bs-toggle="modal" data-bs-target="#addPrice">
                                Add Product
                            </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.name }}</td>
                            <td>Category</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.status }}</td>
                            <td>{{ product.created_at }}</td>
                            <td>
                                <button class="btn btn-success btn-sm"
                                        :to="{ name: 'ProductEdit', params: { productId: product.id }}">Edit
                                </button>
                                <button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button>
                            </td>
                            <td>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                            id="addPrice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog relative w-auto pointer-events-none">
                                <div
                                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div
                                        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium leading-normal text-gray-800"
                                            id="exampleModalLabel">
                                            Add products
                                        </h5>
                                        <button type="button"
                                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                                data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body relative p-4">
                                        <label for="name"
                                               class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                            Name
                                        </label>
                                        <input id="name" type="text" v-model="product.name"
                                               class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                               placeholder="Name"/>
                                        <label for="categories"
                                               class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                            Category
                                        </label>
                                        <select disabled id="categories"  v-model="product.category"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Choose a category</option>
                                        </select>
                                        <label for="price"
                                               class="pt-5 text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                            Price
                                        </label>
                                        <input id="price" type="number" v-model="product.price"
                                               class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                               placeholder="Price"/>
                                    </div>
                                    <div
                                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                        <button type="button"
                                                class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                                data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" v-on:click="saveProducts()"
                                                data-bs-dismiss="modal"
                                                class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!--modal-product-close-->
        <!--modal-category-open-->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex items-center justify-between mb-6">
                                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                    Categories
                                </h1>
                                <button type="button"
                                        class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                        data-bs-toggle="modal" data-bs-target="#addCategory">
                                    Add Category
                                </button>
                            </div>
                            <div
                                class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                                id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog relative w-auto pointer-events-none">
                                    <div
                                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                        <div
                                            class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                            <h5 class="text-xl font-medium leading-normal text-gray-800"
                                                id="exampleModalLabel">
                                                Add categories
                                            </h5>
                                            <button type="button"
                                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body relative p-4">
                                            <label for="name"
                                                   class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                                                Name
                                            </label>
                                            <input id="name" type="text" v-model="category.name"
                                                   class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                                   placeholder="Name"/>

                                            <p class="mb-2 font-semibold text-gray-700">
                                                Description
                                            </p>
                                            <textarea type="text" id="desc" name="desc"
                                                      v-model="category.description"
                                                      class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow-sm h-36"
                                                      placeholder="Category Description...">
                                            </textarea>
                                        </div>
                                        <div
                                            class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                            <button type="button"
                                                    class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                                    data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" v-on:click="saveCategories()"
                                                    data-bs-dismiss="modal"
                                                    class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="category in categories">
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.description }}</td>
                                        <td>{{ category.status }}</td>
                                        <td>{{ category.created_at }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm"
                                                    :to="{ name: 'ProductEdit', params: { category: category.id }}">Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--modal-close-->
</template>
<script>
import products from "./AddProducts.vue";

export default {
    name: "UserDashboard",
    components: {
        AddProducts: products,
    },
    data() {
        return {
            product: {
                name: '',
                price: '',
            },
            category: {
                name: '',
                description: ''
            }
        }
    },
    props: [
        "products",
        "categories"
    ],

    methods: {
        saveProducts: function () {
            axios.post('/add-products', this.product).then(res => {
                this.product = res.data;
                location.reload()
            }).catch(error => {
                console.log(error)
            })
        },
        saveCategories: function () {
            axios.post('/add-categories', this.category).then(res => {
                this.category = res.data;
                location.reload()
            }).catch(error => {
                console.log(error)
            })
        },
        deleteProduct: function (productId) {
            axios.post('/delete-products' + productId).then()
            location.reload()
        },

        deleteCategory: function (categoryId) {
            axios.post('/delete-category' + categoryId).then()
            location.reload()
        }
    },

    // deleteProduct(productId) {
    //     console.log(productId);
    //     this.axios
    //         .delete("/delete-products")
    //         .then(response => {
    //             let i = this.products.map(data => data.id).indexOf(productId);
    //             this.products.splice(i, 1)
    //         });
    // }
}


// created() {
//     this.getProducts();
// },
//     methods: {
//         getProducts() {
//             this.axios.get('http://127.0.0.1:8000/api/products').then(response => {
//                 this.products = response.data;
//             }).catch(error=>{
//                 console.log(error)
//             })
//         },


</script>

<style scoped>

</style>

