<template>
  <v-app id="home">
    <Header/>
    
    <v-row>
    <v-card
    :loading="loading"
    v-for="(request, index) in requests"
    :key="index"
    
    width="80%"
    height="260"
    elevation="24"
    outlined
    shaped
    style="margin:100px 0px 50px 150px"
    >

    

    <v-card-title style="color:#4A646C">Request Number {{request.id}}</v-card-title>


    <v-divider class="mx-4"></v-divider>

    <p style="font-size:1rem">Manager Username: {{request.title}}</p>
    <p style="font-size:1rem">Manager Firstname: {{request.title}}</p>
    <p style="font-size:1rem">Manager Lastname: {{request.title}}</p>
    <p style="font-size:1rem">Manager Email: {{request.date}}</p>


    <v-card-actions >
      <v-row>
      <v-btn
        color="#4A646C"
        dark
        style="margin:0 20px 0 20px"
        @click="AcceptRequest(request.id)"
    
      >
        Accept
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn
        color="#9C2542"
        dark
        style="margin:0 20px 0 20px"
        @click="CancelRequest(request.id)"
    
      >
        Decline
      </v-btn>
      </v-row>
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
    
    requests:
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
    CancelRequest(id){
      console.log(id)
    },
    AcceptRequest(id){
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