<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="7">
      <v-alert v-model="alert" @input="onClose" 
      type="error" dismissible
       border="left"
      close-text="Close"
       >
        {{text}}
      </v-alert>
    </v-col></v-row
  >
</template>
<script>
export default {
  props:['text'],
  data() {
    return {
      error:{
        message:"She cute"
      }
    }
  },
  methods: {
    onClose() {
      this.$emit("dismissed");
    }
  }
};
</script>
