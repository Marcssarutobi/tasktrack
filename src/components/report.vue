<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">List of report</h3>
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
                <router-link to="/report">Report</router-link>
            </li>
        </ul>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <button class="btn btn-primary btn-round" @click="addmodal = true">Add Report</button>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
            <div class="input-group w-50">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" style="height: 50px;" placeholder="search...">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Report (0)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project Name</th>
                                    <th>Report</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr >
                                    <th scope="row">null</th>
                                    <th scope="row">null</th>
                                    <th scope="row">null</th>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1"  >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1"  >Delete</span>
                                            </div>
                                        </div>
                                    </td>
                               </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale Add Report -->

    <div v-if="addmodal" class="modal fade show"   tabindex="-1" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, .5);">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-header">
                    <h5 class="modal-title">Add Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="addmodal = false" aria-label="Close"></button>
                </div>
                <div class=" modal-body">
                    <div class="form-group">
                        <label for="">Project Name :</label>
                        <select name="" class=" form-select" id="" style="height: 50px;">
                            <option selected disabled value="">Select Project</option>
                            <option v-for="prj in ProjectFilter" :key="prj.id" :value="prj.id">{{ prj.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Report :</label>
                        <Editor
                            api-key="mt7eacviadg4vhl7gsuvxdtl8j7gyfz7rjhvcs9ps4582vo8"
                            :init="{
                                toolbar_mode: 'sliding',
                                content_css: 'document',
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown print importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars export',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | forecolor backcolor | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | lineheight | fullscreen | numlist bullist | outdent indent | pagebreak | table',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'Author name',
                                
                            }"
                            style="height: 700px;"
                        />

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-danger rounded" @click="addmodal = false" >Close</button>
                    <button type="button"  class="btn btn-primary rounded" >Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale Add Report end-->

  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import Editor from '@tinymce/tinymce-vue'
export default {
    name:"ReportView",
    components:{
        Editor
    },
    data(){
        return{
            addmodal: false,
            allproject:[],
            currentUser:{},
        }
    },
    methods:{
        async AllPrj(){
            const res = await axiosInstance.get('/allproject')
            if (res.status === 200) {
                this.allproject = res.data.all
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
        ProjectFilter(){
            return this.allproject.filter(prj => prj.assignTo === this.currentUser.id)
        }
    },
    created(){
        this.AllPrj()
        this.CurrentUser()
    }
}
</script>

<style>

</style>