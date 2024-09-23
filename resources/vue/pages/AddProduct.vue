<template>
	<div class="p-10">
		<h1>Formulario para agregar producto</h1>

		<div class="mb-4">
			<label for="nombre" class="block font-medium">Nombre:</label>
			<input
				v-model="name"
				type="text"
				id="nombre"
				class="w-full border rounded p-2"
			/>
		</div>

		<div class="mb-4">
			<label for="price" class="block font-medium">Precio:</label>
			<input
				v-model="price"
				type="text"
				id="price"
				class="w-full border rounded p-2"
			/>
		</div>

		<button @click="add" class="bg-blue-500 text-white px-4 py-2 rounded">
			Agregar
		</button>
		<button @click="()=> router.push('/')" class="ml-5 bg-red-500 text-white px-4 py-2 rounded">
			Cancelar
		</button>
	</div>
</template>

<script setup>
	import { ref } from 'vue';
	import {useRouter} from "vue-router";

	const name = ref('');
	const price = ref('');
	const router = useRouter()

	const add = () => {
		const url = location.origin + "/api/v1/products/create";
		const data = { name: name.value, price: price.value }

		axios.post(url, data).then(async response => {
			const responseData = response.data;
			console.log(responseData);

			if(responseData.response === 'producto registrado'){
				alert('producto registrado')
				name.value = ''
				price.value = ''
			}

		})
		.catch(error => {
			console.log(error);
			alert(error)
		})

		console.log('Datos:', data);
	};
</script>
