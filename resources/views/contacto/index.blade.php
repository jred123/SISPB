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
            <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.943682741264!2d-66.15303262884638!3d-17.372540544388542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e374199a304dbb%3A0x450587ff8b3d9846!2sIC+Norte!5e0!3m2!1sen!2sbo!4v1547841467896" width="100%" height="650" frameborder="0" style="border:0" allowfullscreen></iframe></div>
            
            <div class="fh5co-more-contact">
                <div class="fh5co-narrow-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
                                <div class="fh5co-icon">
                                    <i class="icon-envelope-o"></i>
                                </div>
                                <div class="fh5co-text">
                                    <p><a href="#">phonebol@domain.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
                                <div class="fh5co-icon">
                                    <i class="icon-map-o"></i>
                                </div>
                                <div class="fh5co-text">
                                    <p>Av. America y final Av. Pando IC NORTE .</p>
                                    <p>Av. Melchor Perez de Holguin y Av. Juan de la rosa HIPERMAXI .</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
                                <div class="fh5co-icon">
                                    <i class="icon-phone"></i>
                                </div>
                                <div class="fh5co-text">
                                    <p><a href="tel://">+591 XXX XXXXX</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
                
                <div class="row">
                    <div class="col-md-4">
                        <h1>Mandanos Un Mensaje</h1>
                    </div>
                </div>
                <form action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nombre">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <textarea name="" id="message" cols="30" rows="7" class="form-control" placeholder="Mensaje"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-md" value="Enviar Message">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
@endsection