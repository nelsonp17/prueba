import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'
import Home from '@/pages/Home.vue'
import AddUser from "../pages/AddUser.vue";
import AddProduct from "../pages/AddProduct.vue";
import UpdateProduct from "../pages/UpdateProduct.vue";
import UserProduct from "../pages/UserProduct.vue";
import OrderProduct from "../pages/OrderProduct.vue";

const routes: RouteRecordRaw[] = [
    {
    	path: '/',
    	name: 'Home',
    	component: Home
    },
	{
		path: '/users/add',
		name: 'AddUser',
		component: AddUser
	},

	{
		path: '/products/add',
		name: 'AddProduct',
		component: AddProduct
	},
	{
		path: '/products/update/:id',
		name: 'UpdateProduct',
		component: UpdateProduct
	},
	{
		path: '/users/:id/orders',
		name: 'UserProduct',
		component: UserProduct
	},
	{
		path: '/users/:id/order/:order_id',
		name: 'OrderProduct',
		component: OrderProduct
	},
]
const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
