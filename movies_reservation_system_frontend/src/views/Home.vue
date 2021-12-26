<template>
  <v-app >
    <Header/>
    <br/>
    <v-alert
              v-show="this.NoMovies"
              border="left"
              color="#319177"
              dark
              type="info"
            >
            No movies available
    </v-alert> 
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
      v-if="movie.poster.includes('http')"
      v-bind:src="movie.poster"
      
    ></v-img>
    <v-img
      height="150"
      v-else-if="!movie.poster.includes('http')"
      v-bind:src="`http://127.0.0.1:8000${movie.poster}`"
      
      
    ></v-img>

    <v-card-title>{{movie.title}}</v-card-title>


    <v-divider class="mx-4"></v-divider>

    <v-card-title style="font-size:1rem">On</v-card-title>

    <v-card-text>
      <v-chip-group
        active-class="black accent-4 white--text"
        column
        
        
      >
        <v-chip style="font-size:0.8rem">{{movie.date}}:   From {{movie.start_time}} to {{movie.end_time}}</v-chip>

        

        
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
    loading:true,
    movies:[],
    manager:false,
    NoMovies:false,
    
  }
  
},
methods:{
    reserve(i){
      localStorage.setItem('movieId', i);
      this.$router.push({
        name: "Room",
        params: { id: i },
      });
    },
    Edit(i){
      localStorage.setItem('movieId', i);
      this.$router.push({
        name: "EditMovie",
        params: { id: i },
      });

    },
    create(){
      this.$router.push('/create_new_movie');
    }
    
  },
  created(){
    axios.get("http://127.0.0.1:8000/getAllMovies", {})
    .then(response => {
      this.movies=response.data;
      if (this.movies.length==0){
        this.NoMovies=true;
        
      }
      this.loading=false;

    }).catch((error) => {
      console.log(error)
    });
    if(localStorage.getItem('userRole') == 'Manager'){
      this.manager=true;
    }
    
    
  }
}
</script>
<style scoped>

#home {
  color: #4A646C;
}


</style>>