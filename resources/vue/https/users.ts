import axios, { AxiosResponse } from "axios";

class Users {
	private url_create: string;
	private url_list: string;
	constructor() {
		this.url_create = location.origin + "/api/v1/users/create"
		this.url_list = location.origin + "/api/v1/users"
	}
	async create(data) {

		return await new Promise((resolve, reject)=>{
			axios.post(this.url_create, data)
				.then(async response => {

					const responseData = response.data;
					console.log(responseData);

					resolve(responseData);
				})
				.catch(error => {
					reject(error)
				})
		})
	}
	async getAll() {

		return await new Promise((resolve, reject)=>{
			axios.get(this.url_list)
				.then(async response => {

					const responseData = response.data;
					console.log(responseData);

					resolve(responseData);
				})
				.catch(error => {
					reject(error)
				})
		})
	}
}
