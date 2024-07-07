<div id="appContacto" > 
    <div v-if="loading"> 
        <span v-html="appLoader"></span></p>
    </div>  

    <ol class="breadcrumb sinFondo">
        <li class="breadcrumb-item active" aria-current="page"><text class="titulo6">Contacto</text></li>
    </ol>

    <div class="card border-dark mb-4 bg-light profundidad2" >
        <div class="card-header navSup titulo3" style="text-align:center"><strong>Cálculo de ingresos y gastos</strong></div>
        <div class="card-body fondoWhite">
        
            <H5 style="text-align:center">
                <strong><span style="color: #172f57;">Contactos</span></strong>
            </H5>

            <div class="row mt-3 mb-3">
                <div class="col-sm text-center">
                    <span style="color: #bd8f16;">
                    <strong>Ing. Brayan Cabrera</h5></strong></span> 
                    <br><b>Desarrollador</b>
                </div>
            </div>

            <div class="card-text" style="text-align:center">
                <p>
                    <i class="bi bi-at" style="color: #bd8f16 ;margin-right: 5px ;"></i>
                        <a href="mailto:martako938@gmail.com" target="_top">martako938@gmail.com</a>   
                    <i class="bi bi-telephone-fill" style="color: #bd8f16 ;margin-right: 5px ;"></i><a href="tel:+5215556226124">(56)-3404-4909</a>
                </p>

                <p class="mb-1" >
                   <b>Versión: </b><?php echo $Version ?>. <b>  Sistemas</b> 
                </p>
                <p class="mb-1" >
                   <b>Última Actualización:</b> {{ this.diaNombre }} {{ this.dia }} de  {{ this.mesNombre }} de {{ this.anio }}.
                </p>
                <p>
                    Hecho en México {{ this.anio }}. <b>Esta página no puede ser reproducida.</b>
                </p>
                <p>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalMap" ><u> Dirección: Calle 103 Lt 6-A, Hank González, Ecatepec de Morelos ,Edo. México, C.P., 55520</u></a>
                </p>
            </div>

        </div>
    </div>

    <!-- Modal Map-->
    <div class="modal fade" id="modalMap" tabindex="-1" aria-labelledby="modalMap" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header navSup titulo3">
                        <h1 class="modal-title ms-3 fs-5 text-center" id="mapModalLabel">BY OMEGA</h1>
                        <button type="button" aria-label="Close" class="btn butDark" data-bs-dismiss="modal"><b>X</b></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">                             
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe src="https://maps.google.com/maps?q=Cda.%20103%2016a&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width="765" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn butBlue2 sizeWidth3" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
        </div>
    </div>

</div>              <!-- Fin appContacto -->

