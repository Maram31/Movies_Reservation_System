<template>
  <v-app id="home">
    <Header/>
    <br/>
    <v-alert
              v-show="this.NoRequests"
              border="left"
              color="#319177"
              dark
              type="info"
            >
            No requests available
    </v-alert> 
    <v-alert
              v-show="this.success"
              border="left"
              color="#319177"
              dark
              type="success"
            >
            {{successMsg}}
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

    <p style="font-size:1rem">Manager Username: {{request.username}}</p>
    <p style="font-size:1rem">Manager Firstname: {{request.first_name}}</p>
    <p style="font-size:1rem">Manager Lastname: {{request.last_name}}</p>
    <p style="font-size:1rem">Manager Email: {{request.email}}</p>


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
    errorMsg:'',
    successMsg:'',
    requests:[],
    NoRequests:false,
    loading:true,
    
  }
  
},
methods:{
    CancelRequest(id){

      axios.patch(`http://127.0.0.1:8000/user/${id}`,{approved:0} ,{ headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`}})
      .then(() => {
        this.requests = this.requests.filter(function(request) {
        return request.id != id})
        this.success=true;
        this.fail=false;
        this.successMsg="Request is declined successfully";
      }).catch((error) => {
        this.success=false;
        this.fail=true;
        this.errorMsg=error.response.data.message;
        console.log(error.response.data.message)
      });
    },
    AcceptRequest(id){
      axios.patch(`http://127.0.0.1:8000/user/${id}`,{approved:1}, { headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`}})
      .then(() => {
        this.requests = this.requests.filter(function(request) {
        return request.id != id})
        this.success=true;
        this.fail=false;
        this.successMsg="Request is accepted successfully";
      }).catch((error) => {
        this.success=false;
        this.fail=true;
        this.errorMsg=error.response.data.message;
        console.log(error.response.data.message)
      });

    },
  },
  created(){
  if (sessionStorage.getItem('usertoken') == null) this.$router.push('/');
    axios.get(`http://127.0.0.1:8000/requests`, { headers: { Authorization: `${'Bearer'} ${sessionStorage.getItem('usertoken')}`}})
    .then(response => {
      
      this.loading=false;
      this.requests=response.data;
      if (this.requests.length==0){
        this.NoRequests=true;
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