<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">Your notifications</h3>
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
                <router-link to="/notification">Notification</router-link>
            </li>
        </ul>
    </div>

    <div class="row gx-2">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notification (10)</h4>
                </div>
                <div class="card-body" style="height: 650px; overflow-y: scroll;">
                    <div class="msg p-3 mb-3" style="border-left: 5px solid #151a2b;cursor: pointer;">
                        <div class="info">
                            <h4 class="fw-bold">New tasks</h4>
                            <p class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, incidunt velit maiores ipsa dolore eius rerum </p>
                        </div>
                        <div class="breadcrumbs ms-2 btns">
                            <button class="btn btn-white border"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="msg p-3 mb-3" style="border-left: 5px solid #151a2b;cursor: pointer;">
                        <div class="info">
                            <h4 class="fw-bold">New tasks</h4>
                            <p class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, incidunt velit maiores ipsa dolore eius rerum </p>
                        </div>
                        <div class="breadcrumbs ms-2 btns">
                            <button class="btn btn-white border"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="msg p-3 mb-3" style="border-left: 5px solid #151a2b;cursor: pointer;">
                        <div class="info">
                            <h4 class="fw-bold">New tasks</h4>
                            <p class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, incidunt velit maiores ipsa dolore eius rerum </p>
                        </div>
                        <div class="breadcrumbs ms-2 btns">
                            <button class="btn btn-white border"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="msg p-3 mb-3" style="border-left: 5px solid #151a2b;cursor: pointer;">
                        <div class="info">
                            <h4 class="fw-bold">New tasks</h4>
                            <p class="txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, incidunt velit maiores ipsa dolore eius rerum </p>
                        </div>
                        <div class="breadcrumbs ms-2 btns">
                            <button class="btn btn-white border"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New tasks</h4>
                </div>
                <div class="card-body" style="height: 650px;">
                    <p style="text-align: justify;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam beatae consequuntur velit hic, aperiam pariatur in ab, quos cumque nesciunt aspernatur fuga sequi sed dolore totam tenetur maxime quo rem.
                    Temporibus eligendi tempora totam consequuntur vel libero pariatur cumque modi rerum, aperiam impedit velit aut fugiat corrupti incidunt ad, necessitatibus a qui sed veniam. Facilis quas nesciunt modi minima magnam?
                    Accusantium, nam necessitatibus magnam asperiores, porro laborum incidunt veniam minima nulla suscipit corporis tempore. Vero expedita quo eaque earum consequatur aspernatur magni distinctio assumenda delectus, accusantium, placeat, nesciunt facere ratione.
                    Quisquam, itaque labore? Odit rem quasi, sit optio hic aliquam recusandae doloribus in voluptas. Neque unde itaque, ullam sit eveniet culpa quibusdam tempore, laudantium rem vero eligendi eum, porro officia.
                    Quas non esse saepe. Itaque repudiandae consequatur modi quisquam impedit. Possimus modi aliquam quam, explicabo voluptatum architecto rerum esse reiciendis. Dolores quas aut, laboriosam earum eveniet consectetur quo voluptatem atque.</p>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {
    name:"NoticationVue",
}
</script>

<style>
    .msg{
        background: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, .5);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .msg .txt{
        width: 100%;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden; 
        text-overflow: ellipsis;
        margin: 0;
        max-height: 30px;
    }
</style>