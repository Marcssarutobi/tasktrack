import axiosInstance from "@/plugins/axios";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path:'/',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Accueil.vue')
    },
    {
        path:'/project',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Project.vue')
    },
    {
        path:'/task',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Task.vue')
    },
    {
        path:'/calendar',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Calendar.vue')
    },
    {
        path:'/notification',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Notification.vue')
    },
    {
        path:'/job',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Job.vue')
    },
    {
        path:'/role',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Role.vue')
    },
    {
        path:'/user',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/User.vue')
    },
    {
        path:'/profil',
        meta: { requiresAuth: true },
        component: ()=> import('@/components/Profil.vue')
    },
    {
        path:'/login',
        component: ()=> import('@/components/login.vue')
    },
]
const router = createRouter({
    history:createWebHistory(),
    routes
})


async function isAuthenticated(){
    const res = await axiosInstance.get("/authUserVerify");
    if (res.status === 200) {
        const data = res.data.connect
        return data
    }

    return false
}

router.beforeEach(async (to, from, next)=>{
    if (to.matched.some(record => record.meta.requiresAuth)) {
        try {
            const auth = isAuthenticated()
            const token = localStorage.getItem('token')
            if (auth && token) {
                next();
            }else{
                next('/login')
            }
        } catch (error) {
            console.error("Erreur lors de la vérification de l'authentification :", error);
            next('/login')
        }
    }else{
        next()
    }
})

export default router