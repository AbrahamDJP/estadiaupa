<body>
<?php require 'views/header.php' ?>
	<div class="limiter">
		<div class="container-login">
			<div class="wrap-login">
				<form class="login-form validate-form p-l-55 p-r-55 p-t-178">
					<span class="login-form-title">
						Sign In
					</span>

					<div class="wrap-input validate-input m-b-16" data-validate="Please enter username">
						<input class="input" type="text" name="username" placeholder="Username">
						<span class="focus-input"></span>
					</div>

					<div class="wrap-input validate-input" data-validate = "Please enter password">
						<input class="input" type="password" name="pass" placeholder="Password">
						<span class="focus-input"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a href="#" class="txt3">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php require 'views/footer.php' ?>
</body>
