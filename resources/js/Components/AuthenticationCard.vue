<script setup>
    import 'boxicons';
</script>

<template>
    <div class="w-full flex">
        <div class="min-h-screen flex flex-col sm:pt-0 max-w-xl w-full">
            <div class="h-screen bg-white p-8 px-14 shadow-md overflow-hidden overflow-y-auto">
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
        <div class="bg-[url('/img/canteen5.png')] bg-cover bg-no-repeat bg-center flex-grow"></div>
    </div>
</template>
