<template>
	<div class="p-10">
		<h1>Formulario para agregar usuario</h1>

		<div class="mb-4">
			<label for="nombre" class="block font-medium">Nombre:</label>
			<input
				v-model="nombre"
				type="text"
				id="nombre"
				class="w-full border rounded p-2"
				placeholder="Ingresa el nombre"
			/>
		</div>

		<div class="mb-4">
			<label for="email" class="block font-medium">Email:</label>
			<input
				v-model="email"
				type="email"
				id="email"
				class="w-full border rounded p-2"
				placeholder="Ingresa el email"
			/>
		</div>

		<div class="mb-4">
			<label for="password" class="block font-medium">Contraseña:</label>
			<input
				v-model="password"
				type="password"
				id="password"
				class="w-full border rounded p-2"
				placeholder="Ingresa la contraseña"
			/>
		</div>

		<button @click="addUser" class="bg-blue-500 text-white px-4 py-2 rounded">
			Agregar Usuario
		</button>
		<button @click="()=> router.push('/')" class="ml-5 bg-red-500 text-white px-4 py-2 rounded">
			Cancelar
		</button>
	</div>
</template>

<script setup>
	import { ref } from 'vue';
	import {useRouter} from "vue-router";

	const nombre = ref('');
	const email = ref('');
	const password = ref('');
	const router = useRouter()

	const addUser = () => {
		const url = location.origin + "/api/v1/users/create";
		const data = { name: nombre.value, email: email.value, password: password.value }

		axios.post(url, data).then(async response => {
			const responseData = response.data;
			console.log(responseData);

			if(responseData.response === 'usuario registrado'){
				alert('usuario registrado')
				nombre.value = ''
				email.value = ''
				password.value = ''
			}

		})
		.catch(error => {
			console.log(error);
			alert(error)
		})

		console.log('Datos del usuario:', { name: nombre.value, email: email.value, password: password.value });
	};
</script>
