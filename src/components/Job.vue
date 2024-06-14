<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">List of jobs</h3>
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
                <router-link to="/job">Job</router-link>
            </li>
        </ul>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <button class="btn btn-primary btn-round" @click="toggleOffcanvas">Add Job</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jobs ({{ count }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Job name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="job in alljob.data" :key="job.id">
                                    <th scope="row">{{ job.job_name }}</th>
                                    <td class="text-start">{{ job.status }}</td>
                                    <td class="text-start">{{ formatDate(job.created_at) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetJob(job.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeleteRole(job.id)" >Delete</span>
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
                        <Paginate v-model="currentPage" :page-count="totalPage" :clickHandler="AllJob" :prevText="'Prev'" :nextText="'Next'" :container-class="'pagination justify-content-end'" :page-class="'page-item'"></Paginate>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hors toile -->
    <div class="offcanvas offcanvas-end " ref="offcanvas" :class="{ show: isOffcanvasVisibleJob }"  tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel"  :style="{ visibility: isOffcanvasVisibleJob ? 'visible' : 'hidden' }" >
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasLabel">Create a Job</h2>
            <button type="button" class="btn-close"  @click="toggleOffcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex flex-column align-items-end justify-between w-100 h-100" @Submit.prevent="AddJob" @keydown.enter="handleEnterKey">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Job name :</label>
                    <input type="text" name="" class="form-control" id="" :class="isEmpty.job_name ? 'is-invalid': ''" v-model="data.job_name">
                    <div v-if="isEmpty.job_name" class="invalid-feedback">
                        The Job name field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Status :</label>
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.status ? 'is-invalid': ''" v-model="data.status">
                        <option value="" selected disabled>Select Jobs Status</option>
                        <option value="vacant">vacant</option>
                        <option value="busy">busy</option>
                    </select>
                    <div v-if="isEmpty.status" class="invalid-feedback">
                        The Status field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Description :</label>
                    <textarea v-model="data.desc" name="" class=" form-control" id="" rows="5" :class="isEmpty.desc ? 'is-invalid': ''"></textarea>
                    <div v-if="isEmpty.desc" class="invalid-feedback">
                        The Description field is empty
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
                            <label for="" class="h4">Job name :</label>
                            <input type="text" name="" class="form-control" id=""  v-model="getjob.job_name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Status :</label>
                            <select name="" class="form-select" id="" style="height: 50px;"  v-model="getjob.status">
                                <option value="" selected disabled>Select Jobs Status</option>
                                <option value="vacant">vacant</option>
                                <option value="busy">busy</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Description :</label>
                            <textarea v-model="getjob.desc" name="" class=" form-control" id="" rows="5" ></textarea>
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
import Paginate from 'vuejs-paginate-next'

export default {
    name: "JobVue",
    components:{
        Paginate
    },
    data(){
        return{
            isOffcanvasVisibleJob: false,
            data:{
                job_name:"",
                status:"",
                desc:""
            },
            isEmpty:{},
            alljob:{},
            currentPage: 1,
            totalPage: 0,
            now: new Date(),
            count:0,
            getjob:{},
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
            this.isOffcanvasVisibleJob = !this.isOffcanvasVisibleJob;
            if (this.isOffcanvasVisibleJob) {
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
        EmptyResult(){
            if (this.data.job_name.trim() == "") {
                this.isEmpty.job_name = true
            }else{
                this.isEmpty.job_name = false
            }
            if (this.data.status.trim() == "") {
                this.isEmpty.status = true
            }else{
                this.isEmpty.status = false
            }
            if (this.data.desc.trim() == "") {
                this.isEmpty.desc = true
            }else{
                this.isEmpty.desc = false
            }
        },
        formatDate(date) {
            const commentDate = new Date(date);

            if (isSameDay(commentDate, this.now)) {
                return formatDistance(commentDate, this.now, { locale: enUS, addSuffix: true });
            } else {
                return format(commentDate, "d MMMM yyyy 'at' HH:mm", { locale: enUS });
            }
        },
        async AddJob(){
            this.EmptyResult()
            const allEmpty = Object.values(this.isEmpty).every(value => value === false)
            if (allEmpty) {
                const res = await axiosInstance.post('/createjobs',this.data)
                if (res.status === 200) {
                    const Jobs = this.alljob.data
                    Jobs.unshift(res.data.job)
                    Swal.fire({
                        position:"center",
                        icon:"success",
                        title: "Registration completed successfully",
                        showConfirmButton:false,
                        timer: 1500
                    })
                    this.data.job_name = ""
                    this.data.status = ""
                    this.data.desc = ""
                    this.isOffcanvasVisibleJob = false
                    const backdropElement = document.querySelector('.offcanvas-backdrop.fade.show');
                    if (backdropElement) {
                        // Supprimer l'élément
                        backdropElement.remove();
                    }
                }
            }
        },
        handleEnterKey(event){
            event.preventDefault()
            this.AddJob()
        },
        async AllJob(){
            const res = await axiosInstance.get('/alljob')
            if (res.status === 200) {
                this.alljob = res.data.jobs
                this.currentPage = res.data.jobs.current_page
                this.totalPage = res.data.jobs.last_page
            }
        },
        async Count(){
            const res = await axiosInstance.get('/alljob')
            if (res.status === 200) {
                this.count = res.data.jobN
            }
        },
        async GetJob(id){
            this.updateModal = true
            const res = await axiosInstance.get('/getjob/'+id)
            if (res.status === 200) {
                this.getjob = res.data.job
            }
        },
        async UpdateRole(){
            const res = await axiosInstance.post('/updatejob', this.getjob)
            if (res.status === 200) {
                Swal.fire({
                    position:"center",
                    icon:"success",
                    title: "Edit completed successfully",
                    showConfirmButton:false,
                    timer: 1500
                })
                const Jobs = this.alljob.data
                const index = Jobs.findIndex(job=> job.id === this.getjob.id)
                if (index !== -1) {
                    Jobs[index] = this.getjob
                }
                this.getjob = {}
                this.updateModal = false
            }
        },
        handleEnterKeyUpdate(event){
            event.preventDefault()
            this.UpdateRole()
        },
        async DeleteRole(id){
            const res = await axiosInstance.get('/getjob/'+id)
            if (res.status === 200) {
                this.getjob = res.data.job
                Swal.fire({
                    title:"Do you want to delete this Job?",
                    text:"You won't be able to go back!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText:"Fermer"
                }).then(async (result)=>{
                    if (result.isConfirmed) {
                        const del = await axiosInstance.post('/deletejob',this.getjob)
                        if (del.status === 200) {
                            Swal.fire({
                                position:"center",
                                icon:"success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            const Jobs = this.alljob.data
                            const index = Jobs.findIndex(job => job.id === this.getjob.id)
                            if(index !== -1){
                                Jobs.splice(index,1)
                            }
                        }
                    }
                })
            }
        }
    },
    created(){
        this.AllJob()
        this.Count()
    }
}
</script>

<style>

</style>