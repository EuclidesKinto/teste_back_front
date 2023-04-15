<template>
    <div class="px-4 ">
        <div class="container mx-auto">
            <div class="w-full ">
                <div class="px-4 py-4 bg-gray-100 rounded-tl-lg rounded-tr-lg md:px-10 md:py-7">
                    <div class="items-center justify-between lg:flex">
                        <p class="text-base font-bold leading-normal text-gray-800 sm:text-lg md:text-xl ">
                            Cadastrar Vendedor
                        </p>
                        <div class="items-center mt-6 md:flex lg:mt-0">

                            <div class="flex items-center mt-4 md:mt-0 md:ml-3 lg:ml-0">

                                <router-link :to="{name: 'home'}" class="inline-flex ml-1.5 items-start justify-start px-6 py-3 bg-green-700 hover:bg-green-600 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">Voltar</p>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <form @submit.prevent="storeSeller(form)"
                    class="px-4 overflow-x-auto bg-white shadow py-7 md:px-8 xl:px-10 2xl:overflow-x-hidden">
                    <div class="grid mt-3 md:grid-cols-1 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="name" class="text-base font-medium leading-none text-gray-800">
                                Nome do Vendedor
                            </label>
                            <input
                                v-model="form.name"
                                id="name"
                                class="w-full p-2 mt-2 border border-gray-300 rounded outline-none focus:bg-gray-50"
                            />
                            <p v-if="errors.name"
                                class="mt-3 text-xs leading-3 text-red-600">
                                {{errors.name[0]}}
                            </p>
                        </div>

                    </div>




                    <hr class="h-[1px] bg-gray-100 my-14" />
                    <div
                        class="flex flex-col flex-wrap items-center justify-center w-full px-7 lg:flex-row lg:justify-end md:justify-end gap-x-4 gap-y-4"
                    >
                        <router-link :to="{name: 'home'}"
                            class="cursor-pointer bg-white border-red-700 rounded hover:bg-gray-50 transform duration-300 ease-in-out text-sm font-medium px-6 py-3 text-red-700 border "
                        >
                            Cancelar
                        </router-link>
                        <button type="submit"
                            class="cursor-pointer bg-indigo-700 rounded hover:bg-indigo-600 transform duration-300 ease-in-out text-sm font-medium px-6 py-3 text-white "
                        >
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import {reactive} from  'vue';
import useBudget  from '../../composables/sellerApi.js'

const {storeSeller, errors} = useBudget();

const form = reactive({
    name: ""
});
</script>
