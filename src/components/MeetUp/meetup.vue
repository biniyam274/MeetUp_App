<template>
  <v-card class="mx-auto my-10" max-width="85%">
    <v-container>
      <v-layout column>
        <v-flex>
          <v-img
            class="white--text align-end"
            height="350px"
            alt="No Image"
          >
            <v-card-title> {{ meetup.title }}</v-card-title>
          </v-img>
        </v-flex>
        <v-flex>
          <v-card-subtitle class="pb-0">Intrested peple : 9</v-card-subtitle>
        </v-flex>
        <v-flex>
          <v-card-text class="text--primary">
            <p>Description : {{ meetup.description }}</p>
          </v-card-text>
        </v-flex>
        <v-flex>
          <v-layout row wrap>
            <v-flex class="text-center">
              <v-card-actions>
                <v-btn flat :to="'/meetup/edit/' + meetup.id">
                  <v-icon>mdi-arrow-right</v-icon>
                  Edit Meetup
                </v-btn>
              </v-card-actions>
            </v-flex>
            <v-flex class="text-center">
              <v-card-actions>
                 <v-btn  @click="dialog = true" flat >
                      <v-icon>mdi-edit</v-icon>
                      Delete
                    </v-btn>
                <v-dialog v-model="dialog" persistent max-width="290">
                  <v-card>
                    <v-card-title class="headline"
                      >Are you Sure To delete?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="green darken-1" text @click="dialog = false"
                        >Cancel</v-btn
                      >
                      <v-btn color="green darken-1" text @click="onDelete"
                        >Delete</v-btn
                      >
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-card-actions>
            </v-flex>
          </v-layout>
          <v-spacer></v-spacer>
            <v-layout row wrap>
               <v-flex class="text-center" v-show="IsRegister">
              <v-card-actions>
                 <v-btn  @click="dialog = true" flat class="error">
                      <v-icon>mdi-edit</v-icon>
                     Register to Event
                    </v-btn>
                <v-dialog v-model="me" persistent max-width="400">
                  <v-card>
                    <v-card-title class="headline"
                      >Do you want to register to this Meetup?</v-card-title
                    >
                    <v-card-text
                      >Let Google help apps determine location. This means
                      sending anonymous location data to Google, even when no
                      apps are running.</v-card-text
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="green darken-1" text @click="dialog = false"
                        >Cancel</v-btn
                      >
                      <v-btn color="green darken-1" text @click="onDelete"
                        >Delete</v-btn
                      >
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-card-actions>
            </v-flex>
            </v-layout>
        </v-flex>
      </v-layout>
    </v-container>
  </v-card>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      meetup: null,
      dialog:false
    };
  },
  methods: {
    onDelete(){
      this.$store.dispatch("deleteMeetup",this.id);
      this.dialog =!this.dialog
       this.$router.push("/");
    }
  },
  computed: {
    getUser() {
      return this.$store.getters.user;
    }
  },
  mounted() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }
    this.meetup = this.$store.getters.loadedMeetups
      .filter((element) => {
        return element.id == this.id;
      })
      .shift();
  },
  created() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }
    console.log("Register :"+this.register);
  }
};
</script>
