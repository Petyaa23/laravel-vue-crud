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
                                <td class="border px-4 py-2" v-if="product.category">{{product.category.name}}</td>
                                <td class="border px-4 py-2" v-else></td>
                                <td class="border px-4 py-2">{{ product.name }}</td>
                                <td class="border px-4 py-2">{{ product.price }}</td>
                                <td class="border px-4 py-2">{{ product.status }}</td>
                                <td class="border px-4 py-2">{{ product.created_at }}</td>
                                <td>
                                    <button
                                        v-if="product.status === 'inactive' || product.status === 'pending'"
                                        class="px-3 py-2 bg-black text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-gray-400 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-black active:shadow-lg transition duration-150 ease-in-out"
                                        @click="changeStatus(product, 'active')"
                                        >
                                        Active
                                    </button>

                                    <button
                                        v-if="product.status === 'active' || product.status === 'pending'"
                                        class="px-3 py-2 bg-gray-400 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-black hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
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
<!--    open-modal-Active-->
<!--    <div id="activeAndInactive" v-if="showModal"-->
<!--         class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">-->
<!--        <div class="absolute bg-black opacity-80 inset-0 z-0"></div>-->
<!--        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">-->
<!--            <div class="">-->
<!--                <div class="text-center p-5 flex-auto justify-center">-->
<!--                    <h3 class="text-xl font-bold py-4 ">Are you sure to active this Product?</h3>-->
<!--                </div>-->
<!--                &lt;!&ndash;footer&ndash;&gt;-->
<!--                <div class="p-3  mt-2 text-center space-x-4 md:block">-->
<!--                    <button-->
<!--                        class="mb-2 md:mb-0 bg-gray-100 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-gray rounded-full hover:shadow-lg hover:bg-gray-600"-->
<!--                        type="button" @click="$emit('close')">-->
<!--                        Cancel-->
<!--                    </button>-->
<!--                    <button-->
<!--                        class="mb-2 md:mb-0 bg-gray-100 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-gray rounded-full hover:shadow-lg hover:bg-gray-600"-->
<!--                        type="button" @click="changeStatus()">-->
<!--                        Active-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>-->



</template>

<script>
export default {
    name: "AdminDashboard",
    props: [
        'products'
    ],
    data() {
        return {
            productsList: [],
            showModal: false,
        }
    },
    methods: {
        toggleModal () {
            this.showModal = !this.showModal;
        },
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

