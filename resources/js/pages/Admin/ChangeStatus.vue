<template>
    <div id="activeAndInactive"
         class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div class="">
                <div class="text-center p-5 flex-auto justify-center">
                    <h3 class="text-xl font-bold py-4 ">Are you sure to {{ status }} this Product?</h3>
                </div>
                <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button
                        class="mb-2 md:mb-0 bg-gray-100 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-gray rounded-full hover:shadow-lg hover:bg-gray-600"
                        type="button" @click="$emit('close')">
                        Cancel
                    </button>
                    <button
                        class="mb-2 md:mb-0 bg-gray-100 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-gray rounded-full hover:shadow-lg hover:bg-gray-600"
                        type="button" @click="changeProductStatus">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChangeStatus.vue",
    data() {
        return {
            openChangeStatusModal: false,
            productsList: [],
            product: []
        };
    },
    props: [
        'status',
        'changeStatusId'
    ],

    methods: {

        changeProductStatus(status) {
            axios.post('admin/change-status', {
                id: this.changeStatusId,
                status: this.status
            })
                .then(res => {
                    this.$emit('changeProductStatus')
                })
                .catch(
                    error => {
                        console.log('500 Internal Server Error');
                    })
        }
    },
}
</script>

<style scoped>

</style>
