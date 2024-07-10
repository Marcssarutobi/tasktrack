<template>
  <div class="wrapper" v-if="side">

    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark" >
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="./assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item ">
              <router-link  to="/" class="link" >
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link  to="/project" class="link">
                <i class="fas fa-layer-group"></i>
                <p>Projects</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/task" class="link">
                <i class="fas fa-project-diagram"></i>
                <p>Task</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/calendar" class="link">
                <i class="fas fa-calendar"></i>
                <p>Calendar</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link  to="/notification" class="link">
                <i class="fas fa-bell"></i>
                <p>Notifications <span class="badge bg-success ms-3">{{ $store.state.notificationCount }}</span></p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link  to="/job" class="link">
                <i class="fas fa-briefcase"></i>
                <p>Job</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link  to="/role" class="link">
                <i class="fas fa-tag"></i>
                <p>Role</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/user" class="link">
                <i class="fas fa-user"></i>
                <p>User</p>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="./assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
              </div>
            </nav>

            <!-- navDesktop -->
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Search ..." class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>
              <!-- Onglet message -->
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-envelope"></i>
                </a>
                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                  <li>
                    <div class="dropdown-title d-flex justify-content-between align-items-center">
                      Messages
                      <a href="#" class="small">Mark all as read</a>
                    </div>
                  </li>
                  <li>
                    <div class="message-notif-scroll scrollbar-outer">
                      <div class="notif-center">
                        <a href="#">
                          <div class="notif-img">
                            <img src="assets/img/jm_denis.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="subject">Jimmy Denis</span>
                            <span class="block"> How are you ? </span>
                            <span class="time">5 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-img">
                            <img src="assets/img/chadengle.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="subject">Chad</span>
                            <span class="block"> Ok, Thanks ! </span>
                            <span class="time">12 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-img">
                            <img src="assets/img/mlane.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="subject">Jhon Doe</span>
                            <span class="block">
                              Ready for the meeting today...
                            </span>
                            <span class="time">12 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-img">
                            <img src="assets/img/talha.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="subject">Talha</span>
                            <span class="block"> Hi, Apa Kabar ? </span>
                            <span class="time">17 minutes ago</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Onglet message fin -->
               <!-- Onglet notification -->
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  <span class="notification">{{ $store.state.notificationCount }}</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                  <li>
                    <div class="dropdown-title">
                      You have {{ $store.state.notificationCount }} new notification
                    </div>
                  </li>
                  <li>
                    <div class="notif-scroll scrollbar-outer">
                      <div class="notif-center">

                        <a href="#" v-for="notif in allnotif" :key="notif.id">
                          <div class="notif-icon notif-primary">
                            <i class="fa fa-bell"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block"> {{ notif.subject }} </span>
                            <span class="time">{{ formatCommentDate(notif.created_at) }}</span>
                          </div>
                        </a>

                      </div>
                    </div>
                  </li>
                  <li>
                    <router-link class="see-all" to="/notification">See all notifications<i class="fa fa-angle-right"></i>
                    </router-link>
                  </li>
                </ul>
              </li>
               <!-- Onglet notification fin -->
               <!-- Onglet Action rapide -->
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fas fa-layer-group"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                  <div class="quick-actions-header">
                    <span class="title mb-1">Quick Actions</span>
                    <span class="subtitle op-7">Shortcuts</span>
                  </div>
                  <div class="quick-actions-scroll scrollbar-outer">
                    <div class="quick-actions-items">
                      <div class="row m-0">
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-danger rounded-circle">
                              <i class="far fa-calendar-alt"></i>
                            </div>
                            <span class="text">Calendar</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-warning rounded-circle">
                              <i class="fas fa-map"></i>
                            </div>
                            <span class="text">Maps</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-info rounded-circle">
                              <i class="fas fa-file-excel"></i>
                            </div>
                            <span class="text">Reports</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-success rounded-circle">
                              <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text">Emails</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-primary rounded-circle">
                              <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <span class="text">Invoice</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-secondary rounded-circle">
                              <i class="fas fa-credit-card"></i>
                            </div>
                            <span class="text">Payments</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <!-- Onglet Action rapide fin -->
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img src="./assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ currentUser.fistname }}</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="./assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4>{{ currentUser.fistname }}</h4>
                          <p class="text-muted">{{ currentUser.email }}</p>
                          <router-link to="/profil" class="btn btn-xs btn-secondary btn-sm">View Profile</router-link>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <router-link class="dropdown-item" to="/profil">My Profile</router-link>
                      <a class="dropdown-item" href="#">My Balance</a>
                      <a class="dropdown-item" href="#">Inbox</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Account Setting</a>
                      <div class="dropdown-divider"></div>
                      <span style="cursor:pointer;" class="dropdown-item" @click="logout">Logout</span>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
      <div class="container">
        <div class="page-inner">
          <router-view></router-view>
        </div>
      </div>


    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="selected changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="changeSideBarColor" data-color="white"></button>
              <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div>
    </div>
    <!-- End Custom template -->

  </div>
  <div v-else>
    <login />
  </div>
</template>

