<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php __('Music Manager'); ?> - <?php echo $title_for_layout; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="KGNU">
		<meta name="author" content="KGNU">
		<?php echo $this->Html->css('style'); ?>
		
		<?php echo $this->Html->css('bootstrap'); ?>
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
		</style>
		<?php echo $this->Html->css('bootstrap-responsive'); ?>
		
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
		
		<div class="navbar navbar-fixed-top">
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
							<li><?php echo $this->Html->link('Show Builder', array('controller' => 'showbuilder', 'action' => 'upcomingshows')) ?></li>
							<li><?php echo $this->Html->link('Schedule', array('controller' => 'schedule', 'action' => 'index')) ?></li>
							<li class="active"><?php echo $this->Html->link('Music Library', array('controller' => 'musiclibrary', 'action' => 'show', 'all')) ?></li>
							<li><?php echo $this->Html->link('Events', array('controller' => 'events', 'action' => 'index')) ?></li>
							<li><?php echo $this->Html->link('Help', array('controller' => 'help', 'action' => 'index')) ?></li>
						</ul>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as username <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="logout">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->TB->flashes(array('closable' => true)); ?>
				</div>
			</div>
			<?php echo $content_for_layout; ?>
			
			<hr>
			
			<footer>
				<p>Built with CakePHP v<?php echo Configure::version() ?></p>
			</footer>
			
		</div><!--/.fluid-container-->
		
		<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'); ?>
		<?php echo $this->Html->script('bootstrap'); ?>
		<?php echo $scripts_for_layout; ?>

	</body>
</html>
