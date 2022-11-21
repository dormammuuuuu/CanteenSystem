<script setup>
    import Button from '@/Components/Button.vue';
    import 'boxicons';

    defineProps({
        item: {
            type: Object,
            required: true
        },
        thumb: {
            type: String,
            required: true
        }
    });
</script>

<template>    
    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
        <a href="#" class="relative">
            <img class="max-h-56 w-full object-cover rounded-t-lg" :src="thumb" alt="">
            <p class="absolute bottom-3 rounded-3xl right-3 text-white bg-orange-500 py-1 text-xs px-2">₱ {{item.price}}</p>
        </a>
        <div class="h-fit">
            <div class="flex justify-between px-4 pt-4 content-center">
                <a href="#">
                    <h5 class="mb-1 text-lg font-bold tracking-tight text-gray-900">{{item.name}}</h5>
                </a>
                <div>
                    <Button class="fill-green-500 hover:fill-white w-7 h-7"><box-icon name='edit-alt'></box-icon></Button>
                    <Button class="fill-red-500 hover:fill-white w-7 h-7"><box-icon name='trash-alt'></box-icon></Button>
                </div>
            </div>
            <div class="overflow-hidden h-20 p-4 pt-2">    
                <p class="font-normal text-sm text-gray-700 text-ellipsis line-clamp-3 overflow-hidden">{{item.description}}</p>
            </div>
        </div>
    </div>
</template>