<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">Profil</h3>
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
                <router-link to="/profil">Profil</router-link>
            </li>
        </ul>
    </div>
    <div class="row gx-3">
        <div class="col-lg-4">
            <div class="card card-profile">
                <div class="card-header" :style="{ backgroundImage: `url(${backgroundImage})` }">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">Hizrian, 19</div>
                        <div class="job">Frontend Developer</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            
        </div>
    </div>

  </div>
</template>

<script>
import backgroundImage from '@/assets/img/blogpost.jpg'
export default {
    name:'ProfilVue',
    data() {
        return {
            backgroundImage,
        };
    }
}
</script>

<style>

</style>