<template>
    <div
        class="bg-gray-100 h-full w-full animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog relative w-25 pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800"
                        id="exampleModalLabel">
                        Add categories
                    </h5>
                    <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            @click="$emit('close')">
                    </button>
                </div>
                <Form :validation-schema="schema" v-slot="{ errors }">
                    <div class="modal-body relative p-4">
                        <label for="name"
                               class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Name
                        </label>
                        <Field placeholder="Name"
                               id="name"
                               type="text"
                               v-model="category.name"
                               name="name"
                               class="mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                               :class="{ 'is-invalid': errors.name }">
                        </Field>
                        <div class="invalid-feedback ">{{ errors.name }}</div>
                        <p class="mb-2 font-semibold text-gray-700">
                            Description
                        </p>
                        <Field type="text"
                               id="description"
                               name="description"
                               v-model="category.description"
                               class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow-sm h-36"
                               placeholder="Category Description..."
                               :class="{ 'is-invalid': errors.description }">
                        </Field>
                        <div class="invalid-feedback ">{{ errors.description }}</div>
                    </div>
                    <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end space-x-4 p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button"
                                class="px-6 py-2 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out"
                                @click="$emit('close')">
                            Close
                        </button>
                        <button type="button" @click=addCategory()
                                class="px-6 py-2 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">
                            Save
                        </button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
import {Form, Field} from 'vee-validate';
import * as yup from "yup";

export default {
    name: "AddCategory.vue",

    components: {
        Form,
        Field,
    },

    data() {
        return {
            category: {
                name: '',
                description: ''
            },
        };
    },
    computed: {
        schema() {
            return yup.object().shape({
                name: yup.string()
                    .min(3, "Name should be less than 3 characters")
                    .max(35, "Name should not exceed 35 characters")
                    .required("Name is required"),
                description: yup.string()
                    .min(3, "Description should be less than 3 characters")
                    .max(1000, "Description should not exceed 1000 characters")
            });
        },
    },

    methods: {
        addCategory() {
            axios.post('/add-categories', this.category)
                .then(res => {
                    this.$emit('categoryAdd', res.data.category);
                })
                .catch(
                    error => {
                        console.log('500 Internal Server Error');
                    });
        },
    },
};

</script>
<style scoped>
</style>
