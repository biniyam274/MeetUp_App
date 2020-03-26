<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-account-supervisor-circle</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>MeetUps</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>New MeetUp</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Profile</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
         <v-list-item link>
          <v-list-item-action>
            <v-btn small color="primary" to="/logout">Logout</v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app color="indigo">
      <v-app-bar-nav-icon @click.native.stop="drawer = !drawer" />
      <v-toolbar-title>
        <v-btn text to="/">
          Dev-MeetUps
        </v-btn>
      </v-toolbar-title>
      <v-layout>
        <template v-if="getUser ">
         <v-spacer></v-spacer>
        <v-flex class="text-right">
          <v-btn text to="/meetups"> MeetUps </v-btn>
        </v-flex>
        <v-flex class="text-center">
          <v-btn text to="/meetup/new">
            <v-icon>mdi-plus</v-icon>
            Organize meetUp
          </v-btn>
        </v-flex>
        <v-flex class="text-left">
          <v-btn text to="/profile">
            <span>
              <v-icon text left>mdi-account</v-icon>
              Profile
            </span>
          </v-btn>
        </v-flex>
        </template>
        <template v-else>
         <v-flex class="text-center">
          <v-btn text to="/signup">
            <span>
              <v-icon small left>mdi-face</v-icon>
              <strong>Sign Up</strong>
            </span>
          </v-btn>
        </v-flex>
        <v-flex  class="text-center">
          <v-btn text to="/signin">
            <span>
              <v-icon small left>mdi-lock</v-icon>
              <strong>Sign In</strong>
            </span>
          </v-btn>
        </v-flex>
        </template>
      </v-layout>
    </v-app-bar>

    <main>
      <v-content>
        <router-view></router-view>
      </v-content>
    </main>
    <v-footer color="indigo" app>
      <v-layout row warp>
        <v-flex class="text-center">
          <p>&copy; 2019</p>
        </v-flex>
      </v-layout>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String
  },
  data() {
    return {
      drawer: false,
    };
  },
   computed: {
    getUser(){
      return this.$store.getters.user;
    }
  }
  ,
  mounted() {
    if(this.getUser == null && this.getUser == undefined){
      this.$router.push('/signin');
    }
  },
};
</script>
