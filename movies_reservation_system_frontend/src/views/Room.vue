

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

    <v-card-title style="font-size:0.8rem">Seat at ({{seat.i}},{{seat.j}})</v-card-title>
    <v-divider class="mx-4"></v-divider>


    <v-card-actions >
      <v-btn
        color="#319177"
        small

        :disabled="!seat.reserved"
        dark
        @click="select(seat.i,seat.j)"
    
      >
      {{label[seat.i][seat.j]}}
      </v-btn>
      
      
    </v-card-actions>
    
  </v-card>
  </v-row>
    <div >
     <v-btn
        
        color="#4A646C"
        x-large
        dark
        max-width="100px"
        @click="reserve()"
    
      >
        Reserve
      </v-btn>
      
      </div>
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
    label:[[],[],[],[],[],[]],
    roomSize:6,
  seats:
      {
      seat1:{
        id:1,
        i:1,
        j:1,
        reserved:false,
      }  ,
      seat2:{
        id:2,
        i:1,
        j:2,
        reserved:true,
      }  ,
      seat3:{
        id:3,
        i:1,
        j:3,
        reserved:true,
      }  ,
      seat4:{
        id:4,
        i:1,
        j:4,
        reserved:false,
      }  ,
      seat5:{
        id:5,
        i:1,
        j:5,
        reserved:true,
      }  ,
      seat6:{
        id:6,
        i:2,
        j:1,
        reserved:true,
      }  ,
    },
    roomId:this.$route.params.id, 
    selectedSeats:[],
  }},
  
  
  methods: {
    reserve(){
        
        console.log(this.roomId)
    },
    select(i,j){
        if(localStorage.getItem('usertoken') == null){
          this.dialog=true;
        }
        else{
        if(localStorage.getItem('userRole') == 'Customer'){

        
        //on select if it is a guest they should be asked 
        //if they want to be directed to SignIn if they want to reserve a seat or stay in the same page
        this.label[i][j]="selected";
        console.log(i,j);
        console.log(this.label);
        //add selected seat i,j in the selected array
        }}
    },
    GoToSignIn(){
      this.dialog=false;
      this.$router.push('/login');
    },
    
  },
  created(){
     for(var i=0;i<=this.roomSize;i++){
        for(var j=0;j<=5;j++){
         this.label[i][j]="select"
     } 
     } 
     if(localStorage.getItem('userRole') == 'Customer'){
          this.customer=true;
      }
  },
  watch: {
      label(){

      }
  },
  
};
</script>
