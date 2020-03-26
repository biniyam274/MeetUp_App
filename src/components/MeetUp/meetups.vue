<template>
  <v-container>
    <v-card
      style="margin:20px;"
      v-for="meetup in this.meetups"
      :key="meetup.id"
      class="mx-auto"
      width="90%"
      dark
    >
      <v-container fluid>
        <v-layout row wrap>
          <v-flex xs12 sm4 md6>
            <v-img
              height="80%"
              class="my-10 mx-3"
              :src="require('@/../server/public/' + meetup.imageUrl)"
            ></v-img>
          </v-flex>
          <v-flex xs12 sm8 md6>
            <v-card-title>{{ meetup.title }}</v-card-title>
            <v-card-text>
              <v-row align="center" class="mx-0">
                <v-rating :value="4" color="amber" dense half-increments readonly size="14"></v-rating>
                <div class="grey--text ml-4">4.5 (413)</div>
              </v-row>
              <div class="my-4 subtitle-1">{{meetup.location}}</div>
              <div>
                <p>Description : {{meetup.description}}</p>
              </div>
            </v-card-text>
            <v-divider class="mx-4"></v-divider>
            <v-card-title>Time Of Meetup</v-card-title>
            <v-card-text>
              <v-chip-group
                active-class="deep-purple accent-4 white--text"
                column
              >
                <v-chip>{{ meetup.date | date }}</v-chip>
              </v-chip-group>
            </v-card-text>
            <v-layout row wrap>
              <v-flex>
                <v-card-actions>
                  <v-btn color="deep-purple lighten-2" :to="'/meetup/'+meetup.id">
                    <v-icon>mdi-arrow-right</v-icon>See Meetup
                  </v-btn>
                </v-card-actions>
              </v-flex>
              <v-flex>
                <v-card-actions>
                  <v-btn color="deep-purple lighten-2" href="#">
                    <v-icon>mdi-edit</v-icon>Edit Meetup
                  </v-btn>
                </v-card-actions>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      meetups: []
    };
  },
  computed: {
    getUser(){
      return this.$store.getters.user
    }
  },
  methods: {},
  created() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }
    this.meetups = this.$store.getters.loadedMeetups
    
  }
};
</script>
