<script setup>
    import 'boxicons';
</script>

<template>
    <div class="w-full bg-red-500">
        <div class="min-h-screen flex flex-col sm:pt-0 ">
            <div class="w-full h-screen sm:max-w-xl p-14 bg-white shadow-md overflow-hidden">
                <div class="mb-10">
                    <slot name="logo" />
                    <h1 class="text-3xl font-bold"><slot name="name"/></h1>
                </div>
                <div>
                    <slot name="auth-socialite" />
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
