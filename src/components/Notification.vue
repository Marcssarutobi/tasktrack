<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">Your notifications</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <router-link to="/">
                    <i class="icon-home"></i>
                </router-link>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <router-link to="/notification">Notification</router-link>
            </li>
        </ul>
    </div>

    <div class="row gx-2">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notification ({{ NotificationCount }})</h4>
                </div>
                <div class="card-body" style="height: 650px; overflow-y: scroll;">
                    <div class="vide" v-if="NotificationFilter.length === 0">
                        <i class="fas fa-bell-slash"></i>
                        <span>Aucune Notification</span>
                    </div>
                    <div v-else>
                        <div class="msg p-3 mb-3" v-for="notif in NotificationFilter" :key="notif.id" style="cursor: pointer;" :style="notif.status === 1 ? 'border-left: 5px solid #151a2b;':'border-left: 5px solid #b3b7c4;'">
                            <div class="info">
                                <h4 @click="GetNotif(notif.id)" :class="notif.status === 1 ? 'fw-bold':''">{{ notif.subject }}</h4>
                                <p class="txt">{{ notif.message }} </p>
                            </div>
                            <div class="breadcrumbs ms-2 btns">
                                <button class="btn btn-white border"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div v-if="msg" class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ getnotif.subject }}</h4>
                </div>
                <div class="card-body" style="height: 650px;">
                    <p style="text-align: justify;">{{ getnotif.message }}</p>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios';
export default {
    name:"NoticationVue",
    data(){
        return{
            allnotif:[],
            countall: 0,
            getnotif:{},
            msg:false,
            currentUser:{},
            notif: false
        }
    },
    methods:{
        async AllNotification(){
            const res = await axiosInstance.get('/allnotif')
            if (res.status === 200) {
                this.allnotif = res.data.notifs
                this.countall = res.data.notifC
            }
        },
        async GetNotif(id){
            this.msg = true
            const res = await axiosInstance.get('/getnotif/'+id)
            if (res.status === 200) {
                this.getnotif = res.data.notif
                this.getnotif.status = false
                const update = await axiosInstance.post('/updatenotif', this.getnotif)
                if (update.status === 200) {
                    const index = this.allnotif.findIndex(notif => notif.id === this.getnotif.id)
                    if (index !== -1) {
                        this.allnotif[index] = this.getnotif
                    }
                }
            }
        },
        async CurrentUser() {
            const res = await axiosInstance.get('/user', {
                headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            })
            if (res.status === 200) {
                this.currentUser = res.data
                
            }
        }
    },
    computed:{
        NotificationFilter(){
            return this.allnotif.filter(notif => notif.user_id === this.currentUser.id);
        },
        NotificationCount(){
            return  this.NotificationFilter.length
        },
        NotificationNonLue(){
            return this.NotificationFilter.filter(notifs => notifs.status === 1).length
        }
    },
    watch: {
        NotificationNonLue(newCount) {
            this.$store.commit('updateNotificationCount', newCount);
        }
    },
    created(){
        this.AllNotification()
        this.CurrentUser()
    }
}
</script>

<style>
    .msg{
        background: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, .5);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .msg .txt{
        width: 100%;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden; 
        text-overflow: ellipsis;
        margin: 0;
        max-height: 30px;
    }
    .vide{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .vide i{
        font-size: 10rem;
        color: #cbcbcb;
    }
    .vide span{
        font-size: 33px;
        color: #cbcbcb;
    }
</style>