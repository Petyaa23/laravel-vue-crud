<template>
    <AddProducts></AddProducts>
    <div class="container">
        <h2 class="text-center">Products List</h2>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-sm float-right mb-2 " type="button" v-on:click="toggleModal()">Add Product</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                    <tr v-for="(product, key) in products">
                        <td>{{ product.name }}</td>
                        <td>Category</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.status }}</td>
                        <td>{{ product.created_at }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" :to="{ name: 'ProductEdit', params: { productId: product.id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--modal-open-->
    <div>
        <div v-if="showModal">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h4 class="text-5xl font-semibold">
                            Add new Products
                        </h4>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                                v-on:click="toggleModal()">
      <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
        ×
      </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div>
                            <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name" v-model="product.name" >
                            <input type="text" id="discription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" placeholder="Description" v-model="product.price" >
                        </div>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500  active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
                            Close
                        </button>
                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="saveProducts() ">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
    <!--modal-close-->

    <div class="container">
        <h2 class="text-center">Category</h2>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-sm float-right mb-2 " type="button" v-on:click="toggleModale()">Add Category</button>
            </div>
        </div>
        <div class="row">
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
                    <tr v-for="(category, key) in category">
                        <td>{{ category.name }}</td>
                        <td>{{ category.description}}</td>
                        <td>{{ category.status }}</td>
                        <td>{{ category.created_at }}</td>

                        <td>
                            <button class="btn btn-success btn-sm" :to="{ name: 'ProductEdit', params: { category: category.id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Delete</button>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <div v-if="showModale">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h4 class="text-5xl font-semibold">
                            Add new Products
                        </h4>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                                v-on:click="toggleModale()">
      <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
        ×
      </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div>
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Category name" v-model="category.name" >
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" placeholder="Category description" v-model="category.description" >
                        </div>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500  active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModale()">
                            Close
                        </button>
                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="saveCategories() ">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModale" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
    <!--modal-close-->
</template>


<script>
import products from "./AddProducts.vue";
export default {
    name: "UserDashboard",
            components: {
                AddProducts:products,
            },
    data() {
        return {
            showModal: false,
            showModale: false,
            product: {
                name:'',
                price:'',
            },
            category: {
                name: '',
                description: ''
            }

        }
    },
    props:[
        "products",
        "category"
    ],

    methods: {
        toggleModal: function(){
            this.showModal = !this.showModal;
        },
        toggleModale: function(){
            this.showModale = !this.showModale;
        },
        saveProducts: function(){
            axios.post('/add-products',this.product).then(res => {
                this.product = res.data;
                console.log(this.product.name)
            }).catch(error=>{
                console.log(error)
            })
        },
        saveCategories: function(){
            axios.post('/add-categories',this.category).then(res => {
                this.category = res.data;
                console.log(this.category.name)
            }).catch(error=>{
                console.log(error)
            })
        },

        deleteProduct: function(productId){
            axios.post('/delete-products' + productId).then()
            }
        },

        deleteCategory: function(categoryId){
            axios.post('/delete-category' + categoryId).then()
         }



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

