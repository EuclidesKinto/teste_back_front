import {reactive, ref} from 'vue';
import {createWebHashHistory, useRouter} from 'vue-router';
import http from '@/service/http.js';
import _ from 'lodash';

export default function useBudget(){
    const url = 'budgets/';
    const budgets = reactive({budgets:[]});
    const budget= ref([]);
    const errors = ref({
        client: null,
        price: null,
        description: null,
        seller_id: null
    });
    const budgetSearch = ref();
    const router = useRouter();

    const getAllBudgets = async (page) => {
        const res = await http.get(url+'?page='+Number(page))
        console.log(res.data);
        budgets['budgets'] = res.data;
    }

    const getBudget = async (id) => {
        const res = await http.get(url+id)

        budget.value = res.data.data;
    }

    const storeBudget = async (data) =>{
        try {
            await http.post(url, data);
            await router.push({name: "home"});
        } catch (error) {
            if(error.response.status === 422){
                // console.log(error.response.data.errors)
                errors.value = error.response.data.errors;
            }
        }
    }

    const updateBudget = async (id) =>{
        try {
            await http.put(url+id, budget.value);
            await router.push({name: "home"});
        } catch (error) {
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    }

    const destroyBudget = async (id) =>{
        if(!window.confirm("Deletar esse orçamento?")){
            return
        }
        await http.delete(url+id);
        await getAllBudgets();

    }

    return {
        budgets,
        budget,
        errors,
        getAllBudgets,
        getBudget,
        storeBudget,
        updateBudget,
        destroyBudget
    }
}