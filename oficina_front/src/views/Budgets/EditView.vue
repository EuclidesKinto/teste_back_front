<template>
    <div class="px-4 ">
        <div class="container mx-auto">
            <div class="w-full ">
                <div class="px-4 py-4 bg-gray-100 rounded-tl-lg rounded-tr-lg md:px-10 md:py-7">
                    <div class="items-center justify-between lg:flex">
                        <p class="text-base font-bold leading-normal text-gray-800 sm:text-lg md:text-xl ">
                            Editar Orçamento
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
                <form @submit.prevent="updateBudget($route.params.id)"
                    class="px-4 overflow-x-auto bg-white shadow py-7 md:px-8 xl:px-10 2xl:overflow-x-hidden">
                    <div class="grid mt-3 md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="client" class="text-base font-medium leading-none text-gray-800">
                                Cliente
                            </label>
                            <input
                                v-model="budget.client"
                                id="client"
                                class="w-full p-2 mt-2 border border-gray-300 rounded outline-none focus:bg-gray-50"
                            />
                            <p v-if="errors.client"
                                class="mt-3 text-xs leading-3 text-red-600">
                                {{errors.client[0]}}
                            </p>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="price" class="text-base font-medium leading-none text-gray-800">
                                Preço
                            </label>
                            <CurrencyInput v-model="budget.price" :options="{ currency: 'BRL'}"
                                           id="price"
                            :value="budget.price"/>

                            <p v-if="errors.price"
                               class="mt-3 text-xs leading-3 text-red-600">
                                {{errors.price[0]}}
                            </p>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-1 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="description" class="text-base font-medium leading-none text-gray-800">
                                Descrição
                            </label>
                            <textarea
                                v-model="budget.description"
                                id="description"
                                class="mt-2 border border-gray-300 rounded focus:bg-gray-50 resize-none w-full h-[100px] px-4 py-4 text-base outline-none text-slate-600"
                                placeholder="Pequena Descrição..."
                            ></textarea>
                            <p v-if="errors.description"
                               class="mt-3 text-xs leading-3 text-red-600">
                                {{errors.description[0]}}
                            </p>
                        </div>
                    </div>


                    <div class="grid md:grid-cols-1 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="seller" class="text-base font-medium leading-none text-gray-800">
                                Vendendor
                            </label>
                            <select v-model="budget.seller_id"
                                    class="w-full p-2 mt-2 border border-gray-300 rounded outline-none focus:bg-gray-50">
                                <option :value="budget.seller">{{budget.seller}}</option>
                                <option v-for="({id, name}, i) in sellers" :key="id" :value="id">{{name}}</option>
                            </select>
                            <p v-if="errors.seller_id"
                               class="mt-3 text-xs leading-3 text-red-600">
                                {{errors.seller_id[0]}}
                            </p>
                        </div>
                    </div>
                    <hr class="h-[1px] bg-gray-100 my-14" />
                    <div
                        class="flex flex-col flex-wrap items-center justify-center w-full px-7 lg:flex-row lg:justify-end md:justify-end gap-x-4 gap-y-4"
                    >
                        <router-link :to="{name: 'home'}"
                            class="px-6 py-3 text-sm font-medium text-red-700 duration-300 ease-in-out transform bg-white border border-red-700 rounded cursor-pointer hover:bg-gray-50 "
                        >
                            Cancelar
                        </router-link>
                        <button type="submit"
                            class="px-6 py-3 text-sm font-medium text-white duration-300 ease-in-out transform bg-indigo-700 rounded cursor-pointer hover:bg-indigo-600 "
                        >
                            Editar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script setup >
import {onMounted} from 'vue';
import useBudget  from '../../composables/budgetApi.js'
import useSeller  from '../../composables/sellerApi.js'
import CurrencyInput from "@/components/common/CurrencyInput.vue";

const {updateBudget, errors, budget, getBudget} = useBudget();
const {sellers, getAllSellers} = useSeller();
const props = defineProps({
    id: {
        required:true,
        type: String
    }
});
onMounted(() => getBudget(props.id));
onMounted(getAllSellers)


</script>
