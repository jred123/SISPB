<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Transeferencias
                        <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <!-- Listado-->
                    <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="tipo_comprobante">Tipo Comprobante</option>
                                      <option value="num_comprobante">Número Comprobante</option>
                                      <option value="fecha_hora">Fecha-Hora</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarTransferencia(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarTransferencia(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Usuario Envio</th>
                                        <th>Usuario Recibo</th>
                                        <th>Tipo Comprobante</th>
                                        <th>Origen</th>
                                        <th>Número Comprobante</th>
                                        <th>Fecha Hora</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="transferencia in arrayTransferencia" :key="transferencia.id">
                                        <td>
                                            <button type="button" @click="verTransferencia(transferencia.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                            <button type="button" @click="pdfTransferencia(transferencia.id)" class="btn btn-info btn-sm">
                                            <i class="icon-doc"></i>
                                            </button> &nbsp;
                                            <template v-if="transferencia.estado=='Registrado'">
                                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarTransferencia(transferencia.id)">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </template>
                                            <template v-else-if="transferencia.estado=='Pendiente'">
                                                
                                                <button type="button" class="btn btn-info btn-sm" @click="agregarTransferencia(transferencia,transferencia.id)">
                                                    <i class="icon-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" @click="eliminarTransferencia(transferencia.id)">
                                                    <i class="icon-close"></i>
                                                </button>
                                                
                                            </template>
                                            
                                        </td>
                                        <td v-text="transferencia.usuario"></td>
                                        <td v-text="transferencia.Receptor"></td>
                                        <td v-text="transferencia.tipo_comprobante"></td>
                                        <td v-text="transferencia.origen"></td>
                                        <td v-text="transferencia.num_comprobante"></td>
                                        <td v-text="transferencia.fecha_hora"></td>
                                        <td v-text="transferencia.total"></td>
                                        <td v-text="transferencia.estado"></td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-else-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo Comprobante(*)</label>
                                    <select class="form-control" v-model="tipo_comprobante">
                                        <option value="0">Seleccione</option>
                                        <option value="BOLETA">Boleta</option>
                                        <option value="FACTURA">Factura</option>
                                        <option value="TICKET">Ticket</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Numero Comprobante</label>
                                    <input type="text" class="form-control" v-model="num_comprobante" placeholder="000x">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="text-input">Origen</label>
                                    <select class="form-control" v-model="origen">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="sucursal in arraySucursal" :key="sucursal.id" :value="sucursal.nombre" v-text="sucursal.nombre"></option>
                                    </select>  
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="text-input">Destino</label>
                                    <select class="form-control" v-model="destino">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="sucursal in arraySucursal" :key="sucursal.id" :value="sucursal.nombre" v-text="sucursal.nombre"></option>
                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorTransferencia" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTransferencia" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Artículo <span style="color: red;" v-show="idarticulo==0">(*Seleccione Articulo)</span></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarMote()" placeholder="Ingrese artículo">
                                        <button @click="abrirModal()" class="btn btn-primary">...</button>
                                       <!-- <input type="text" readonly class="form-control" v-model="articulo">-->
                                    </div>                                    
                                </div>
                            </div>
                            

                        </div>
                       
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Artículo</th>
                                            
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.articulo">
                                            </td>
                                            
                                            <td>
                                                <span style="color:red;" v-show="detalle.cantidad>detalle.stock">Stock: {{detalle.stock}}</span>
                                                <input v-model="detalle.cantidad" type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                {{detalle.cantidad}}
                                            </td>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total:</strong></td>
                                            <td>{{total=calcularTotal}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">
                                                No hay articulos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarTransferencia()" >Registrar Transferencia</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!--Ver ingreso-->
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo Comprobante</label>
                                    <p v-text="tipo_comprobante"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Número Comprobante</label>
                                    <p v-text="num_comprobante"></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Origen</label>
                                    <p v-text="origen"></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Destino</label>
                                    <p v-text="destino"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Artículo</th>
                                            <th>Imei</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.articulo">
                                            </td>
                                            <td v-text="detalle.codigo">
                                            </td>
                                            <td v-text="detalle.cantidad">
                                            </td>
                                            <td>
                                                {{detalle.cantidad}}
                                            </td>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total:</strong></td>
                                            <td>{{total=calcularTotal}}</td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay articulos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!--Fin ver ingreso-->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterioA">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                      <option value="codigo">Código</option>
                                      <option value="nombre_categoria">Categoria</option>
                                    </select>
                                    <input type="text" v-model="buscarA" @keyup.enter="listarArticulo(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarArticulo(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                 <thead>
                                 <tr>
                                    <th>Opciones</th>
                                    <th>Articulo</th>
                                    <th>Codigo</th>
                                    <th>Cantidad</th>
                                    <th>Sucursal</th>
                                    <th>Marca</th>
                                    <th>Categoría</th>
                                    
                                    
                                    <th>Estado</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                     <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                                    <td>
                                        <button type="button" @click="agregarDetalleModal(articulo)" class="btn btn-success btn-sm">
                                          <i class="icon-check"></i>
                                        </button>
                                    </td>
                                    <td v-text="articulo.nombre"></td>
                                    <td v-text="articulo.codigo"></td>
                                    <td v-text="articulo.stock"></td>
                                    <td v-text="articulo.nombre_sucursal"></td>
                                    <td v-text="articulo.nombre_marca"></td>
                                    <td v-text="articulo.nombre_categoria"></td>
                                    
                                    
                                    <td>
                                        <div v-if="articulo.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    import vSelect from 'vue-select';
    export default {
        data (){
            return {
                transferencia_id: 0,
                tipo_comprobante : 'BOLETA',
                num_comprobante : '',
                total:0.0,
                origen:'',
                destino:'',
                arrayTransferencia : [],
                arrayDetalle : [],
                arraySucursal :[],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTransferencia : 0,
                errorMostrarMsjTransferencia : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'num_comprobante',
                buscar : '',
                criterioA: 'nombre',
                buscarA:'',
                arrayArticulo: [],
                idarticulo: 0,
                codigo: '',
                articulo: '',
                stock: '',
                cantidad: 0,
                arraySucursal:[],
            }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },

            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            },

            calcularTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(1*this.arrayDetalle[i].cantidad)
                }
                return resultado;
            }
        },
        methods : {
            listarTransferencia (page,buscar,criterio){
                let me=this;
                var url= '/transferencia?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayTransferencia = respuesta.transferencias.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.selectSucursal();
            },
            selectSucursal(){
                let me=this;
                var url= '/sucursal/selectSucursal';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraySucursal = respuesta.sucursals;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfTransferencia(id){
                window.open('/transferencia/pdf/'+ id ,'_blank');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarTransferencia(page,buscar,criterio);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].idarticulo==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if(me.idarticulo==0 || me.cantidad==0 || me.precio==0){
                }else{
                    if(me.encuentra(me.idarticulo)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este Artículo ya se encuentra agregado!',
                        })
                    }else{
                         me.arrayDetalle.push({
                    idarticulo: me.idarticulo,
                    articulo: me.articulo,
                    cantidad: me.cantidad,
                    });
                    me.codigo='';
                    me.idarticulo=0;
                    me.articulo='';
                    me.cantidad=0;
                    }
                   
                }
                
            },
            agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este Artículo ya se encuentra agregado!',
                        })
                    }else{
                    me.arrayDetalle.push({
                    idarticulo: data['id'],
                    articulo: data['nombre'],
                    stock: data['stock'],
                    cantidad: 1,
                    });
                    }
            },
            listarArticulo (buscar,criterio){
                let me=this;
                var url= '/articulo/listarArticulo?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayArticulo = respuesta.articulos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarTransferencia(){
                if (this.validarTransferencia()){
                    return;
                }
                
                let me = this;

                axios.post('/transferencia/registrar',{
                    'tipo_comprobante': this.tipo_comprobante,
                    'num_comprobante' : this.num_comprobante,
                    'origen' : this.origen,
                    'destino' : this.destino,
                    'total' : this.total,
                    'data' : this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarTransferencia(1,'','num_comprobante');
                    me.tipo_comprobante='BOLETA';
                    me.num_comprobante='';
                    me.origen='';
                    me.destino='';
                    me.total=0;
                    me.idarticulo=0;
                    me.articulo='';
                    me.cantidad=0;
                    me.arrayDetalle=[];
                    
                }).catch(function (error) {
                    console.log(error);
                });
            },
            agregarTransferencia(data,id){
                let me = this;
                
                axios.put('/transferencia/confirmar',{
                    'idc': data['id'],
                    'data': data['destino']

                }).then(function (response) {
                    me.listado=1;
                    me.listarTransferencia(1,'','num_comprobante');
                }).catch(function (error) {
                    console.log(error);
                });

                
            },
            selectSucursal(){
                let me=this;
                var url= '/sucursal/selectSucursal';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraySucursal = respuesta.sucursals;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            validarTransferencia(){
                this.errorTransferencia=0;
                this.errorMostrarMsjTransferencia =[];

                if (this.tipo_comprobante==0) this.errorMostrarMsjTransferencia.push("Seleccione el Comprobante");
                if (!this.num_comprobante) this.errorMostrarMsjTransferencia.push("Ingrese el numero de comprobante");
                if (this.num_comprobante>9999999999) this.errorMostrarMsjTransferencia.push("El numero de comprobante es mayor a lo almacenado");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjTransferencia.push("Ingrese detalles");

                if (this.errorMostrarMsjTransferencia.length) this.errorTransferencia = 1;

                return this.errorTransferencia;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

                me.idproveedor=0;
                    me.tipo_comprobante='BOLETA';
                    me.num_comprobante='';
                    me.total=0.0;
                    me.origen='';
                    me.destino='';
                    me.idarticulo=0;
                    me.articulo='';
                    me.cantidad=0;
                    me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
            verTransferencia(id){
                let me=this;
                me.listado=2;

                //Obtener datos del ingreso
                var arrayTransferenciaT=[];
                var url= '/transferencia/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayTransferenciaT = respuesta.transferencia;
                    
                    me.proveedor = arrayTransferenciaT[0]['nombre'];
                    me.tipo_comprobante=arrayTransferenciaT[0]['tipo_comprobante'];
                    me.num_comprobante=arrayTransferenciaT[0]['num_comprobante'];
                    me.origen=arrayTransferenciaT[0]['origen'];
                    me.destino=arrayTransferenciaT[0]['destino'];
                    me.total=arrayTransferenciaT[0]['total'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                //obtener datos de los detalles
                 var url= '/transferencia/obtenerDetalles?id=' + id;

                axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
            },
            abrirModal(){
                this.arrayArticulo=[];
                this.modal = 1;
                this.tituloModal = 'Seleccione los articulos que desee';
 
            },
        
            desactivarTransferencia(id){
               swal({
                title: 'Esta seguro de desactivar esta Transferencia?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/transferencia/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarTransferencia(1,'','num_comprobante');
                        swal(
                        'Anulado!',
                        'La Transferencia ha sido anulada con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            eliminarTransferencia(id){
               swal({
                title: 'Esta seguro de Cancelar esta Transferencia?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/transferencia/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarTransferencia(1,'','num_comprobante');
                        swal(
                        'Eliminada!',
                        'La Transferencia ha sido eliminada con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },

        },

        mounted() {
            this.listarTransferencia(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }

</style>
