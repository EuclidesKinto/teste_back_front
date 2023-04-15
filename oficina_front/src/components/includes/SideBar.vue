<template>
    <div  style="min-height: 700px"
          class="absolute hidden w-64 h-screen bg-gray-100 shadow lg:relative lg:block">
        <div class="flex items-center justify-center w-full h-16 px-8 text-xl font-bold border-b hover:bg-gray-50">
            Oficina 2.0
        </div>
        <ul class="py-6">
            <Li v-for="item in linkItem"
                :key="item.link"
                :link="item.link"
                :title="item.title"
            />
        </ul>
    </div>
</template>

<script setup>
import Li from '@/components/common/Li.vue'
import {reactive} from "vue";

const linkItem = reactive([
    {title: "Home", link: "home"},
    {title: "Adicionar Orçamento", link: "create-budget"},
    {title: "Vendedores", link: "index-seller"},
    {title: "Adicionar Vendedor", link: "create-seller"},
])
</script>
