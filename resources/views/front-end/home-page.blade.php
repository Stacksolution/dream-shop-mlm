@extends('front-end.layouts.app')
@section('title','Ic quick payment')
@section('content')
<section class="section pt-9 pb-9 section-header text-white gradient-overly-right-color" style="background: url('{{ static_asset("front-end/img/hero-bg10.jpg")}}')no-repeat center center / cover">
   <div class="container">
      <div class="row">
         <div class="col-md-7 col-lg-6">
            <div class="hero-slider-content">
               <span class="text-uppercase">Business Solutions</span>
               <h1 class="display-2">Your Most Trusted Business Partner</h1>
               <p class="lead">Holisticly procrastinate mission-critical convergence with reliable customer service. Assertively underwhelm idea-sharing for impactful solutions.</p>
               <a href="#" class="btn btn-secondary mt-4">Get Start Now</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--hero section end-->
<!--promo section start-->
<section class="section section-sm pb-0 mt-n8 z-5 position-relative">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-lg-4 mb-md-4 mb-4 mb-lg-0">
            <div class="single-promo-block promo-hover-bg-1 hover-image shadow p-5 rounded-custom bg-white">
               <div class="icon icon-lg text-primary"><i class="fab fa-confluence"></i></div>
               <div class="promo-block-content">
                  <h5>Creative Design</h5>
                  <p class="mb-0">Compellingly promote collaborative products without synergistic schemas. </p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 mb-md-4 mb-4 mb-lg-0">
            <div class="single-promo-block promo-hover-bg-2 hover-image shadow p-5 rounded-custom bg-white">
               <div class="icon icon-lg text-primary"><i class="fas fa-bug"></i></div>
               <div class="promo-block-content">
                  <h5>Cyber Security</h5>
                  <p class="mb-0">Enthusiastically scale mission-critical imperatives rather than an expanded array.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 mb-md-4 mb-4 mb-lg-0">
            <div class="single-promo-block promo-hover-bg-3 hover-image shadow p-5 rounded-custom bg-white">
               <div class="icon icon-lg text-primary"><i class="fas fa-cloud-moon"></i></div>
               <div class="promo-block-content">
                  <h5>Cloud Services</h5>
                  <p class="mb-0">Rapidiously create cooperative resources rather than client-based leadership skills.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--promo section end-->
<!--about section start-->
<section class="section section-lg  ">
   <div class="container">
      <div class="row justify-content-between align-items-center">
         <div class="col-md-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
            <div class="card bg-primary position-relative  shadow-lg fancy-radius p-3">
               <div class="dot-shape-top position-absolute">
                  <img src="{{ static_asset('front-end/img/color-shape.svg')}}" alt="dot" class="img-fluid">
               </div>
               <img class="fancy-radius img-fluid" src="{{ static_asset('front-end/img/about-us-2.jpg')}}" alt="modern desk">
               <div class="dot-shape position-absolute bottom-0">
                  <img src="{{ static_asset('front-end/img/dot-shape.png')}}" alt="dot">
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-5">
            <div class="video-promo-content">
               <h2>Total Solutions for Your Business Here</h2>
               <p class="lead">Interactively develop timely niche markets before extensive imperatives. Professionally
                  repurpose strategies.
               </p>
               <ul class="list-unstyled tech-feature-list">
                  <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Creative</strong> Websites Design</li>
                  <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Accounting</strong> Procedures Guidebook</li>
                  <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>Cost</strong> Accounting Fundamentals</li>
                  <li class="py-1"><span class="icon icon-xs mr-2 text-secondary"> <i class="ti-control-forward"></i></span><strong>SEO</strong> Optimization Services</li>
               </ul>
               <a href="#" class="btn btn-primary  mt-3">View Services</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--about section end-->
