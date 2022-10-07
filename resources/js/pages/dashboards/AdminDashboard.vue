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
                            <tr v-for="product in productsList">
                                <td class="py-3 px-6">{{ product.category.name }}</td>
                                <td class="py-3 px-6">{{ product.name }}</td>
                                <td class="py-3 px-6">{{ product.price }}</td>
                                <td class="py-3 px-6">{{ product.status }}</td>
                                <td class="py-3 px-6">{{ product.created_at }}</td>
                                <td>
                                    <button
                                        v-if="product.status === 'inactive' || product.status === 'pending'"
                                        class="btn btn-success btn-sm"
                                        @click="changeStatus(product, 'active')"
                                    >
                                        Active
                                    </button>
                                    <button
                                        v-if="product.status === 'active' || product.status === 'pending'"
                                        class="btn btn-danger btn-sm"
                                        @click="changeStatus(product, 'inactive')"
                                    >
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
    name: "AdminDashboard",
    props: [
        'products'
    ],
    data() {
        return {
            productsList: []
        }
    },
    methods: {
        changeStatus(product, status) {
            const data = {
                id: product.id,
                status: status
            }
            axios.post('admin/change-status', data)
                .then(res => {
                    product.status = status;
                })
                .catch(
                    error => {
                        console.log('500 Internal Server Error');
                    })
        }
    },
    created() {
        this.productsList = this.products

    }

}

</script>

<style scoped>

</style>

