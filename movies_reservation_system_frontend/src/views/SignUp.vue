<template>
    <v-app id="content">
      <Header/>
      <br />
      <br />
      <v-container id="container" class="mt-10 mb-10">
        <v-row justify="center" class="mb-5">
          <v-col
            cols="12"
            id="signup"
          >
          <h1>Sign Up</h1>
          </v-col>
        </v-row>
        <br/>
        <v-form ref="form" >
        
             <v-alert
              v-show="this.ExistingUseralert"
              border="left"
              color="#9C2542"
              dark
              type="error"
            >
            This Email/Username is already taken. Try to login.
            </v-alert>
        
       
            <v-text-field
              v-model="Name"
              label="Username"
              prepend-inner-icon="mdi-account"
              color="#4A646C"
              :rules="[rules.required, rules.Namelength]"
              outlined
              clearable
            ></v-text-field>
         
        
            <v-text-field
              v-model="FirstName"
              label="First Name"
              prepend-inner-icon="mdi-account"
              color="#4A646C"
              :rules="[rules.required, rules.Namelength]"
              outlined
              clearable
            ></v-text-field>
        
            <v-text-field
              v-model="LastName"
              label="Last Name"
              prepend-inner-icon="mdi-account"
              color="#4A646C"
              :rules="[rules.required, rules.Namelength]"
              outlined
              clearable
            ></v-text-field>
          
        
            <v-text-field
              v-model="Email"
              label="Email"
              prepend-inner-icon="mdi-email"
              color="#4A646C"
              :rules="[rules.required, rules.email]"
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
              @click:append="show1 = !show1"
              clearable
            ></v-text-field>
        
            <v-text-field
              v-model="Confirmpassword"
              :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show2 ? 'text' : 'password'"
              label="Confirm Password"
              prepend-inner-icon="mdi-lock"
              color="#4A646C"
              :rules="[rules.required, rules.Matchingchar(Confirmpassword, password),rules.containANumber,rules.containALetter]"
              outlined
              @click:append="show2 = !show2"
              clearable
            ></v-text-field>


        
            <h3 
            style="margin-inline-start: 0px;
                  margin-inline-end: 540px;"
             id="signup">
            Register as
            </h3>
            <v-radio-group
              v-model="Role"
              row
              :rules="[rules.required]"
              
            >
            
              <v-radio
                
                label="Customer"
                value="Customer"
                color="#4A646C"
              ></v-radio>
              <v-radio
                label="Manager"
                value="Manager"
                color="#4A646C"
              ></v-radio>
              
            </v-radio-group>
          
        </v-form>
        <br />
        
            <v-btn
              @click="Validate"
              rounded
              dark
              color="#4A646C"
              x-large
              style="width: 250px">
              Register
            </v-btn>
          
        <br />
        <br />
        <p>Already have an account?</p>
        <br />
        
            <v-btn
              to='/login'
              outlined
              rounded
              color="#4A646C"
              large
              style="width: 200px"
            >
            Login
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
      show2: false,
      ExistingUseralert: false,
      Role: '',
      Name: '',
      FirstName:'',
      LastName: '',
      Email: '',
      password: '',
      Confirmpassword: '',
      rules: {
        required: (value) => !!value || 'Required.',
        email: (value) => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || 'Invalid e-mail.';
        },
        Passlength: (value) => (value.length >= 8) || 'Min 8 characters',
        Namelength: (value) => (value.length >= 3 && value.length <= 64) || 'Min 3 characters and Max 64 characters',
        Matchingchar: (Confirmpassword, password) => this.IsMatching(Confirmpassword, password) || 'Confirm password must be the same as the password',
        containALetter:(value)=>{
          const regExp = /[a-zA-Z]/g;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 letter';
          }
          return true;
        },
        containANumber:(value)=>{
          const regExp = /[0-9]/;
          if (!regExp.test(value)){
            return 'Invalid password: Should contain atleast 1 digit';
          }
          return true;
        },

      },
    };
  },
  methods: {
    IsMatching(Confirmpassword, password) {
      if (Confirmpassword !== password) return false;
      return true;
    },
    Validate() {
      if (this.$refs.form.validate()) {
        axios({
          method: "post",
          url: "http://localhost:8000/register",

          data: {
            username: this.Name,
            first_name: this.FirstName,
            last_name: this.LastName,
            email:this.Email,
            password: this.password,
            password_confirmation: this.Confirmpassword,
            role: this.Role,
          },
        })
          .then((response) => {
            this.ExistingUseralert = false;
            sessionStorage.setItem('usertoken', response.data.AccessToken);
            sessionStorage.setItem('userRole', response.data.user);
            this.$router.push('/');
          })
          .catch(() => {
            this.ExistingUseralert = true;
          });
      }
    },
   
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
#signup {
  color: #4A646C;
}


</style>>
