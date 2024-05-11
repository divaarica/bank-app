<!doctype html>
<html lang="en">

<head>
    <title>Finances &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css"> -->

    <link rel="stylesheet" href="{{ asset('Accueil/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Accueil/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('Accueil/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Accueil/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Accueil/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('Accueil/css/style.css') }}">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>



        <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-6 col-xl-2">
                        <h1 class="mb-0 site-logo"><a href="{{ route('accueil.index')  }}" class="h2 mb-0">SoftBanK<span class="text-primary">.</span>
                            </a></h1>
                    </div>

                    <div class="col-12 col-md-10 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="{{ route('accueil.index')  }}" class="nav-link">Accueil</a></li>
                                <li><a href="#contact-section" class="nav-link">Contact</a></li>
                                <li><a href="{{ route('auth.login')  }}" class="nav-link">Se Connecter</a></li>
                                <!-- <li class="has-children">
                                    <a class="nav-link">Langue - Francais</a>
                                    <ul class="dropdown">
                                        <li><a  class="nav-link">Anglais</a></li>
                                        <li><a  class="nav-link">Espagnol</a></li>
                                    </ul>
                                </li> -->
                                <li class="social"><a href="#contact-section" class="nav-link"><span class="icon-linkedin"></span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>


                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>

        </header>


        <div class="site-blocks-cover overlay img1" data-aos="fade" id="home-section">

            <div class="container">
                <div class="row align-items-center justify-content-center">


                    <div class="col-md-10 mt-lg-5 text-center">
                        <div class="single-text owl-carousel">
                            <div class="slide">
                                <h1 class="text-uppercase" data-aos="fade-up">Solutions bancaires</h1>
                                <!-- <div data-aos="fade-up" data-aos-delay="100">
                  <a href="#" target="_blank" class="btn  btn-primary mr-2 mb-2">Get In Touch</a>
                </div> -->
                            </div>

                            <div class="slide">
                                <h1 class="text-uppercase" data-aos="fade-up">Solutions Financieres</h1>
                                <!-- <div data-aos="fade-up" data-aos-delay="100">
                  <a href="#" target="_blank" class="btn  btn-primary mr-2 mb-2">Get In Touch</a>
                </div> -->
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <a href="#next" class="mouse smoothscroll">
                <span class="mouse-icon">
                    <span class="mouse-wheel"></span>
                </span>
            </a>
        </div>


        <div class="site-section cta-big-image" id="about-section">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">A Propos de nous</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Bienvenue sur softBank, votre partenaire financier
                            pour une gestion simple et sécurisée de votre argent. .</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="circle-bg">
                            <img src="{{ asset('Accueil/images/img_2.jpg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

                        <p class="text-black mb-4">Notre plateforme est conçue pour faciliter vos transferts d'argent, gérer vos
                            comptes courants et épargne, et créer des cartes bancaires adaptées à vos besoins.</p>

                        <p>Nous mettons l'accent sur la simplicité et la commodité. Grâce à notre interface conviviale, vous pouvez
                            accéder à votre compte à tout moment et de n'importe où, pour effectuer des transferts, consulter vos
                            soldes et gérer vos dépenses.</p>

                        <p>Chez [Nom de la Banque], la sécurité et la confidentialité de vos informations sont notre priorité
                            absolue. Vous pouvez avoir confiance en notre engagement à protéger vos données à chaque étape de votre
                            parcours financier.</p>

                    </div>
                </div>

            </div>
        </div>

        <section class="site-section border-bottom bg-light" id="services-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">Nos services</h2>
                    </div>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="{{ asset('Accueil/images/flaticon-svg/svg/006-credit-card.svg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Cartes Bancaires </h3>
                                <p>Personnalisez votre expérience bancaire avec nos cartes bancaires sur mesure. Profitez de la
                                    commodité des paiements en ligne et en magasin, avec la tranquillité d'esprit offerte par nos mesures
                                    de sécurité avancées.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="{{ asset('Accueil/images/flaticon-svg/svg/002-rich.svg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Comptes</h3>
                                <p>Avec nos comptes, vous pouvez effectuer vos transactions quotidiennes en toute facilité tout en
                                    mettant de l'argent de côté pour vos projets futurs. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="{{ asset('Accueil/images/flaticon-svg/svg/003-notes.svg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Insurance Consulting</h3>
                                <p>Envoyez de l'argent rapidement et en toute sécurité à vos proches, où qu'ils se trouvent dans le
                                    monde. Notre service de transfert d'argent vous permet d'effectuer des transactions en quelques clics
                                    seulement.</p>
                                <!-- <p><a href="#">Learn More</a></p> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="site-section" id="next">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <img src="{{ asset('Accueil/images/about_2.jpg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <br>
                        <br>
                        <br>
                        <div class="mb-4">
                            <h3 class="h3 mb-4 text-black">Notre priorité est la Solution Bancaire</h3>

                        </div>

                        <div class="mb-4">
                            <ul class="list-unstyled ul-check success">
                                <li>Effectuer des virements bancaires en ligne</li>
                                <li>Consulter votre solde de compte en temps réel</li>
                                <li>Creer vos prpros carte de credit</li>
                            </ul>

                        </div>




                    </div>
                </div>
            </div>
        </div>


        <!-- <section class="site-section" id="gallery-section" data-aos="fade">


      <div class="container">

        <div class="row mb-3">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Gallerrie</h2>
          </div>
        </div>



        <div id="posts" class="row no-gutter">
          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_1.jpg" class="item-wrap fancybox">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_1.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>
          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_2.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_2.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item brand col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_3.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_3.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item design col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">

            <a href="images/img_4.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_4.jpg">{{ asset('Admin/css/app.css') }}
            </a>

          </div>

          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_5.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_5.jpg">
            </a>
          </div>

          <div class="item brand col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_1.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_1.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_2.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_2.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item design col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_3.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_3.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_4.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_4.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item design col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_5.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="images/img_5.jpg">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item brand col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="images/img_1.jpg" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="{{ asset('Accueil/images/img_1.jpg') }}">{{ asset('Admin/css/app.css') }}
            </a>
          </div>

          <div class="item design col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
            <a href="{{ asset('Accueil/images/img_2.jpg') }}" class="item-wrap fancybox" data-fancybox="gallery2">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="{{ asset('Accueil/images/img_2.jpg') }}">{{ asset('Admin/css/app.css') }}
            </a>
          </div>


        </div>
      </div>

    </section> -->


        <section class="site-section bg-light" id="contact-section" data-aos="fade">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Contactez nous</h2>
                    </div>
                </div>
                <div class="row mb-5">



                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-room d-block h2 text-primary"></span>
                            <span>Sacre coeur - Cite keur gorgui, Dakar</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-phone d-block h2 text-primary"></span>
                            <a href="#">+221 33 3235 324</a>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-0">
                            <span class="icon-mail_outline d-block h2 text-primary"></span>
                            <a href="#">ricamouelel@gmail.com</a>
                        </p>
                    </div>
                </div>
                <!-- <div class="row">
          <div class="col-md-12 mb-5">

            <form action="#" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Contact Form</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          
        </div> -->
                <br><br>

                <div class="col-12 text-center">
                    <h3 class="text-center">Vous Souhaitez recevoir les informations d'une transaction par mail? Veuillez remplir le formulaire suivant !</h3>
                </div>
                <br>
                @if(session('success'))
                <div class="text-danger">
                    {{ session('success') }}
                </div>
                <br><br>


                @endif
                <div class="row justify-content-center ">
                    <form action="{{ route('transactions.receVoirInfo') }}" method="post" class="justify-content-center">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <br>
                                <input class="form-control" name="email" type="text" value="">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <br>
                                <label for="example-text-input" class="form-control-label">Code Transaction </label>
                                <br>

                                <input class="form-control" type="text" name="codeTrans" value="">
                                @error('codeTrans')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                                <label for="example-text-input" class="form-control-label">Mot de passe</label>
                                <br>

                                <input class="form-control" name="motDePasse" type="password" value="">
                                @error('motDePasse')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>



                        </div>

                        <button type="submit" class="btn bnt-sm btn-primary"> Valider</button>
                    </form>
                </div>

            </div>
    </div>
    </section>


    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="footer-heading mb-4">A propos de nous</h2>
                            <p>Notre plateforme est conçue pour faciliter vos transferts d'argent, gérer vos
                                comptes courants et épargne, et créer des cartes bancaires adaptées à vos besoins.</p>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <h2 class="footer-heading mb-4">Links</h2>
                            <ul class="list-unstyled">
                                <li><a href="#about-section" class="smoothscroll">A propos de nous</a></li>
                                <li><a href="#contact-section" class="smoothscroll">Contactez nous</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 footer-social">
                            <h2 class="footer-heading mb-4">Follow Us</h2>
                            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5 mt-5 text-center">
                <div class="col-md-12">
                    <div class="border-top pt-5">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made
                            with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                    </div>
                </div>

            </div>
        </div>
    </footer>

    </div> <!-- .site-wrap -->

    <script>
        const stepMenuOne = document.querySelector('.formbold-step-menu1')
        const stepMenuTwo = document.querySelector('.formbold-step-menu2')
        const stepMenuThree = document.querySelector('.formbold-step-menu3')

        const stepOne = document.querySelector('.formbold-form-step-1')
        const stepTwo = document.querySelector('.formbold-form-step-2')
        const stepThree = document.querySelector('.formbold-form-step-3')

        const formSubmitBtn = document.querySelector('.formbold-btn')
        const formBackBtn = document.querySelector('.formbold-back-btn')

        formSubmitBtn.addEventListener("click", function(event) {
            event.preventDefault()
            if (stepMenuOne.className == 'formbold-step-menu1 active') {
                event.preventDefault()

                stepMenuOne.classList.remove('active')
                stepMenuTwo.classList.add('active')

                stepOne.classList.remove('active')
                stepTwo.classList.add('active')

                formBackBtn.classList.add('active')
                formBackBtn.addEventListener("click", function(event) {
                    event.preventDefault()

                    stepMenuOne.classList.add('active')
                    stepMenuTwo.classList.remove('active')

                    stepOne.classList.add('active')
                    stepTwo.classList.remove('active')

                    formBackBtn.classList.remove('active')

                })

            } else if (stepMenuTwo.className == 'formbold-step-menu2 active') {
                event.preventDefault()

                stepMenuTwo.classList.remove('active')
                stepMenuThree.classList.add('active')

                stepTwo.classList.remove('active')
                stepThree.classList.add('active')

                formBackBtn.classList.remove('active')
                formSubmitBtn.textContent = 'Submit'
            } else if (stepMenuThree.className == 'formbold-step-menu3 active') {
                document.querySelector('form').submit()
            }
        })
    </script>
    <script src="{{ asset('Accueil/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('Accueil/js/popper.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('Accueil/js/aos.js') }}"></script>
    <script src="{{ asset('Accueil/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('Accueil/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('Accueil/js/isotope.pkgd.min.js') }}"></script>


    <script src="{{ asset('Accueil/js/main.js') }}"></script>

    <!-- <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>


    <script src="js/main.js"></script> -->


</body>

</html>