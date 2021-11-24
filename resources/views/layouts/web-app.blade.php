<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sand Bar Beach Resort </title>
        <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/icon type">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e3a63f713c.js" crossorigin="anonymous"></script>
        {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

        <style>
            #app {
                font-family: 'Montserrat', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar-reduce-opacity navbar navbar-expand-lg navbar-dark background-color-s" style="position:fixed; width: 100%; z-index: 999999">
                <a class="navbar-brand logo-nav" href="{{ route('website.index') }}"><img src="{{url('/images/logo.jpg')}}" height="75" width="75"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto" style="margin-right:150px">
                        <li class="nav-item @route('website.index') active @endif">
                            <a class="nav-link font-oswald letter-spacing" href="{{ route('website.index') }}"> HOME </a>
                            @route('website.index') <hr style="margin-bottom:0px; margin-top:0px; border-top:3px solid #68A6BF; width: 40%; margin-left:9px"> @endif
                        </li>
                        <li class="nav-item @route('website.rooms') active @endif">
                            <a class="nav-link font-oswald letter-spacing" href="{{ route('website.rooms') }}">ROOMS</a>
                            @route('website.rooms') <hr style="margin-bottom:0px; margin-top:0px; border-top:3px solid #68A6BF; width: 40%; margin-left:9px"> @endif
                        </li>
                        <li class="nav-item @route('website.facilities') active @endif">
                            <a class="nav-link font-oswald letter-spacing" href="{{ route('website.facilities') }}">FACILITIES</a>
                            @route('website.facilities') <hr style="margin-bottom:0px; margin-top:0px; border-top:3px solid #68A6BF; width: 40%; margin-left:9px"> @endif
                        </li>
                        <li class="nav-item @route('website.contact-us') active @endif">
                            <a class="nav-link font-oswald letter-spacing" href="{{ route('website.contact-us') }}">CONTACT US</a>
                            @route('website.contact-us') <hr style="margin-bottom:0px; margin-top:0px; border-top:3px solid #68A6BF; width: 40%; margin-left:9px"> @endif
                        </li>
                        <li class="nav-item @route('website.booking-details') active @endif">
                            <a class="nav-link font-oswald letter-spacing font-weight-bold" href="{{ route('website.booking-details') }}" style="color: #68A6BF"> Check Booking </a>
                            @route('website.booking-details') <hr style="margin-bottom:0px; margin-top:0px; border-top:3px solid #68A6BF; width: 40%; margin-left:9px"> @endif
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
            <footer class="p-3 background-color-s text-white">
                <div class="row col-md-12 mt-2 mb-2">
                    <div class="col-md-4 offset-md-2 footer-container">
                        <h5 class="text-center font-weight-bold font-oswald letter-spacing">CONTACT</h5>
                        <table class="d-flex justify-content-center">
                            <tr>
                                <td class="pr-3 pt-2"><i class="fas fa-thumbtack"></i> </td>
                                <td class="pt-2">
                                    Sand Bar Beach Resort Calayo Rd, Nasugbu, Batangas 4231 Nasugbu, Philippines
                                </Td>
                            </tr>
                            <tr>
                                <td class="pr-3 pt-2"><i class="fas fa-mobile"></i></td>
                                <td class="pt-2">(+63) 918-449-5439</td>
                            </tr>
                            <tr>
                                <td class="pr-3 pt-2"><i class="fas fa-envelope"></i></td>
                                <td class="pt-2">sandbarbeachresort@gmail.com</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-center font-weight-bold font-oswald letter-spacing">CONNECT WITH US</h5>
                        <div class="row mt-1 text-center">
                            <div class="col-md-6">
                                <a href="https://www.facebook.com/SandBarEco/"><i class="fab fa-facebook-f fa-2x"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a href="https://www.instagram.com/sandbarresort/"><i class="fab fa-instagram fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
