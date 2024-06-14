<template>
  <div class="body">
    
    <div class="containers">
        <div class="form p-4">
            <h1 class="fw-bold title">Login</h1>
            <form @submit.prevent="Login" @keydown.enter="handleEnterKey">
                <div class="inputs form-group">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Your email address" class="form-control" :class="isEmpty.email ? 'is-invalid': ''" v-model="data.email">
                    <div v-if="isEmpty.email" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="inputs form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Your password" class="form-control" :class="isEmpty.password ? 'is-invalid': ''" v-model="data.password">
                    <div v-if="isEmpty.password" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <span>Forgot your password ? <a href="#">Click here</a></span>
                <div class="btns">
                    <button class="btn btn-primary btn-lg w-100" @click="Login">Login</button>
                </div>
            </form>
        </div>
    </div>

  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import Swal from 'sweetalert2';

export default {
    name:'LoginVue',
    data(){
        return{
            data:{
                email: "",
                password:""
            },
            isEmpty:{},
        }
    },
    methods:{
        EmptyResult(){
            if (this.data.email.trim() == "") {
                this.isEmpty.email = true
            }else{
                this.isEmpty.email = false
            }
            if (this.data.password.trim() == "") {
                this.isEmpty.password = true
            }else{
                this.isEmpty.password = false
            }
        },
        async Login(){
            try {
                this.EmptyResult()
                const allEmpty = Object.values(this.isEmpty).every(value => value === false)
                if (allEmpty) {
                    const res = await axiosInstance.post('/login',this.data)
                    if (res.status === 200) {
                        localStorage.setItem('token',res.data.token)
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Successful connection",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "success"
                        })
                        this.$router.push('/')
                        this.data.email = ""
                        this.data.password = ""
                    }
                }
            } catch (error) {
                console.error(error)
            }
        },
        handleEnterKey(event){
            event.preventDefault()
            this.Login()
        },
    }
}
</script>

<style scoped>

    .body{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: #e7e7e7;
    }
    .body .containers{
        position: relative;
        width: 490px;
        height: 420px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, .5);
    }
    .body .containers::before{
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 490px;
        height: 420px;
        background: linear-gradient(0deg,transparent,#151a2b,#151a2b);
        transform-origin: bottom right;
        animation: animate 7s linear infinite;
    }
    .body .containers::after{
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 490px;
        height: 420px;
        background: linear-gradient(0deg,transparent,#4287f5,#4287f5);
        transform-origin: bottom right;
        animation: animate 7s linear infinite;
        animation-delay: 3.5s;
    }
    @keyframes animate{
        100%{
            transform: rotate(360deg);
        }
    }
    .containers .form{
        position: absolute;
        inset: 3px;
        border-radius: 10px;
        background: #fff;
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .form .title{
        width: 100%;
        height: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form form{
        width: 100%;
        height: 70%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }
    .inputs{
        width: 80%;
        height: 20%;
        background: #e7e7e7;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
    .inputs i{
        width: 10%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .inputs input{
        width: 90%;
        height: 100%;
        border: none;
        background: transparent;
        outline: none;
        padding: 10px;
        font-size: 18px;
    }
    .btns{
        width: 80%;
    }

</style>