<!--services section start-->
<section class="section services-section ptb-100 bg-soft">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="section-heading text-center mb-5">
               <h2>We Provide Quality Services</h2>
               <p class="lead">Efficiently aggregate end-to-end core competencies without maintainable. Dynamically
                  foster tactical solutions without enabled value.
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-announcement"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">Marketing Services</h3>
                  <p>Progressively empower business "outside the box" thinking with resource-leveling
                     partnerships.
                  </p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-light-bulb"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">Web App Development</h3>
                  <p>Quickly pontificate holistic e-commerce rather than goal web-readiness enhance inexpensive.</p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-headphone-alt"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">24/7 Call Center Service</h3>
                  <p>Authoritatively reinvent multimedia based niches with global portals orchestrate client-centered .</p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-bell"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">Social Media Marketing</h3>
                  <p>Assertively leverage other's standardized e-services with fully tested e-commerce synergistic. </p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-briefcase"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">Corporate Business</h3>
                  <p>Enthusiastically scale client-centric supply chains vis-a-vis enabled benefits empower global core.</p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 mb-4 mb-md-4">
            <div class="services-single d-flex p-5 shadow-sm bg-white rounded">
               <div class="icon icon-lg mr-4 text-secondary">
                  <i class="ti-vector"></i>
               </div>
               <div class="services-content-wrap">
                  <h3 class="h6">Creative Consultancy</h3>
                  <p>Conveniently productize corporate imperatives for innovative best practices ideas ethical change.</p>
                  <a href="services-details.html" class="link-with-icon text-default font-small font-weight-bold" target="_blank">Read more <span> <i class="fas fa-angle-right"></i></span></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--services section end-->

<!--team section start-->
<section class="section section-lg ">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8">
            <div class="section-heading text-center mb-5">
               <h2>Our Team</h2>
               <p class="lead">Dynamically pursue reliable convergence rather than 24/7 process improvements
                  develop end-to-end customer service.
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12 col-md-6 col-lg-4 mb-md-4 mb-lg-0 mb-4">
            <div class="profile-card">
               <div class="card bg-soft  shadow-sm animate-hover border-variant-soft">
                  <div class="profile-image-small  bg-white  shadow-inset shadow border border-light rounded-circle p-1 mt-5 mb-4">
                     <img src="{{ static_asset('front-end/img/team/team-6.jpg')}}" class="card-img-top rounded-circle" alt="Christopher Avatar">
                  </div>
                  <div class="card-body text-center px-5 pb-5 pt-0">
                     <h3 class="h5 mb-2">John Q. Public</h3>
                     <span class="h6 font-weight-normal text-gray mb-3">Developer</span>
                     <ul class="list-unstyled d-flex my-3 justify-content-center">
                        <li>
                           <a href="#" target="_blank" aria-label="facebook social link" class="icon icon-xs icon-facebook mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="50k Like">
                           <span class="fab fa-facebook-f"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="twitter social link" class="icon icon-xs icon-twitter mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="40k Followers">
                           <span class="fab fa-twitter"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="slack social link" class="icon icon-xs icon-slack mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="25k Subscribe">
                           <span class="fab fa-youtube"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-xs icon-dribbble mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="2k Project">
                           <span class="fab fa-dribbble"></span>
                           </a>
                        </li>
                     </ul>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-md-6 col-lg-4 mb-md-4 mb-lg-0 mb-4">
            <div class="profile-card">
               <div class="card bg-soft  shadow-sm animate-hover border-variant-soft">
                  <div class="profile-image-small  bg-white  shadow-inset shadow border border-light rounded-circle p-1 mt-5 mb-4">
                     <img src="{{ static_asset('front-end/img/team/team-1.jpg')}}" class="card-img-top rounded-circle" alt="Christopher Avatar">
                  </div>
                  <div class="card-body text-center px-5 pb-5 pt-0">
                     <h3 class="h5 mb-2">Madurai Mani Iyer</h3>
                     <span class="h6 font-weight-normal text-gray mb-3">Developer</span>
                     <ul class="list-unstyled d-flex my-3 justify-content-center">
                        <li>
                           <a href="#" target="_blank" aria-label="facebook social link" class="icon icon-xs icon-facebook mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="50k Like">
                           <span class="fab fa-facebook-f"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="twitter social link" class="icon icon-xs icon-twitter mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="40k Followers">
                           <span class="fab fa-twitter"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="slack social link" class="icon icon-xs icon-slack mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="25k Subscribe">
                           <span class="fab fa-youtube"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-xs icon-dribbble mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="2k Project">
                           <span class="fab fa-dribbble"></span>
                           </a>
                        </li>
                     </ul>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-md-6 col-lg-4 mb-md-4 mb-lg-0 mb-4">
            <div class="profile-card">
               <div class="card bg-soft  shadow-sm animate-hover border-variant-soft">
                  <div class="profile-image-small  bg-white  shadow-inset shadow border border-light rounded-circle p-1 mt-5 mb-4">
                     <img src="{{ static_asset('front-end/img/team/team-4.jpg')}}" class="card-img-top rounded-circle" alt="Christopher Avatar">
                  </div>
                  <div class="card-body text-center px-5 pb-5 pt-0">
                     <h3 class="h5 mb-2">Maria J. Go</h3>
                     <span class="h6 font-weight-normal text-gray mb-3">Developer</span>
                     <ul class="list-unstyled d-flex my-3 justify-content-center">
                        <li>
                           <a href="#" target="_blank" aria-label="facebook social link" class="icon icon-xs icon-facebook mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="50k Like">
                           <span class="fab fa-facebook-f"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="twitter social link" class="icon icon-xs icon-twitter mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="40k Followers">
                           <span class="fab fa-twitter"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="slack social link" class="icon icon-xs icon-slack mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="25k Subscribe">
                           <span class="fab fa-youtube"></span>
                           </a>
                        </li>
                        <li>
                           <a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-xs icon-dribbble mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="2k Project">
                           <span class="fab fa-dribbble"></span>
                           </a>
                        </li>
                     </ul>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--team section end-->
