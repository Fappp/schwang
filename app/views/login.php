<?php page(); redirectIfLoggedIn(); ?>

<div class="col-xs-12">
	<h1>Login</h1>
</div>

<div class="col-xs-12">

	<?php form_init('login') ?>

		<div class="form-group">
			<input class="form-control" name="email" type="text" placeholder="Email Address">
		</div>

		<div class="form-group">
			<input class="form-control" name="password" type="password" placeholder="Password">
		</div>

		<div>
			<button type="submit" class="btn btn-default">Login</button>
		</div>

	</form>

</div>