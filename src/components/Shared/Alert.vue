<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="7">
      <v-alert v-model="alert" @input="onClose" 
      type="error" dismissible
       border="left"
      close-text="Close"
       >
        <p>{{errors.email==null?"":errors.email}} </p>
        <p> {{errors.password==null?"":errors.password}}</p>
          <p>{{errors.name==null?"":errors.name}}</p>
      </v-alert>
    </v-col></v-row
  >
</template>
<script>
export default {
  props:['text'],
  data() {
    return {
      errors:this.text
    }
  },
  methods: {
    onClose() {
      this.$emit("dismissed");
    }
  }
};
</script>
