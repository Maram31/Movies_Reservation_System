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
          <h1 >Create New Movie</h1>
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
            Movie is added successfully
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
              clearable
            ></v-text-field>
<v-text-field
              v-model="date"
              label="Date"
              color="#4A646C"
              outlined
              type="date"
              :rules="[rules.required]"
              clearable
            ></v-text-field>
            <v-text-field
              
              v-model="startTime"
              label="Start Time"
              color="#4A646C"
              outlined
              type="time"
              :rules="[rules.required]"
              clearable
            ></v-text-field>
            <v-text-field
              v-model="endTime"
              label="End Time"
              color="#4A646C"
              outlined
              type="time"
              :rules="[rules.required]"
              clearable
            ></v-text-field>
    <v-file-input
              v-model="posterImage"
              prepend-icon="mdi-camera-plus"
              label="Poster Image"
              color="#4A646C"
              outlined
              chips
              accept="image/*"
              :rules="[rules.required]"
            ></v-file-input>
      <v-select
              v-model="room"
              :items="items"
              label="Room"
              color="#4A646C"
              
              :rules="[rules.required]"
            ></v-select>

        </v-form>
        <br/>
        
            <v-btn @click="createNewMovie()" rounded dark color="#4A646C" x-large style="width: 250px">
              Create
            </v-btn>
          
        
      </v-container>
      <br />
      <br />
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
    return {
      title:'',
      date:'',
      startTime:'',
      endTime:'',
      posterImage:'Enter Movie Poster',
      room:'',
      screen:'',
      success:false,
      fail:false,
      errorMsg:'',
      items: ['Room 1 - size 20', 'Room 2 - size 30'],
      rules: {
        required: (value) => !!value || 'Required.',
        
      },
    };
  },
  methods: {
    createNewMovie() {
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
        fd.append('poster', this.posterImage);
        fd.append('date', this.date);
        fd.append('start_time', this.startTime);
        fd.append('end_time', this.endTime);
        fd.append('screen',  this.screen);
        fd.append('title', this.title);
        const option = { headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`, 'Content-Type': 'multipart/form-data' } };
        axios.post('http://127.0.0.1:8000/createmovie', fd, option)
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
    if (sessionStorage.getItem('usertoken') == null) this.$router.push('/');
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
