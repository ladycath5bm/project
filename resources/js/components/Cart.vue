<script setup>
    defineProps(['msg'])
</script>

<template>
    <div>
        <span class="bg-white rounded-full  px-1 font-size-10 text-justify text-gray-400 hover:text-orange-500 font-bold">
        {{ msg }}
        </span> 
    </div>
</template>
