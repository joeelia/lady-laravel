<template>
<div id="main">
  <h1 style="text-align: center;"> Haircuts Waiting </h1>
  <p style="text-align: center;">Call next client 3 times and click their name.</p>
  	<ul>
      <li v-for="(client, index) in clients" ><a @click="wasCalled(client,index)" href="#">{{ index }}. {{ client.name }}</a></li>
    </ul>
</div>
</template>
<script>
    export default {
        data() {
            return {
                clients: [],
            }
        },
    created() {
        Echo.join('haircut')
            .listenForWhisper('reserved', () => {
                axios.get('clients/waiting',{params: {name: this.name}})
		 		        .then(response => {
				  	this.clients = response.data;
		 	});
            });
    	},
        methods: {
          wasCalled(client,index){
        	 axios.get('client/called/'+client.id, {params: {id: this.id}});
           console.log(client.id,index);
            this.clients.splice(index, 1);
          }
        },
        mounted(){
        	axios.get('clients/waiting',{params: {name: this.name}})
		 		.then(response => {
				  	this.clients = response.data;
		 	});
        }
    }
</script>
<style module>
/* Lazy browser reset */

* {
  margin: 0;
  padding:0;
}

#main {
  width: 200px;
  margin: 20px auto;
}

/* typography */
h1 {
  font-family: helvetica, arial, sans-serif;
  font-szie: 30px;
  color: #000;
}

/* list styles */
ul {
  list-style: none;
  width:200px;
  margin: 0;
  padding: 0;
}

li {
  text-decoration: none;
  font: 24px helvetica, arial, sans-serif;
  border-bottom: 1px solid #999;
}

li:first-child {
  border-top: 1px solid #999;
}

li a {
  text-decoration:none;
  color: #999;
  display: block;
  width: 200px;
  height: 40px;
	line-height: 40px;
  
  /* transitions and animations */
  -webkit-transition: font-size 0.3s ease, background-color 1s ease;
  -moz-transition: font-size 0.3s ease, background-color 1s ease;
  -ms-transition: font-size 0.3s ease, background-color 1s ease;
  -o-transition: font-size 0.3s ease, background-color 1s ease;
  transition: font-size 0.3s ease, background-color 1s ease;
}

li a:hover {
  font: 26px helvetica, arial, sans-serif;
  line-height: 40px;
  text-decoration: none;
  color: #999;
  background: #e3e3e3;
}
</style>