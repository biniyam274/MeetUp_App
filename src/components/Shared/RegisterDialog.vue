<template>
 <v-row justify="center">
    
  </v-row>
</template>

  <script>
  export default {

    computed: {
      // isRegistered(){
        
      // }
    },
    props:['id'],
    data () {
      return {
        dialog: false,
      }
    },
    methods: {
      onDelete(){
        // this.$store.dispatch('deleteMeetup',this.id);
        this.dialog = false
      }
    },
  }
</script>