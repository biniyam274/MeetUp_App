<template>
  <v-container class="grey lighten-5">
    <v-layout row wrap xs12 md6 sm6 class="mt-3" v-if="loading">
      <v-flex class="text-center">
        <v-progress-circular indeterminate size="100" color="green"></v-progress-circular>
        <v-progress-circular indeterminate size="100" color="red"></v-progress-circular>
        <v-progress-circular indeterminate size="100" color="purple"></v-progress-circular>
      </v-flex>
    </v-layout>
    <v-layout row wrap xs12 md6 sm6 class="mt-3">
      <v-flex class="text-center">
        <v-carousel>
          <v-carousel-item
            v-for="(item, i) in this.meetups"
            :key="i"
            
            @click="onLoadMeetUp(item.id)"
            reverse-transition="fade-transition"
            transition="fade-transition"
            
          >
          <!-- <v-carousel-item
            v-for="(item, i) in this.meetups"
            :key="i"
            :src="require('../../server/public/' + item.imageUrl)"
            @click="onLoadMeetUp(item.id)"
            reverse-transition="fade-transition"
            transition="fade-transition"
            alt="No Image"
          > -->
            <div class="title">{{ item.title }}</div>
          </v-carousel-item>
        </v-carousel>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
    getUser() {
      return this.$store.getters.user;
    }
  },
  data() {
    return {
      meetups: []
    };
  },
  methods: {
    onLoadMeetUp(id) {
      this.$router.push("/meetup/" + id);
    },
    onQuoteDeleted(id) {
      const position = this.quotes.findIndex(element => {
        return (element.id = id);
      });
      this.quotes.splice(position, 1);
    },
    onQuoteUpdated() {}
  },
  created() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }
    if(!this.$store.getters.loadedMeetups){
    this.$store.dispatch("getMeetups");
    }
     this.meetups = this.$store.getters.loadedMeetups;
  },
  mounted() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }
     this.meetups = this.$store.getters.loadedMeetups;
  },
};
</script>
<style scoped>
.title {
  position: absolute;
  bottom: 50px;
  padding: 10px;
  color: white;
  background-color: rgb(0, 0, 0, 0.7);
}
</style>
