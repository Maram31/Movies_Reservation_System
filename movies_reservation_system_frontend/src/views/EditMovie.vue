<template>

<v-app id="content">
  <Header/>
  <br />
  <br />
    <v-container id="container" class="mt-10 mb-10">
        <br/>
        <v-row justify="center" class="mb-5">
          <v-col
            cols="12"
            id="login"
          >
          <h1 >Update Movie Details</h1>
          </v-col>
        </v-row>
        <br/>
        
        
        <v-form ref="form">
        <v-alert
              v-show="this.success"
              border="left"
              color="#319177"
              dark
              type="success"
            >
            Movie is updated successfully
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
        

        <v-text-field
              v-model="title"
              label="Title"
              color="#4A646C"
              :rules="[rules.required]"
              outlined
            ></v-text-field>
<v-text-field
              v-model="date"
              label="Date"
              color="#4A646C"
              outlined
              type="date"
              :rules="[rules.required]"
            ></v-text-field>
            <v-text-field
              v-model="startTime"
              label="Start Time"
              color="#4A646C"
              outlined
              type="time"
              :rules="[rules.required]"
            ></v-text-field>
            <v-text-field
              v-model="endTime"
              label="End Time"
              color="#4A646C"
              outlined
              type="time"
              :rules="[rules.required]"
            ></v-text-field>
            <v-row>
            <v-file-input
              v-model="posterImage"
              :disabled="!this.updatePoster"
              prepend-icon="mdi-camera-plus"
              label="Poster Image"
              color="#4A646C"
              outlined
              chips
              accept="image/*"
              :rules="[rules.required]"
            ></v-file-input>
            <v-btn
              @click="edit()"
              class="ma-2"
              icon
              color="#4A646C"
            >
            <v-icon>{{ icons.mdiPencil }}</v-icon>
            
            </v-btn>
          </v-row>
            <v-select
              v-model="room"
              :items="items"
              label="Room"
              color="#4A646C"
              
              :rules="[rules.required]"
            ></v-select>

        </v-form>
        <br/>
        
            <v-btn @click="EditMovie()" rounded dark color="#4A646C" x-large style="width: 250px">
              Update
            </v-btn>
          
        
      </v-container>
      <br />
      <br />
      <Footer/>
    </v-app>
</template>

<script>
import {
    mdiPencil,
  } from '@mdi/js'
import axios from 'axios';
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return {
      icons:{mdiPencil},
      movieId:this.$route.params.id,
      title:'',
      date:'',
      startTime:'',
      endTime:'',
      room:'',
      screen:'',
      success:false,
      posterImage:'',
      fail:false,
      updatePoster:false,
      errorMsg:'',
      items: ['Room 1 - size 20', 'Room 2 - size 30'],
      rules: {
        required: (value) => !!value || 'Required.',
        
      },
    };
  },
  methods: {
    edit(){
      this.updatePoster=!this.updatePoster;
      if(this.updatePoster==true){
        this.posterImage=null;
      }
      
    },
    EditMovie() {
      this.success=false;
      this.fail=false;
      if (this.$refs.form.validate()) {
        if(this.room=='Room 1 - size 20'){
          this.screen=1
        }
        else{
          this.screen=2
        }
        const fd = new FormData();

        if(this.updatePoster==true){
          fd.append('poster', this.posterImage);
        }
        else{
          fd.append('poster', null);
        }
        fd.append('date', this.date);
        fd.append('start_time', this.startTime);
        fd.append('end_time', this.endTime);
        fd.append('screen',  this.screen);
        fd.append('title', this.title);
        const option = { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}`, 'Content-Type': 'multipart/form-data' } };
        axios.post(`http://127.0.0.1:8000/editmovie/${this.$route.params.id}`, fd, option)
          .then(() => {
            this.success=true;
          })
          .catch((error) => {
            this.fail=true;
            this.errorMsg=error.response.data.ErrorsIn;
            console.log(error.response.data.ErrorsIn)
          });
      }
    },
    
  },
  created() {
    if (localStorage.getItem('usertoken') == null) this.$router.push('/');
    axios.get(`http://127.0.0.1:8000/movie/${this.$route.params.id}/edit`, { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}`}})
    .then(response => {
      const image=response.data.poster;
      const urlToObject= async()=> {
        const response = await fetch(image);
        const blob = await response.blob();
        const file = new File([blob], 'poster.jpg', {type: blob.type}); 
        return file

      }
      urlToObject().then(x => { 
        this.posterImage=x;
        this.title=response.data.title;
        this.date=response.data.date;
        this.startTime=response.data.start_time;
        this.startTime = this.startTime.slice(0, -3);
        this.endTime=response.data.end_time;
        this.endTime = this.endTime.slice(0, -3);
        if(response.data.screen==1){
          this.room=this.items[0];
        }
        else{
          this.room=this.items[1];
        }
      
      } )
      
      
    }).catch((error) => {
      console.log(error)
    });
  },
};
</script>
<style scoped>

#content {
  background-color: #4A646C;
  
}

#container {
  background-color: #eeeeee;
  border-radius: 50px;
  width: 50%;
 
}
#login {
  color: #4A646C;
}

</style>>
