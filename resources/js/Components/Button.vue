<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="hover:text-white inline-flex items-center p-1 rounded-full border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring focus:ring-orange-300 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
