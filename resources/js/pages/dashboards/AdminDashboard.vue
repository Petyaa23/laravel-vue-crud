<template>
    <div class="container bg-green-100">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                Products
                            </h1>
                            <button type="button"
                                    class="px-6 py-2.5 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                    @click="openAddProductModal = !openAddProductModal">
                                Add Product
                            </button>
                        </div>
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="bg-gray-200">
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
                                <td class="border px-4 py-2">{{ product.category.name }}</td>
                                <td class="border px-4 py-2">{{ product.price }}</td>
                                <td class="border px-4 py-2">{{ product.status }}</td>
                                <td class="border px-4 py-2">{{ product.created_at }}</td>
                                <td class="d-flex pl-4 md:border md:border-grey-500 text-left block md:table-cell">

                                    <button type="button" @click="editProduct(product)"
                                            data-bs-dismiss="modal"
                                            class="px-3 py-2.5 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out">
                                        Edit
                                    </button>

                                    <button type="button" class="mx-2 px-3 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                            data-bs-toggle="modalDeleteProduct" data-bs-target="#deleteProduct"
                                            @click="deleteProductModal(product.id)">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <AddProducts
                            :categories="categories"
                            v-if="openAddProductModal"
                            @productAdd="productAdd"
                            @close="openAddProductModal = false">
                        </AddProducts>
                        <EditCategory
                            v-if="openCategoryEditModal"
                            @close="openCategoryEditModal = false"
                            @moveCategory="moveCategory"
                            :selectedCategory="selectedCategory"
                            :changesCategory="changesCategory"
                        >
                        </EditCategory>
                        <EditProduct
                            v-if="openProductEditModal"
                            @close="openProductEditModal = false"
                            @moveProduct="moveProduct"
                            :selectedProduct="selectedProduct"
                            :changesProduct="changesProduct"
                        >
                        </EditProduct>
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
    </div>

</template>

<script>
import AddCategory from './AddCategory.vue';
import AddProducts from "./AddProducts.vue";
import DeleteCategory from './DeleteCategory.vue';
import DeleteProduct from "./DeleteProduct.vue";
import EditCategory from "./EditCategory.vue";
import EditProduct from "./EditProduct.vue";

export default {
    name: "UserDashboard.vue",

    components: {
        EditProduct,
        EditCategory,
        AddCategory,
        AddProducts,
        DeleteCategory,
        DeleteProduct
    },

    props: [
        'products'
    ],

    data() {
        return {
            showModal: false,
            selectedProduct: {},
            selectedCategory: {},
            selectedProductId: null,
            selectedCategoryId: null,
            openDeleteProductModal: false,
            openDeleteCategoryModal: false,
            changesProduct:{},
            changesCategory:{},
            openAddCategoryModal:false,
            openAddProductModal:false,
            openCategoryEditModal:false,
            openProductEditModal:false,
        }
    },

    methods: {
        toggleModal: function () {
            this.showModal = !this.showModal;
        },

        categoryAdd(item) {
            this.categories.push(item);
            this.openAddCategoryModal = false;
        },

        productAdd(item) {
            this.products.push(item);
            this.openAddProductModal = false;
        },

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

        editProduct(product) {
            this.openProductEditModal = !this.openProductEditModal;
            this.selectedProduct.id = product.id;
            this.selectedProduct.name = product.name;
            this.selectedProduct.price = product.price;
            this.changesProduct = product;
        },

        moveProduct(item) {
            this.selectedProduct = item;
            this.openProductEditModal = false
        },

        editCategory(category) {
            this.openCategoryEditModal = !this.openCategoryEditModal;
            this.selectedCategory.id = category.id;
            this.selectedCategory.name = category.name;
            this.selectedCategory.description = category.description;
            this.changesCategory = category;

        },

        moveCategory(item) {
            this.selectedCategory = item;
            this.openCategoryEditModal = false
        }
    }
}

</script>

<style scoped>

</style>

