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
      <v-col><v-btn v-if="!authorized" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToSignIn()">login</v-btn><v-btn v-if="authorized" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToSignIn()">logout</v-btn></v-col>
      
    </v-row>
    
    
    </v-app-bar>
    
  </nav>
</template>

<script>

export default {
  name: 'Header',
  data (){ return{
  authorized: false, //if user.token!=null to be edit laters
  
  }},
  
  rules: {
    required: (value) => !!value || 'Required.',
  },
  methods: {
    GoToSignUp() {
      this.$router.push('/signup');
    },
    GoToHome() {
      this.$router.push('/');
    },
    GoToSignIn(){
      this.$router.push('/login');
    },
    
    
  },
  
};
</script>
