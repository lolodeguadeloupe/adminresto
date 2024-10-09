<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link} from '@inertiajs/vue3';


defineProps({
    restaurants: {
        type: Array,
        required: true,
    },
});
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
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                                Mes restaurants
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 p-6">
                        <div v-for="restaurant in restaurants" :key="restaurant.id" class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ restaurant.name }}</h3>
                                <p class="text-gray-600 mb-2"><strong>Adresse:</strong> {{ restaurant.address }}</p>
                                <p class="text-gray-600 mb-2"><strong>Téléphone:</strong> {{ restaurant.phone }}</p>
                                <p class="text-gray-600 mb-4"><strong>Email:</strong> {{ restaurant.email }}</p>
                                <Link :href="route('restaurants.show', restaurant.id)" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                                            Voir
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
    </AuthenticatedLayout>
</template>