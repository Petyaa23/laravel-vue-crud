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
                                    class="px-6 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                    @click="openAddProductModal = !openAddProductModal">
                                Add Product
                            </button>
                        </div>
                        <div v-if="Object.values(products).length">
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
                                <tr v-for="product in products.data">
                                    <td class="border px-4 py-2">{{ product.name }}</td>
                                    <td class="border px-4 py-2" v-if="product.category_id">{{ product.category.name }}</td>
                                    <td class="border px-4 py-2" v-else></td>
                                    <td class="border px-4 py-2">{{ product.price }}</td>
                                    <td class="border px-4 py-2">{{ product.status }}</td>
                                    <td class="border px-4 py-2">{{ product.created_at }}</td>
                                    <td class="d-flex pl-4 py-1 md:border md:border-grey-500 text-left block md:table-cell">

                                        <button type="button" @click="editProduct(product)"
                                                class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                        >
                                            Edit
                                        </button>

                                        <button type="button"
                                                class="mx-2 px-3 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                                data-bs-toggle="modalDeleteProduct" data-bs-target="#deleteProduct"
                                                @click="deleteProductModal(product.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex" v-if="products.links.length > 3">
                                <div class="mt-10 flex justify-center mt-8">
                                    <template v-for="(link, key) in products.links" :key="key">
                                        <div
                                            v-if="link.url === null"
                                            class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                            v-html="link.label"
                                        />
                                        <button
                                            v-else
                                            @click="getProducts(link.url)"
                                            class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                            :class="{ 'bg-gray-800 text-white': link.active }"
                                            v-html="link.label"
                                        ></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            Loading...
                        </div>
                        <AddProducts
                            :categories="categoryList"
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
                            :categories="categoryList"
                            v-if="openProductEditModal"
                            @close="openProductEditModal = false"
                            @moveProduct="moveProduct"
                            :selectedProduct="selectedProduct"
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                Categories
                            </h1>
                            <button type="button"
                                    class="px-6 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                    @click="openAddCategoryModal = !openAddCategoryModal">
                                Add Category
                            </button>
                        </div>
                        <div v-if="Object.values(categories).length">
                            <table class="table-fixed w-full">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Description</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Created Date</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="category in categories.data">
                                    <td class="border px-4 py-2">{{ category.name }}</td>
                                    <td class="border px-4 py-2">{{ category.description }}</td>
                                    <td class="border px-4 py-2">active</td>
                                    <td class="border px-4 py-2">{{ category.created_at }}</td>
                                    <td class="d-flex py-1 pl-8 md:border md:border-grey-500 text-left block md:table-cell">
                                        <button type="button" @click="editCategory(category)"
                                                class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out">
                                            Edit
                                        </button>
                                        <button type="button"
                                                class="mx-2 px-3 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                                @click="deleteCategoryModal(category.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex" v-if="categories.links.length > 3">
                                <div class="mt-10 flex justify-center mt-8">
                                    <template v-for="(link, key) in categories.links" :key="key">
                                        <div
                                            v-if="link.url === null"
                                            class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                            v-html="link.label"
                                        />
                                        <button
                                            v-else
                                            @click="getCategories(link.url)"
                                            class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                            :class="{ 'bg-gray-800 text-white': link.active }"
                                            v-html="link.label"
                                        ></button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            Loading...
                        </div>
                        <AddCategory
                            v-if="openAddCategoryModal"
                            @categoryAdd="categoryAdd"
                            @close="openAddCategoryModal = false"
                        >
                        </AddCategory>
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
import AddCategory from '../../components/Category/AddCategory.vue';
import AddProducts from "../../components/Product/AddProducts.vue";
import DeleteCategory from '../../components/Category/DeleteCategory.vue';
import DeleteProduct from "../../components/Product/DeleteProduct.vue";
import EditCategory from "../../components/Category/EditCategory.vue";
import EditProduct from "../../components/Product/EditProduct.vue";

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
        'categories',
        'products',
        'category_list'
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
            changesProduct: {},
            changesCategory: {},
            openAddCategoryModal: false,
            openAddProductModal: false,
            openCategoryEditModal: false,
            openProductEditModal: false,
            categories: {},
            products: {},
            categoryList: [],
        }
    },

    methods: {
        toggleModal() {
            this.showModal = !this.showModal;
        },

        categoryAdd(item) {
            this.categories.data.unshift(item);
            if(this.categories.data.length > 5) {
                this.categories.data.pop();
            } else {
                this.categories.data.push(item)
            }
            this.openAddCategoryModal = false;
        },

        productAdd(item) {
            this.products.data.unshift(item);
            this.products.data.pop();
            this.openAddProductModal = false;
        },

        deleteCategory() {
            this.categories.data.forEach((item, index) => {
                if (item.id === this.selectedCategoryId) {
                    this.categories.data.splice(index, 1);
                }
            });
            this.openDeleteCategoryModal = false;
        },

        deleteCategoryModal(id) {
            this.openDeleteCategoryModal = true;
            this.selectedCategoryId = id;
        },

        deleteProduct() {
            this.products.data.forEach((item, index) => {
                if (item.id === this.selectedProductId) {
                    this.products.data.splice(index, 1);
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
            this.selectedProduct.category = product.category;
            this.changesProduct = product;
        },

        moveProduct(product) {
            this.changesProduct.name = product.name;
            this.changesProduct.price = product.price;
            this.changesProduct.category = product.category;
            this.openProductEditModal = false;
        },

        editCategory(category) {
            this.openCategoryEditModal = !this.openCategoryEditModal;
            this.selectedCategory.id = category.id;
            this.selectedCategory.name = category.name;
            this.selectedCategory.description = category.description;
            this.changesCategory = category;
        },

        moveCategory() {
            this.openCategoryEditModal = false
        },

        getCategories(link = null) {
            axios.get(link ?? '/get-categories').then(res => {
                this.categories = res.data.categories;
            });
        },

        getProducts(link = null) {
            axios.get(link ?? '/get-products').then(res => {
                this.products = res.data.products;
            });
        },

        getCategoryList() {
            axios.get('/get-category-list').then(res => {
                this.categoryList = res.data.category_list;
            });
        }
    },

    created() {
        this.getCategories();
        this.getProducts();
        this.getCategoryList();
    }
}

</script>

<style scoped>
</style>

