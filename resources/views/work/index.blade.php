@extends('layouts.index')
@section('contenido')
<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
        <aside id="fh5co-aside" role="complementary" class="border js-fullheight">

            <h1 id="fh5co-logo"><a href=""><img src="{{asset ('images/logo.png')}}" ></a></h1>
            <nav id="fh5co-main-menu" role="navigation">
                <ul>
                    <li class="fh5co-active"><a href="/">Inicio</a></li>
                    <li><a href="">Telefonos</a></li>
                    <li><a href="{{ url('contacto') }}">Contactanos</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="fh5co-active"><a href="{{ url('/main') }}">Home</a></li>
                        @else
                            <li><a href="" data-toggle="modal" data-target="#popUpWindow">login</a></li>
                        @endauth
                    @endif
                </ul>
            </nav>

            <div class="fh5co-footer">
                <p><small>&copy; 2018 Todos los derechos reservados Phonebol.</span></small></p>
                <ul>
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-instagram"></i></a></li>
                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
                </ul>
            </div>

        </aside>
        <div id="fh5co-main">

<div class="fh5co-narrow-content">
<div class="row">

					<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
						<figure class="text-center">
							<img src="images/work_1.jpg"   class="redu">
						</figure>
					</div>
                    <button data-animate-effect="fadeInLeft" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Negociar</button>
                    
					<div class="col-md-8 col-md-offset-2 animate-box" data-animate-effect="fadeInLeft">
						
						<div class="col-md-9 col-md-push-3">
                            <h1>Características</h1>
                            <h3>Pantalla:</h3>
                            <p>5.8 pulgadas</p>
                            <h3>Cámara:</h3>
                            <p>Trasera 12.0 MP Frontal 8.0 MP </p>
                            <h3>Memoria:</h3>
                            <p>64GB</p>
                            <h3>Ram:</h3>
                            <p>4GB</p>
                            <h3>Batería:</h3>
                            <p>3000mAh</p>

						</div>

						<div class="col-md-3 col-md-pull-9 fh5co-services">
							<h3>Precio</h3>
							<ul>
								<li>3200 BS</li>
							</ul>
						</div>

					</div>
				</div>

			</div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">NEGOCIAR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Telefono</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Celular a Modo de Pago</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Estado</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Telefono que desea</label>
                            <input type="text" class="form-control" id="recipient-name" placeholder="Galaxy S9">
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Enviar</button>
                    </div>
                    </div>
                </div>
            </div>

<div class="row work-pagination animate-box" data-animate-effect="fadeInLeft">
    <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0">

        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
            
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
            <a href="#"><i class="icon-th-large"></i></a>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
        
        </div>
    </div>
</div>

</div>
</div>


@endsection