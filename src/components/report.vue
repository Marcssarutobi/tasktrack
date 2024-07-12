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
                    <h4 class="card-title">Report ({{ count }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Project Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr v-for="rpt in allreport" :key="rpt.id">
                                    <th scope="row">{{ GetProject(rpt.prj_id) }}</th>
                                    <td scope="row">{{ formatCommentDate(rpt.created_at) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetReportView(rpt.id)" >View</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="GetReportUpdate(rpt.id)" >Update</span>
                                                <span style="cursor: pointer;" class="dropdown-item fw-1" @click="DeleteReport(rpt.id)" >Delete</span>
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
                       <Paginate v-model="currentPage" :page-count="totalPage" :clickHandler="AllReport" :prevText="'Prev'" :nextText="'Next'" :container-class="'pagination justify-content-end'" :page-class="'page-item'"></Paginate>
                    </div>
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
                        <select name="" class=" form-select" id="" style="height: 50px;" :class="isEmpty.prj_id ? 'is-invalid' : ''" v-model="data.prj_id">
                            <option selected disabled value="">Select Project</option>
                            <option v-for="prj in ProjectFilter" :key="prj.id" :value="prj.id">{{ prj.name }}</option>
                        </select>
                        <div v-if="isEmpty.prj_id" class="invalid-feedback">
                            The field is empty
                        </div>
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
                            v-model="data.content"
                            :class="isEmpty.content ? 'is-invalid' : ''"
                        />
                        <div v-if="isEmpty.content" class="invalid-feedback">
                            The field is empty
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-danger rounded" @click="addmodal = false" >Close</button>
                    <button type="button"  class="btn btn-primary rounded" @click="AddReport" >Create</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modale Add Report end-->

    <!-- Modal View -->
    <div v-if="viewmodal" class="modal fade show"   tabindex="-1" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, .5);">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-header">
                    <h5 class="modal-title">View Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="viewmodal = false" aria-label="Close"></button>
                </div>
                <div class=" modal-body">
                    
                    <div class="document-style" ref="invoiceContent">
                        <h2>Project report : {{ GetProject(getreport.prj_id) }}</h2>
                        <div v-html="getreport.content"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-danger rounded" @click="viewmodal = false" >Close</button>
                    <button type="button"  class="btn btn-primary rounded" @click="generatePDF" >Export as PDF</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View End -->

    <!-- Modale Update Report -->
    <div v-if="updatemodal" class="modal fade show"   tabindex="-1" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, .5);">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-header">
                    <h5 class="modal-title">Update Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="updatemodal = false" aria-label="Close"></button>
                </div>
                <div class=" modal-body">
                    <div class="form-group">
                        <label for="">Project Name :</label>
                        <select name="" class=" form-select" id="" style="height: 50px;" :class="isEmpty.prj_id ? 'is-invalid' : ''" v-model="getreport.prj_id">
                            <option selected disabled value="">Select Project</option>
                            <option v-for="prj in ProjectFilter" :key="prj.id" :value="prj.id">{{ prj.name }}</option>
                        </select>
                        <div v-if="isEmpty.prj_id" class="invalid-feedback">
                            The field is empty
                        </div>
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
                            v-model="getreport.content"
                            :class="isEmpty.content ? 'is-invalid' : ''"
                        />
                        <div v-if="isEmpty.content" class="invalid-feedback">
                            The field is empty
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-danger rounded" @click="updatemodal = false" >Close</button>
                    <button type="button"  class="btn btn-primary rounded" @click="UpdateRepor" >Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modale Update Report end-->

  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios';
import Editor from '@tinymce/tinymce-vue'
import Swal from 'sweetalert2';
import { formatDistance,format, isSameDay } from 'date-fns';
import { enUS } from "date-fns/locale";
import Paginate from 'vuejs-paginate-next'
import  html2pdf  from 'html2pdf.js';
export default {
    name:"ReportView",
    components:{
        Editor,
        Paginate
    },
    data(){
        return{
            addmodal: false,
            viewmodal: false,
            updatemodal: false,
            allproject:[],
            currentUser:{},
            isEmpty: {},
            data:{
                prj_id:"",
                content:""
            },
            allreport:[],
            currentPage: 1,
            totalPage: 0,
            now: new Date(),
            getreport:{},
            count:0
        }
    },
    mounted(){
        //la fonction qui actualise dynamiquement notre date
        setInterval(() => {
        this.now = new Date();
        }, 1000);
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
        },
        EmptyResult(){
            if (this.data.prj_id == "") {
                this.isEmpty.prj_id = true
            } else {
                this.isEmpty.prj_id = false
            }
            if (this.data.content.trim() == "") {
                this.isEmpty.content = true
            } else {
                this.isEmpty.content = false
            }
        },
        async AddReport(){
           try {
                this.EmptyResult()
                const allEmpty = Object.values(this.isEmpty).every(value => value === false)
                if (allEmpty) {
                    const res = await axiosInstance.post('/createreport', this.data)
                    if (res.status === 200) {
                        this.allreport.unshift(res.data.report)
                        this.count = this.count + 1
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Registration completed successfully",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.data.prj_id = ""
                        this.data.content = ""
                        this.addmodal = false
                    }
                    
                }else{
                    this.addmodal = true
                }
            } catch (error) {
                console.log(error)
            
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "A report already exists for this project",
                    showConfirmButton: false,
                    timer: 1500
                })
                this.addmodal = true
            }
        },
        async AllReport(){
            const res = await axiosInstance.get('/allreport')
            if (res.status === 200) {
                this.allreport = res.data.report9.data
                this.currentPage = res.data.report9.current_page
                this.totalPage = res.data.report9.last_page
                this.count = res.data.count
            }
        },
        GetProject(id) {
            const Users = this.allproject.find(prj => prj.id === id)
            return Users ? Users.name  : ''
        },
        formatCommentDate(date) {
            const commentDate = new Date(date);

            if (isSameDay(commentDate, this.now)) {
                return formatDistance(commentDate, this.now, { locale: enUS, addSuffix: true });
            } else {
                return format(commentDate, "d MMMM yyyy 'at' HH:mm", { locale: enUS });
            }
        },
        async GetReportView(id){
            this.viewmodal = true
            const res = await axiosInstance.get('/getreport/'+id)
            if (res.status === 200) {
                this.getreport = res.data.report
            }
        },
        async GetReportUpdate(id){
            this.updatemodal = true
            const res = await axiosInstance.get('/getreport/'+id)
            if (res.status === 200) {
                this.getreport = res.data.report
            }
        },
        generatePDF(){
            try {
                const invoiceContent = this.$refs.invoiceContent
                const option = {
                    margin:0,
                    filename: this.GetProject(this.getreport.id),
                    image: {type: 'jpeg',quality: 0.98},
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait', },
                }
                html2pdf(invoiceContent,option)
            } catch (error) {
                console.log(error)
            }
        },
        async UpdateRepor(){
            const res = await axiosInstance.post('/updatereport',this.getreport)
            if (res.status === 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Edit completed successfully",
                    showConfirmButton: false,
                    timer: 1500
                })
                const index = this.allreport.findIndex(rpt => rpt.id === this.getreport.id)
                if (index !== -1) {
                    this.allreport[index] = this.getreport
                }
                this.getreport = {}
                this.updatemodal = false
            }
        },
        async DeleteReport(id){
            const res = await axiosInstance.get('/getreport/'+id)
            if (res.status === 200) {
                this.getreport = res.data.report
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
                        const del = await axiosInstance.post('/deletereport', this.getreport)
                        if (del.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Delete perform",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.count = this.count - 1
                            const index = this.allreport.findIndex(rpt => rpt.id === this.getreport.id)
                            if (index !== -1) {
                                this.allreport.splice(index, 1)
                            }
                        }
                    }
                })
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
        this.AllReport()
    }
}
</script>

<style>
.document-style {
    padding: 20px;
    background-color: #fff;
    max-height: 70vh;
    overflow-y: auto;
}
</style>