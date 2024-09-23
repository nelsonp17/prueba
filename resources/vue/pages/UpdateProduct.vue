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
			Actualizar
		</button>
		<button @click="()=> router.push('/')" class="ml-5 bg-red-500 text-white px-4 py-2 rounded">
			Cancelar
		</button>
	</div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import {useRoute, useRouter} from "vue-router";

const id = ref('');
const name = ref('');
const price = ref('');
const router = useRouter()
const route = useRoute()

onMounted(()=>{
	// console.log(route.params.id)
	const url = location.origin + "/api/v1/products/find";
	axios.post(url, {id: route.params.id}).then(async response => {
		const responseData = response.data;
		console.log(responseData);

		id.value = responseData.id
		name.value = responseData.name
		price.value = responseData.price

	})
		.catch(error => {
			console.log(error);
			alert(error)
		})
});


const add = () => {
	const url = location.origin + "/api/v1/products/update";
	const data = { id: id.value, name: name.value, price: price.value }

	axios.post(url, data).then(async response => {
		const responseData = response.data;
		console.log(responseData);

		if(responseData.response === 'producto actualizado'){
			alert('producto actualizado')
			router.push('/');
		}

	})
		.catch(error => {
			console.log(error);
			alert(error)
		})

	console.log('Datos:', data);
};
</script>
