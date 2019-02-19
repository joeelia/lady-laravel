<template>

    <div class="container" style="">
    	<div :class="[ isReserved ? 'overlay visible' : 'overlay hidden']">Please have a seat, we will call you soon!</div>
     <input
     			class="client-input"
                type="text"
                name="client"
                placeholder="Your Name."
                v-model="client">
        <div class="row">
            <div class="team">
                <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Alex Morrison</h4>
                <p style="text-align:center;">Hairdresser</p>
                <button @click="sendClient" class="button-reserve">Reserve</button>
            </div>
            <div class="team">
                 <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Bryan Jones</h4>
                <p style="text-align:center;">Barber</p>
                <button @click="sendClient" class="button-reserve">Reserve</button>
            </div>
            <div class="team">
               <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Gabrielle Vasques</h4>
                <p style="text-align:center;">Master Stylist</p>
                <button @click="sendClient" class="button-reserve">Reserve</button>
            </div>
        </div>
    </div>  
</template>

<script>
    export default {
        data() {
            return {
                client: '',
                isReserved: 0
            }
        },
        methods: {
            sendClient(client) {
            /*
                this.$emit('clientsent', {
                    client: this.client
                });

                this.client = ''
                
                Echo.join('reserve')
            		.listen('ClientSent', (event) => {
                		this.client.push({
                    	client: event.client.client
                		});
            		});
            		*/
        axios.post('client/reserved', {
            client: this.client,
            }).then(response => {
							console.log(response.data); 
                    })
                    .catch(error =>{
            			const response = error.response;
						  console.log(response.data.errors);
						  this.errors = response.data.errors;
						  this.success = "";
					});
                
            	console.log("clicked");
            	console.log(this.client);
            	this.isReserved = 1;
            	this.client = "";
            	setTimeout(()=>{
   					this.isReserved = 0;
				},4000);
            }
        }
    }
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Raleway:200);
.overlay{
    background-color:#f19b2c;
    position:fixed;
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    z-index:1000;
    color: white;
    font-size: 5em;
    padding: 200px 50px 0px 50px;
    }
    
.hidden{
	visibility: hidden;
}
.visible{
	visibility: visible;
}
body {
    color: #858585;
    font-family: 'Raleway',sans-serif;
    font-size: 16px;
    font-weight: 200;
}

h4,
.h4{
    font-size: 18px;
    font-weight: bold;
}


.container {
   width: 80%;
	margin: auto;
	text-align:center;
	padding-top: 200px;
}
.row{
 display: flex;
 }

.team
{
	flex: 1;
    width: 370px;
    border: 1px solid rgba(133,133,133,.15);
    background-color: #fff;
    -moz-box-shadow: 0 0 8px rgba(0,0,0,.09);
    -webkit-box-shadow: 0 0 8px rgba(0,0,0,.09);
    box-shadow: 0 0 8px rgba(0,0,0,.09);
    float: left;
    margin-left: 16px;
}
.teamimg
{
    display: block;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    margin-top: -80px;
    width:170px;
    height:170px;
    background: #1bbc9d;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.09);
}

button{
  color:#fff;
  text-align: center;
  padding: 20px;
margin: 20px;
    position:center;

}

/*Button Three*/
.button-reserve {
    position: relative;
    background-color: #f39c12;
    border: none;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    text-align: center;
  cursor: pointer;
  font-size:24px;
  text-align: center;

}

.button-reserve:hover{
   background:#fff;
   box-shadow:0px 2px 10px 5px #97B1BF;
   color:#000;
}

.button-reserve:after {
    content: "";
    background: #f1c40f;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px !important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}

.button-reserve:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s
}

.client-input {
    margin-bottom: 120px;
}
</style>