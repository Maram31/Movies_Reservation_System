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
    <v-text-field
              v-model="posterImage"
              label="Poster Image"
              color="#4A646C"
              outlined
              type="file"
              accept="image/*"
              :rules="[rules.required]"
            ></v-text-field>
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
//import axios from 'axios';
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return {
      items: ['Room 1 - size 20', 'Room 2 - size 30'],
      rules: {
        required: (value) => !!value || 'Required.',
        
      },
    };
  },
  methods: {
    createNewMovie() {
      if (this.$refs.form.validate()) {
        /*axios.post('http://127.0.0.1:8000/api/login', { name: this.Name, password: this.password }, { headers: { APP_KEY: 'c2Nob29sX2ZpbmRlcl9hcHBfa2V5ZmJkamhqeGNoa2N2anhqY2p2Ymh4amM6dmFzZGhoYXNkaGphZHNrZHNmYW1jbmhkc3VoZHVoY3Nq' } })
          .then((response) => {
            this.verifyalert = false;
            this.NotRegisteredalert = false;
            this.WrongNameOrPassAlert = false;
            this.$store.state.usertoken = response.data.access_token;
            localStorage.setItem('usertoken', response.data.access_token);
            this.$router.push('/');
          })
          .catch((error) => {
            if (error.response) {
              if (error.response.status === 401) {
                this.verifyalert = true;
                this.NotRegisteredalert = false;
                this.WrongNameOrPassAlert = false;
              } else if (error.response.status === 402) {
                this.verifyalert = false;
                this.NotRegisteredalert = false;
                this.WrongNameOrPassAlert = true;
              } else {
                this.verifyalert = false;
                this.NotRegisteredalert = true;
                this.WrongNameOrPassAlert = false;
              }
            }
          });*/
      }
    },
    
  },
  /*created() {
    if (localStorage.getItem('usertoken') !== null) this.$router.push('/home');
  },*/
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
