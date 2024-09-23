<template>
	<div class="p-10">


		<div v-if="orderList.length > 0" class="my-16">
			<h1>Pedido {{ route.params.order_id }}: Lista de Productos</h1>
			<table class="w-full my-8" >
				<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Precio</th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(order, i) in orderList" :key="i">
					<td>{{ order.product.id }}</td>
					<td>{{ order.product.name }}</td>
					<td>{{ order.product.price }}</td>
				</tr>
				</tbody>
			</table>
		</div>


		<button @click="()=> router.push(`/users/${route.params.id}/orders`)" class="ml-5 bg-red-500 text-white px-4 py-2 rounded">
			Volver
		</button>
	</div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import {useRoute, useRouter} from "vue-router";

const router = useRouter()
const route = useRoute()
const orderList = ref([]);


onMounted(()=>{
	const url = location.origin + "/api/v1/users/order_list";
	const data = { user_id: route.params.id, order_id: route.params.order_id }

	axios.post(url, data).then(async response => {
		const responseData = response.data;
		console.log(responseData);
		orderList.value = responseData


	})
		.catch(error => {
			console.log(error);
			// alert(error)
		})
});
</script>
