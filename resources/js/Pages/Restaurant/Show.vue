    <script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
});

console.log(props.restaurant);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
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
                                <Link
                                    :href="route('restaurants.show', props.restaurant.id)"
                                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors"
                                >
                                    Voir
                                </Link>
                            </div>
                        </div>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">
                                    Menu
                                </h3>
                                <p class="text-gray-600 mb-2">
                                    <strong>Catégories:</strong>
                                    <ul>
                                        <li v-for="category in props.restaurant.menuCategories" :key="category.id">
                                            {{ category.name }}
                                        </li>
                                    </ul>
                                </p>
                                <p class="text-gray-600 mb-2">
                                    <strong>Menus:</strong>
                                    <ul>
                                        <li v-for="menu in props.restaurant.menuItems" :key="menu.id">
                                            {{ menu.name }}
                                        </li>
                                    </ul>
                                </p>
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
                                            <span class="font-semibold">{{ order.total_amount }} €</span>
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
