<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>PFE</title>

  <link rel="apple-touch-icon" href="template/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="template/assets/images/favicon.ico">

  <link rel="stylesheet" href="template/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="template/assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="template/assets/css/site.min.css">
  <link rel="stylesheet" href="template/assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="template/assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="template/assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="template/assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="template/assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="template/assets/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="template/assets/css/pages/user.css">
  <link rel="stylesheet" href="template/assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="template/assets/fonts/brand-icons/brand-icons.min.css">
  <link rel="stylesheet" href="template/assets/css/pages/profile.css">
  <link rel="stylesheet" href="template/assets/vendor/highlight/styles/default.css">
  <link rel="stylesheet" href="template/assets/vendor/highlight/styles/github-gist.css">
  <link rel="stylesheet" href="template/assets/vendor/highlight/highlight.css">
  <link rel="stylesheet" href="template/assets/vendor/toastr/toastr.css">
  <link rel="stylesheet" href="template/assets/vendor/bootstrap-treeview/bootstrap-treeview.css">
  
  <link rel="stylesheet" href="template/assets/vendor/select2/select2.css">
  
  <script src="template/assets/vendor/modernizr/modernizr.js"></script>
  <script src="template/assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
  

  <script src="template/assets/vendor/jquery/jquery.js"></script>
</head>

