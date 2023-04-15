<template>
    <div class="px-4 ">
        <div class="container mx-auto">
            <div class="w-full ">
                <div class="px-4 py-4 bg-gray-100 rounded-tl-lg rounded-tr-lg md:px-10 md:py-7">
                    <div class="items-center justify-between flex space-x-1">
                        <p class="text-base font-bold leading-normal text-gray-800 sm:text-lg md:text-xl ">
                            Orçamento
                        </p>

                        <div class="items-center mt-6 md:flex lg:mt-0">

                            <div class="flex items-center">
                                <div class="relative">
                                    <input v-model="start_dateSearch"
                                           type="date"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                                </div>
                                <span class="mx-4 text-gray-500"> - </span>
                                <div class="relative">
                                    <input v-model="end_dateSearch"
                                           type="date"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                                </div>
                            </div>
                            <div class="items-center mt-6 md:flex lg:mt-0">
                                <div class="flex items-center mt-4 md:mt-0 md:ml-3 lg:ml-0">
                                    <div  @click="search"
                                            class="cursor-pointer inline-flex ml-1.5 items-start justify-start px-6 py-3 bg-green-700 hover:bg-green-600 focus:outline-none rounded">
                                        <p class="text-xs font-medium leading-none text-white">Filtrar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center w-64 pl-3 bg-white border border-gray-200 rounded">
                                <svg class="text-gray-500" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M8.33333 13.1667C11.555 13.1667 14.1667 10.555 14.1667 7.33333C14.1667 4.11167 11.555 1.5 8.33333 1.5C5.11167 1.5 2.5 4.11167 2.5 7.33333C2.5 10.555 5.11167 13.1667 8.33333 13.1667Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.5 17.5L12.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <input v-model="budgetSearch"
                                       type="text"
                                       class="py-2.5 pl-1 w-full focus:outline-none text-sm rounded text-gray-600 placeholder-gray-500"
                                       placeholder="Pesquisar" />
                            </div>
                            <div @click="search"
                                 class=" inline-flex items-center px-3 py-2 text-white bg-green-500 rounded-r cursor-pointer hover:bg-green-600 ">
                                pesquisar
                            </div>
                        </div>

                    </div>
                </div>
                <div class="px-4 overflow-x-auto bg-white shadow py-7 md:px-8 xl:px-10 2xl:overflow-x-hidden">
                    <table   class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="w-full h-20 text-sm leading-none text-gray-600">
                                <th class="pl-4 italic font-bold text-left">#</th>
                                <th class="italic font-bold text-left pl-11">Cliente</th>
                                <th class="pl-10 italic font-bold text-left">Vendedor</th>
                                <th class="italic font-bold text-left">Criado em</th>
                                <th class="italic font-bold text-left">Valor</th>
                                <th class="italic font-bold text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="w-full">
                            <tr v-for="(budget, i) in budgets['budgets']['data']" :key="budget.id"
                            class="h-20 text-sm leading-none text-gray-700 bg-white border-t border-b border-gray-200 hover:bg-gray-100">
                                <td class="pl-4">{{ ++i }}</td>
                                <td class="pl-11">
                                    <div class="flex items-center">
                                        {{ budget.client }}
                                    </div>
                                </td>
                                <td>
                                    <p class="pl-10 mr-16">{{ budget.seller }}</p>
                                </td>
                                <td>
                                    <p class="mr-16">{{ budget.created_day }}</p>
                                </td>
                                <td>
                                    <p class="mr-16">{{format(budget.price, 'pt-BR', 'BRL')}}</p>
                                </td>
                                <td class="justify-items-end">
                                    <div class="flex items-center">
                                        <RouterLink :to="{name: 'edit-budget', params: {id: budget.id}}"
                                            class="bg-blue-100 mr-3 hover:bg-blue-200 py-2.5 px-5 rounded text-sm leading-3 text-blue-500">
                                            Editar
                                        </RouterLink>
                                        <button
                                            @click="destroyBudget(budget.id)"
                                            class="bg-red-100 mr-3 hover:bg-red-200 py-2.5 px-5 rounded text-sm leading-3 text-red-500">
                                            Deletar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
<!--                    /<p v-else class="text-center">AInda não temos Orçamentos Cadastrados</p>-->
                    <TailwindPagination class="bg-green-400 border-0 mt-3"
                                        :limit="-1"
                                        :show-disabled="false"
                            :data="budgets['budgets']"
                            @pagination-change-page="handlePage"
                    >
                        <template #prev-nav >
                            <span class="px-2 py-1">&lt; Anterior</span>
                        </template>
                        <template #next-nav >
                            <span class="px-2 py-1">Próximo &gt; </span>
                        </template>

                    </TailwindPagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, reactive, ref} from 'vue';
import useBudget from '../../composables/budgetApi';
import format from "../../service/format";
import _ from 'lodash';
import http from "@/service/http";
import { TailwindPagination } from 'laravel-vue-pagination';

const { budgets ,getAllBudgets, destroyBudget} = useBudget();
const budgetSearch = ref();
const budgetSearchDate = ref();
const searched = ref(true);
const start_dateSearch = ref();
const end_dateSearch = ref();
const url = 'budgets/';
// const budgets = reactive({budgets:[]});

onMounted(() => {budgetsGet()})

// onMounted( async () => {
//     const res = await http.get(url)
//     console.log(res.data.data);
//     budgets['budgets'] = res.data.data;
// });
function budgetsGet(page = 1){
    getAllBudgets(page)
}

function handlePage(page){
    return searched.value ? budgetsGet(page) : searchPage(page)
}
async function searchPage(page=1){
    try {
        const res = await http.get(url+'search?page='+Number(page), {
            params: {
                budget:budgetSearch.value,
                start_date:start_dateSearch.value,
                end_date:end_dateSearch.value,
            }
        })
        if(!budgetSearch.value &&  !start_dateSearch.value && !end_dateSearch.value ){
            searched.value = false;
            budgetsGet();
        }else{
            console.log(res);
            searched.value = true;
            budgets['budgets'] = res.data;
        }
    }catch (error){
        console.log(error.response.data)
    }
    budgetSearch.value = '';
}

const search = _.debounce(async () => {
   searchPage();
});

const searchDate = _.debounce(async () => {
    try {
        const res = await http.get(url+'searchDate', {
            params: {
                start_date:start_dateSearch.value,
                end_date:end_dateSearch.value,
            }
        })
        budgets['budgets'] = res.data.data;
    }catch (error){
        console.log(error.response.data)
    }
    budgetSearch.value = '';
});


</script>