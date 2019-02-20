<template>

    <div class="container" style="">
    	<div :class="[ isReserved ? 'overlay visible' : 'overlay hidden']">Please have a seat, we will call you soon!
            <div :class="[ isReserved ? 'wrapper' : '']">
                <div class="timer-background"></div>
                <div class="timer spinner"></div>
                <div class="timer filler"></div>
                <div class="mask"></div>
            </div>
        </div>
      
    <span class="input margin-input">
     <input
     			class="client-input"
                type="text"
                name="client"
                placeholder="Your Name."
                v-model="client" v-on:keyup="isClientInput">
                <span></span>	
	</span>
  
        <div class="row">
            <div class="team">
                <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Alex Morrison</h4>
                <p style="text-align:center;">Hairdresser</p>
                <button :disabled="isClient === 0" :class="[ isClient ? 'button-reserve' : 'button-reserve disabled']" @click="sendClient" >Reserve</button>
            </div>
            <div class="team">
                 <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Bryan Jones</h4>
                <p style="text-align:center;">Barber</p>
                <button :disabled="isClient === 0" :class="[ isClient ? 'button-reserve' : 'button-reserve disabled']" @click="sendClient" >Reserve</button>
            </div>
            <div class="team">
               <div class="teamimg"></div>
                <h4 style="text-align:center;margin-bottom: 2px;margin-top: 25px;">Gabrielle Vasques</h4>
                <p style="text-align:center;">Master Stylist</p>
                <button :disabled="isClient === 0" :class="[ isClient ? 'button-reserve' : 'button-reserve disabled']" @click="sendClient">Reserve</button>
            </div>
        </div>
    </div>  
</template>

<script>
    export default {
        data() {
            return {
                client: '',
                isReserved: 0,
                isClient: 0,
            }
        },
        methods: {
            isClientInput() {
                if(this.client.length > 0){
                    this.isClient = 1;
                } else {
                    this.isClient = 0;
                }
            },
            sendClient(client) {
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
                Echo.join('haircut')
                    .whisper('reserved', this.client);
            	console.log("clicked");
            	console.log(this.client);
            	this.isReserved = 1;
            	this.client = "";
                 this.isClient = 0;
            	setTimeout(()=>{
   					this.isReserved = 0;
				},4000);
            },
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

.disabled{
    background:gray;
}

.disabled:hover{
    background:gray !important;
    box-shadow:none !important;
    color: white !important;
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

.wrapper {
  position: relative;
  margin: 40px auto;
}

.wrapper, .wrapper * {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

.wrapper {
  width: 250px;
  height: 250px;
}

.wrapper .timer {
  width: 50%;
  height: 100%;
  transform-origin: 100% 50%;
  position: absolute;
  border: 50px solid #f19b2c;
}

.wrapper .spinner {
  border-radius: 100% 0 0 100% / 50% 0 0 50%;
  z-index: 200;
  border-right: none;
  animation: rota 4s linear infinite;
}

.wrapper:hover .spinner,
.wrapper:hover .filler,
.wrapper:hover .mask {
  animation-play-state: running;
}

.wrapper .filler {
  border-radius: 0 100% 100% 0 / 0 50% 50% 0;
  left: 50%;
  opacity: 0;
  z-index: 100;
  animation: opa 4s steps(1, end) infinite reverse;
  border-left: none;
}

.wrapper .timer-background {
  width: 100%;
  height: 100%;
  position: absolute;
  background: none;
  border: 50px solid #FFF;
  border-radius: 100%;
  z-index: 100;
}

.wrapper .mask {
  width: 50%;
  height: 100%;
  position: absolute;
  background: inherit;
  border: 50px solid #FFF;
  border-radius: 100% 0 0 100% / 50% 0 0 50%;
  border-right: none;
  opacity: 1;
  z-index: 300;
  animation: opa 4s steps(1, end) infinite;
}

@keyframes rota {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes opa {
  0% {
    opacity: 1;
  }
  50%, 100% {
    opacity: 0;
  }
}
@media (max-width:992px) {
    .teamimg
    {
        margin-top: 20px !important;
    }

    .team
    {
        margin-bottom: 30px !important;
    }
}



.input {
  position: relative;
  font-size: 1.5em;
  background: linear-gradient(21deg, #10abff, #1beabd);
  padding: 3px;
  display: inline-block;
  border-radius: 9999em;
}
.input *:not(span) {
  position: relative;
  display: inherit;
  border-radius: inherit;
  margin: 0;
  border: none;
  outline: none;
  padding: 0 .325em;
  z-index: 1;
}
.input *:not(span):focus + span {
  opacity: 1;
  -webkit-transform: scale(1);
          transform: scale(1);
}
.input span {
  -webkit-transform: scale(0.993, 0.94);
          transform: scale(0.993, 0.94);
  transition: opacity .25s, -webkit-transform .5s;
  transition: transform .5s, opacity .25s;
  transition: transform .5s, opacity .25s, -webkit-transform .5s;
  opacity: 0;
  position: absolute;
  z-index: 0;
  margin: 4px;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  border-radius: inherit;
  pointer-events: none;
  box-shadow: inset 0 0 0 3px #fff, 0 0 0 4px #fff, 3px -3px 30px #1beabd,  -3px 3px 30px #10abff;
}





input {
  font-family: inherit;
  line-height: inherit;
  color: #2e3750;
  min-width: 12em;
}

::-webkit-input-placeholder {
  color: #cbd0d5;
}

:-ms-input-placeholder {
  color: #cbd0d5;
}

::-ms-input-placeholder {
  color: #cbd0d5;
}

::placeholder {
  color: #cbd0d5;
}

html::after {
  content: '';
  background: linear-gradient(21deg, #10abff, #1beabd);
  height: 3px;
  width: 100%;
  position: absolute;
  left: 0;
  top: 0;
}

.margin-input{
        align: center;
        margin-bottom: 150px;
    }

@media (max-width:992px) {
    .margin-input{
        margin-bottom: 30px !important;
    }
}

</style>