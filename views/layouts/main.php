<? global $user; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	
	
	<!-- Bootstrap -->  
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-select.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
	
	<!-- HTML5 Shim and Respond.js for IE8 support of HTML5 elements and media queries -->  
    <!-- Предупреждение: Respond.js не работает при просмотре страницы через файл:// -->  
    <!--[if lt IE 9]>
 	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script >
 	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	 <![endif]-->  
	
	
	<!--
	<script src="/js/jquery.min.js"></script>
    
    <script src="/js/bootstrap.js"></script>
    
    <script src="<?=SITE_URL?>js/routins.js"></script>-->  
	
	<? if (!isset($pagetitle)) $pagetitle = "Задание - телефонный справочник"; ?>
	<title><?=$pagetitle?></title>
</head>

<body>
	<!--  header -->
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Развернуть список</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index.php">Тестовое задание</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          	<? $menu = 
          		["index"=>"На главную",
          		 "about"=>"О задании",
          		 "contacts"=>"Контакты",
          	    ]; 
          		foreach($menu as $ind => $val)
          		{	
          			$is_activ = "";
          			if ($template_name == $ind) $is_activ = " class=\"active\"";
          			echo("<li$is_activ><a href=/$ind>$val</a></li>");
          		} 	          	
          	?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
		
	<div class="container theme-showcase" role="main">
		
		<?php
		include ($contentPage);
		?>
	
		<div></div>			
	</div>
	
	
	<!--  footer -->
	<nav class="navbar navbar-default navbar-fixed-bottom">
      <div class="container">
        <div class="navbar-header">
           <h5>Тестовое задание. <small><a href="mailto:alexvkv@mail.ru">Корпушев Алексей</a></small></h5>
        </div>
      </div>
    </nav>
	
	<script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
    
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap-select.js"></script>
    
    <script src="<?=SITE_URL?>js/routins.js"></script>
</body>
</html>