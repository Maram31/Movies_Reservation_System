<template>
  <v-app id="home">
    <Header/>
    
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

    

    <v-card-title style="color:#4A646C">{{reservation.title}}</v-card-title>


    <v-divider class="mx-4"></v-divider>

    <v-card-title style="font-size:1rem">Room Number: {{reservation.id}}</v-card-title>
    <v-card-title style="font-size:1rem">seats: </v-card-title>


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


import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return{
    
    reservations:
      {
      movie1:{
        id:1,
        title:"Spiderman",
        date:"Sunday",
        StartTime:"3:00 pm",
        EndTime:"5:00 pm",
        room:"",
        PosterImage:"https://cdn.vuetifyjs.com/images/cards/cooking.png",
      }  ,
      movie2:{
        id:2,
        title:"Free guy",
        date:"Sunday",
        StartTime:"3:00 pm",
        EndTime:"5:00 pm",
        room:"",
        PosterImage:"https://cdn.vuetifyjs.com/images/cards/cooking.png",
      }  ,
      movie3:{
        id:3,
        title:"Elbadla",
        date:"Sunday",
        StartTime:"3:00 pm",
        EndTime:"3:00 pm",
        room:"",
        PosterImage:"https://cdn.vuetifyjs.com/images/cards/cooking.png",
      }  ,
      movie4:{
        id:4,
        title:"Final Destination",
        date:"Sunday",
        StartTime:"3:00 pm",
        EndTime:"3:00 pm",
        room:"",
        PosterImage:"https://cdn.vuetifyjs.com/images/cards/cooking.png",
      }  ,
      movie5:{
        id:5,
        title:"Silence",
        date:"Sunday",
        StartTime:"3:00 pm",
        EndTime:"3:00 pm",
        room:"",
        PosterImage:"https://cdn.vuetifyjs.com/images/cards/cooking.png",
      }  ,
      
    
    },
    
    
  }
  
},
methods:{
    CancelReservation(id){
      console.log(id)
    }
  },
}
</script>
<style scoped>

#home {
  background-color: #4A646C;
}


</style>>