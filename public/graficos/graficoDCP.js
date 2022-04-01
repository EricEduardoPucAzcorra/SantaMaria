var url = 'http://santamaria.test/getDetalles_CP';

var myChart = document.getElementById('mychart');

new Vue({
	el:'#id_vue',
	data:{

	},
	created(){
		this.getDetalles_CP();
	},
	methods:{
		getDetalles_CP(){
			this.$http.get(url).then(function(json){
				//console.log(json);
				//contructor de la grafica
				var grafica = new Chart(myChart,{
					type:'bar',
					data:{
						//etiquetas
						labels:json.data.labels,
						datasets:[
							{
							   //etiqueta de serie
								label:'Enero',
								//color fondo de la grafica
								backgroundColor:'#FF504C',
								//border de color 
								borderColor:'black',
								//with
								borderWidth:2,
								//retorna los datos de la serie
								data:json.data.serie1
							},
							{
								//etiqueta de serie
								 label:'Febrero ',
								 //color fondo de la grafica
								 backgroundColor:'#FFA04C',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie2
							 },
							 {
								//etiqueta de serie
								 label:'Marzo ',
								 //color fondo de la grafica
								 backgroundColor:'#FFE54C',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie3
							 },
							 {
								//etiqueta de serie
								 label:'Abril',
								 //color fondo de la grafica
								 backgroundColor:'#C3FF4C',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie4
							 },
							 {
								//etiqueta de serie
								 label:'Mayo ',
								 //color fondo de la grafica
								 backgroundColor:'#4CFF58',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie5
							 },
							 {
								//etiqueta de serie
								 label:'Junio ',
								 //color fondo de la grafica
								 backgroundColor:'#4CFFD0',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie6
							 },
							 {
								//etiqueta de serie
								 label:'Julio ',
								 //color fondo de la grafica
								 backgroundColor:'#4CB2FF',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie7
							 },
							 {
								//etiqueta de serie
								 label:'Agosto',
								 //color fondo de la grafica
								 backgroundColor:'#4C51FF',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie8
							 },
							 {
								//etiqueta de serie
								 label:'Septiembre',
								 //color fondo de la grafica
								 backgroundColor:'#AA4CFF',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie9
							 },
							 {
								//etiqueta de serie
								 label:'Octubre',
								 //color fondo de la grafica
								 backgroundColor:'#FB4CFF',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie10
							 },
							 {
								//etiqueta de serie
								 label:'Noviembre',
								 //color fondo de la grafica
								 backgroundColor:'#FF4CA0',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie11
							 },
							 {
								//etiqueta de serie
								 label:'Diciembre',
								 //color fondo de la grafica
								 backgroundColor:'#FF000F',
								 //border de color 
								 borderColor:'black',
								 //with
								 borderWidth:2,
								 //retorna los datos de la serie
								 data:json.data.serie12
							 },
						]
					},
				});
			}).catch(function(json){

			});
		}
	}	
});