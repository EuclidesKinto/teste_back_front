<template>
    <div class="px-4 ">
        <div class="container mx-auto">
            <div class="w-full ">
                <div class="px-4 py-4 bg-gray-100 rounded-tl-lg rounded-tr-lg md:px-10 md:py-7">
                    <div class="items-center justify-between lg:flex">
                        <p class="text-base font-bold leading-normal text-gray-800 sm:text-lg md:text-xl ">
                            Vendedores
                        </p>
                        <div class="items-center mt-6 md:flex lg:mt-0">
                            <div class="flex items-center">
                                <div class="flex items-center w-64 pl-3 bg-white border border-gray-200 rounded">
                                    <svg class="text-gray-500" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M8.33333 13.1667C11.555 13.1667 14.1667 10.555 14.1667 7.33333C14.1667 4.11167 11.555 1.5 8.33333 1.5C5.11167 1.5 2.5 4.11167 2.5 7.33333C2.5 10.555 5.11167 13.1667 8.33333 13.1667Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.5 17.5L12.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="text" class="py-2.5 pl-1 w-full focus:outline-none text-sm rounded text-gray-600 placeholder-gray-500" placeholder="Search" />
                                </div>
                            </div>
                            <div class="flex items-center mt-4 md:mt-0 md:ml-3 lg:ml-0">

                                <router-link :to="{name: 'create-seller'}" class="inline-flex ml-1.5 items-start justify-start px-6 py-3 bg-green-700 hover:bg-green-600 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">Add Vendedor</p>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 overflow-x-auto bg-white shadow py-7 md:px-8 xl:px-10 2xl:overflow-x-hidden">
                    <table v-if="sellers.length > 0" class="w-full whitespace-nowrap">
                        <thead>
                        <tr class="w-full h-20 text-sm leading-none text-gray-600">
                            <th class="pl-4 italic font-bold text-left">#</th>
                            <th class="italic font-bold text-left pl-11 ">Nome do Vendedor</th>
                            <th class="italic font-bold text-left">Ação</th>
                        </tr>
                        </thead>
                        <tbody class="w-full">
                        <tr v-for="({id, name}, i) in sellers" :key="id"
                            class="h-20 text-sm leading-none text-gray-700 bg-white border-t border-b border-gray-200 hover:bg-gray-100">
                            <td class="pl-4">{{ ++i }}</td>
                            <td class="pl-11">
                                <div class="flex items-center">
                                    {{ name }}
                                </div>
                            </td>
                            <td class="justify-items-end">
                                <div class="flex items-center">
                                    <RouterLink :to="{name: 'edit-seller', params: {id: id}}"
                                                class="bg-blue-100 mr-3 hover:bg-blue-200 py-2.5 px-5 rounded text-sm leading-3 text-blue-500">
                                        Editar
                                    </RouterLink>
                                    <button
                                        @click="destroySeller(id)"
                                        class="bg-red-100 mr-3 hover:bg-red-200 py-2.5 px-5 rounded text-sm leading-3 text-red-500">
                                        Deletar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-else class="text-center">AInda não temos Vendedores Cadastrados</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import useSeller from '../../composables/sellerApi';

const { sellers, getAllSellers, destroySeller} = useSeller();

onMounted(getAllSellers);
</script>
