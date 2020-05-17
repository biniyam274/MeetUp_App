<template>
  <v-container class="fill-height">
     <app-alert @dismissed="onDismissed" v-if="error" :text="error"></app-alert>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="7">
        <v-card class="elivation- 6" align="center">
          <v-toolbar class="secondary" >
            <v-toolbar-title class="">
              Sign Up
            </v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" align="center" >
              <v-text-field
                v-model="name"
                label="Username"
                required
              ></v-text-field>
              <v-text-field
                v-model="email"
                label="E-mail"
                required
              ></v-text-field>
              <v-text-field
                v-model="password"
                label="Password"
                type="password"
                required
              ></v-text-field>
              <v-btn color="primary" :disabled="loading" @click="signUp">
                Sign Up
              </v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      email:'',
      password:'',
      name:'',
    }
  },
  computed: {
    user(){
      return this.$store.getters.user;
    },
    loading(){
       return this.$store.getters.loading;
    },
    error(){
      return this.$store.getters.error
    }
  },
  watch: {
  user(value){
    if(value !== null && value !== undefined){
      this.$router.push('/');
    }
  }
  },
  methods:{
    signUp(){
      this.$store.dispatch('signUserUp',{
        email:this.email,
        password:this.password,
        name:this.name
      })
    },
  onDismissed(){
    this.$store.dispatch('clearError')
  }
  }
}
</script>