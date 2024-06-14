<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">User List</h3>
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
                <router-link to="/user">User</router-link>
            </li>
        </ul>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <button class="btn btn-primary btn-round" @click="toggleOffcanvas">Add User</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users ({{ count }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Last name</th>
                                    <th>First name</th>
                                    <th>Email</th>
                                    <th>Job</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="user in alluser.data" :key="user.id">
                                    <th scope="row">{{ user.lastname }}</th>
                                    <th scope="row">{{ user.fistname }}</th>
                                    <td class="text-start">{{ user.email }}</td>
                                    <td class="text-start">{{ GetJobName(user.job_id) }}</td>
                                    <td class="text-start">{{ GetRoleName(user.role_id) }}</td>
                                    <td class="text-start">{{ user.phone }}</td>
                                    <td class="text-start">{{ formatDate(user.created_at) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetUser(user.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeleteUser(user.id)" >Delete</span>
                                            </div>
                                        </div>
                                    </td>
                               </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div class="demo">
                        <Paginate v-model="currentPage" :page-count="totalPage" :clickHandler="AllUser" :prevText="'Prev'" :nextText="'Next'" :container-class="'pagination justify-content-end'" :page-class="'page-item'"></Paginate>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hors toile -->
    <div class="offcanvas offcanvas-end " ref="offcanvas" :class="{ show: isOffcanvasVisibleUser }"  tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel"  :style="{ visibility: isOffcanvasVisibleUser ? 'visible' : 'hidden' }" >
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasLabel">Create User</h2>
            <button type="button" class="btn-close"  @click="toggleOffcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex flex-column align-items-end justify-between w-100 h-100" @submit.prevent="AddUser" @keydown.enter="handleEnterKey">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Last name :</label>
                    <input type="text" name="" class="form-control" :class="isEmpty.lastname ? 'is-invalid': ''" v-model="data.lastname" id="">
                    <div v-if="isEmpty.lastname" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group m-2">
                    <label for="" class="h4">Fist name :</label>
                    <input type="text" name="" class="form-control" :class="isEmpty.fistname ? 'is-invalid': ''" v-model="data.fistname" id="">
                    <div v-if="isEmpty.fistname" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group m-2">
                    <label for="" class="h4">Email :</label>
                    <input type="email" name="" class="form-control" :class="isEmpty.email ? 'is-invalid': ''" v-model="data.email" id="">
                    <div v-if="isEmpty.email" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Job :</label>
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.job_id ? 'is-invalid': ''" v-model="data.job_id">
                        <option value="" selected disabled>Select Jobs</option>
                        <option v-for="job in alljob" :key="job.id" :value="job.id">{{ job.job_name }}</option>
                    </select>
                    <div v-if="isEmpty.job_id" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Role :</label>
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.role_id ? 'is-invalid': ''" v-model="data.role_id">
                        <option value="" selected disabled>Select role</option>
                        <option v-for="role in allrole" :key="role.id" :value="role.id">{{ role.role_name }}</option>
                    </select>
                    <div v-if="isEmpty.role_id" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group m-2">
                    <label for="" class="h4">Phone :</label>
                    <input type="text" name="" class="form-control" :class="isEmpty.phone ? 'is-invalid': ''" v-model="data.phone" id="">
                    <div v-if="isEmpty.phone" class="invalid-feedback">
                        This field is empty
                    </div>
                </div>
                <div class="form-group m-2">
                    <label for="" class="h4">Password :</label>
                    <input type="password" name="" class="form-control" :class="isEmpty.password ? 'is-invalid': passwordValid.password ? 'is-invalid':''" v-model="data.password" id="" >
                    <div v-if="isEmpty.password" class="invalid-feedback">
                        This field is empty
                    </div>
                    <div v-if="passwordValid.password" class="invalid-feedback">
                        Different password
                    </div>
                </div>
                <div class="form-group m-2">
                    <label for="" class="h4">Confirm Password :</label>
                    <input type="password" name="" class="form-control" :class="isEmpty.confirm_password ? 'is-invalid': passwordValid.confirm_password ? 'is-invalid':''" v-model="data.confirm_password" id="" @input="ValidPassword">
                    <div v-if="isEmpty.confirm_password" class="invalid-feedback">
                        This field is empty
                    </div>
                    <div v-if="passwordValid.confirm_password" class="invalid-feedback">
                        Different password
                    </div>
                </div>
               
            </div>
            <div class="offcanvas-footer p-3 text-end">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- Fin Hors toile -->

    <!-- Update Modal Start -->
    <div v-if="updateModal" class="modal fade show"   tabindex="-1" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, .5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="updateModal = false" aria-label="Close"></button>
                </div>
                <form @Submit.prevent="UpdateUser" @keydown.enter="handleEnterKeyUpdate">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="h4">Last name :</label>
                            <input type="text" name="" class="form-control"  v-model="getuser.lastname" id="">
                        </div>
                        <div class="form-group m-2">
                            <label for="" class="h4">Fist name :</label>
                            <input type="text" name="" class="form-control"  v-model="getuser.fistname" id="">
                        </div>
                        <div class="form-group m-2">
                            <label for="" class="h4">Email :</label>
                            <input type="email" name="" class="form-control"  v-model="getuser.email" id="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Job :</label>
                            <select name="" class="form-select" id="" style="height: 50px;"  v-model="getuser.job_id">
                                <option value="" selected disabled>Select Jobs</option>
                                <option v-for="job in alljob" :key="job.id" :value="job.id">{{ job.job_name }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Role :</label>
                            <select name="" class="form-select" id="" style="height: 50px;"  v-model="getuser.role_id">
                                <option value="" selected disabled>Select role</option>
                                <option v-for="role in allrole" :key="role.id" :value="role.id">{{ role.role_name }}</option>
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="" class="h4">Phone :</label>
                            <input type="text" name="" class="form-control" v-model="getuser.phone" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="UpdateUser" class="btn btn-primary rounded">Update</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- Update Modal End -->


  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import Swal from 'sweetalert2';
import { formatDistance,format, isSameDay } from 'date-fns';
import { enUS } from "date-fns/locale";
import Paginate from 'vuejs-paginate-next'

export default {
    name:'UserVue',
    components:{
        Paginate
    },
    data(){
        return{
            isOffcanvasVisibleUser: false,
            allrole:{},
            alljob:{},
            data:{
                lastname:"",
                fistname:"",
                email:"",
                phone:"",
                password:"",
                job_id:"",
                role_id:"",
                confirm_password:""
            },
            isEmpty:{},
            passwordValid:{},
            alluser:{},
            currentPage: 1,
            totalPage: 0,
            now: new Date(),
            count:0,
            updateModal: false,
            getuser:{}
        }
    },
    mounted(){
        //la fonction qui actualise dynamiquement notre date
        setInterval(() => {
        this.now = new Date();
        }, 1000);
    },
    methods:{
        toggleOffcanvas() {
            this.isOffcanvasVisibleUser = !this.isOffcanvasVisibleUser;
            if (this.isOffcanvasVisibleUser) {
                this.showOffcanvas();
            } else {
                this.hideOffcanvas();
            }
        },
        showOffcanvas(){
            const offcanvasElement = this.$refs.offcanvas;
            // eslint-disable-next-line no-undef
            const bootstrapOffcanvas  = new bootstrap.Offcanvas(offcanvasElement)
            bootstrapOffcanvas.show()

            const backdrop = document.querySelector('.offcanvas-backdrop')
            const Btn = document.querySelector('.btn-close')
            if (backdrop) {
                Btn.setAttribute('data-bs-dismiss','offcanvas')
            }
        },
        hideOffcanvas() {
            const offcanvasElement = this.$refs.offcanvas;
            // eslint-disable-next-line no-undef
            const bootstrapOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
            bootstrapOffcanvas.hide();

            const backdrop = document.querySelector('.offcanvas-backdrop')
            const Btn = document.querySelector('.btn-close')
            if (backdrop) {
                Btn.removeAttribute('data-bs-dismiss')
            }
        },
        async AllRole(){
            const res = await axiosInstance.get('/allrole')
            if (res.status === 200) {
                this.allrole = res.data.roles
            }
        },
        async AllJob(){
            const res = await axiosInstance.get('/alljob')
            if (res.status === 200) {
                this.alljob = res.data.all
            }
        },
        GetJobName(id){
            const jobs = this.alljob.find(job => job.id === id)
            return jobs ? jobs.job_name : ""
        },
        GetRoleName(id){
            const roles = this.allrole.find(role => role.id === id)
            return roles ? roles.role_name : ""
        },
        formatDate(date) {
            const commentDate = new Date(date);

            if (isSameDay(commentDate, this.now)) {
                return formatDistance(commentDate, this.now, { locale: enUS, addSuffix: true });
            } else {
                return format(commentDate, "d MMMM yyyy 'at' HH:mm", { locale: enUS });
            }
        },
        ValidPassword(){
            
            if (this.data.confirm_password.length > 0) {
                if (this.data.password.trim() === this.data.confirm_password.trim()) {
                    this.passwordValid.password = false
                    this.passwordValid.confirm_password = false
                }else{
                    this.passwordValid.password = true
                    this.passwordValid.confirm_password = true
                    this.isOffcanvasVisibleUser = true
                }
            }
        },
        EmptyInput(){
            if (this.data.lastname.trim() == "") {
                this.isEmpty.lastname = true
            }else{
                this.isEmpty.lastname = false
            }
            if (this.data.fistname.trim() == "") {
                this.isEmpty.fistname = true
            }else{
                this.isEmpty.fistname = false
            }
            if (this.data.email.trim() == "") {
                this.isEmpty.email = true
            }else{
                this.isEmpty.email = false
            }
            if (this.data.phone.trim() == "") {
                this.isEmpty.phone = true
            }else{
                this.isEmpty.phone = false
            }
            if (this.data.job_id == "") {
                this.isEmpty.job_id = true
            }else{
                this.isEmpty.job_id = false
            }
            if (this.data.role_id == "") {
                this.isEmpty.role_id = true
            }else{
                this.isEmpty.role_id = false
            }
            if (this.data.password.trim() == "") {
                this.isEmpty.password = true
            }else{
                this.isEmpty.password = false
            }
            if (this.data.confirm_password.trim() == "") {
                this.isEmpty.confirm_password = true
            }else{
                this.isEmpty.confirm_password = false
            }
        },
        async AddUser(){
            this.EmptyInput()
            this.ValidPassword()
            const allEmpty = Object.values(this.isEmpty).every(value => value === false)
            const allValid = Object.values(this.passwordValid).every(value => value === false)

            if (allEmpty && allValid) {
                const res = await axiosInstance.post('/createuser',this.data)
                if (res.status === 200) {
                    const Users = this.alluser.data
                    Users.unshift(res.data.user)
                    this.count = this.count + 1
                    Swal.fire({
                        position:"center",
                        icon:"success",
                        title: "Registration completed successfully",
                        showConfirmButton:false,
                        timer: 1500
                    })
                    this.data.lastname = ""
                    this.data.fistname = ""
                    this.data.email = ""
                    this.data.phone = ""
                    this.data.job_id = ""
                    this.data.role_id = ""
                    this.data.password = ""
                    this.data.confirm_password = ""
                    this.isOffcanvasVisibleUser = false
                    const backdropElement = document.querySelector('.offcanvas-backdrop.fade.show');
                    if (backdropElement) {
                        // Supprimer l'élément
                        backdropElement.remove();
                    }
                }
            }else{
                this.isOffcanvasVisibleUser = true
            }
        },
        handleEnterKey(event){
            event.preventDefault()
            this.AddUser()
        },
        async AllUser(){
            const res = await axiosInstance.get('/alluser')
            if (res.status === 200) {
                this.alluser = res.data.users
                this.currentPage = res.data.users.current_page
                this.totalPage = res.data.users.last_page
            }
        },
        async Count(){
            const res = await axiosInstance.get('/alluser')
            if (res.status === 200) {
                this.count = res.data.userN
            }
        },
        async GetUser(id){
            this.updateModal = true
            const res = await axiosInstance.get('/getuser/'+id)
            if (res.status === 200) {
                this.getuser = res.data.user
            }
        },
        async UpdateUser(){
            const res = await axiosInstance.post('/updateuser', this.getuser)
            if (res.status === 200) {
                Swal.fire({
                    position:"center",
                    icon:"success",
                    title: "Edit completed successfully",
                    showConfirmButton:false,
                    timer: 1500
                })
                const Users = this.alluser.data
                const index = Users.findIndex(user=> user.id === this.getuser.id)
                if (index !== -1) {
                    Users[index] = this.getuser
                }
                this.getuser = {}
                this.updateModal = false
            }
        },
        handleEnterKeyUpdate(event){
            event.preventDefault()
            this.UpdateUser()
        },
        async DeleteUser(id){
            const res = await axiosInstance.get('/getuser/'+id)
            if (res.status === 200) {
                this.getuser = res.data.user
                Swal.fire({
                    title:"Do you want to delete this user?",
                    text:"You won't be able to go back!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText:"Fermer"
                }).then(async (result)=>{
                    if (result.isConfirmed) {
                        const del = await axiosInstance.post('/deleteuser',this.getuser)
                        if (del.status === 200) {
                            this.count = this.count - 1
                            Swal.fire({
                                position:"center",
                                icon:"success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            const Users = this.alluser.data
                            const index =  Users.findIndex(user => user.id === this.getuser.id)
                            if(index !== -1){
                                Users.splice(index,1)
                            }
                        }
                    }
                })
            }
        }
    },
    created(){
        this.AllRole()
        this.AllJob()
        this.AllUser()
        this.Count()
    }
}
</script>

<style>

</style>