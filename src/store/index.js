import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);

const url = "http://127.0.0.1:8000/api";

export const store = new Vuex.Store({
  state: {
    loadedMeetups: null,
    user: null,
    loading:false,
    error:null,
    token:null
  },
  mutations: {
    addMeetup(state, payload) {
      state.loadedMeetups.push(payload);
    },
    deleteMeetup(state,id){
      delete state.loadedMeetups.filter((element)=>{
        element.id = id
      });
    },
    loadMeetups(state, payload) {
      state.loadedMeetups = payload;
    },
    UpdateMeetups(state, payload) {
      state.loadedMeetups = payload;
    },
    setUser(state, payload) {
      state.user = payload;
    },
    setLoading(state, payload) {
      state.loading = payload;
    },
    setError(state, payload) {
      state.error = payload;
    },
    clearError(state){
      state.error = null;
    },
    setToken(state, payload) {
      state.token = payload;
      localStorage.setItem('access_token',payload)
    },
    clearToken(state){
      state.token = null;
      localStorage.setItem('access_token',"");
    }
  },
  actions: {
    getMeetups({commit}) {
      commit("setLoading", true);
      axios
        .get(url + "/meetups",)
        .then(response => {
          console.log(response.data.data);
          commit("UpdateMeetups", response.data.data);
          commit("setLoading", false);
        })
        .catch(
          error => {
            commit("setLoading", false);
            console.error(error)}
          
          );
    },
    createMeetup({commit},payload) {
      let formdata = new FormData()
      formdata = payload
      console.log("Payload :"+formdata);
      axios
        .post("http://127.0.0.1:8000/api/meetup",formdata)
        .then(response => {
          console.log(response);
          commit("addMeetup", response.data);
        })
        .catch(response => console.log(response));
     
    },
    deleteMeetup({commit},id) {
      
      axios
        .delete("http://127.0.0.1:8000/api/meetup/"+id)
        .then(response => {
          console.log(response);
          commit("deleteMeetup", id);
        })
        .catch(response => console.log(response));
     
    },
    fetchAllMeetups({ commit }, meetups) {
      commit("loadMeetups", meetups);
    },
    signUserUp({ commit }, payload) {
      commit("setLoading", true);
      axios
        .post(url + "/signup", {
          username: payload.username,
          email: payload.email,
          password: payload.password
        })
        .then(response => {
          if(response.data.error !== null){
            commit("setError", response.data.error);
          }
          commit("setLoading", false);
          const newUser ={
            id:response.data.user.id,
            registeredMeetups:response.data.meetups
          }
          
          console.log("User Data:"+response.data);
          commit("setUser",newUser );
        })
        .catch(error => {
          commit("setLoading", false);
          commit("setError", error);
          console.error(error);
        });
    },
    signUserIn({ commit }, payload) {
      commit("setLoading", true);
      axios
        .post(url + "/signin", {
          email: payload.email,
          password: payload.password
        })
        .then(response => {
          let access_token = response.data.access_token;
          let error = response.data.error;
          if(error !== null){
            commit("setError", error);
          }
          if(access_token !== null){
            //save data
            commit("setToken", access_token);
          }
          commit("setLoading", false);
          
          const newUser ={
            id:response.data.user.id,
            registeredMeetups:response.data.meetups
          }
          console.log("User Data:"+response.data);
          commit("setUser",newUser );
        })
        .catch(error => {
          commit("setLoading", false);
          commit("setError", error);
          console.error(error);
        });
    },
    clearError({commit}){
      commit("clearError");
    }
  },
  getters: {
    loadMeetup() {},
    loadedMeetups(state) {
      return state.loadedMeetups;
    },
    feturedMeetups(state, getters) {
      return getters.loadedMeetups.slice(0, 4);
    },
    user(state) {
      return state.user;
    },
    loading(state) {
      return state.loading;
    },
    error(state) {
      return state.error;
    }
    ,
    token(state) {
      return state.token;
    }
  }
});