<body class="site-gridmenu-active site-menubar-fold bg-blue-grey-100" data-auto-menubar="false">

  <nav class="site-navbar navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header" style="background:#263238;">
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search" data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
      </button>
	  <div class="navbar-brand navbar-brand-center site-gridmenu-toggle active" data-toggle="fullscreen" aria-expanded="true">
        <img class="navbar-brand-logo" src="template/assets/images/logo.png" title="Remark">
        <span class="navbar-brand-text"> Remark</span>
      </div>
    </div>

    <div class="navbar-container container-fluid">
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <ul class="nav navbar-toolbar">
			<li class="">
				<a href="javascript:void();">PFE Approches Sémantiques Pour La Composition Des Services Web</a>
			</li>
        </ul>
		
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
			<li class="">
				<a href="javascript:void();">EOC Amir Amri © 2018 EMP</a>
			</li>
			<!-- NAV RIGHT -->
        </ul>
      </div>
	  
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>
  
  <div class="site-gridmenu" style="padding-top: 0px;">
    <ul>
      <li>
        <a href="javascript:void();" id="afficher-description" class="bg-blue-grey-300 blue-grey-800" style="text-decoration:none!important;">
          <i class="icon wb-clipboard"></i>
          <span>Description</span>
        </a>
      </li>
      <li>
        <a href="javascript:void();" id="afficher-decouverte" style="text-decoration:none!important;">
          <i class="icon wb-search"></i>
          <span>Découverte</span>
        </a>
      </li>
      <li>
        <a href="javascript:void();" id="afficher-composition" style="text-decoration:none!important;">
          <i class="icon wb-extension"></i>
          <span>Composition</span>
        </a>
      </li>
      <li>
        <a href="javascript:void();" id="afficher-selection" style="text-decoration:none!important;">
          <i class="icon wb-star"></i>
          <span>Sélection</span>
        </a>
      </li>
      <li>
        <a href="javascript:void();" id="afficher-orchestration" style="text-decoration:none!important;">
          <i class="icon wb-share"></i>
          <span>Orchestration</span>
        </a>
      </li>
      <li>
        <a href="javascript:void();" id="afficher-validation" style="text-decoration:none!important;">
          <i class="icon wb-check"></i>
          <span>Validation</span>
        </a>
      </li>
    </ul>
  </div>
 
  <div class="page bg-blue-grey-100">
    <div class="page-content" style="padding:10px;">
		<div id="page-description">
			<?php include("moduleDescription.php"); ?>		
		</div>
		<div id="page-decouverte" style="display:none;">
			<?php include("moduleDecouverte.php"); ?>	
		</div>
		<div id="page-composition" style="display:none;">
			<?php include("moduleComposition.php"); ?>	
		</div>
		<div id="page-selection" style="display:none;">
			<?php include("moduleSelection.php"); ?>	
		</div>
		<div id="page-orchestration" style="display:none;">
			<?php include("moduleOrchestration.php"); ?>	
		</div>
		<div id="page-validation" style="display:none;">
			<?php include("moduleValidation.php"); ?>	
		</div>
	</div>
  </div>
  
  <script src="template/assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="template/assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="template/assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="template/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="template/assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="template/assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <script src="template/assets/vendor/switchery/switchery.min.js"></script>
  <script src="template/assets/vendor/intro-js/intro.js"></script>
  <script src="template/assets/vendor/screenfull/screenfull.js"></script>
  <script src="template/assets/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="template/assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>
  
  <script src="template/assets/vendor/select2/select2.min.js"></script>
  
  <script src="template/assets/js/core.js"></script>
  <script src="template/assets/js/site.js"></script>
  <script src="template/assets/js/sections/menu.js"></script>
  <script src="template/assets/js/sections/menubar.js"></script>
  <script src="template/assets/js/sections/sidebar.js"></script>
  <script src="template/assets/js/configs/config-colors.js"></script>
  <script src="template/assets/js/configs/config-tour.js"></script>
  <script src="template/assets/js/components/asscrollable.js"></script>
  <script src="template/assets/js/components/animsition.js"></script>
  <script src="template/assets/js/components/slidepanel.js"></script>
  <script src="template/assets/js/components/switchery.js"></script>
  
  <script src="template/assets/js/components/select2.js"></script>
  
  <script src="template/assets/js/components/highlight-js.js"></script>
  <script src="template/assets/vendor/highlight/highlight.pack.js"></script>

  <script src="template/xml2json.js"></script>
  <script src="template/vkbeautify.js"></script>

	<script>
		(function(document, window, $) {
		  'use strict';

		  var Site = window.Site;

		  $(document).ready(function($) {
			Site.run();
		  });
		})(document, window, jQuery);
	</script>

	<script>
		$("#afficher-description" ).click(function() {
			activePage("description");
		});
		
		$("#afficher-decouverte" ).click(function() {
			activePage("decouverte");
		});
		
		$("#afficher-composition").click(function() {
			activePage("composition");
		});
		
		$("#afficher-selection").click(function() {
			activePage("selection");
		});
		
		$("#afficher-orchestration").click(function() {
			activePage("orchestration");
		});
		
		$("#afficher-validation").click(function() {
			activePage("validation");
		});
		
		function activePage(page)
		{
			$("#description-json").text("");
			$("#description-xml").text("");
			$("#page-composition").hide();
			$("#page-description").hide();
			$("#page-decouverte").hide();
			$("#page-selection").hide();
			$("#page-orchestration").hide();
			$("#page-validation").hide();
			$("#afficher-description").removeClass('bg-blue-grey-300'); $("#afficher-description" ).removeClass('blue-grey-800');
			$("#afficher-decouverte").removeClass('bg-blue-grey-300'); $("#afficher-decouverte" ).removeClass('blue-grey-800');
			$("#afficher-composition").removeClass('bg-blue-grey-300'); $("#afficher-composition" ).removeClass('blue-grey-800');
			$("#afficher-selection").removeClass('bg-blue-grey-300'); $("#afficher-selection" ).removeClass('blue-grey-800');
			$("#afficher-orchestration").removeClass('bg-blue-grey-300'); $("#afficher-orchestration" ).removeClass('blue-grey-800');
			$("#afficher-validation").removeClass('bg-blue-grey-300'); $("#afficher-validation" ).removeClass('blue-grey-800');
			
			$("#afficher-" + page).addClass('bg-blue-grey-300'); $("#afficher-" + page).addClass('blue-grey-800');
			$("#page-" + page).fadeIn(500);
		}
		
		function download(data, filename, type) {
			var file = new Blob([data], {type: type});
			if (window.navigator.msSaveOrOpenBlob) // IE10+
				window.navigator.msSaveOrOpenBlob(file, filename);
			else { // Others
				var a = document.createElement("a"),
						url = URL.createObjectURL(file);
				a.href = url;
				a.download = filename;
				document.body.appendChild(a);
				a.click();
				setTimeout(function() {
					document.body.removeChild(a);
					window.URL.revokeObjectURL(url);  
				}, 0); 
			}
		}
    </script>
</body>

</html>