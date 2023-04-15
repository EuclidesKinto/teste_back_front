<template>
    <router-link :to="{name: props.link}">
        <li class="py-2 pl-6 mt-4 mb-4 text-sm leading-3 tracking-normal text-gray-600 cursor-pointer hover:text-green-600">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="4" y="4" width="6" height="6" rx="1" />
                        <rect x="14" y="4" width="6" height="6" rx="1" />
                        <rect x="4" y="14" width="6" height="6" rx="1" />
                        <rect x="14" y="14" width="6" height="6" rx="1" />
                    </svg>
                <div class="ml-2">{{ props.title }}</div>
            </div>
        </li>
    </router-link>
</template>

<script setup >
const props = defineProps({
    title: {
        type: String,
        default: 'link'
    },
    link: {
        type: String,
        default: 'home'
    }
})


</script>