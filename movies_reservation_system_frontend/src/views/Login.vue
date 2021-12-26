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
          <h1 >Login</h1>
          </v-col>
        </v-row>
        <br/>
        <br/>
        <br/>
        <br/>
        <v-form ref="form">
        
        
             <v-alert
              v-show="this.NotRegisteredalert"
              border="left"
              color="#9C2542"
              dark
              type="error"
            >
            You're not registered, Please Register at first
            </v-alert>
          
        
             <v-alert
              v-show="this.WrongNameOrPassAlert"
              border="left"
              color="#9C2542"
              dark
              type="error"
            >
            {{errorMessage}}
            </v-alert>
          

        <v-text-field
              v-model="Name"
              label="Username"
              prepend-inner-icon="mdi-account"
              color="#4A646C"
              :rules="[rules.required]"
              outlined
              clearable
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
              clearable
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
      show1: false,
      Name: '',
      password: '',
      NotRegisteredalert: false,
      WrongNameOrPassAlert: false,
      errorMessage:'',
      rules: {
        required: (value) => !!value || 'Required.',
        Passlength: (value) => (value.length >= 8) || 'Min 8 characters',
        Namelength: (value) => (value.length >= 3 && value.length <= 64),
        containALetter:(value)=>{
          const regExp = /[a-zA-Z]/g;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 letter'
          }
          return true
        },
        containANumber:(value)=>{
          const regExp = /[0-9]/;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 digit'
          }
          return true
        },
      },
    };
  },
  methods: {
    Validate() {
      if (this.$refs.form.validate()) {
        axios.post('http://127.0.0.1:8000/login', { username: this.Name, password: this.password })
          .then((response) => {
            this.NotRegisteredalert = false;
            this.WrongNameOrPassAlert = false;
            localStorage.setItem('usertoken', response.data.AccessToken);
            localStorage.setItem('userRole', response.data.role);
            
            this.$router.push('/');
          })
          .catch((error) => {
            if (error.response) {
              if (error.response.status === 400) {
                this.NotRegisteredalert = false;
                this.WrongNameOrPassAlert = true;
                console.log(error.response.data.ErrorsIn)
                this.errorMessage=error.response.data.ErrorsIn;
              } else {
                this.NotRegisteredalert = true;
                this.WrongNameOrPassAlert = false;
              }
            }
          });
      }
    },
    
  },
  created() {
    if (localStorage.getItem('usertoken') != null) this.$router.push('/');
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
