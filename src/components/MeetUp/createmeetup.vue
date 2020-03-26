<template>
  <v-layout>
    <v-flex>
      <v-container>
        <v-form @submit.prevent="onSaveMeetup" style="width:80%;height:50%;" class="mx-auto my-100">
          <v-layout row>
            <v-flex xs12>
              <v-text-field v-model="meetup.title" :counter="25" label="Title" required></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field v-model="meetup.location" label="Location" required></v-text-field>
              <v-textarea v-model="meetup.description" filled label="Description" auto-grow></v-textarea>
              <v-file-input
                v-model="files"
                color="deep-purple accent-4"
                counter
                label="File input"
                multiple
                placeholder="Select your files"
                prepend-icon="mdi-paperclip"
                outlined
                @change="onFilePicked"
                :show-size="1000"
              >
                <template v-slot:selection="{ index, text }">
                  <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>{{ text }}</v-chip>

                  <span
                    v-else-if="index === 2"
                    class="overline grey--text text--darken-3 mx-2"
                  >+{{ files.length - 2 }} File(s)</span>
                </template>
              </v-file-input>
            </v-flex>
            <v-flex xs12>
              <v-row>
                <v-col cols="6" sm="5">
                  <v-menu
                    ref="menu"
                    v-model="menu2"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field v-model="time" label="Pick Time" readonly v-on="on"></v-text-field>
                    </template>
                    <v-time-picker
                      v-if="menu2"
                      v-model="time"
                      full-width
                      @click:minute="$refs.menu.save(time)"
                    ></v-time-picker>
                  </v-menu>
                  <p>
                    Time:
                    <strong>{{ time }}</strong>
                  </p>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="6" lg="6">
                  <v-menu
                    ref="menu1"
                    v-model="menu1"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="time"
                        label="Date"
                        hint="MM/DD/YYYY format"
                        persistent-hint
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                  </v-menu>
                  <p>
                    Date in ISO format:
                    <strong>{{ this.date }}</strong>
                  </p>
                </v-col>
              </v-row>
              <br />
              <v-row justify="center">
                <v-btn color="warning" type="submit" :disabled="!formIsValid">Save</v-btn>
                <v-btn color="error" class="ml-4" @click="cancel">Cancel</v-btn>
              </v-row>
            </v-flex>
          </v-layout>
        </v-form>
      </v-container>
    </v-flex>
  </v-layout>
</template>

<script>
// import axios from "axios";
export default {
  data() {
    return {
      files: [],
      image: null,
      meetup: {
        title: "",
        location: "",
        imageUrl: "",
        description: "",
        date: null
      },
      time: "",
      modal2: false,
      date: null,
      menu1: false,
      menu2: false
    };
  },

  computed: {
    getUser(){
        return this.$store.getters.user;
    },
    formIsValid() {
      return (
        this.meetup.title !== "" &&
        this.meetup.location !== "" &&
        this.meetup.description !== ""
      );
    }
  },
  created() {
    if (this.getUser == null && this.getUser == undefined) {
      this.$router.push("/signin");
    }},

  methods: {
    submitableDate() {
      let date = new Date();
      if (this.time != "") {
        const year = Number.parseInt(this.date.split("-")[0]);
        date.setFullYear(year);
        const month = Number.parseInt(this.date.split("-")[1]);
        date.setMonth(month - 1);
        const day = Number.parseInt(this.date.split("-")[2]);
        date.setDate(day);
        console.log(this.date.split("-"));
        const hour = Number.parseInt(this.time.split(":")[0]);
        date.setHours(hour);
        const minute = Number.parseInt(this.time.split(":")[1]);
        date.setMinutes(minute);
        date.setSeconds(0);
      }
      return date.toString();
    },
    onSaveMeetup() {
      if (!this.formIsValid) {
        return alert("fill the form correctly");
      }
      if (!this.image) {
        return alert("please Upload Image");
      }

      const formdata = new FormData()

      formdata.append("title", this.meetup.title);
      formdata.append("location", this.meetup.location);
      formdata.append("description", this.meetup.description);
      formdata.append("date",this.submitableDate());
      formdata.append("imageUrl",this.image,this.image.name);
      formdata.append("user_id",this.$store.getters.user.id);
      this.$store.dispatch("createMeetup",formdata);
    },
    cancel() {},
    onFilePicked() {
      const filename = this.files[0].name;

      console.log(this.files[0]);
      if (
        filename.lastIndexOf(".") <= 0 ||
        filename.split(".").slice(-1)[0] !== "jpg"
      ) {
        return alert(
          "Invelid Document Upload: extention is " +
            filename.split(".").slice(-1)[0]
        );
      }
      this.image = this.files[0];
    },
    parseDate(date) {
      if (!date) return null;
      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    }
  }
};
</script>
