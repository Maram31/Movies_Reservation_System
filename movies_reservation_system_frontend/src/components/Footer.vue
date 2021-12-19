<template>
  <v-card height="48">
    <v-footer style="background-color:#07141c;">
    <v-col
      class="text-center teal--text"
      cols="12"
      style="color:white"
      
    >
      {{ new Date().getFullYear() }} — <strong >Movie Reservation System</strong>
    </v-col>
  </v-footer>
  </v-card>
</template>

<script>
export default {
  name: 'Footer',
};
</script>
