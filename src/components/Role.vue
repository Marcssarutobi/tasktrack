<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">List of role</h3>
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
                <router-link to="/role">Role</router-link>
            </li>
        </ul>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <button class="btn btn-primary btn-round" @click="toggleOffcanvas">Add Role</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role ({{ allrole.length }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Role name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="role in allrole" :key="role.id">
                                    <th scope="row">{{ role.role_name }}</th>
                                    <th scope="row">{{ formatCommentDate(role.created_at) }}</th>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetRole(role.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeleteRole(role.id)" >Delete</span>
                                            </div>
                                        </div>
                                    </td>
                               </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hors toile -->
    <div class="offcanvas offcanvas-end " ref="offcanvas" :class="{ show: isOffcanvasVisibleJobRole }"  tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel"  :style="{ visibility: isOffcanvasVisibleJobRole ? 'visible' : 'hidden' }" >
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasLabel">Create a Role</h2>
            <button type="button" class="btn-close"  @click="toggleOffcanvas"  aria-label="Close"></button>
        </div>
        <form @submit.prevent="AddRole" @keydown.enter="handleEnterKey" class="d-flex flex-column align-items-end justify-between w-100 h-100">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Role name :</label>
                    <input type="text" name="" class="form-control" id="" :class="isEmpty.role_name ? 'is-invalid': ''" v-model="data.role_name">
                    <div v-if="isEmpty.role_name" class="invalid-feedback">
                        The Role field is empty
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
                    <h5 class="modal-title">Edit a role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="updateModal = false" aria-label="Close"></button>
                </div>
                <form @Submit.prevent="UpdateRole" @keydown.enter="handleEnterKeyUpdate">
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="" class="h4">Role name :</label>
                        <input type="text" name="" class="form-control" id="" :class="isEmpty.role_name ? 'is-invalid': ''" v-model="getrole.role_name">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="UpdateRole" class="btn btn-primary rounded">Update</button>
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
export default {
    name:"RoleVue",
    data(){
        return{
            isOffcanvasVisibleJobRole: false,
            data:{
                role_name: ""
            },
            isEmpty:{},
            allrole:{},
            now: new Date(),
            getrole:{},
            updateModal: false,
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
            this.isOffcanvasVisibleJobRole = !this.isOffcanvasVisibleJobRole;
            if (this.isOffcanvasVisibleJobRole) {
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
        emptyRole(){
            if (this.data.role_name.trim() == "") {
                this.isEmpty.role_name = true
            }else{
                this.isEmpty.role_name = false
            }
        },
        formatCommentDate(date) {
            const commentDate = new Date(date);

            if (isSameDay(commentDate, this.now)) {
                return formatDistance(commentDate, this.now, { locale: enUS, addSuffix: true });
            } else {
                return format(commentDate, "d MMMM yyyy 'at' HH:mm", { locale: enUS });
            }
        },
        async AddRole(){
            this.emptyRole()
            const allEmpty = Object.values(this.isEmpty).every(value => value === false)
            if (allEmpty) {
                const res = await axiosInstance.post('/createrole',this.data)
                if (res.status === 200) {
                    this.allrole.unshift(res.data.role)
                    Swal.fire({
                        position:"center",
                        icon:"success",
                        title: "Registration completed successfully",
                        showConfirmButton:false,
                        timer: 1500
                    })
                    this.data.role_name = ""
                    this.isOffcanvasVisibleJobRole = false
                    const backdropElement = document.querySelector('.offcanvas-backdrop.fade.show');
                    if (backdropElement) {
                        // Supprimer l'élément
                        backdropElement.remove();
                    }
                }
            }else{
                this.isOffcanvasVisibleJobRole = true
            }
            
        },
        handleEnterKey(event){
            event.preventDefault()
            this.AddRole()
        },
        async AllRole(){
            const res = await axiosInstance.get('/allrole')
            if (res.status === 200) {
                this.allrole = res.data.roles
            }
        },
        async GetRole(id){
            this.updateModal = true
            const res = await axiosInstance.get('/getrole/'+id)
            if (res.status === 200) {
                this.getrole = res.data.role
            }
        },
        async UpdateRole(){
            const res = await axiosInstance.post('/updaterole', this.getrole)
            if (res.status === 200) {
                Swal.fire({
                    position:"center",
                    icon:"success",
                    title: "Edit completed successfully",
                    showConfirmButton:false,
                    timer: 1500
                })
                const index = this.allrole.findIndex(role=> role.id === this.getrole.id)
                if (index !== -1) {
                    this.allrole[index] = this.getrole
                }
                this.getrole = {}
                this.updateModal = false
            }
        },
        handleEnterKeyUpdate(event){
            event.preventDefault()
            this.UpdateRole()
        },
        async DeleteRole(id){
            const res = await axiosInstance.get('/getrole/'+id)
            if (res.status === 200) {
                this.getrole = res.data.role
                Swal.fire({
                    title:"Do you want to delete this role?",
                    text:"You won't be able to go back!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText:"Fermer"
                }).then(async (result)=>{
                    if (result.isConfirmed) {
                        const del = await axiosInstance.post('/deleterole',this.getrole)
                        if (del.status === 200) {
                            Swal.fire({
                                position:"center",
                                icon:"success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            const index = this.allrole.findIndex(role => role.id === this.getrole.id)
                            if(index !== -1){
                                this.allrole.splice(index,1)
                            }
                        }
                    }
                })
            }
        }
    },
    created(){
        this.AllRole()
    }
}
</script>

<style>

</style>