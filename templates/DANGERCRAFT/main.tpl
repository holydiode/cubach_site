<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	{headers}
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="manifest" href="site.webmanifest">
	<link rel="icon" href="{THEME}/img/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,500,600" rel="stylesheet">
	<script src="https://kit.fontawesome.com/78f53e2d9f.js"></script>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css' integrity='sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ' crossorigin='anonymous'>
	<link rel="stylesheet" href="{THEME}/css/bootstrap.min.css?">
	<link rel="stylesheet" href="{THEME}/icons/icomoon.css">
	<link rel="stylesheet" href="{THEME}/css/main.css?">
	<link rel="stylesheet" href="{THEME}/css/style.css?">
	<link rel="stylesheet" href="{THEME}/css/global.css?">
	<link rel="stylesheet" href="{THEME}/dist/css/swiper.min.css">
	<link rel="stylesheet" href="{THEME}/uikit/css/uikit.css?" />
	<script src="{THEME}/ukitnew/js/uikit.min.js"></script>
    <script src="{THEME}/ukitnew/js/uikit-icons.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="{THEME}/uikit/js/uikit.js"></script>
	<script src="{THEME}/uikit/js/uikit-icons.js"></script>
	<!-- <script src='https://me-habeebjz.ru/template/js/jquery.js' charset='utf-8'></script> -->
</head>
   
   <body>
		{include file='engine/modules/habeebjz/global.php'}
      <!-- Page Content START -->
      <div class="page-content">
         <!-- Main Nav START -->
         <nav id="main-nav" class="main-nav fixed">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="nav-header d-flex justify-content-between align-items-center">
                        <a href="/" class="logo" id='logotype'>
							<img src="/templates/DANGERCRAFT/img/DANGERCRAFT.png" alt="Логотип">
							<!-- DANGERCRAFT -->
                        </a>
                     </div>
                     <div class="nav-wrap">
                        <ul id="nav" class="nav-wrap__list menu">
                           <li><a href="/">Главная</a></li>
                            <li><a href="/">О серверах</a></li>
                           <li><a href="/rules">Правила</a></li>
						   <li><a href="/faq">FAQ</a></li>
                        </ul>
                        <div class="riglt-floats-xs">
							[group=5]
                           <!-- <a href="#auth" class="btn-login"><span class="ic-sx21"></span>Войти в аккаунт</a> -->
                           <a href="/register" class="btn-startgames"><span class="ic-sx22"></span> Регистрация</a>
							[/group]
							[not-group=5]
                           <!-- <a uk-toggle='target: #launcher' class="btn-login"><span class="ic-sx21"></span> Скачать лаунчер</a> -->
                           <a href="/cabinet" class="btn-startgames"><span class="ic-sx22"></span> Личный кабинет</a>
							[/not-group]
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
         <!-- Main Nav END -->
         <!-- Home Section START -->
		 [aviable=main]
         <section id="home-sec" class="main-banner parallax">
            <div class="bg-lefts"></div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-9">
                     <!-- Swiper -->
                     <div class="swiper-container">
                        <div class="swiper-wrapper">
                           <div class="swiper-slide" data-hash="slide1">
                              <div class="col-md-6">
                                 <span class="img-ste1"></span>
                              </div>
                              <div class="col-md-6">
                                 <h3 class="name-intro">Добро пожаловать! снова!</h3>
                                 <span class="hr-intro"></span>
                                 <p class="docopation-intro">
                                    Сервер ждёт <br>
                                    именно тебя!
                                 </p>
                                 <a href="/register" class="btn-drop"><span class="ic-sx22"></span> Начать играть</a>
                              </div>
                           </div>
                           <div class="swiper-slide" data-hash="slide2">
                              <div class="col-md-6">
                                 <span class="img-ste1"></span>
                              </div>
                              <div class="col-md-6">
                                 <h3 class="name-intro">Мутанты</h3>
                                 <span class="hr-intro"></span>
                                 <p class="docopation-intro">
                                    На нашем сервере есть <br>
                                    мутанты, которых ты даже не видел!
                                 </p>
                                 <a href="#" class="btn-drop"><span class="ic-sx22"></span> Подробнее</a>
                              </div>
                           </div>
                           <div class="swiper-slide" data-hash="slide3">
                              <div class="col-md-6">
                                 <span class="img-ste1"></span>
                              </div>
                              <div class="col-md-6">
                                 <h3 class="name-intro">Аномалии</h3>
                                 <span class="hr-intro"></span>
                                 <p class="docopation-intro">
                                    Аномалии - особенности зоны <br>
                                    попробуй залутать их все!
                                 </p>
                                 <a href="#" class="btn-drop"><span class="ic-sx22"></span> Подробнее</a>
                              </div>
                           </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                     </div>
                  </div>
                  <div class="col-lg-3">
							[group=5]
                     <a href="/how-start.html" class="block-s1">
                        <p class="how-to-games">Как начать играть ?</p>
                        <p class="desctops"> В данной теме рассказано как начать игру на нашем проекте.</p>
                     </a>
							[/group]
							[not-group=5]

							[/not-group]
                  </div>
               </div>
            </div>
         </section>
		 [/aviable]
		 [not-aviable=main]<div style='margin-top:20px'></div>[/not-aviable]
         <!-- Home Section END -->
         <div class="container">
            <div class="row">
               <div class="col-lg-9 col-md-9">
					{info}
					{content}
               </div>
			   
               <div class="col-lg-3 col-md-3">
				  {login}
				  
                  <div class="right-block">
                     <div class="n-m">Мониторинг серверов</div>
					   {include file="engine/modules/monitoring/cache_file.php"}
					 <div class='monload'></div>
                  </div>
				  
                  <div class="right-block vk">
                     <div class="n-m">Наша группа Вконтакте</div>
                     <div>
						<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

						<!-- VK Widget -->
						<div id="vk_groups"></div>
						<script type="text/javascript">
						VK.Widgets.Group("vk_groups", {mode: 4, width: "238", height: "400"}, 148975808);
						</script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Footer START -->
         <footer class="section site-footer bg-dark">
            <div class="container">
               <div class="row">
                  <div class="col-lg-2 col-md-2">
                     <a class="logo logotype-footer" id="logotype">Сuba.ch</a>
                  </div>
                  <div class="col-lg-6 col-md-6 text-center">
                     <p class="footer-text">© 2019 DANGERCRAFT - MMORPG STALKER </p> 
			<div class="nav-wrap__list menu">
				  <!-- <li><a href="/team">Команда проекта</a></li>
                  <li><a href="/claim">Набор в модераторы</a></li> -->
				  </ul>
                  </div>
		</div>
                  <div class="col-md-4">

					
					
                  </div>
               </div>
            </div>
         </footer>
         <!-- Footer END -->
      </div>
      <!-- Page Content END -->	
      <script src="/templates/DANGERCRAFT/dist/js/swiper.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
         var swiper = new Swiper('.swiper-container', {
           spaceBetween: 30,
           hashNavigation: {
             watchState: true,
           },
           pagination: {
             el: '.swiper-pagination',
             clickable: true,
           },
           navigation: {
             nextEl: '.swiper-button-next',
             prevEl: '.swiper-button-prev',
           },
         });
      </script>
      <script src="{THEME}/js/jquery.min.js"></script>
      <script src="{THEME}/js/vendor/modernizr-3.5.0.min.js"></script>
      <script src="{THEME}/js/vendor/jquery-3.2.1.min.js"></script>
      <script src="{THEME}/js/main.js"></script>
      <script src="{THEME}/js/minecraft/main.js?"></script>
   </body>
</html>