@extends('layouts.index')
@section('contenido')
<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

    <h1 id="fh5co-logo"><a href="index.html"><img src="{{asset ('images/logo.png')}}" ></a></h1>
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
        <div class="container">
            <div class="modal fade" id="popUpWindow">
            <div class="modal-dialog">
                <div class="modal-content">
                <!-- header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Inresar</h3>
                </div>
                <!-- body -->
                <div class="modal-header">

                    <form  method="POST" action="{{ route('login')}}">
                        {{ csrf_field() }}
                    <div class="form-group">
                    <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                        <span class="input-group-addon"><i class="icon-user"></i></span>
                        <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                        {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                    <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                    </form>
                </div>
                <!-- footer -->
                
                
                </div>
            </div>
            </div>

            </div>          
            <div class="fh5co-narrow-content">
                <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">NOVEDADES</h2>
                <div class="row animate-box" data-animate-effect="fadeInLeft">
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="{{ url('work') }}">
							<img src="images/work_1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Galaxy S9</h3>
							<p>Samsung</p>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_2.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Moto G7</h3>
							<p>Motorola</p>
						</a>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_3.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Mate 20</h3>
							<p>Huawei</p>
						</a>
					</div>
					<div class="clearfix visible-md-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_4.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Mate 20 Lite</h3>
							<p>Huawei</p>
						</a>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_5.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">iPhone-X</h3>
							<p>Apple</p>
						</a>
					</div>
					
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Work Title Here</h3>
							<p>Illustration, Branding</p>
						</a>
					</div>
					<div class="clearfix visible-md-block"></div>
					
				</div>
            </div>
            <div class="fh5co-narrow-content">
                <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ESPECIALES</h2>
                <div class="row animate-box" data-animate-effect="fadeInLeft">
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Galaxy S9</h3>
							<p>Samsung</p>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_2.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Moto G7</h3>
							<p>Motorola</p>
						</a>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
						<a href="work.html">
							<img src="images/work_3.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<h3 class="fh5co-work-title">Mate 20</h3>
							<p>Huawei</p>
						</a>
					</div>

					<div class="clearfix visible-md-block"></div>
					
				</div>
            </div>
            <div class="fh5co-testimonial" >
                <div class="fh5co-narrow-content">
                    <div class="owl-carousel-fullwidth animate-box" data-animate-effect="fadeInLeft">
                    <div class="item">
                        <figure>
                            <img src="images/testimonial_person2.jpg" alt="Free HTML5 Bootstrap Template">
                        </figure>
                        <p class="text-center quote" style="color:white;">&ldquo;Estoy contento con el teléfono y con la oferta recibida. Quería un buen smarthphone que pudiera hacer todo lo básico y el lugar cumplplía todos los requisitos. Luego el servicio de atención al cliente me ayudó a conseguir eactamente ki que estaba buscando. &rdquo; <cite class="author">&mdash; Andres A. Andia</cite></p>
                    </div>
                    <div class="item">
                        <figure>
                            <img src="images/testimonial_person3.jpg" alt="Free HTML5 Bootstrap Template">
                        </figure>
                        <p class="text-center quote" style="color:white;">&ldquo;Phonebol es la única empresa en Cochabamba, en el que sientes que estás en tu casa, el trato es increíble y siempre con una sonrisa. Aparte de la innovación del sistema de parte de pago y ser pioneros en el mercado de celulares web&rdquo;<cite class="author">&mdash; Bruno G. Salazar</cite></p>
                    </div>
                    <div class="item">
                        <figure>
                            <img src="images/testimonial_person4.jpg" alt="Free HTML5 Bootstrap Template">
                        </figure>
                        <p class="text-center quote" style="color:white;">&ldquo;Tanto el dueño como sus empleados son muy cordiales y amigables. No me arrepiento de haber ido. Me encanto la manera poder conseguir los celulares y como manejan el pago.&rdquo;<cite class="author">&mdash; Freddy Delgadillo</cite></p>
                    </div>
                    <div class="item">
                        <figure>
                            <img src="images/testimonial_person5.jpg" alt="Free HTML5 Bootstrap Template">
                        </figure>
                        <p class="text-center quote" style="color:white;">&ldquo;La mejor atención que he visto en mucho tiempo, realmente merecen la confiaza que se les brinda, muy orgulloso que sea en cochabamba&rdquo;<cite class="author">&mdash; Geovanny B. Encinas</cite></p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="fh5co-narrow-content">
                <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Qué le podemos <span>Ofrecer</span></h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
                            <div class="fh5co-icon">
                                <i class="icon-shopping-cart"></i>
                            </div>
                            <div class="fh5co-text">
                                <h3>Teléfonos</h3>
                                <p>Ofrecemos Variedad de Teléfonos de ultima generación apenas salen al mercado. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
                            <div class="fh5co-icon">
                                <i class="icon-headphones"></i>
                            </div>
                            <div class="fh5co-text">
                                <h3>Accesosrios</h3>
                                <p>Gran variedad de accesorios para celulares como ser cases, protectores, auriculares y muchas cosas más. </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
                            <div class="fh5co-icon">
                                <i class="icon-phone"></i>
                            </div>
                            <div class="fh5co-text">
                                <h3>Atención al Cliente</h3>
                                <p>Puede contactarse con nosotrós de manera sencilla cotizar y adquirir lo que deseé, ya sea con nuestros telefonos o como con la página.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
                            <div class="fh5co-icon">
                                <i class="icon-user"></i>
                            </div>
                            <div class="fh5co-text">
                                <h3>Mantenimiento</h3>
                                <p>Ofrecemos un servicio de mantenimiento, con experertos con mas de 20 años de experiencía trabajando siempre para dar lo mejor. </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="fh5co-counters" style="background-image: url(images/fondohome.jpg);" data-stellar-background-ratio="0.5" id="counter-animate">
                <div class="fh5co-narrow-content animate-box">
                    <div class="row" >
                        <div class="col-md-4 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="67" data-speed="5000" data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Negocios en Ejecucion</span>
                        </div>
                        <div class="col-md-4 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="130" data-speed="5000" data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Trabajos Completados</span>
                        </div>
                        <div class="col-md-4 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="27232" data-speed="5000" data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Clientes trabajando con Phonebol</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="fh5co-cards">
                <div class="fh5co-narrow-content">
                    <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Futuros Proyectos</h2>

                    <div class="fh5co-flex-wrap">
                        <div class="fh5co-card animate-box" data-animate-effect="fadeInLeft">
                            <h5>Sucursal</h5>
                            <p>Gracias a la preferenciá de nuestros clientes se esta propuso la idea de abrir nuevas sucursales con la intención de facilitar a nuestros clientes contactarnos y disfrutar de nuestros productos.</p>
                        </div>
                        <div class="fh5co-card animate-box" data-animate-effect="fadeInLeft">
                            <h5>Mercado</h5>
                            <p>Nuestra empresa planea impulsar nuevas fuentes de trabajo dando una oportunidad a nuestra propia gente demostrando el gran valor y respeto que tenemos hacia nuestra sociedad.</p>

                        </div>

                    </div>  
                    
                </div>
            </div>
            <div class="fh5co-narrow-content">
                <div class="row">
                    <div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
                        <h1 class="fh5co-heading-colored">Acerca de  Nosotros</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
                        <p class="fh5co-lead">Desde 1998 importando innovación tecnológica en telefonía.</p>
                    </div>
                    <div class="col-md-7 col-md-push-1">
                        <div class="row">
                            <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                                <p>Phonebol trabaja con las normativas claras cordialidad, confianza y rapides, para la mejor experiencia del nuestros clientes.</p>
                            </div>
                            <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                                <p>Para un servició completo ofrecemos ayuda con los equipos con posibles problemas y gente capacitada para el mantenimiento y reparación de sus celulares</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection