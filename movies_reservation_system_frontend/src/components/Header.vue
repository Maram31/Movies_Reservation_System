<template>
  <nav>
    <v-app-bar
      src="../assets/image2.jpg"
      elevation="24"
      shaped
    >
      <v-toolbar-title style="font-size: 2rem;color:white" >Movie Reservation System</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-row >
      <v-col
       d-inline>
          <br />
      
      </v-col>
      </v-row>
      <v-spacer></v-spacer>
      <v-spacer></v-spacer>
    <v-row dense >
      <v-col><v-btn  style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToHome()">
      Home</v-btn></v-col>
      <v-col><v-btn style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToAbout()">About</v-btn></v-col>
      
    </v-row>
  
    </v-app-bar>
    
  </nav>
</template>

<script>

export default {
  name: 'Header',
  data: () => ({
    
  }),
  
  rules: {
    required: (value) => !!value || 'Required.',
  },
  methods: {
    GoToAbout() {
      this.$router.push('/about');
    },
    GoToHome() {
      this.$router.push('/');
    },
    
    
  },
};
</script>
