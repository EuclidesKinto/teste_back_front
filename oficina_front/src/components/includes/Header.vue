<template>
    <div class="flex items-center w-full py-5 bg-green-700">
        <div class="container flex justify-start mx-auto ">
            <router-link
                    :to="{name:'home'}"
                    class="w-56 text-2xl font-extrabold text-white hover:underline">
                Oficina 2.0
            </router-link>
            <div class="flex items-center justify-start w-full space-x-5 text-white border-l">
                <router-link
                        v-for="item in linkItem" :key="item.to"
                        :to="item.to"
                        class="pl-5 text-lg hover:underline hover:text-yellow-200">
                    {{item.title}}
                </router-link>
            </div>
        </div>

    </div>
</template>

<script setup>
import {reactive} from "vue";

const linkItem = reactive([
    {title: "Home", to: "/"},
])
</script>