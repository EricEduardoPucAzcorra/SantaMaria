<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                            {{mesas}}

                            <button @click="mensaje()">Mensaje</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                hola:'hola mundo',
                mesas:[],
            }
        },
        computed:{

        },
        methods: {
            getMesas(){
                    var i = this;
                    let  url = '/mesas';
                    axios.get(url).then(function (response) {
                        //console.log(response);
                       i.mesas = response.data; 
                    }).catch(function (error) {
                    console.log(error);
                    });   
            },
            mensaje(){
                alert('Bienvenido');
            },
        },
        mounted() {
            this.getMesas();
            console.log('Component mounted.')
        }
    }
</script>