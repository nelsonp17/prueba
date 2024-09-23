<template>
	<div class="p-10">


		<div v-if="orderList.length > 0" class="my-16">
			<h1>Pedidos del usuario</h1>
			<table class="w-full my-8" >
				<thead>
				<tr>
					<th>ID</th>
					<th>Solicitado</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(order, i) in orderList" :key="i">
					<td>{{ order.id }}</td>
					<td>{{ order.created_at }}</td>
					<td>
						<button class="bg-green-500 text-white px-2 py-1" @click="router.push(`/users/${user_id}/order/${order.id}`)">Ver productos</button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>

	</div>

	<div class="p-10">
		<div v-if="productAllList.length > 0" class="my-8">
			<h1>Todos los productos comprados por este usuario</h1>
			<table class="w-full my-8" >
				<thead>
				<tr>
					<th>ID</th>
					<th>ID producto</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<template v-for="(list, i) in productAllList" :key="i">
					<tr v-for="(item, j) in list.items" :key="j">
						<td>{{ item.id }}</td>
						<td>{{ item.product.id }}</td>
						<td>{{ item.product.name }}</td>
						<td>{{ item.product.price }}</td>
					</tr>
				</template>
				</tbody>
			</table>
		</div>


		<button @click="()=> router.push('/')" class="ml-5 bg-red-500 text-white px-4 py-2 rounded">
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
const user_id = ref([]);
const productAllList = ref([]);


function getOrders(){
	user_id.value = route.params.id
	const url = location.origin + "/api/v1/users/orders";
	const data = { id: route.params.id }

	axios.post(url, data).then(async response => {
		const responseData = response.data;
		console.log(responseData);
		orderList.value = responseData


	})
		.catch(error => {
			console.log(error);
			alert(error)
		})
}
function getProductAll(){
	user_id.value = route.params.id
	const url = location.origin + "/api/v1/users/all_product";
	const data = { user_id: route.params.id }

	axios.post(url, data).then(async response => {
		const responseData = response.data;
		console.log(responseData);
		productAllList.value = responseData


	})
		.catch(error => {
			console.log(error);
			alert(error)
		})
}
onMounted(()=>{
	getOrders()
	getProductAll()
});
</script>
