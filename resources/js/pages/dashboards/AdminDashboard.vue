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

                                    <button type="button" @click="changeStatus()"
                                            data-bs-dismiss="modal"
                                            class="px-3 py-2.5 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out">
                                        Active
                                    </button>

                                    <button type="button" class="mx-2 px-3 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                            data-bs-toggle="modalDeleteProduct" data-bs-target="#deleteProduct"
                                            @click="">
                                        Inactive
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

</template>

<script>


export default {
    name: "AdminDashboard.vue",
    props: [
        'products'
    ],

    data() {
        return {
            product: {
                'id': '',
                'status': '',
            },
            selectedProduct:{},


        }
    },
    methods: {
        editProduct(product) {
            this.selectedProduct.id = product.id;
            this.selectedProduct.name = product.name;
            this.selectedProduct.status = product.status;
            this.selectedProduct.price = product.price;
        },

        changeStatus() {
            console.log()
            axios.post('/admin/change-status', this.selectedProduct)
                .then(res => {
                        if (res.data.post) {
                            this.$emit('editProduct', res.data.selectedProduct)
                }
                })
                .catch(
                    error => {
                        console.log('500 Internal Server Error');
                    })

        },

    },
}






</script>

<style scoped>

</style>

