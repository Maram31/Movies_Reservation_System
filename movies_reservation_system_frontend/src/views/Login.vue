<template>
<v-main id="content">
  <Header/>
    <v-container id="container" class="mt-10 mb-10">
        <br/>
        <v-row justify="center" class="mb-5">
          <v-col
            cols="12"
            id="login"
          >
          <h1 >Login</h1>
          </v-col>
        </v-row>
        <br/>
        <br/>
        <br/>
        <br/>
        <v-form ref="form">
        
        
             <v-alert
              v-show="this.verifyalert"
              border="left"
              color="#4A646C"
              dark
            >
            Please Verify your account before login
            </v-alert>
          
        
             <v-alert
              v-show="this.NotRegisteredalert"
              border="left"
              color="#4A646C"
              dark
            >
            You're not registered, Please Register at first
            </v-alert>
          
        
             <v-alert
              v-show="this.WrongNameOrPassAlert"
              border="left"
              color="#4A646C"
              dark
            >
            wrong Username or password
            </v-alert>
          

        <v-text-field
              v-model="Name"
              label="Username"
              prepend-inner-icon="mdi-account"
              color="#4A646C"
              :rules="[rules.required]"
              outlined
            ></v-text-field>
          

        <v-text-field
              v-model="password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              label="Password"
              prepend-inner-icon="mdi-lock"
              color="#4A646C"
              :rules="[rules.required, rules.Passlength,rules.containANumber,rules.containALetter]"
              outlined
              @click:append="show1 = !show1"
            ></v-text-field>
          

        </v-form>
        <br/>
        
            <v-btn @click="Validate" rounded dark color="#4A646C" x-large style="width: 250px">
              Login
            </v-btn>
          
        <br /><br /><br/><br/>

        <p>Doesn't have an account?</p>
        <br />
        
            <v-btn
              to='/signup'
              outlined
              rounded
              color="#4A646C"
              large
              style="width: 200px"
            >
            Register
            </v-btn>
         
        <br />
        <br /><br/>
        <br/><br/>
        
            <v-btn
              to='/'
              outlined
              rounded
              color="#4A646C"
              small
              style="width: 170px"
            >
            Continue as a Guest
            </v-btn>
      </v-container>
      <Footer/>
    </v-main>
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
      show1: false,
      Name: '',
      password: '',
      verifyalert: false,
      NotRegisteredalert: false,
      WrongNameOrPassAlert: false,
      rules: {
        required: (value) => !!value || 'Required.',
        Passlength: (value) => (value.length >= 8) || 'Min 8 characters',
        Namelength: (value) => (value.length >= 3 && value.length <= 64),
        containALetter:(value)=>{
          const regExp = /[a-zA-Z]/g;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 letter'
          }
        },
        containANumber:(value)=>{
          const regExp = /[0-9]/;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 digit'
          }
        },
      },
    };
  },
  methods: {
    Validate() {
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
