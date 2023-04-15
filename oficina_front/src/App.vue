
<template>

  <div class="w-full h-full bg-gray-200">
            <div class="flex flex-no-wrap">
                <SideBar/>
                <div class="w-full">
                    <nav class="relative z-10 flex items-center justify-end h-16 bg-white shadow lg:items-stretch lg:justify-between">
                        <div class="hidden w-full pr-6 lg:flex">
                            <div class="items-center justify-center hidden w-1/2 h-full mx-auto lg:flex">
                                <div class="relative text-center  text-xl">
                                    Tabela de Orçamento
                                </div>
                            </div>

                        </div>

                        <button aria-label="Main Menu" class="relative visible mr-8 text-gray-600 lg:hidden focus:outline-none focus:ring-2 focus:ring-gray-600 " onclick="sidebarHandler(true)" id="menu">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_header_and_icons-svg7.svg" alt="toggler">
                        </button>
                    </nav>
                    <div class="container p-10 mx-auto ">
                        <div class="w-full h-full">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>


        </div>

</template>

<script setup>
import SideBar from "@/components/includes/SideBar.vue";
</script>

