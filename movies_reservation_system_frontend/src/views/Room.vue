

<template>
<v-app>
  <Header/>
  <br/><br/><br/>
  <h1>Pick your seat(s)</h1>
  <br/><br/>
    <v-row>
     
    <v-card
    
    width="100%"
    height="50"
    elevation="24"
    outlined
    shaped
    color="#4A646C"
    >
    
  
<v-card-title elevation="24" style="justify-content:center;font-size:2rem">Screen</v-card-title>
  </v-card>
  </v-row>
    <br/><br/>
    <v-row>
      
    <v-card
    
    v-for="(seat, index) in seats"
    :key="index"
    
    width="110"
    height="110"
    elevation="24"
    outlined
    shaped
    style="margin:50px 20px 50px 120px"
    >
    
    <v-card-title style="font-size:0.8rem">Seat at ({{seat.row_number}},{{seat.column_number}})</v-card-title>
    <v-divider class="mx-4"></v-divider>
      

    <v-card-actions >
      <v-btn
        color="#319177"
        small
        v-if="seatsAvailable[seat.row_number][seat.column_number]"
        @click="select(seat.row_number,seat.column_number,seat.id)"
    
      >
      {{label[seat.row_number][seat.column_number]}}
      </v-btn>
      <div>
      <v-btn
        v-if="!seatsAvailable[seat.row_number][seat.column_number]"
        color="#9C2542"
        small
        :disabled="!seatsAvailable[seat.row_number][seat.column_number]"
      >
      Taken
      </v-btn>
      </div>
      
    </v-card-actions>
    <v-divider  style="margin:-100px 0px 0px 180px" vertical></v-divider>
    
    <v-divider style="margin:30px 0px 0px 0px"></v-divider>
    <v-spacer></v-spacer>
    
  </v-card>
  
  </v-row>
    
      <br/>
      <br/><br/><br/>
      
      <v-form ref="form" style="width:50%;margin:0 350px 0 350px">
      <v-text-field
              :disabled="this.manager || this.siteAdmin ||(!this.manager && !this.siteAdmin && !this.customer)"
              v-model="creditCard"
              label="Credit Card Number"
              color="#4A646C"
              :rules="[rules.required,rules.number]"
              outlined
              clearable
              counter
              maxlength="16"
            ></v-text-field>
      <v-text-field
              :disabled="this.manager || this.siteAdmin ||(!this.manager && !this.siteAdmin && !this.customer)"
              v-model="pin"
              label="Pin"
              color="#4A646C"
              outlined
              maxlength="4"
              counter
              :rules="[rules.required,rules.pinNumber]"
              clearable
            ></v-text-field>  
           
     <v-btn
        :disabled="this.manager || this.siteAdmin ||(!this.manager && !this.siteAdmin && !this.customer)"
        color="#4A646C"
        x-large
        
        max-width="100px"
        @click="reserve()"
    
      >
        Reserve
      </v-btn>
      <br/><br/>
      <v-alert
              v-show="this.success"
              border="left"
              color="#319177"
              dark
              type="success"
            >
            Seat(s) are reserved successfully
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
        <v-alert
             v-show="this.noSeatsAreSelected"
              border="left"
              color="#9C2542"
              dark
              type="error"
            >
            No seat is selected
            </v-alert>         
       </v-form>
      
     
      <v-dialog
      v-model="dialog"
      max-width="400"
      
    >
      <v-card>
        <v-card-title class="text-h5">
          Want to login?
        </v-card-title>

        <v-card-text>
          If you want to reserve a seat you have to login at first
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="#319177"
            
            @click="GoToSignIn()"
          >
            Login
          </v-btn>

          <v-btn
            color="#4A646C"
            
            @click="dialog = false"
          >
            Stay in the same page
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <br/><br/><br/><br/><br/>

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
  
  data () {
    return{

    dialog:false,  
    customer:false,
    manager:false,
    siteAdmin:false, 
    success:false,
    fail:false,
    errorMsg:'',
    creditCard:'',
    pin:'',
    seatsAvailable:[[1,1,1,1,1,1],[1,1,1,1,1,1],[1,1,1,1,1,1],[1,1,1,1,1,1],[1,1,1,1,1,1],[1,1,1,1,1,1],[1,1,1,1,1,1]],
    label:[["select","select","select","select","select","select"],["select","select","select","select","select","select"],["select","select","select","select","select","select"],["select","select","select","select","select","select"],["select","select","select","select","select","select"],["select","select","select","select","select","select"],["select","select","select","select","select","select"]],
    roomSize:7,
    seats:[],
    selectedSeats:[],
    noSeatsAreSelected:false,
    rules: {
        required: (value) => !!value || 'Required.',
        number: (value) => this.IsaNumber(value) || 'Not a Valid Number',
        pinNumber: (value) => this.IsaPinNumber(value) || 'Not a Valid Number',
      },
  }},
  
  
  methods: {
    IsaNumber(value) {
      const num = /^\d{16}$/;
      if (value.match(num)) {
        return true;
      }
      return false;
    },
    IsaPinNumber(value) {
      const num = /^\d{4}$/;
      if (value.match(num)) {
        return true;
      }
      return false;
    },
    reserve(){
        if (this.$refs.form.validate()) {
          if(localStorage.getItem('usertoken') != null){
           if(this.selectedSeats.length!=0){
             this.noSeatsAreSelected=false
              axios.post(`http://127.0.0.1:8000/movie/${localStorage.getItem('movieId')}/book`,{
                seats:this.selectedSeats
              }, 
              { headers: { Authorization: `${'Bearer'} ${localStorage.getItem('usertoken')}` } })
              .then(()=>{
                
                this.success=true
                this.fail=false
                this.selectedSeats.forEach(selectedSeat => {
                  
                  this.seats.forEach(Seat=>{
                    
                    if (selectedSeat==Seat.id){
                      this.seatsAvailable[Seat.row_number].splice(Seat.column_number, 1, 0);
                    }
                  })
                });
                

              }).catch((error)=>{
                this.success=false
                this.fail=true
                this.errorMsg=error.response.data.message
              });
            }
            else{
              this.noSeatsAreSelected=true
            }
          }
        }
    },
    select(i,j,seatID){
        if(localStorage.getItem('usertoken') == null){
          this.dialog=true;
        }
        else{
        if(localStorage.getItem('userRole') == 'Customer'){

        if(this.label[i][j]=="select"){
          //push in array of selected seat
          this.label[i].splice(j, 1, "selected");
          this.selectedSeats.push(seatID)
          
        }
        else{
          //pop from array the selected seat
          this.label[i].splice(j, 1, "select");
          this.selectedSeats = this.selectedSeats.filter(function(selectedSeat) {
          return selectedSeat != seatID})
          
        }
        
        }}
    },
    GoToSignIn(){
      this.dialog=false;
      this.$router.push('/login');
    },
    
  },
  created(){
     
     if(localStorage.getItem('userRole') == 'Customer'){
        this.customer=true;
        this.siteAdmin= false;
        this.manager=false;
      }
      else if(localStorage.getItem('userRole') == 'Manager'){
        this.customer=false;
        this.siteAdmin= false;
        this.manager=true;
      }
      else if(localStorage.getItem('userRole') == 'Admin'){
        this.customer=false;
        this.siteAdmin= true;
        this.manager=false;
      }
      else{
        this.customer=false;
        this.siteAdmin= false;
        this.manager=false;
      }
      
      axios.get(`http://127.0.0.1:8000/movie/${localStorage.getItem('movieId')}/seats`, { })
      .then((response)=>{
        this.seats=response.data;
        this.seats.forEach(seat => {
          this.seatsAvailable[seat.row_number][seat.column_number]=seat.available
        });
      }).catch((error)=>{
        console.log(error)
      });
      
  },
  
  
};
</script>
