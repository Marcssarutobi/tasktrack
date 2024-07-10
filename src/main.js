import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createStore } from "vuex";

const store = createStore({
    state:{
        notificationCount: 0
    },
    mutations:{
        updateNotificationCount(state,count){
            state.notificationCount = count
        }
    }
})



const app = createApp(App)

app.use(router)
app.use(store)
app.mount('#app')
