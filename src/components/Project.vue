<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">List of projects</h3>
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
                <router-link to="/project">Projects</router-link>
            </li>
        </ul>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <button class="btn btn-primary btn-round" @click="toggleOffcanvas">Add Project</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Project ({{ count }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project name</th>
                                    <th>Assign to</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Number of tasks</th>
                                    <th>Progress rate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="prj in allproject" :key="prj.id">
                                    <th scope="row">{{ prj.name }}</th>
                                    <td class="text-start">{{ GetUserName(prj.assignTo) }}</td>
                                    <td class="text-start">{{ prj.startDate }}</td>
                                    <td class="text-start">{{ prj.endDate }}</td>
                                    <td class="text-start">{{ GetTaskCount(prj.id) }}</td>
                                    <td class="text-start">{{ PercentPrj(prj.id) }}%</td>
                                    <td class="text-start">{{ prj.statuts }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetProject(prj.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeletePrj(prj.id)" >Delete</span>
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
                       <Paginate v-model="currentPage" :page-count="totalPage" :clickHandler="AllProject" :prevText="'Prev'" :nextText="'Next'" :container-class="'pagination justify-content-end'" :page-class="'page-item'"></Paginate>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hors toile -->
    <div class="offcanvas offcanvas-end " ref="offcanvas" :class="{ show: isOffcanvasVisible }"  tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel"  :style="{ visibility: isOffcanvasVisible ? 'visible' : 'hidden' }" >
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasLabel">Create a project</h2>
            <button type="button" class="btn-close"  @click="toggleOffcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex flex-column align-items-end justify-between w-100 h-100" @Submit.prevent="AddProject" @keydown.enter="handleEnterKey">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Project name :</label>
                    <input type="text" name="" class="form-control" id="" :class="isEmpty.name ? 'is-invalid' : ''" v-model="data.name">
                    <div v-if="isEmpty.name" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Assign To :</label>
                    <select name="" class="form-select" id="" v-model="data.assignTo" :class="isEmpty.assignTo ? 'is-invalid' : ''">
                        <option value="" selected disabled>Select User</option>
                        <option v-for="user in alluser" :key="user.id" :value="user.id">{{ user.lastname }} {{ user.fistname }}</option>
                    </select>
                    <div v-if="isEmpty.assignTo" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Start date :</label>
                    <input type="date" name="" class=" form-control" id="" :class="isEmpty.startDate ? 'is-invalid' : ''" v-model="data.startDate">
                    <div v-if="isEmpty.startDate" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">End date :</label>
                    <input type="date" name="" class=" form-control" id="" :class="isEmpty.endDate ? 'is-invalid' : ''" v-model="data.endDate">
                    <div v-if="isEmpty.endDate" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Status :</label>
                    <select name="" class="form-select" id="" v-model="data.status" :class="isEmpty.status ? 'is-invalid' : ''">
                        <option value="" selected disabled>Select Status</option>
                        <option value="No start">No start</option>
                        <option value="In progress">In progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <div v-if="isEmpty.status" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer p-3 text-end">
                <button class="btn btn-primary" @click="AddProject">Save</button>
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
                <form @Submit.prevent="UpdateProject" @keydown.enter="handleEnterKeyUpdate">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="h4">Project name :</label>
                            <input type="text" name="" class="form-control" id="" :class="isEmpty.name ? 'is-invalid' : ''" v-model="getprj.name">
                            <div v-if="isEmpty.name" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Assign To :</label>
                            <select name="" class="form-select" id="" v-model="getprj.assignTo" :class="isEmpty.assignTo ? 'is-invalid' : ''">
                                <option value="" selected disabled>Select User</option>
                                <option v-for="user in alluser" :key="user.id" :value="user.id">{{ user.lastname }} {{ user.fistname }}</option>
                            </select>
                            <div v-if="isEmpty.assignTo" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Start date :</label>
                            <input type="date" name="" class=" form-control" id="" :class="isEmpty.startDate ? 'is-invalid' : ''" v-model="getprj.startDate">
                            <div v-if="isEmpty.startDate" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">End date :</label>
                            <input type="date" name="" class=" form-control" id="" :class="isEmpty.endDate ? 'is-invalid' : ''" v-model="getprj.endDate">
                            <div v-if="isEmpty.endDate" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Nbr Task :</label>
                            <input type="text" name="" class=" form-control" id="" :class="isEmpty.nbrTask ? 'is-invalid' : ''" v-model="getprj.nbrTask">
                            <div v-if="isEmpty.nbrTask" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Progress :</label>
                            <input type="text" name="" class=" form-control" id="" :class="isEmpty.progress ? 'is-invalid' : ''" v-model="getprj.progress">
                            <div v-if="isEmpty.progress" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Status :</label>
                            <select name="" class="form-select" id="" v-model="getprj.status" :class="isEmpty.status ? 'is-invalid' : ''">
                                <option value="" selected disabled>Select Status</option>
                                <option value="No start">No start</option>
                                <option value="In progress">In progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <div v-if="isEmpty.status" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-primary rounded" @click="UpdateProject">Update</button>
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
import Paginate from 'vuejs-paginate-next'
export default {
    name: 'ProjectVue',
    components: {
        Paginate
    },
    data(){
        return{
            isOffcanvasVisible: false,
            data: {
                name: "",
                assignTo: "",
                startDate: "",
                endDate: "",
                nbrTask: 0,
                progress: 0,
                status:""
            },
            alluser: {},
            isEmpty: {},
            allproject: {},
            currentPage: 1,
            totalPage: 0,
            now: new Date(),
            count: 0,
            alljob: {},
            getprj: {},
            updateModal: false,
            alltask: [],
            projects: [],
            countTas: "",
            statutsTas: "",
            percent:0,
            dataNotif:{
                user_id:"",
                subject:"",
                message:"",
                status: true
            }

            
        }
    },
    methods:{
        toggleOffcanvas() {
            this.isOffcanvasVisible = !this.isOffcanvasVisible;
            if (this.isOffcanvasVisible) {
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
        async AllUser() {
            const res = await axiosInstance.get('/alluser')
            if (res.status === 200) {
                this.alluser = res.data.alluser
            }
        },
        EmptyResult() {
            if (this.data.name.trim() == "") {
                this.isEmpty.name = true
            } else {
                this.isEmpty.name = false
            }
            if (this.data.assignTo == "") {
                this.isEmpty.assignTo = true
            } else {
                this.isEmpty.assignTo = false
            }
            if (this.data.startDate.trim() == "") {
                this.isEmpty.startDate = true
            } else {
                this.isEmpty.startDate = false
            }
            if (this.data.endDate.trim() == "") {
                this.isEmpty.endDate = true
            } else {
                this.isEmpty.endDate = false
            }
            if (this.data.status.trim() == "") {
                this.isEmpty.status = true
            } else {
                this.isEmpty.status = false
            }
        },
        async AddProject() {
           try {

            this.EmptyResult()
            const allEmpty = Object.values(this.isEmpty).every(value => value === false)
            if (allEmpty) {
                const res = await axiosInstance.post('/createproject', this.data)
                if (res.status === 200) {
                    this.allproject.unshift(res.data.prj)
                    this.count = this.count + 1
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Registration completed successfully",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.data.name = ""
                    this.data.assignTo = ""
                    this.data.startDate = ""
                    this.data.endDate = ""
                    this.data.nbrTask = ""
                    this.data.progress = ""
                    this.data.status = ""
                    this.isOffcanvasVisible = false
                    const backdropElement = document.querySelector('.offcanvas-backdrop.fade.show');
                    if (backdropElement) {
                        // Supprimer l'élément
                        backdropElement.remove();
                    }

                    const prj = res.data.prj

                    this.dataNotif.user_id = prj.assignTo
                    this.dataNotif.subject = prj.name
                    this.dataNotif.message = `Un nouveau projet vous a été attribué récemment. Nous vous encourageons à consulter la liste de vos projets pour obtenir tous les détails nécessaires. Veuillez vérifier attentivement les informations fournies et vous familiariser avec les objectifs et les exigences du projet. Si vous avez des questions ou avez besoin de clarifications supplémentaires, n'hésitez pas à contacter votre responsable de projet.`

                    const notif = await axiosInstance.post('/createnotif',this.dataNotif)
                    if (notif.status === 200) {
                        console.log('ok')
                    }
                }
            } else {
                this.isOffcanvasVisible = true
            }
            
           } catch (error) {
            console.log(error)
           }
        },
        handleEnterKey(event) {
            event.preventDefault()
            this.AddProject()
        },
        async AllProject() {
            const res = await axiosInstance.get('/allproject')
            if (res.status === 200) {
                this.allproject = res.data.prjs.data
                this.currentPage = res.data.prjs.current_page
                this.totalPage = res.data.prjs.last_page

                if (this.allproject) {
                    this.allproject.forEach(project => {
                        if (project.tasks) {
                            project.tasks.forEach(task => {
                                this.alltask.push(task)
                            })
                            const tasks = project.tasks
                            if (tasks.every(value => value.status === "No start")) {
                                project.statuts = "No start"
                            } else if (tasks.some(value => value.status === "In progress")) {
                                project.statuts = "In progress"
                            } else if (tasks.every(value => value.status === "Completed")) {
                                project.statuts = "Completed"
                            }
                        }
                    })
                }
                
            }
        },
        GetUserName(id) {
            const Users = this.alluser.find(user => user.id === id)
            return Users ? Users.lastname + ' ' + Users.fistname : ''
        },
        async Count() {
            const res = await axiosInstance.get('/allproject')
            if (res.status === 200) {
                this.count = res.data.count
            }
        },
         GetTaskCount(projectId) {
            return this.countTas = this.alltask.filter(tasks => tasks.prj_id === projectId).length
        },
        PercentPrj(projectId) {
            const ProjectTask = this.alltask.filter(task => task.prj_id === projectId)
            if (ProjectTask.length === 0) {
                return 0
            }
            const CompletdTask = this.alltask.filter(task => task.status === "Completed").length
            this.percent = (CompletdTask / ProjectTask.length) * 100
            return Math.round(this.percent)
            
        },
        async GetProject(id) {
            this.updateModal = true
            const res = await axiosInstance.get('/getproject/' + id)
            if (res.status === 200) {
                this.getprj = res.data.prj
                this.GetTaskCount(this.getprj.id)
                this.StatusPrj(this.getprj.id)
                this.getprj.nbrTask = this.countTas
                this.getprj.status = this.statutsTas
            }
        },
        async UpdateProject() {
            const res = await axiosInstance.post('/updateproject', this.getprj)
            if (res.status === 200) {
                Swal.fire({
                    position:"center",
                    icon:"success",
                    title: "Edit completed successfully",
                    showConfirmButton:false,
                    timer: 1500
                })
                const index = this.allproject.findIndex(prj => prj.id === this.getprj.id)
                if (index !== -1) {
                    this.allproject[index] = this.getprj
                }
                this.getprj = {}
                this.updateModal = false
            }
        },
        handleEnterKeyUpdate(event) {
            event.preventDefault()
            this.UpdateProject()
        },
        async DeletePrj(id) {
            const res = await axiosInstance.get('/getproject/' + id)
            if (res.status === 200) {
                this.getprj = res.data.prj
                Swal.fire({
                    title: "Do you want to delete this project?",
                    text: "You won't be able to go back!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText: "Fermer"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const del = await axiosInstance.post('/deleteproject', this.getprj)
                        if (del.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.count = this.count - 1
                            const index = this.allproject.findIndex(prj => prj.id === this.getprj.id)
                            if (index !== -1) {
                                this.allproject.splice(index, 1)
                            }
                        }
                    }
                })
            }
        },
       
    },
    created() {
        this.AllUser()
        this.AllProject()
        this.Count()
    }
}
</script>

<style>

</style>