<template>
  <div>
    
    <div class="page-header">
        <h3 class="fw-bold mb-3">Calendar</h3>
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
                <router-link to="/calendar">Calendar</router-link>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">

            <Fullcalendar :options="calendarPlugins" :events="calendarEvents" />

        </div>
    </div>

  </div>
</template>

<script>
import Fullcalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import axiosInstance from '@/plugins/axios';
export default {
    components:{
        Fullcalendar
    },
    name:'CalendarVue',
    data(){
        return {
            calendarPlugins:{
                plugins: [dayGridPlugin,timeGridPlugin,interactionPlugin,listPlugin],
                headerToolbar: {
                    left: 'title',
                    center: 'dayGridMonth,timeGridWeek,timeGridDay',
                    right: 'today prev,next'
                },
                initialView: 'dayGridMonth',
                weekends: true,
                viewDidMount: function() {
                    document.querySelectorAll('.fc-prev-button, .fc-next-button, .fc-button').forEach(button => {
                        button.classList.add('btn', 'btn-primary','me-2');
                    });
                },
                events:[]
            },
            allproject: {},
            
        }
    },
    methods: {
        async AllProject() {
            const res = await axiosInstance.get('/allproject')
            if (res.status === 200) {
                this.allproject = res.data.all
                const events = this.allproject.map(prj => ({
                    title: prj.name,
                    start: prj.startDate,
                    end: prj.endDate
                }))
                this.calendarPlugins.events = events
            }
        },
    },
    created() {
        this.AllProject()
    }
}
</script>

<style>
    .fc-event{
        background: #4287f5;
        color: #fff;
    }
    .fc-col-header-cell-cushion{
        font-weight: 800;
        color: #fff;
    }
    .fc-button{
        background: #4287f5;
        color: #fff;
    }
    .fc-col-header-cell{
        background: #151a2b;
    }
</style>