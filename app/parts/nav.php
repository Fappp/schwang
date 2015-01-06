<?php if ( !defined( 'ABSPATH' ) ) exit; ?>

<nav class="mainNav navbar navbar-default">
	<div class="container-fluid">

		<ul class="float-right nav navbar-nav">
			<li>
				<?php if (loggedIn()) : ?>
					<a href="/logout">Logout</a>
				<?php else : ?>
					<a href="/login">Login</a>
				<?php endif; ?>
			</li>
		</ul>

		<div class="navbar-header">
			<a class="navbar-brand" href="/"><?= Settings::get('site_name') ?></a>
		</div>

		<ul class="nav navbar-nav">

			<?php

				$pages = getParts('/app/views');
				
				$disabledPages = array('404', 'home', 'logout');
				$loggedInPages = LoggedUser::isAdmin() ? array() : array();
				$loggedOutPages = array();

				foreach ($pages as $page) {
					if ( !in_array($page, $disabledPages) && ( (loggedIn() && in_array($page, $loggedInPages)) || (!loggedIn() && in_array($page, $loggedOutPages)) )) { ?>
						<li <?=$currentPage == $page ? 'class="active"' : ''; ?>>
							<a href="/<?=$page?>"><?= ucwords($page) ?></a>
						</li>
					<?php }
				}
				
			?>

		</ul>

	</div>
</nav>