<script>
import login from './components/login.vue';
import axiosInstance from '@/plugins/axios';
import { formatDistance,format, isSameDay } from 'date-fns';
import { enUS } from "date-fns/locale";
export default {
  components:{
    login
  },
  name: 'App',
  data(){
    return {
      toggle_customSidebar: false,
      custom_open: 0,
      currentUser:{},
      allnotif:[],
      now: new Date(),
    }
  },
  mounted(){
    this.getCheckmark()
    this.Sentting()
    this.ChangeLogo()
    this.ChangeTopBar()
    this.ChangeSideBar()

    //la fonction qui actualise dynamiquement notre date
    setInterval(() => {
      this.now = new Date();
    }, 1000);
  },
  methods:{
    Sentting(){
      if (!this.toggle_customSidebar) {
        const toggle = document.querySelector(".custom-template .custom-toggle")
        toggle.addEventListener("click",()=>{
          const customTemplate = document.querySelector(".custom-template");
          if (this.custom_open === 1) {
            customTemplate.classList.remove("open");
            toggle.classList.remove("toggled");
            this.custom_open = 0
          }else{
            customTemplate.classList.add("open");
            toggle.classList.add("toggled");
            this.custom_open = 1
          }
        })
        this.toggle_customSidebar = true;
      }
    },
    ChangeLogo(){
      const Changelogo = document.querySelectorAll(".changeLogoHeaderColor")
      Changelogo.forEach((element)=>{
        element.addEventListener("click",()=>{

          const dataColor = element.getAttribute("data-color")
          const logoHeader = document.querySelector(".logo-header")

          if (dataColor === "default") {
            logoHeader.removeAttribute("data-background-color")
          }else{
            logoHeader.setAttribute("data-background-color", dataColor);
          }

          //remove the 'selected' class from all sibling
          const siblings = element.parentElement.querySelectorAll(".changeLogoHeaderColor")
          siblings.forEach((sibling) => {
            if (sibling !== element) {
              sibling.classList.remove("selected");
            }
          });

          // Add the 'selected' class to the clicked element
          element.classList.add("selected");
          this.customCheckColor()
          this.layoutsColors()
          this.getCheckmark()
        })
      })
    },
    ChangeTopBar(){
      const changeTopBar = document.querySelectorAll('.changeTopBarColor')
      changeTopBar.forEach((element)=>{
        const navHeader = document.querySelector(".main-header .navbar-header")
        element.addEventListener("click",()=>{
          if (element.getAttribute("data-color") === "default") {
            navHeader.removeAttribute("data-background-color")
          }else{
            navHeader.setAttribute("data-background-color",element.getAttribute("data-color"))
          }
          //remove 'selected' class from all siblings
          const siblings = element.parentElement.querySelectorAll(".changeTopBarColor")
          siblings.forEach((sibling)=>{
            sibling.classList.remove("selected")
          })
          //Add 'selected' class to clicked element
          element.classList.add("selected")

          this.layoutsColors()
          this.getCheckmark()
        })
      })
    },
    ChangeSideBar(){
      const changeSidebare = document.querySelectorAll(".changeSideBarColor")
      changeSidebare.forEach((element)=>{
        element.addEventListener('click',()=>{
          const SideBar = document.querySelector(".sidebar")
          if (element.getAttribute("data-color") === "default") {
            SideBar.removeAttribute("data-background-color")
          }else{
            SideBar.setAttribute("data-background-color",element.getAttribute("data-color"))
          }
          //remove 'selected' class from all siblings
          const siblings = element.parentElement.querySelectorAll(".changeSideBarColor")
          siblings.forEach((sibling)=>{
            sibling.classList.remove("selected")
          })

          //Add 'selected' class to clicked element
          element.classList.add("selected")

          this.layoutsColors()
          this.getCheckmark()

        })
      })
    },
    customCheckColor() {
      const logoHeader = document.querySelector(".logo-header").getAttribute("data-background-color");
      const navbarBrand = document.querySelector(".logo-header .navbar-brand");

      if (logoHeader !== "white") {
        navbarBrand.setAttribute("src", require("@/assets/img/kaiadmin/logo_light.svg"));
      } else {
        navbarBrand.setAttribute("src", require("@/assets/img/kaiadmin/logo_dark.svg"));
      }
    },
    layoutsColors() {
      const sidebar = document.querySelector('.sidebar');
      const html = document.querySelector('html');

      if (sidebar.hasAttribute('data-background-color')) {
        html.classList.add('sidebar-color');
      } else {
        html.classList.remove('sidebar-color');
      }
    },
    getCheckmark() {
      const checkmark = '<i class="gg-check"></i>';
      const btnSwitch = document.querySelector('.btnSwitch');
      const buttons = btnSwitch.querySelectorAll('button');

      buttons.forEach(function(button) {
        button.innerHTML = ''; // Vide le contenu de chaque bouton
      });

      const selectedButtons = btnSwitch.querySelectorAll('button.selected');

      selectedButtons.forEach(function(button) {
        button.innerHTML = checkmark; // Ajoute la coche au contenu du bouton sélectionné
      });
    },
    async logout() {
      const res = await axiosInstance.post('/logout', null, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`
        }
      })
      if (res.status === 200) {
        localStorage.removeItem('token')
        this.currentUser = {}
        this.$router.push("/login")
      }
    },
    async AllNotification(){
        const res = await axiosInstance.get('/allnotif')
        if (res.status === 200) {
            this.allnotif = res.data.notif4
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
    formatCommentDate(date) {
      const commentDate = new Date(date);

      if (isSameDay(commentDate, this.now)) {
          return formatDistance(commentDate, this.now, { locale: enUS, addSuffix: true });
      } else {
          return format(commentDate, "d MMMM yyyy 'at' HH:mm", { locale: enUS });
      }
    },
  },
  computed:{
    side(){
      return this.$route.path !== '/login'
    },
  },
  created() {
    this.CurrentUser()
    this.AllNotification()
  },
  
}
</script>

<style>
  .nav-item .router-link-active.link{
    background: #151a2b;
  }
  .nav-item .router-link-active.link i{
    color: #6861ce;
  }
  .nav-item .router-link-active.link p{
    color: #fff;
  }
</style>
