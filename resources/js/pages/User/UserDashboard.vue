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
                                    <td class="border px-4 py-2">{{ product.category.name }}</td>
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
                            :current_page="products.current_page"
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
                            :current_page="categories.current_page"
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
        categoryAdd(item) {
            if (this.categories.current_page === 1 ) {
                this.categories.data.unshift(item);
            }

            if(this.categories.data.length > 5) {
                this.categories.data.pop();
            }
            this.categories.total++;
            const perPage = Math.ceil(this.categories.total / 5);
            if (perPage > (this.categories.links.length - 2)) {
                const categoriesLink = {
                    url: window.location.origin + '/get-categories?page=' + perPage,
                    label: perPage,
                    active: false
                };
                this.categories.links.splice(this.categories.links.length - 1, 0, categoriesLink);
            }
            this.getCategoryList();
            this.openAddCategoryModal = false;
        },

        productAdd(item) {
            if (this.products.current_page === 1 ) {
                this.products.data.unshift(item);
            }

            if(this.products.data.length > 5) {
                this.products.data.pop();
            }
            this.products.total++;
            const perPage = Math.ceil(this.products.total / 5);
            if (perPage > (this.products.links.length - 2)) {
                const productsLink = {
                    url: window.location.origin + '/get-products?page=' + perPage,
                    label: perPage,
                    active: false
                };
                this.products.links.splice(this.products.links.length - 1, 0, productsLink);
            }
            this.openAddProductModal = false;
        },

        deleteCategory(category) {
            this.categories.data.forEach((item, index) => {
                if (item.id === this.selectedCategoryId) {
                    this.categories.data.splice(index, 1);
                }
            });
            if (this.categories.data.length === 4) {
                if (category)
                    this.categories.data.push(category);
            }
            this.categories.total--;
            const perPage = Math.ceil(this.categories.total / 5);
            if (perPage < (this.categories.links.length - 2)) {
                this.categories.links.splice(this.categories.links.length - 2, 1);
            }
            if (this.categories.current_page) {
                if (this.categories.data.length === 0){
                    const pages = this.categories.current_page - 1;
                    this.getCategories('/get-categories?page=' + pages);
                }
            }
            this.openDeleteCategoryModal = false;
        },

        deleteCategoryModal(id) {
            this.openDeleteCategoryModal = true;
            this.selectedCategoryId = id;
        },

        deleteProduct(products) {
            this.products.data.forEach((item, index) => {
                if (item.id === this.selectedProductId) {
                    this.products.data.splice(index, 1);
                }
            });
            if (this.products.data.length === 4) {
                if (products)
                    this.products.data.push(products);
            }
            this.products.total--;
            const perPage = Math.ceil(this.products.total / 5);
            if (perPage < (this.products.links.length - 2)) {
                this.products.links.splice(this.products.links.length - 2, 1);
            }
            if (this.products.current_page) {
                if (this.products.data.length === 0){
                    const pages = this.products.current_page - 1;
                    this.getProducts('/get-products?page=' + pages);
                }
            }
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



