<template>
    <div class="container">
        <h2 class="text-center">Products List</h2>
        <div class="row">
            <div class="col-md-12">
                <button :to="{ name: 'ProductCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add Product</button>
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

    <div class="container">
        <h2 class="text-center">Category</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add Category</router-link>
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
                            <button class="btn btn-danger btn-sm" @click="deleteProduct(category.id)">Delete</button>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
// export default {
//
// }
export default {
    name: "UserDashboard",
    data() {
        return {
            // products: {
            //
            // }
        }
    },
    props:[
        "products",
        "category"
    ],

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
//         deleteProduct(productId) {
//             this.axios
//                 .delete(`http://127.0.0.1:8000/api/products/${productId}`)
//                 .then(response => {
//                     let i = this.products.map(data => data.id).indexOf(productId);
//                     this.products.splice(i, 1)
//                 });
//         }
//     }
 }
</script>

<style scoped>

</style>

