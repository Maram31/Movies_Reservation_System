<template>
  <v-app id="home">
    <Header/>
    <br/>
    <v-alert
              v-show="this.success"
              border="left"
              color="#319177"
              dark
              type="success"
            >
            User is deleted successfully
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
    v-for="(user, index) in users"
    :key="index"
    
    width="500"
    height="300"
    elevation="24"
    outlined
    shaped
    style="margin:100px 50px 50px 80px"
    >

    

    <v-card-title style="color:#4A646C">{{user.username}}</v-card-title>


    <v-divider class="mx-4"></v-divider>
    
    <p style="text-align:start;padding-top:20px;padding-left:20px;font-size:1rem"><strong>Firstname: </strong>{{user.first_name}}</p>
    <p style="text-align:start;padding-left:20px;font-size:1rem"><strong>Lastname:</strong> {{user.last_name}}</p>
    <p style="text-align:start;padding-left:20px;font-size:1rem"><strong>Email: </strong>{{user.email}}</p>
    <p style="text-align:start;padding-left:20px;font-size:1rem"><strong> Role: </strong>{{user.role}}</p>

    <v-card-actions >
      
      
      <v-spacer></v-spacer>
      <v-btn
        color="#9C2542"
        dark
        style="margin:0 20px 0 20px"
        @click="removeUser(user.id)"
    
      >
        Delete User
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
    success:false,
    fail:false,
    loading:true,
    errorMsg:'',
    users:[],
    
    
  }
  
},
methods:{
    removeUser(id){
      axios.delete(`http://127.0.0.1:8000/deleteUser/${id}`, { headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`}})
    .then(() => {
      this.success=true;
      this.fail=false;
      this.users = this.users.filter(function(user) {
        return user.id != id
      })
      
    }).catch((error) => {
      console.log(error.response.data.message)
      this.errorMsg=error.response.data.message;
      this.success=false;
      this.fail=true;
    });
    },
    
  },
  created(){
    if (sessionStorage.getItem('usertoken') == null) this.$router.push('/');
    axios.get(`http://127.0.0.1:8000/users`, { headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`}})
    .then(response => {
      this.loading=false;
      this.users=response.data;
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