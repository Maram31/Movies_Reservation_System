<template>
  <v-app >
    <Header/>
    
    <v-row>
    <v-card
    :loading="loading"
    v-for="(movie, index) in movies"
    :key="index"
    
    max-width="300"
    max-height="450"
    elevation="24"
    outlined
    shaped
    style="margin:50px 20px 50px 20px"
    >

    <v-img
      height="150"
      v-bind:src="movie.PosterImage"
      
    ></v-img>

    <v-card-title>{{movie.title}}</v-card-title>


    <v-divider class="mx-4"></v-divider>

    <v-card-title style="font-size:1rem">On</v-card-title>

    <v-card-text>
      <v-chip-group
        active-class="black accent-4 white--text"
        column
        
        
      >
        <v-chip style="font-size:0.8rem">{{movie.date}}: {{movie.StartTime}} to {{movie.EndTime}}</v-chip>

        

        
      </v-chip-group>
    </v-card-text>

    <v-card-actions >
      <v-btn
        color="#4A646C"
        dark
        @click="reserve(movie.id)"
    
      >
        Reserve
      </v-btn>
      <v-btn
        v-if="manager"
        style="margin:0 0 0 5px"
        color="#319177"

        dark
        @click="Edit(movie.id)"
    
      >
        Edit
      </v-btn>
    </v-card-actions>
    
  </v-card>
  </v-row>
    <v-divider v-if="manager"></v-divider>
      <br/><br/>
      <div>
      <v-btn
        v-if="manager"
       
        color="#4A646C"
        max-width="200px"
        dark
        @click="create()"
    
      >
        Create new Movie
      </v-btn>
      </div>
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
    loading:false,
    movies:
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
    manager:false,
    
  }
  
},
methods:{
    reserve(i){
      //console.log(i)
      this.$router.push({
        name: "Room",
        params: { id: i },
      });
    },
    Edit(i){
      this.$router.push({
        name: "EditMovie",
        params: { id: i },
      });

    },
    create(){
      this.$router.push('/create_new_movie');
    }
  },
}
</script>
<style scoped>

#home {
  color: #4A646C;
}


</style>>