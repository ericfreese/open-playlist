<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $title_for_layout; ?> &mdash; Open Playlist</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Open Playlist">
		<meta name="author" content="Open Playlist">
		<?php echo $this->Html->css('style'); ?>
		
		<?php echo $this->Html->css('bootstrap'); ?>
		<?php echo $this->Html->css('bootstrap-responsive'); ?>
		
		<?php echo $this->fetch('css'); ?>
		
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<?php echo $this->Html->meta('icon'); ?>
		<!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png"> -->
		<!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png"> -->
		<!-- <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png"> -->
	</head>
	
	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php echo $this->Html->link(Configure::read('Organization.Name'), '/', array('class' => 'brand')); ?>
					<div class="nav-collapse">
						<ul class="nav">
						</ul>
						<ul class="nav pull-right">
							<li><?php echo $this->Html->link('Help', array('controller' => 'help', 'action' => 'index')) ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<?php echo $content_for_layout; ?>
		</div>
		
		<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'); ?>
		<?php echo $this->Html->script('bootstrap'); ?>
		<?php echo $this->fetch('script'); ?>

	</body>
</html>
