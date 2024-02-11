<div id="appPrograma"> 
    <div v-if="loading"> 
        <span v-html="appLoader"></span></p>
    </div> 


    <ol v-if="viewEntrada === true" class="breadcrumb sinFondo">
            <li class="breadcrumb-item-active" aria-current="page" ><text class="titulo6"><a>Entrada/</a></text></li>
            <li class="breadcrumb-item" aria-current="page" ><text class="titulo6"><a href="#" @click="irSalida()">Salida</a></text></li>
    </ol> 

    <ol v-if="viewSalida === true" class="breadcrumb sinFondo">
            <li class="breadcrumb-item"><a href="#"  @click="irEntrada()">Entrada</a></li>
            <li class="breadcrumb-item-active" aria-current="page" ><text class="titulo6"><a> / Salida</a></text></li>       
    </ol> 
    
    <div class="container mt3 area4 profundidad">
        <br>
        <div v-if="viewEntrada">
            <div class="row">

                <!-- <div class="col-4 text-center">
                    <div class="card mb-2 profundidad2">
                        <div class="card-body edge2">

                            <h5> <b>Atención</b></h5>                            
                            <br>

                            <p>Esta opción se habilita si existen datos guardados. Si deseas borrarlos presiona el botón rojo</p>
                            <div class="btn-group mb-3">
                                <button type="button" class="btn butRed2" :disabled="botonBorrarReg"  @click="borrarEntrada()" href="#">Borrar datos</button>
                            </div>

                        </div>
                    </div>

                </div> -->

                <div class="col-4 text-center">

                    <!-- <div class="card mb-2 profundidad2">
                        <div class="card-body edge2">

                        </div>
                    </div> -->

                </div>

                <div class="col-4 text-center">

                    <div class="card mb-2 profundidad2">
                        <div class="card-body edge2">

                            <h5> <b>Ingresa dato:</b></h5>                            
                            <br>

                            <form id="ingresarReg" @submit.prevent="ingresarNumeros()">
                                <p class="card-text">
                                   <textarea id="vcNums" name="vcNums" rows="4" cols="20" placeholder="Numeros de empleado"  v-model="numerosEmp"></textarea>                                                                                                 
                                </p>
                                <input type="hidden" id="vcNumsFil" name="vcNumsFil" v-model="cadenas.cadena">
                                <input type="hidden" id="vcNumslim" name="vcNumslim" v-model="cadenas.cadenalimpia">

                                <div class="btn-group mb-3">
                                   <button type="button" class="btn btn-outline-success" :disabled="botonEnviarReg" @click="ingresarNumeros()" href="#">Guardar Números</button>
                                    <button type="button" class="btn btn-outline-warning"  @click="traerSalida">Obtener Códigos</button>

                                </div>

                                <div v-if="msjSalida[1] == '1' " class="container area3 text-center"> 
                                    <p class="titulo4 sinMarginBottom"> {{ msjSalida[0]}} </p> 
                                </div>
                            </form> 

                        </div>
                    </div>

                </div>

                <div class="col-4 text-center">

                    <!-- <div class="card mb-2 profundidad2">
                        <div class="card-body edge2">

                        </div>
                    </div> -->

                </div>

            </div>
        </div>

        <div v-if="viewSalida">
            <div class="row">
                <div class="col-1 text-center"></div>
                    
                <div class="col-10 text-center">
                    <div class="mb-3">
                        <h5> <b>Codigos obtenidos</b></h5>
                    </div>
                    <!-- Tabla de datos -->
                    <div class="table-responsive-md navSupDark col-12 edge2 profundidad2" >
                        <table class="table2 tablaBorde table-bordered" id="tabla"  style="width:80%" align="center">
                            <tbody>  
                                <thead class="primero" border="1">
                                    <tr>
                                        <td id="uno" colspan="8" align="center">
                                        <!-- <b>Cabecera</b><br>												
                                        <b>/b>	<br>												
                                        <b></b>	<br>												
                                        <b></b>	<br>												
                                        <b></b> -->
                                        </td>
                                        <td id="" align="center">
                                            <div id="current_date" align="right">
                                                <script>
                                                    date = new Date();
                                                    year = date.getFullYear();
                                                    month = date.getMonth() + 1;
                                                    day = date.getDate();
                                                    document.getElementById("current_date").innerHTML = "<strong>"+day + "/" + month + "/" + year+"</strong>";
                                                </script>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                                <tr>
                                    <td class="encabezado">ID</td>
                                    <td class="encabezado">NumEmpleado</td>
                                    <td class="encabezado">NumEmpleadoL</td>
                                    <td class="encabezado">Dependencia</td>
                                    <td class="encabezado">PR</td>
                                    <td class="encabezado">SP</td>
                                    <td class="encabezado">DEP</td>
                                    <td class="encabezado">SD</td>
                                    <td class="encabezado">Partida</td>
                                </tr>
                                <template v-for="(sal, index) in salida" :key="index">     
                                    <tr class="">
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{index+1}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iNumEmp}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iNumEmpLargo}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].vcDependencia}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iPR}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iSP}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iDEP}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].iSD}}</div>
                                        </td>
                                        <td scope="row" class="text-center sizeWidth2" style="border: 1px solid #808080; border-right: 1px solid black; border-collapse: collapse;">
                                            <div class="marginsTable">{{salida[index].ipartida}}</div>
                                        </td>
                                    </tr>
                                </template>    
                            </tbody>
                        </table>
                    </div>

                    </br>

                    <div class="btn-group mb-3">
                        <button type="button" class="btn btn-outline-secondary"  @click="irEntrada()">Cargar Números</button>
                        <button type="button" class="btn btn-outline-success" name="btnExportar" id="btnExportar" value="Exportar a Excel" onclick="exportToExcel()" >Exportar a Excel</button>
                    </div>

                </div>

                <div class="col-1 text-center"></div>
            </div> 
        </div>

        <br>

    </div>
