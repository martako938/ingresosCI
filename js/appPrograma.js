axios.defaults.timeout = 10000;
const appPrograma = Vue.createApp({
    data() {
        return{
            loading: false,
            appLoader: '<div class="preloader" align="center"><svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ripple" style="background:0 0"><circle cx="50" cy="50" r="4.719" fill="none" stroke="#1d3f72" stroke-width="2"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="3" keySplines="0 0.2 0.8 1" begin="-1.5s" repeatCount="indefinite"/><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="3" keySplines="0.2 0 0.8 1" begin="-1.5s" repeatCount="indefinite"/></circle><circle cx="50" cy="50" r="27.591" fill="none" stroke="#5699d2" stroke-width="2"><animate attributeName="r" calcMode="spline" values="0;40" keyTimes="0;1" dur="3" keySplines="0 0.2 0.8 1" begin="0s" repeatCount="indefinite"/><animate attributeName="opacity" calcMode="spline" values="1;0" keyTimes="0;1" dur="3" keySplines="0.2 0 0.8 1" begin="0s" repeatCount="indefinite"/></circle></svg></div>',
            viewEntrada: true, viewSalida: false,
            enviarReg: false, msjSalida: ['0','0'],
            numerosEmp: '', cadenas: {cadena:"", cadenalimpia: ""}, numerosEmpTabla: '',
            salida: [], entero: false,
            existenDatos: true,
            msg_res: '\n* Se realizó la solicitud y el servidor respondió con un código de \nestado que cae fuera del rango de 2xx\nerr.res.status:', res2: '\nerr.res.headers: ', res3: '\n error.response.data: ',
            msg_req: '\n* La solicitud se realizó pero no se recibió respuesta, `error.request` es \nuna instancia de XMLHttpRequest en el navegador y una instancia de http.ClientRequest en Node.js \nerr.req: ',
            msg_err: '\n* Algo sucedió al configurar la solicitud y provocó un error\nError: ',
            msg_err2: 'error.config: '
        }
    },
    created() {
        //this.traerEntrada()                //Actualizar estado del boton borrar datos al iniciar
        this.traerIngresos()
    },
    methods: {
        irEntrada() {
            //this.traerEntrada()
            this.viewEntrada = true
            this.viewSalida = false
        },
        irSalida() {
            this.viewEntrada = false
            this.viewSalida = true
        },
        ingresarNumeros() {
            this.loading = true
            let url = base + 'progra/ingresaNum'
            const form = document.getElementById('ingresarReg')
            var datosForm = new FormData(form);
            axios.post(url, datosForm).then(res => {
                this.numerosEmpTabla = res.data
                console.log('Registros Agregados correctamente');
                console.log('Registros en tabla', res.data)
                // this.viewEntrada = false
                // this.viewSalida = true
                this.numerosEmp = ''
                this.loading = false
                ico = this.datosMensaje('exito','¡Éxito!','Se han agregado correctamente los registros')
                var title = 'Registros agregados';  this.msjAlert(ico,title)
                //this.traerEntrada()                                                 //Actualizar estado del boton borrar datos al ingresar nuevos numeros
            }).catch((error) => {
                ico = this.datosMensaje('error','¡Error!','Hubo un error agregando los datos. Intentelo de nuevo')
                var title = 'Error Restableciendo';  this.msjAlert(ico,title);
            })
        },
        validaEntrada (){                                                           // Ya quedo pero hay que validar el boton de OK REVISAR
            comprueba = this.validacionPrevia(this.numerosEmp) 
            if(comprueba == 0 ){
                this.msjSalida[1] = '0'; 
                return this.enviarReg = false  
            }else if (comprueba['cadena'] == "for" || comprueba['cadena']== "no" || comprueba['cadena'] == "") {
                this.msjSalida[0] = 'Debes llenar correctamente tus datos'; 
                this.msjSalida[1] = '1'; 
                return this.enviarReg = false 
            }else if (comprueba['cadena'] == "XX" ){
                this.msjSalida[0] = 'No puede haber dos beneficiarios iguales'; 
                this.msjSalida[1] = '1'; 
                return this.enviarReg = false 
            }else{
                this.msjSalida[1] = '0'; 
                return this.enviarReg = true
            }
        },
        validacionPrevia(texto){
            var observaciones = texto; var cadena = "";
            var cadenalimpia = ""; 
            const regex = /(?=(^[0-9]+[[^A-Z]{1,2}]*$))\b\w{3,8}\b/;                  // const regex = /(?=(^[0-9]+[[^A,B,C,M,I,Z]{1}]*$))\b\w{4,7}\b/;
            let m;
            observaciones = observaciones.replaceAll(/^\s+|\s+$/gm, '');            //Validacion saltos de línea
            if (observaciones == "" ) {                                             //Aqui no es valido  
            } else {                                                                //colocamos la del boton
                if(observaciones.includes("\n")) {
                    var myArray = observaciones.split("\n");
                    for (var i = 0; i < myArray.length; i++) {                      //Construyendo la cadena de salida que sera entrada      
                        if (myArray[i] !== "") {
                            if ((m = regex.exec(myArray[i])) !== null) {
                                // if(cadena.contains({A}) && cadena.contains({B}) ){
                                    cadena += myArray[i] + ",";
                                    numeroCiclo = myArray[i].substring(0, myArray[i].length - 1)
                                    numeroCiclo=this.limpiaCadena(numeroCiclo);     //Eliminando letras dejando numeros 
                                    cadenalimpia += numeroCiclo + ",";    
                                //}
                            } else {    
                                cadena = "for ";  cadenalimpia = "for "; 
                                break;    }                                         //aqui no es valido termina el for y borra observaciones
                        }
                    }
                }else{
                    if ((m = regex.exec(observaciones)) !== null) {
                        cadena = observaciones + ",";
                        numeroInd = observaciones.substring(0, observaciones.length - 1)
                        numeroInd=this.limpiaCadena(numeroInd);
                        cadenalimpia = numeroInd + ",";     
                    } else {                                                       //aqui no es valido termina el for y reinicia la cadena, porque por ahí no es// ahora regresas
                        cadena = "no ";  cadenalimpia = "no ";   
                    }                              
                }
            }
            this.cadenas["cadena"] = cadena.substring(0, cadena.length - 1)
            this.cadenas["cadenalimpia"] = cadenalimpia.substring(0, cadenalimpia.length - 1)
            if (cadena === "for" || cadena=== "no" || cadena === ""){
                return 0;
            }else{
                return this.cadenas;
            }
        },
        limpiaCadena(cadena){
            if(isNaN(cadena)){
                cadena = cadena.substring(0, cadena.length - 1) ;
            }
            return cadena
        },
        exportTableToExcel(tableID, filename) {
            if (!filename)
                filename = 'excel_data.xls';
            let dataType = 'application/vnd.ms-excel';
            let tableSelect = document.getElementById(tableID);
            let tableHTML = tableSelect.outerHTML;
            let blob = new Blob([tableHTML], {type: dataType});
            if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                let a = document.createElement("a");
                document.body.appendChild(a);
                a.style = "display: none";
                let csvUrl = URL.createObjectURL(blob);
                a.href = csvUrl;
                a.download = filename;
                a.click();
                URL.revokeObjectURL(a.href)
                a.remove();
            }
        },
        traerSalida() {
            this.loading = true
            console.log('traer salida');
            var url = base + 'progra/traeSal'
            axios.get(url)
                    .then(res => {
                        this.salida = res.data
                        this.loading = false
                        //this.traerEntrada()             //Actualizar estado del boton borrar datos al obtener codigos
                        this.irSalida()
                    })
        },
        datosMensaje(tipo, cab, msg) {
            if (tipo == 'exito') {
                var ico = '<h1><i class="bi bi-check-circle-fill" style="color: #17816a ;padding px-5 ;"></i></h1><h4><b>'
            } else if (tipo == 'error') {
                var ico = '<h1><i class="bi bi-x-octagon" style="color: #d63d0b ;padding px-5 ;"></i></h1><h4><b>¡Error!</b></h4>'
            }
            ico += cab;
            ico += '</b></h4>';
            ico += msg;
            return ico;
        },
        msjAlert(ico,title){
            Swal.fire({
                title: title, 
                html: ico,
                background: `rgba(243, 247, 248)`,
                confirmButtonText: 'OK',  
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn butDark",
                    title: 'navSup titulo3'
                }
            }).then((result) => { 
                if (result.isConfirmed) {    }
            })
        },
        // traerEntrada() {                        //Trae la tabla de entrada para hacer funcionar boton de borrar
        //     this.loading = true
        //     var url = base + 'progra/traeEnt'
        //     axios.get(url)
        //     .then(res => {
        //         if(res.data == '' || res.data == null){
        //             this.loading = false
        //             return this.existenDatos= false
        //         }else{
        //             this.loading = false
        //             return this.existenDatos= true
        //         }   
        //     })
        // },
        traerIngresos() {                        //Trae la tabla de ingresos
            this.loading = true
            var url = base + 'progra/traeIngre'
            console.log('TraeIngresos ');
            axios.get(url)
            .then(res => {
                if(res.data == '' || res.data == null){
                    this.loading = false
                    return this.existenDatos= false
                }else{
                    this.loading = false
                    console.log('datos ingresos: ',res.data);
                    return this.existenDatos= false
                }   
            })
        },
        // borrarEntrada() {                        //Borra la tabla de entrada 
        //     this.loading = true
        //     var url = base + 'progra/borraEnt'
        //     axios.get(url)
        //     .then(res => {
        //         this.traerEntrada()
        //         this.loading = false
        //         console.log('Borrado correcto de la entrada');
        //         ico = this.datosMensaje('exito','¡Éxito!','Se ha borrado correctamente los registros existentes')
        //         var title = 'Registros borrados';  this.msjAlert(ico,title)
        //     }).catch((error)=>{
        //         this.traerEntrada()
        //         this.loading = false
        //         console.log('Error al borrar la entrada');
        //         ico = this.datosMensaje('error','¡Error!','Hubo un error al borrar tabla. Intentelo de nuevo')
        //         var title = 'Error Borrando';  this.msjAlert(ico,title);
        //     })
        // },
        
        msjAlertTimeOut(title) {
            var ico = this.datosMensaje('error', '¡Oops!', ' ... El servidor ha tardado mucho en responder, intente de nuevo  más tarde.')
            Swal.fire({
                title: title,
                html: ico,
                background: `rgba(243, 247, 248)`,
                confirmButtonText: 'OK',
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn butDark",
                    title: 'navSup titulo3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                }
            })
        }
    },
    computed: {
        botonEnviarReg(){
            this.validaEntrada()
            if( this.enviarReg == true ) { return false }
                                     else{ return true  }
        },
        botonBorrarReg(){
            //this.traerEntrada()                         //Actualizar estado del boton borrar datos
            if(this.existenDatos=== true){
                return false                            //Se habilita el boton desactivando disable
            }else{
                return true
            }
        }
    },
})
.mount('#appPrograma');