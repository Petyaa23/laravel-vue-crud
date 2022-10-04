<template>
    <AddProducts
        :categories="categories">
    </AddProducts>

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
                                <td class="border px-4 py-2">{{ product.category.name }}</td>
                                <td class="border px-4 py-2">{{ product.price }}</td>
                                <td class="border px-4 py-2">{{ product.status }}</td>
                                <td class="border px-4 py-2">{{ product.created_at }}</td>
                                <td class="px-4 py-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <button class="btn btn-success btn-sm" type="submit"
                                            @click=editProduct(product)> Edit</button>

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
                            <tr v-for="category in categories">
                                <td class="border px-4 py-2">{{ category.name }}</td>
                                <td class="border px-4 py-2">{{ category.description }}</td>
                                <td class="border px-4 py-2">{{ category.status }}</td>
                                <td class="border px-4 py-2">{{ category.created_at }}</td>
                                <td class="px-4 py-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <button type="button" @click="editCategory(category)"
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
    <!--    open-modal-product-->
    <div v-if="showModal"
         class="w-7/12 m-auto overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div
                    class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Edit the product
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                        @click="toggleModal()">
      <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
        ×
      </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <div>
                        <input type="text" id="name"
                               class="bg-gray-50
                                        border border-gray-300
                                        text-gray-900
                                        text-sm rounded-lg
                                        focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600
                                        dark:placeholder-gray-400 dark:text-white
                                        dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Name" v-model="selectedProduct.name">
                        <input type="text"
                               class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                       focus:border-blue-500 block w-full p-2.5
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"
                               placeholder="Price" v-model="selectedProduct.price">

                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                    <button
                        class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="changeProduct()">
                        Edit
                    </button>
                    <button
                        class="text-green-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="toggleModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
<!--    close-modal-product-->

    <!--    open-modal-category-->
    <div v-if="showModal"
         class="w-7/12 m-auto overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div
                    class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Edit the Category
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                        @click="toggleModal()">
      <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
        ×
      </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <div>
                        <input type="text" id="name"
                               class="bg-gray-50
                                        border border-gray-300
                                        text-gray-900
                                        text-sm rounded-lg
                                        focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600
                                        dark:placeholder-gray-400 dark:text-white
                                        dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Name" v-model="selectedCategory.name">
                        <input type="text"
                               class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                       focus:border-blue-500 block w-full p-2.5
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"
                               placeholder="Price" v-model="selectedCategory.description">

                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                    <button
                        class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="changeCategory()">
                        Edit
                    </button>
                    <button
                        class="text-green-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="toggleModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    <!--    close-modal-category-->
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
            showModal: false,
            selectedProduct: {},
            selectedCategory: {},
            selectedProductId: null,
            selectedCategoryId: null,
            openDeleteProductModal: false,
            openDeleteCategoryModal: false,
            changesProduct:{},
            changesCategory:{},
        }
    },

    methods: {
        toggleModal: function () {
            this.showModal = !this.showModal;
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
            this.selectedProduct.id = product.id;
            this.selectedProduct.name = product.name;
            this.selectedProduct.price = product.price;
            this.changesProduct = product;
            this.toggleModal();
        },

        editCategory(category) {
            this.selectedCategory.id = category.id;
            this.selectedCategory.name = category.name;
            this.selectedCategory.description = category.description;
            this.changesCategory = category;
            this.toggleModal();
        },


        changeProduct(product) {
            axios.post('/update-product', this.selectedProduct)
                .then(res => {
                    if (res.data.post) {
                        this.changesProduct.name = this.selectedProduct.name;
                        this.changesProduct.price = this.selectedProduct.price;
                    }
                    this.toggleModal();
                    })
        },
        changeCategory(category) {
            axios.post('/update-category', this.selectedCategory)
                .then(res => {
                    if (res.data.post) {
                        this.changesCategory.name = this.selectedCategory.name;
                        this.changesCategory.id = this.selectedCategory.id;
                        this.changesCategory.description = this.selectedCategory.description;
                    }
                    this.toggleModal();
                    })
        },
    },
    created() {
        console.log(this.products)
    }
}















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


    // updatePost() {
    //     this.axios
    //         .post(`/update/${this.$route.params.id}`, this.post)
    //         .then((response) => {
    //             this.$router.push({name: 'home'});
    //         });
    // }




</script>

<style scoped>

</style>

