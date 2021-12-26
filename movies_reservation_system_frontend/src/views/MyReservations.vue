<template>
  <v-app id="home">
    <Header/>
    <br/>
    <v-alert
              v-show="this.NoReservations"
              border="left"
              color="#319177"
              dark
              type="info"
            >
            No reservations available
    </v-alert> 
    <v-alert
              v-show="this.success"
              border="left"
              color="#319177"
              dark
              type="success"
            >
            Reservation is canceled successfully
            </v-alert>
        <v-alert
              v-show="this.fail"
              border="left"
              color="#9C2542"
              dark
              type="error"
            >
            {{errorMsg}}
            </v-alert> 
    <v-row>
    <v-card
    :loading="loading"
    v-for="(reservation, index) in reservations"
    :key="index"
    
    width="80%"
    max-height="450"
    elevation="24"
    outlined
    shaped
    style="margin:100px 0px 50px 150px"
    >

    

    <v-card-title style="color:#4A646C">{{reservation.movieTitle}}</v-card-title>


    <v-divider class="mx-4"></v-divider>

    <v-card-title style="font-size:1rem">Room Number: {{reservation.room}}</v-card-title>
    <v-card-title style="font-size:1rem">Reserved seats: {{reservation.seats}}</v-card-title>
    <v-card-title style="font-size:1rem">Reserved on: {{reservation.creation_date}}</v-card-title>

    <v-card-actions >
      <v-btn
        color="#9C2542"
        dark
        @click="CancelReservation(reservation.id)"
    
      >
        Cancel Reservations
      </v-btn>
      
    </v-card-actions>
    
  </v-card>
  </v-row>
    
      <br/><br/>
    <Footer/>
  </v-app>
</template>

<script>

import axios from 'axios';
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return{
    errorMsg:'',
    success:false,
    fail:false,  
    loading:true,
    reservations:[],
    NoReservations:false,
    
  }
  
},
methods:{
    CancelReservation(id){
      
      axios.delete(`http://127.0.0.1:8000/bookings/${id}`,{ headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}`}})
    .then(() => {
      
      this.success=true;
      this.fail=false;
      this.reservations = this.reservations.filter(function(reservation) {
        return reservation.id != id
      });
      
    }).catch((error) => {
      console.log(error)
      this.errorMsg=error.response.data.message;
      this.success=false;
      this.fail=true;
    });
    }
  },
  created(){
    if (localStorage.getItem('usertoken') == null) this.$router.push('/');
    axios.get(`http://127.0.0.1:8000/bookings`, { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}`}})
    .then(response => {
      
      this.loading=false;
      this.reservations=response.data;
      if (this.reservations.length==0){
        this.NoReservations=true;
      }
    }).catch((error) => {
      console.log(error)
    });
    
  }
}
</script>
<style scoped>

#home {
  background-color: #4A646C;
}


</style>>