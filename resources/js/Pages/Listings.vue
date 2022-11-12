<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import FoodCard from '@/Components/FoodCard.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref, reactive } from 'vue';

    const showModal = ref(false);
    const productName = ref(null);
    const productDescription = ref(null);
    const productPrice = ref(null);

    const form = reactive({
        name: '',
        description: '',
        price: '',
        images: null,
        errors: '',
    });

    const showAddModal = () => {
        showModal.value = true;
    };    

    const closeModal = () => {
        showModal.value = false;
        form.name = '';
        form.description = '';
        form.price = '';
        form.image = null;
        form.errors = '';
    };
</script>

<template>
    <AppLayout title="Listings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listings
            </h2>            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto flex w-full justify-end sm:px-6 lg:px-8">
                <button class="px-4 py-2 cursor-pointer text-black text-sm rounded outline-none hover:bg-gray-300" @click="showAddModal()">
                    + Add Food
                </button>
                <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                </div> -->
            </div>
        </div>

        <div class="max-w-7xl mx-auto grid lg:grid-cols-4 sm:grid-cols-3 justify-center gap-3 sm:px-6 lg:px-8 ">
            <div v-for="listing in componentListings" :key="listing._id">
                <FoodCard :item="listing" :thumb="processThumb(listing)"/>
            </div>
        </div>

        <DialogModal :show="showModal" @close="closeModal">
            <template #title>
                Add Product
            </template>
            <template #content>
                <InputLabel for="product-name" value="Product Name" class="mt-3"/>
                <TextInput id="product-name" v-model="form.name" ref="productName" type="text" class="mt-1 block w-full"/>
                <InputError :message="form.errors.name" class="mt-2" />
                
                <InputLabel for="product-description" value="Product Description" class="mt-3"/>
                <TextInput id="product-description" v-model="form.description" ref="productDescription" type="text" class="mt- block w-full"/>
                <InputError :message="form.errors.description" class="mt-2" />

                <InputLabel for="product-price" value="Product Price" class="mt-3"/>
                <TextInput id="product-price" v-model="form.price" ref="productPrice" type="number" class="mt- block w-full"/>
                <InputError :message="form.errors.price" class="mt-2" />

                <InputLabel value="Product Images" class="mt-3 text-sm"/>
                <UploadMedia :error="error" :server="server" @media="Media"></UploadMedia>
                <InputError :message="form.errors.images" class="mt-2" />

            </template>
            <template #footer>
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton @click="addFood" class="ml-2">Add</PrimaryButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>

<script>
    import {UploadMedia} from "vue-media-upload";
    export default {
        props: {
            listings: Object,
        },
        data(){
            return{
                error:'', //if it is not null it will apply the error styling and show the error message.
                server:'/tmp/images', //the api that will temporary save the image.
                media:[], //the added images
                items: []
            }
        },
        computed: {
            componentListings(){
                return this.items;
            }
        },
        created(){
            this.items = this.listings;
        },
        methods:{
            Media(value){
                this.form.images = value
            },
            processThumb(value){
                let image = JSON.parse(value.image);
                let thumb = "img/upload/" + image[0];
                return thumb;
            },
            async addFood() {
                await axios.post(route('food.store'), {
                    name: this.form.name,
                    description: this.form.description,
                    price: this.form.price,
                    images: this.form.images,
                }).then(() => {
                    this.form.name = '';
                    this.form.description = '';
                    this.form.price = '';
                    this.form.image = null;
                    this.closeModal();
                    this.reloadMenu();                    
                }).catch(error => {
                    console.log(error);
                    this.form.errors = error.response.data.errors;
                });
            },
            async reloadMenu(){
                const response = await axios.get(route('food.read'));
                this.items = response.data;
            },
        },
        components: {
            UploadMedia
        }
    }
</script>