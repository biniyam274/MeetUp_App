<template>
  <v-container class="fill-height" fluid>
    <app-alert @dismissed="onDismissed" v-if="error" :text="error"></app-alert>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="7">
        <v-card class="elevation-12"  align="center" justify="center">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Login </v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" align="center" >
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
              <v-btn color="primary" @click="signIn" :disabled="loading">Login</v-btn>
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
      email: "",
      password: "",
      username: ""
    };
  },
  computed: {
    getUser(){
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
    
  },
  methods: {
    signIn() {
      const payload = {
        email: this.email,
        password: this.password,
        username: this.username
      };
      this.$store.dispatch("signUserIn", payload);
      if( this.getUser !== null && this.getUser !== undefined){
        this.$router.push('/')
      }else{
         this.$router.push('/signup');
      }
    }
  },
  onDismissed() {
    this.$store.dispatch("clearError");
  }
};
</script>
