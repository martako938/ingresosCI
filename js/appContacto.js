axios.defaults.timeout = 10000;
const appContacto = Vue.createApp({
    data(){
        return{
                loading: true,
                appLoader: '<div class="preloader" align="center"><svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ripple" style="background:0 0"><circle cx="50" cy="50" r="4.719" fill="none" stroke="#1d3f72" stroke-width="2"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="3" keySplines="0 0.2 0.8 1" begin="-1.5s" repeatCount="indefinite"/><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="3" keySplines="0.2 0 0.8 1" begin="-1.5s" repeatCount="indefinite"/></circle><circle cx="50" cy="50" r="27.591" fill="none" stroke="#5699d2" stroke-width="2"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="3" keySplines="0 0.2 0.8 1" begin="0s" repeatCount="indefinite"/><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="3" keySplines="0.2 0 0.8 1" begin="0s" repeatCount="indefinite"/></circle></svg></div>',
                dia: '', diaNombre: '', mesNombre: '', anio: '', 
                msg_res:'\n* Se realizó la solicitud y el servidor respondió con un código de \nestado que cae fuera del rango de 2xx\nerr.res.status:', res2: '\nerr.res.headers: ', res3: '\n error.response.data: ',
                msg_req:'\n* La solicitud se realizó pero no se recibió respuesta, `error.request` es \nuna instancia de XMLHttpRequest en el navegador y una instancia de http.ClientRequest en Node.js \nerr.req: ', 
                msg_err:'\n* Algo sucedió al configurar la solicitud y provocó un error\nError: ',
                msg_err2: 'error.config: '
        }
    },
    created(){
        this.traerfechaCompleta()
    },
    methods: {
        traerfechaCompleta(){
            var fecha= '11-02-2024'
            var url=base+ 'contacto/traeFechComp/'+fecha
            axios.get(url)                                              // Traer la fecha actual compuesta
            .then(res =>{
                this.diaNombre = res.data[0]
                this.dia = res.data[1]
                this.mesNombre = res.data[2]
                this.anio = res.data[3]
                this.loading = false 
            }).catch((error)=>{
            if (error.response) { console.log('1.- traerfechaCompleta(): ', this.msg_res, error.response.status, this.res2, error.response.headers, this.res3, error.response.data); } 
            else if (error.request) { 
                //console.log('2.- traerfechaCompleta(): ', this.msg_req, error.request); 
                if (error.code === 'ECONNABORTED' && error.message.includes('timeout')) {
                    this.loading = false    
                    console.log('Request timed out: ','traerfechaCompleta()');
                    var title = 'traerfechaCompleta()'  
                    this.msjAlertTimeOut(title)  
                }
                return Promise.reject(error);
            } else { console.log('3.- traerfechaCompleta(): ',this.msg_err, error.message); }  
            console.log(this.msg_err2, error.config);   })
        },
        datosMensaje(tipo, cab, msg){
            if(tipo== 'exito'){         var ico=    '<h1><i class="bi bi-check-circle-fill" style="color: #17816a ;padding px-5 ;"></i></h1><h4><b>'        }
            else if(tipo== 'error'){    var ico=   '<h1><i class="bi bi-x-octagon" style="color: #d63d0b ;padding px-5 ;"></i></h1><h4><b>¡Error!</b></h4>' }
            ico+=   cab;    ico+=   '</b></h4>';    ico+=   msg;    return ico;
        },
        msjAlertTimeOut(title){
            var ico = this.datosMensaje('error','¡Oops!',' ... El servidor ha tardado mucho en responder, intente de nuevo  más tarde.')
            Swal.fire({
                title: title, 
                html: ico,
                background: `rgba(243, 247, 248)`,
                confirmButtonText: 'OK',  
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn butBlue1 sizeWidth2",
                    title: 'navSup titulo3'
                }
            }).then((result) => { 
                if (result.isConfirmed) {   }
            })
        }
    },
    computed:{
    },
})
.mount('#appContacto');