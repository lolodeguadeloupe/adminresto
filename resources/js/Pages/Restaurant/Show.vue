<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
    menuList: {
        type: Object,
        required: true,
    },
});

console.log(props.menuList);
console.log(props.restaurant.menu_categories); 

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard 2
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Le Restaurant : {{ props.restaurant.name }}
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 p-6">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">
                                    {{ props.restaurant.name }}
                                </h3>
                                <p class="text-gray-600 mb-2">
                                    <strong>Adresse:</strong>
                                    {{ props.restaurant.address }}
                                </p>
                                <p class="text-gray-600 mb-2">
                                    <strong>Téléphone:</strong>
                                    {{ props.restaurant.phone }}
                                </p>
                                <p class="text-gray-600 mb-4">
                                    <strong>Email:</strong>
                                    {{ props.restaurant.email }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">
                                    Menu
                                </h3>
                                <ul v-for="category in menuList" :key="category.id">
                                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                                        {{ category.name }}
                                    </h2>
                                    <ul>
                                        <li v-for="item in category.items" :key="item.name">
                                            {{ item.name }} - {{ item.price }}
                                            <span v-if="item.available">Available</span>
                                            <span v-else>Not Available</span>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                            
                        </div>

                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">
                                    Statistiques
                                </h3>
                                <p class="text-gray-600 mb-2">
                                    <strong>Commandes:</strong>
                                <ul>
                                    <li v-for="order in props.restaurant.orders" :key="order.id">
                                        <span class="font-semibold mr-6">{{ order.total_amount }} €</span>
                                        <span >{{ order.pickup_time }} </span>
                                    </li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
