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
                    <h4 class="card-title">Task (250)</h4>
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
                                    <th>Progress rate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <th scope="row">null</th>
                                    <td class="text-start">null</td>
                                    <td class="text-start">null</td>
                                    <td class="text-start">null</td>
                                    <td class="text-start">null</td>
                                    <td class="text-start">null</td>
                                    <td class="text-start">null</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
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
                      <ul class="pagination pg-primary">
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item active">
                          <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      </ul>
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
        <form class="d-flex flex-column align-items-end justify-between w-100 h-100">
            <div class="offcanvas-body w-100">
                <div class="form-group">
                    <label for="" class="h4">Task name :</label>
                    <input type="text" name="" class="form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Project Name :</label>
                    <select name="" class="form-select" id="" style="height: 50px;">
                        <option value="" selected disabled>Select Project</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Assign To :</label>
                    <select name="" class="form-select" id="" style="height: 50px;">
                        <option value="" selected disabled>Select User</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Start date :</label>
                    <input type="date" name="" class=" form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">End date :</label>
                    <input type="date" name="" class=" form-control" id="">
                </div>
                <div class="form-group mb-2">
                    <label for="" class="h4">Status :</label>
                    <select name="" class="form-select" id="" style="height: 50px;">
                        <option value="" selected disabled>Select Status</option>
                        <option value="No start">No start</option>
                        <option value="In progress">In progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="offcanvas-footer p-3 text-end">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- Fin Hors toile -->

  </div>
</template>

<script>
export default {
    name:"TaskVue",
    data(){
        return{
            isOffcanvasVisibleTask: false,
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
        },
        hideOffcanvas() {
            const offcanvasElement = this.$refs.offcanvas;
            // eslint-disable-next-line no-undef
            const bootstrapOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
            bootstrapOffcanvas.hide();
        }
    }
}
</script>

<style>

</style>