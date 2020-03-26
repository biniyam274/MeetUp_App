<template>
  <v-container class="fill-height" fluid>
    <app-alert @dismissed="onDismissed" v-if="error" :text="error"></app-alert>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="7">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Login form</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field label="Login" v-model="email" type="text" />
              <v-text-field
                label="Password"
                v-model="password"
                type="password"
              />
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn color="primary" @click="signIn" :disabled="loading">Login</v-btn>
          </v-card-actions>
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
    // user(value) {
    //   if (value !== null && value !== undefined) {
    //     this.$router.push("/");
    //   }
    // }
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
