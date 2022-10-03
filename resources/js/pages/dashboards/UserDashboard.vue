<template>
    <AddProducts></AddProducts>
    <div class="container">
        <!--modal-product-open-->
        <div class="py-12">
            <div class="max-w-[85%] mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                Products
                            </h1>
                            <button type="button"
                                    class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    data-bs-toggle="modal" data-bs-target="#addProduct">
                                Add Product
                            </button>
                        </div>
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Created Date</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products">
                                <td class="border px-4 py-2">{{ product.name }}</td>
                                <td class="border px-4 py-2">
                                    <option selected>

                                    </option>
                                </td>
                                <td class="border px-4 py-2">{{ product.price }}</td>
                                <td class="border px-4 py-2">{{ product.status }}</td>
                                <td class="border px-4 py-2">{{ product.created_at }}</td>
                                <td class="px-4 py-2 md:border md:border-grey-500 text-left block md:table-cell">

                                    <button type="button" @click="editProduct()"
                                            data-bs-dismiss="modal"
                                            class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Edit
                                    </button>
                                    <button type="button" class="mx-2 btn btn-danger px-4 py-2"
                                            data-bs-toggle="modalDeleteProduct" data-bs-target="#deleteProduct"
                                            @click="deleteProductModal(product.id)">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <DeleteProduct
                            v-if="openDeleteProductModal"
                            :id="selectedProductId"
                            @close="openDeleteProductModal = false"
                            @deleteProduct="deleteProduct">
                        </DeleteProduct>
                    </div>
                </div>
            </div>
        </div>
        <AddCategory></AddCategory>
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
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Created Date</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories" v-bind:key="category.id">
                                <td class="border px-4 py-2">{{ category.name }}</td>
                                <td class="border px-4 py-2">{{ category.description }}</td>
                                <td class="border px-4 py-2">{{ category.status }}</td>
                                <td class="border px-4 py-2">{{ category.created_at }}</td>
                                <td class="px-4 py-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <button type="button" @click="editCategory()"
                                            data-bs-dismiss="modal"
                                            class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Edit
                                    </button>
                                    <button type="button" class="mx-2 btn btn-danger px-4 py-2"
                                            data-bs-toggle="modalDeleteCategory" data-bs-target="#deleteCategory"
                                            @click="deleteCategoryModal(category.id)">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <DeleteCategory
                            v-if="openDeleteCategoryModal"
                            :id="selectedCategoryId"
                            @close="openDeleteCategoryModal = false"
                            @deleteCategory="deleteCategory">
                        </DeleteCategory>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import modalCategory from './AddCategory.vue';
import modalProduct from "./AddProducts.vue";
import modalDeleteCategory from './DeleteCategory.vue';
import modalDeleteProduct from "./DeleteProduct.vue";

export default {
    name: "user-dashboard",
    components: {
        AddCategory: modalCategory,
        AddProducts: modalProduct,
        DeleteCategory: modalDeleteCategory,
        DeleteProduct: modalDeleteProduct
    },

    props: [
        'categories',
        'products'
    ],

    data() {
        return {
            selectedProductId: null,
            selectedCategoryId: null,
            openDeleteProductModal: false,
            openDeleteCategoryModal: false,
        }
    },

    methods: {
        deleteCategory() {
            this.categories.forEach((item, index) => {
                if (item.id === this.selectedCategoryId) {
                    this.categories.splice(index, 1);
                }
            });

            this.openDeleteCategoryModal = false;
        },

        deleteCategoryModal(id) {
            this.openDeleteCategoryModal = true;
            this.selectedCategoryId = id;
        },

        deleteProduct() {
            this.products.forEach((item, index) => {
                if (item.id === this.selectedProductId) {
                    this.products.splice(index, 1);
                }
            });

            this.openDeleteProductModal = false;
        },

        deleteProductModal(id) {
            this.openDeleteProductModal = true;
            this.selectedProductId = id;
        },

        // saveProducts: function () {
        //     axios.post('/add-products', this.product).then(res => {
        //         this.product = res.data;
        //         location.reload()
        //     }).catch(error => {
        //         console.log(error)
        //     })
        // },
        // saveCategories: function () {
        //     axios.post('/add-categories', this.category).then(res => {
        //         this.category = res.data;
        //         location.reload()
        //     }).catch(error => {
        //         console.log(error)
        //     })
        // },

        // updateCategory: function (categories) {
        //     console.log(this.categories)

        // location.reload()
    },

    // updatePost() {
    //     this.axios
    //         .post(`/update/${this.$route.params.id}`, this.post)
    //         .then((response) => {
    //             this.$router.push({name: 'home'});
    //         });
    // }

}


</script>

<style scoped>

</style>

