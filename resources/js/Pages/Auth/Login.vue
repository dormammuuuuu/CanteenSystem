<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <template #auth-socialite>
            <p class="mb-2">Sign in with</p>
            <div class="grid grid-cols-3 gap-2 space-x-4">
                <Link :href="route('login')" class="border-gray-400 rounded-lg border-solid border-2 flex justify-center items-center py-2"><box-icon type='logo' color="gray" name='google'></box-icon></Link>
                <Link :href="route('login')" class="border-gray-400 rounded-lg border-solid border-2 flex justify-center items-center py-2"><box-icon type='logo' color="gray" name='twitter'></box-icon></Link>
                <a href="/auth/facebook" class="border-gray-400 rounded-lg border-solid border-2 flex justify-center items-center py-2"><box-icon type='logo' color="gray" name='facebook-circle'></box-icon></a>
            </div> 
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-4 text-gray-400">or</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div> 
        </template>

        <template #name>Sign in to your account</template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex flex-row justify-between my-6">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm font-bold text-orange-500 hover:text-orange-700">
                    Forgot your password?
                </Link>
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="w-full h-10 bg-orange-500 hover:bg-orange-700 flex justify-center mb-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Sign in
                </PrimaryButton>
            </div>
            <div class="text-center">
                <Link :href="route('register')" class="text-sm">
                    Don't have an account? <span class="text-orange-500 hover:text-orange-700">Register</span>
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
