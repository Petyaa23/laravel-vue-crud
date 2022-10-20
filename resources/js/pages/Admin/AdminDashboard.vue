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
                            <tr v-for="product in productsList.data">
                                <td class="border px-4 py-2">{{product.category.name}}</td>
                                <td class="border px-4 py-2">{{ product.name }}</td>
                                <td class="border px-4 py-2">{{ product.price }}</td>
                                <td class="border px-4 py-2">{{ product.status }}</td>
                                <td class="border px-4 py-2">{{ product.created_at }}</td>
                                <td>
                                    <button
                                        v-if="product.status === 'inactive' || product.status === 'pending'"
                                        class="px-3 py-2 bg-black text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-gray-400 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-black active:shadow-lg transition duration-150 ease-in-out"
                                        @click="updateProductStatus(product, 'active')"
                                        >
                                        Active
                                    </button>

                                    <button
                                        v-if="product.status === 'active' || product.status === 'pending'"
                                        class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                                        @click="updateProductStatus(product, 'inactive')"
                                    >
                                        Inactive
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="productsList.links.length > 3">
                            <div class="flex flex-wrap mt-8">
                                <template v-for="(link, key) in productsList.links" :key="key">
                                    <div
                                        v-if="link.url === null"
                                        class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                        v-html="link.label"
                                    />
                                    <a
                                        v-else
                                        class="text-white mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded hover:bg-black focus:border-primary focus:text-primary text-decoration-none bg-gray-400"
                                        :class="{ 'bg-gray-600 text-white': link.active }"
                                        :href="link.url"
                                        v-html="link.label"
                                    ></a>
                                </template>
                            </div>
                        </div>
                        <ChangeStatus
                            v-if="openChangeStatusModal"
                            @changeProductStatus="changeProductStatus"
                            :status = 'changeStatus'
                            :changeProductId = 'changeProduct.id'
                            @close="openChangeStatusModal = false">
                        </ChangeStatus>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChangeStatus from "./ChangeStatus.vue";

export default {
    name: "AdminDashboard.vue",
    props: [
        'products'
    ],
    components: {
        ChangeStatus
    },

    data() {
        return {
            openChangeStatusModal:false,
            productsList: [],
            changeProduct: {},
            changeStatus: '',
        }
    },
    methods: {
        updateProductStatus(product,status) {
            this.changeProduct = product;
            this.changeStatus = status;
            this.openChangeStatusModal = !this.openChangeStatusModal
        },
        changeProductStatus() {
            this.changeProduct.status = this.changeStatus
            this.openChangeStatusModal = false
        }
    },

    created() {
        this.productsList = this.products
    }
}

</script>

<style scoped>

</style>

