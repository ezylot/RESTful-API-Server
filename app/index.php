<!DOCTYPE html>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>snippget</title>
    <meta name="keywords" content="snippets,snippget,codeausschnitt,code,programming,temlate">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">

    <script src="scripts/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
  </head>
  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

	<div class="modal fade" id="RegisterForm">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Registration</h4>
		  </div>
		  <div class="modal-body">
			<p>We a sorry to tell you that the registration is currently closed</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary disabled">Register</button>
		  </div>
		</div>
	  </div>
	</div>

    <nav class="navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand site-title" href="#">snippget.ga</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Log in</button>
            <button type="button" data-toggle="modal" data-target="#RegisterForm" class="btn btn-primary">Register</button>

          </form>
        </div>
      </div>
    </nav>

	<div id="wrapper" class="container-fluid">
		<div class="row">
			<section class="col-md-9">
				<img style="width: 100%" src="http://www.miratelinc.com/wp-content/uploads/2013/12/page-under-construction.jpg" alt="This site is currently under construction" />

			</section>
			<aside class="col-md-3 panel panel-default">
				<div class="summary">
					<h3>First Snippet<span class="pull-right glyphicon glyphicon-edit"></span></h3>
				</div>

				<div class="snippet-nav">
					<a href=""><span class="glyphicon glyphicon-tag"></span><span>FirstSnippet</span></a>
					<a href=""><span class="glyphicon glyphicon-tag"></span><span>SecondSnippet</span></a>
					<a href=""><span class="glyphicon glyphicon-tag"></span><span>ThirdSnippet</span></a>
					<a href=""><span class="glyphicon glyphicon-tag"></span><span>FourthSnippet</span></a>
				</div>				
			</aside>
		</div>
	</div>

	<footer>
		<span id="left"></span>
		<span id="middle"></span>
		<p id="copyright">&copy; eZyloT 2015</p>
	</footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="scripts/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="scripts/vendor/bootstrap.min.js"></script>

    <script src="scripts/plugins.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>
