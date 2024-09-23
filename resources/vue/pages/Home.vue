<template>
	<div class="p-10">
		<h1>Usuarios</h1>
		<button class="bg-blue-500 text-white px-2 py-3" @click="handleClickAddUser">Agregar usuario</button>
<!--		<button class="ml-5 bg-blue-500 text-white px-2 py-3" @click="handleClickUserList">Lista de usuario</button>-->


		<div v-if="userList.length > 0" class="my-16">
			<h1><b>Lista de Usuarios</b></h1>
			<table class="w-full my-8" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(user, i) in userList" :key="i">
						<td>{{ user.id }}</td>
						<td>{{ user.name }}</td>
						<td>{{ user.email }}</td>
						<td>
							<button class="bg-green-500 text-white px-2 py-1" @click="handleClickProductDelete(user.id)">Comprar</button>
<!--							<button class="ml-5 bg-green-500 text-white px-2 py-1" @click="()=>{}">Ver productos</button>-->
							<button class="ml-5 bg-green-500 text-white px-2 py-1" @click="router.push(`/users/${user.id}/orders`)">Ver pedidos</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div v-else>No hay usuarios agregados</div>

	</div>

	<div class="p-10">
		<h1>Productos</h1>
		<button class="bg-blue-500 text-white px-2 py-3" @click="handleClickAddProduct">Agregar producto</button>
<!--		<button class="ml-5 bg-blue-500 text-white px-2 py-3" @click="handleClickProductList">Lista de productos</button>-->


		<div v-if="productList.length > 0" class="my-16">
			<h1><b>Lista de Productos</b></h1>
			<table class="w-full my-8" >
				<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>price</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="(product, i) in productList" :key="i">
					<td>{{ product.id }}</td>
					<td>{{ product.name }}</td>
					<td>{{ product.price }}</td>
					<td>
						<button class="bg-red-500 text-white px-2 py-1" @click="handleClickProductDelete(product.id)">Eliminar</button>
						<button class="ml-5 bg-green-500 text-white px-2 py-1" @click="handleClickProductEdit(product.id)">Actualizar</button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div v-else>No hay producto agregados</div>

	</div>


	<div class="p-10">
		<div v-if="productUserAllList.length > 0" class="my-8">
			<h1>Todos usuarios que han comprado productos</h1>
			<table class="w-full my-8" >
				<thead>
				<tr>
					<th>ID</th>
					<th>ID producto</th>
					<th>Nombre del usuario</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<template v-for="(list, i) in productUserAllList" :key="i">
					<tr v-for="(item, j) in list.items" :key="j">
						<td>{{ item.id }}</td>
						<td>{{ item.product.id }}</td>
						<td>{{ list.user.name }}</td>
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

<script setup lang="ts">
	import {useRouter} from "vue-router";
	import {onMounted, ref} from "vue";
	import axios from "axios";

	const router = useRouter()
	const userList = ref([]);
	const productList = ref([]);
	const productUserAllList = ref([]);

	function handleClickAddUser() {
		router.push('/users/add')
	}
	function handleClickAddProduct() {
		router.push('/products/add')
	}
	function handleClickUserList() {
		const url = location.origin + "/api/v1/users";
		axios.get(url).then(async response => {
			const responseData = response.data;
			console.log(responseData);

			if(responseData){
				userList.value = responseData
			}

		})
		.catch(error => {
			console.log(error);
			alert(error)
		})
	}

	function handleClickProductList() {
		const url = location.origin + "/api/v1/products";
		axios.get(url).then(async response => {
			const responseData = response.data;
			console.log(responseData);

			if(responseData){
				productList.value = responseData
			}

			// if(responseData.response === 'usuario registrado'){
			// 	nombre.value = ''
			// 	email.value = ''
			// 	password.value = ''
			// }

		})
			.catch(error => {
				console.log(error);
				alert(error)
			})
	}

	function handleClickProductEdit(id){
		router.push(`/products/update/${id}`)
	}

	function getProductUserAll(){
		const url = location.origin + "/api/v1/users/all_user_product";

		axios.post(url).then(async response => {
			const responseData = response.data;
			console.log(responseData);
			productUserAllList.value = responseData


		})
			.catch(error => {
				console.log(error);
				alert(error)
			})
	}
	function handleClickProductDelete(id){
		const url = location.origin + "/api/v1/products/delete";
		axios.post(url, {id}).then(async response => {
			const responseData = response.data;
			console.log(responseData);
			location.reload()



		})
		.catch(error => {
			console.log(error);
			alert(error)
		})
	}

	onMounted(()=>{
		handleClickUserList();
		handleClickProductList();
		getProductUserAll();
	});
</script>
