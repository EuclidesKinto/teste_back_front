import {reactive, ref} from 'vue';
import {useRouter} from 'vue-router';
import http from '@/service/http.js';

export default function useBudget(){
    const url = 'sellers/';
    const sellers= ref([]);
    const seller= ref({});
    const errors = ref({
        name: null
    });
    const router = useRouter();

    const getAllSellers = async () => {
        const res = await http.get(url)
        console.log(res.data.data);
        sellers.value = res.data.data;
    }

    const getSeller = async (id) => {
        const res = await http.get(url+id)
        console.log(res.data.data);
        seller.value = res.data.data;
    }

    const storeSeller = async (data) =>{
        try {
            await http.post(url, data);
            await router.push({name: "index-seller"});
        } catch (error) {
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    }

    const updateSeller = async (id) =>{
        try {
            await http.put(url+id, seller.value);
            await router.push({name: "index-seller"});
        } catch (err) {
            if(err.response.status === 422){
                errors.value = err.response.data.errors;
            }
        }
    }

    const destroySeller = async (id) =>{
        if(!window.confirm("Deletar esse vendedor?")){
            return
        }
        await http.delete(url+id);
        await getAllSellers();

    }


    return {
        sellers,
        seller,
        errors,
        getAllSellers,
        getSeller,
        storeSeller,
        updateSeller,
        destroySeller
    }
}