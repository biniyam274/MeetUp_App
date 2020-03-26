import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import SignIn from '../components/User/signin.vue'
import SignUp from '../components/User/signup.vue'
import Profile from '../components/User/profile.vue'
import MeetUps from '../components/MeetUp/meetups.vue'
import MeetUp from '../components/MeetUp/meetup.vue'
import CreatMeetUp from '../components/MeetUp/createmeetup.vue'
import DeleteMeetup from '../components/Shared/RegisterDialog'

Vue.use(Router)
export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      props: true
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignUp,
      props:true
    }
    ,
    {
      path: '/signin',
      name: 'signin',
      component: SignIn,
      props:true
    }
    ,
    {
      path: '/profile',
      name: 'profile',
      component: Profile,
      props: true
    }
    ,
    {
      path: '/meetup/new',
      name: 'createmeetup',
      component: CreatMeetUp,
      props: true
    }
    ,
    {
      path: '/meetup/delete/:id',
      name: 'deletemeetup',
      component: DeleteMeetup,
      props: true
    }
    ,
    {
      path: '/meetup/:id',
      name: 'meetup',
      props:true,
      component: MeetUp
    }
    ,
    {
      path: '/meetups',
      name: 'meetups',
      component: MeetUps,
      props: true
    }

  ]
})
