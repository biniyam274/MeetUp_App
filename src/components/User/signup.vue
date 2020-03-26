<template>
  <v-container class="fill-height">
     <app-alert @dismissed="onDismissed" v-if="error" :text="error"></app-alert>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="7">
        <v-card class="elivation- 6">
          <v-toolbar class="secondary">
            <v-toolbar-title>
              Sign Up Form
            </v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form">
              <v-text-field
                v-model="username"
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
              <v-btn color="warning" :disabled="loading" @click="signUp">
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
      username:'',
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
      const payload = {
        email:this.email,
        password:this.password,
        username:this.username
      }
      this.$store.dispatch('signUserUp',payload)
      // this.$router.push('/');
    },
  onDismissed(){
    this.$store.dispatch('clearError')
  }
  }
}
</script>