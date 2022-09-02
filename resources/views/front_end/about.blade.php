@section('title', 'About')

<x-front_layout>
    <div class="container">
        <blockquote>Webtalks is a blog that is created for all those individuals who love web technology. Here you get latest news and updates in the world of web development. Here people can give there comments about published posts and also can do discusion with post author and other users.</blockquote>
    </div>

    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                       <h2 class="lg-title">About Me</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <img src="{{asset('images')}}" alt="" srcset="">
            </div>
        </div>
    </div>

    <section class="pt-5 padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                     
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="text-uppercase letter-spacing mb-4">Who is me?</h5>
                                    <p>I am Sakhawat Hussain from Pakistan. I have graduated in Computer Science from the University Of Sindh. I do back-end stuff related to web applications. I use technologies like PHP, PHP Laravel Framework, MYSQL DBMS, JabaScript and HTML, CSS, Bootstrap for some front-end stuff as well.</p>
                    
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="text-uppercase letter-spacing mb-4">My vission</h5>
                                    <p>I am a fresher, I graduated in 2021 one year ago, so I am looking for a career related to my expertise. My vision is to build awesome web applications according to different requirenments and contribute in this world.</p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="text-uppercase letter-spacing mb-4">Follow Me</h5>
                                    @include('partials._socialLinks')
                                </div>
                            </div>
                    
                            <h3 class="mb-3 mt-5">Certificates</h3>
                            <p class="mb-5">After completing my graduation I have been taking some online courses from which I earned these certificates:</p>
                    
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="about-widget mb-4 mb-lg-0">
                                        <img src="{{asset('assets/images/certificates/01.jpg')}}" alt="" class="img-fluid">
                                        <h4 class="mt-3">Create A jQuery Mobile App</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="about-widget mb-4 mb-lg-0">
                                        <img src="{{asset('assets/images/certificates/02.jpg')}}" alt="" class="img-fluid">
                                        <h4 class="mt-3">Design A Portfolio Gallery Using jQuery</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="about-widget mb-4 mb-lg-0">
                                        <img src="{{asset('assets/images/certificates/03.jpg')}}" alt="" class="img-fluid">
                                        <h4 class="mt-3">HTML5 Blog Frontend</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="about-widget mb-4 mb-lg-0">
                                        <img src="{{asset('assets/images/certificates/04.jpg')}}" alt="" class="img-fluid">
                                        <h4 class="mt-3">Create Apple Style Thumbslider Using JavaScript and jQuery</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="about-widget mb-4 mb-lg-0">
                                        <img src="{{asset('assets/images/certificates/05.jpg')}}" alt="" class="img-fluid">
                                        <h4 class="mt-3">Building Projects In C Sharp</h4>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>			
                </div>
            </div>
        </div>
    </section>
</x-front_layout>