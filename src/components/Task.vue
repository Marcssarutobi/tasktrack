<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">List of tasks</h3>
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
                <router-link to="/task">Task</router-link>
            </li>
        </ul>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <button class="btn btn-primary btn-round" @click="toggleOffcanvas">Add Task</button>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
            <div class="input-group w-50">
                <span class="input-group-text"><i class="fas fa-filter"></i></span>
                <select class=" form-select" style="height: 50px;">
                    <option value="" selected disabled>Select project ...</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Task ({{ count }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Task name</th>
                                    <th>Project name</th>
                                    <th>Assign to</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="task in alltask" :key="task.id">
                                    <th scope="row">{{ task.task_name }}</th>
                                    <td class="text-start">{{ GetProject(task.prj_id) }}</td>
                                    <td class="text-start">{{ GetUserName(task.assignTo) }}</td>
                                    <td class="text-start">{{ task.startDate }}</td>
                                    <td class="text-start">{{ task.endDate }}</td>
                                    <td class="text-start">{{ task.status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetTask(task.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeleteTask(task.id)" >Delete</span>
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
                       <Paginate v-model="currentPage" :page-count="totalPage" :clickHandler="AllTask" :prevText="'Prev'" :nextText="'Next'" :container-class="'pagination justify-content-end'" :page-class="'page-item'"></Paginate>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hors toile -->
    <div class="offcanvas offcanvas-end " ref="offcanvas" :class="{ show: isOffcanvasVisibleTask }"  tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel"  :style="{ visibility: isOffcanvasVisibleTask ? 'visible' : 'hidden' }" >
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasLabel">Create a task</h2>
            <button type="button" class="btn-close"  @click="toggleOffcanvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form class="d-flex flex-column align-items-end justify-between w-100 h-100" @Submit.prevent="AddTask" @keydown.enter="handleEnterKey">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Task name :</label>
                    <input type="text" name="" class="form-control" id="" :class="isEmpty.task_name ? 'is-invalid' : ''" v-model="data.task_name">
                    <div v-if="isEmpty.task_name" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Project Name :</label>
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.prj_id ? 'is-invalid' : ''" v-model="data.prj_id">
                        <option value="" selected disabled>Select Project</option>
                        <option v-for="prj in allprj" :key="prj.id" :value="prj.id">{{ prj.name }}</option>
                    </select>
                    <div v-if="isEmpty.prj_id" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Assign To :</label>
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.assignTo ? 'is-invalid' : ''" v-model="data.assignTo">
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
                    <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.status ? 'is-invalid' : ''" v-model="data.status">
                        <option value="" selected disabled>Select Status</option>
                        <option value="No start">No start</option>
                        <option value="In progress">In progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <div v-if="isEmpty.status" class="invalid-feedback">
                        The field is empty
                    </div>
                </div>
                <div class="offcanvas-footer p-3 text-end">
                    <button class="btn btn-primary">Save</button>
                </div>
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
                <form @Submit.prevent="UpdateTask" @keydown.enter="handleEnterKeyUpdate">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="h4">Task name :</label>
                            <input type="text" name="" class="form-control" id="" :class="isEmpty.task_name ? 'is-invalid' : ''" v-model="gettask.task_name">
                            <div v-if="isEmpty.task_name" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Project Name :</label>
                            <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.prj_id ? 'is-invalid' : ''" v-model="gettask.prj_id">
                                <option value="" selected disabled>Select Project</option>
                                <option v-for="prj in allprj" :key="prj.id" :value="prj.id">{{ prj.name }}</option>
                            </select>
                            <div v-if="isEmpty.prj_id" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Assign To :</label>
                            <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.assignTo ? 'is-invalid' : ''" v-model="gettask.assignTo">
                                <option value="" selected disabled>Select User</option>
                                <option v-for="user in alluser" :key="user.id" :value="user.id">{{ user.lastname }} {{ user.fistname }}</option>
                            </select>
                            <div v-if="isEmpty.assignTo" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Start date :</label>
                            <input type="date" name="" class=" form-control" id="" :class="isEmpty.startDate ? 'is-invalid' : ''" v-model="gettask.startDate">
                            <div v-if="isEmpty.startDate" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">End date :</label>
                            <input type="date" name="" class=" form-control" id="" :class="isEmpty.endDate ? 'is-invalid' : ''" v-model="gettask.endDate">
                            <div v-if="isEmpty.endDate" class="invalid-feedback">
                                The field is empty
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="h4">Status :</label>
                            <select name="" class="form-select" id="" style="height: 50px;" :class="isEmpty.status ? 'is-invalid' : ''" v-model="gettask.status">
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
                        <button type="button"  class="btn btn-primary rounded" >Update</button>
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
    name: "TaskVue",
    components: {
        Paginate
    },
    data(){
        return{
            isOffcanvasVisibleTask: false,
            allprj: {},
            alluser: {},
            data: {
                task_name:"",
                prj_id:"",
                assignTo:"",
                startDate:"",
                endDate: "",
                progress: 0,
                status:""
            },
            isEmpty: {},
            alltask: {},
            currentPage: 1,
            totalPage: 0,
            count: 0,
            gettask:{},
            updateModal: false,

            
        }
    },
    methods:{
        toggleOffcanvas() {
            this.isOffcanvasVisibleTask = !this.isOffcanvasVisibleTask;
            if (this.isOffcanvasVisibleTask) {
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
                Btn.setAttribute('data-bs-dismiss', 'offcanvas')
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
        async allproject() {
            const res = await axiosInstance.get('/allproject')
            if (res.status === 200) {
                this.allprj = res.data.all
            }
        },
        async AllUser() {
            const res = await axiosInstance.get('/alluser')
            if (res.status === 200) {
                this.alluser = res.data.alluser
            }
        },
        EmptyResult() {
            if (this.data.task_name.trim() == "") {
                this.isEmpty.task_name = true
            } else {
                this.isEmpty.task_name = false
            }
            if (this.data.prj_id == "") {
                this.isEmpty.prj_id = true
            } else {
                this.isEmpty.prj_id = false
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
        async AddTask() {
            try {
                this.EmptyResult()
                const allEmpty = Object.values(this.isEmpty).every(value => value === false)
                if (allEmpty) {
                    const res = await axiosInstance.post('/createtask', this.data)
                    if (res.status === 200) {
                        this.alltask.unshift(res.data.tsk)
                        this.count = this.count + 1
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Registration completed successfully",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.data.task_name = ""
                        this.data.prj_id = ""
                        this.data.assignTo = ""
                        this.data.startDate = ""
                        this.data.endDate = ""
                        this.data.progress = ""
                        this.isOffcanvasVisibleTask = false
                        const backdropElement = document.querySelector('.offcanvas-backdrop.fade.show');
                        if (backdropElement) {
                            // Supprimer l'élément
                            backdropElement.remove();
                        }
                    }
                } else {
                    this.isOffcanvasVisibleTask = true
                }
            } catch (error) {
                console.log(error)
            }
        },
        handleEnterKey(event) {
            event.preventDefault()
            this.AddTask()
        },
        async AllTask() {
            const res = await axiosInstance.get('/alltask')
            if (res.status === 200) {
                this.alltask = res.data.tsks.data
                this.currentPage = res.data.tsks.current_page
                this.totalPage = res.data.tsks.last_page
            }
        },
        GetUserName(id) {
            const Users = this.alluser.find(user => user.id === id)
            return Users ? Users.lastname + ' ' + Users.fistname : ''
        },
        GetProject(id) {
            const Users = this.allprj.find(prj => prj.id === id)
            return Users ? Users.name  : ''
        },
        async Count() {
            const res = await axiosInstance.get('/alltask')
            if (res.status === 200) {
                this.count = res.data.all
            }
        },
        async GetTask(id) {
            this.updateModal = true
            const res = await axiosInstance.get('/gettask/' + id)
            if (res.status === 200) {
                this.gettask = res.data.tsk
            }
        },
        async UpdateTask() {
            const res = await axiosInstance.post('/updatetask', this.gettask)
            if (res.status === 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Edit completed successfully",
                    showConfirmButton: false,
                    timer: 1500
                })
                const index = this.alltask.findIndex(tsk => tsk.id === this.gettask.id)
                if (index !== -1) {
                    this.alltask[index] = this.gettask
                }
                this.gettask = {}
                this.updateModal = false
            }
        },
        handleEnterKeyUpdate(event) {
            event.preventDefault()
            this.UpdateTask()
        },
        async DeleteTask(id) {
            const res = await axiosInstance.get('/gettask/' + id)
            if (res.status === 200) {
                this.gettask = res.data.tsk
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
                        const del = await axiosInstance.post('/deletetask', this.gettask)
                        if (del.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.count = this.count - 1
                            const index = this.alltask.findIndex(tsk => tsk.id === this.gettask.id)
                            if (index !== -1) {
                                this.alltask.splice(index, 1)
                            }
                        }
                    }
                })
            }
        }
        
    },
    created() {
        this.allproject()
        this.AllUser()
        this.AllTask()
        this.Count()
    }
}
</script>

<style>

</style>