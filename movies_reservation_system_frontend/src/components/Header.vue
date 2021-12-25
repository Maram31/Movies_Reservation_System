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
      <v-col v-if="customer || siteAdmin"><v-btn v-if="customer" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToMyReservations()">
      My Reservations</v-btn><v-btn v-if="siteAdmin" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToManagersRequests()">
      Managers Requests</v-btn></v-col>
      <v-col v-if="siteAdmin"><v-btn v-if="siteAdmin" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToUsers()">
      Users</v-btn></v-col>
      <v-col><v-btn v-if="!authorized" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="GoToSignIn()">login</v-btn><v-btn v-if="authorized" style="font-size: 1.2rem;color:white" class="d-none d-lg-block" text @click="Logout()">logout</v-btn></v-col>
      
    </v-row>
    
    
    </v-app-bar>
    
  </nav>
</template>

<script>
import axios from 'axios';
export default {
  name: 'Header',
  data (){ return{
  authorized: false, 
  siteAdmin: false,
  manager:false,
  customer:false,
  
  }},
  
  
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
    Logout(){
      
      if(this.customer==true){
        axios.post('http://127.0.0.1:8000/logout','', { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}` } });
      }
      else if(this.manager==true){
        axios.post('http://127.0.0.1:8000/manager/logout','', { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}` } });
      }  
      else if(this.siteAdmin==true){
        axios.post('http://127.0.0.1:8000/admin/logout','', { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}` } });
      }
      
      localStorage.clear();
      this.authorized= false;
      this.customer=false;
      this.siteAdmin= false;
      this.manager=false;
      this.$router.push('/login');

    },
    GoToMyReservations(){
      this.$router.push('/my_reservations');
    },
    GoToManagersRequests(){
      this.$router.push('/managers_requests');
    },
    GoToUsers(){
      this.$router.push('/users');
    }
    
  },
  created(){
    if (localStorage.getItem('usertoken') != null){
      this.authorized=true;
      if(localStorage.getItem('userRole') == 'Customer'){
        this.customer=true;
        this.siteAdmin= false;
        this.manager=false;
      }
      else if(localStorage.getItem('userRole') == 'Manager'){
        this.customer=false;
        this.siteAdmin= false;
        this.manager=true;
      }
      else if(localStorage.getItem('userRole') == 'Admin'){
        this.customer=false;
        this.siteAdmin= true;
        this.manager=false;
      }
      else{
        this.customer=false;
        this.siteAdmin= false;
        this.manager=false;
      
      }
    }
    else{
      this.authorized=false;
    }
  }
};
</script>
