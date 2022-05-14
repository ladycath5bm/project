
<script setup>
    defineProps(['msg'])
</script>

<template>
    <div>
        <span class="bg-orange-500 rounded-full font-bold px-1 text-xs text-justify text-white">
        {{ msg }}
        </span> 
    </div>
</template>