<!--testimonial section start-->
<section class="section section-lg bg-soft">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-9 col-lg-8">
            <div class="section-heading mb-5 text-center">
               <h2>What Clients Say About Us</h2>
               <p class="lead">
                  Rapidiously morph transparent internal or "organic" sources whereas resource sucking
                  e-business innovate compelling internal.
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
            <div class="testimonial-single shadow-sm bg-white rounded-custom p-5">
               <div class="quotation mb-4">
                  <span class="icon icon-md icon-lg icon-light"><i class="fas fa-quote-left"></i></span>
               </div>
               <blockquote class="blockquote">
                  Assertively procrastinate distributed relationships whereas equity invested intellectual capital everything energistically underwhelm proactive.
               </blockquote>
               <div class="d-flex justify-content-md-between justify-content-lg-between align-items-center pt-3">
                  <div class="media align-items-center">
                     <img src="{{ static_asset('front-end/img/team/team-4.jpg')}}" alt="team" class="avatar avatar-sm mr-3">
                     <div class="media-body">
                        <h6 class="mb-0">Kyan Boards</h6>
                        <small>CEO, ThemeTags</small>
                     </div>
                  </div>
                  <div class="client-ratting d-none d-md-block d-lg-block">
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                     </ul>
                     <span class="font-weight-bold small">5.0 <span class="font-weight-lighter">Out of 5</span></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-6 mb-4 mb-md-4 mb-lg-0">
            <div class="testimonial-single shadow-sm bg-white rounded-custom p-5">
               <div class="quotation mb-4">
                  <span class="icon icon-md icon-lg icon-light"><i class="fas fa-quote-left"></i></span>
               </div>
               <blockquote class="blockquote">
                  Intrinsicly facilitate functional imperatives without next-generation services. Compellingly revolutionize worldwide users enterprise best practices.
               </blockquote>
               <div class="d-flex justify-content-md-between justify-content-lg-between align-items-center pt-3">
                  <div class="media align-items-center">
                     <img src="{{ static_asset('front-end/img/team/team-1.jpg')}}" alt="team" class="avatar avatar-sm mr-3">
                     <div class="media-body">
                        <h6 class="mb-0">Pirtle Karol</h6>
                        <small>Team Leader, ThemeTags</small>
                     </div>
                  </div>
                  <div class="client-ratting d-none d-md-block d-lg-block">
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                        <li class="list-inline-item mr-0"><span class="icon icon-xs font-small text-warning"><i class="fas fa-star ratting-color"></i></span></li>
                     </ul>
                     <span class="font-weight-bold small">5.0 <span class="font-weight-lighter">Out of 5</span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--testimonial section end-->
<!--cta section start-->
<section class="section section-sm py-5 ">
   <div class="container">
      <div class="row justify-content-around align-items-center">
         <div class="col-md-7">
            <div class="subscribe-content">
               <h3>Consulting Agency for Your Business</h3>
               <p class="mb-lg-0 mb-md-0">Rapidiously engage fully tested e-commerce with progressive architectures.</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="action-btn text-lg-right text-sm-left">
               <a href="#" class="btn btn-primary">Contact With Us</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--cta section end-->
@endsection

@section('script')

@endsection