</div> 

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" ></script>
<!-- LIBRERÍA DATA TABLE -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.js" ></script>
<!-- ExcelJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.2.0/exceljs.min.js"></script>

<style>
    .encabezado{
        background-color: mediumaquamarine;
        color: black;
        font-weight: bold;
        border-style: solid;
    }
    .campo {
        border-style: solid;
    }
</style>

<script>
    async function exportToExcel() {
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet('Sheet 1');

        // Agregar datos a la hoja de trabajo y así mismo agregamos las librerias
        const table = document.getElementById('tabla');
        const headers = Array.from(table.querySelectorAll('th')).map(header => header.textContent.trim());
        const rows = Array.from(table.querySelectorAll('tbody tr')).map(row =>
            Array.from(row.querySelectorAll('td')).map(cell => cell.textContent.trim())
        );

        worksheet.addRow(headers);
            rows.forEach(row => worksheet.addRow(row));
                
        //Tamaño columnas
        worksheet.getColumn('A').width = 5;
        worksheet.getColumn('B').width = 15;
        worksheet.getColumn('C').width = 15;
        worksheet.getColumn('D').width = 80;
        worksheet.getColumn('E').width = 5;
        worksheet.getColumn('F').width = 5;
        worksheet.getColumn('G').width = 5; 
        worksheet.getColumn('H').width = 5;
        worksheet.getColumn('I').width = 10; 
        
        //Centrado texto
        worksheet.getColumn('A').alignment = { horizontal: 'center' };
        worksheet.getColumn('B').alignment = { horizontal: 'center' };
        worksheet.getColumn('C').alignment = { horizontal: 'center' };
        worksheet.getColumn('D').alignment = { horizontal: 'center' };
        worksheet.getColumn('E').alignment = { horizontal: 'center' };
        worksheet.getColumn('F').alignment = { horizontal: 'center' };
        worksheet.getColumn('G').alignment = { horizontal: 'center' };
        worksheet.getColumn('H').alignment = { horizontal: 'center' };
        worksheet.getColumn('I').alignment = { horizontal: 'center' };
        
        //Color del encabezado
        const segundo = worksheet.getRow(2);
        segundo.eachCell(cell => {
            cell.fill = {
                type: 'pattern',
                pattern: 'solid',
                fgColor: { argb: '87eaa6' },
            };
            cell.font = {
                color: { argb: '000000' }, 
                    bold: true,
            };
            
        });
        
        //Array para las columnas al borde
        var miArray = document.getElementById("tabla").rows.length;
        for (i=0;i<(miArray+3);i++){ 
        const cuarto = worksheet.getRow(i);
        cuarto.eachCell(cell => {
            // Agregar borde a las celdas
            cell.border = {
                top: { style: 'thin', color: { argb: '000000' } },
                left: { style: 'thin', color: { argb: '000000' } },
                bottom: { style: 'thin', color: { argb: '000000' } },
                right: { style: 'thin', color: { argb: '000000' } },
                
            };
            //Finalizacón del programa
        });
        }    
        // Crear un Blob con el archivo Excel
        const blob = await workbook.xlsx.writeBuffer();

        // Descargar el archivo
        const blobURL = URL.createObjectURL(new Blob([blob], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' }));
        const a = document.createElement('a');
        a.href = blobURL;
        a.download = 'Códigos obtenidos.xlsx';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>
