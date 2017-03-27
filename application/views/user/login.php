
<div class="row">
	<div class="col-md-4 col-md-offset-4">

		<div class="row">

				<div class="row">
					<div class="col-md-12">
						<?php showMessage();?>
						<h3>Login</h3>
						<?php echo form_open_multipart('user/login', array('id' => 'loginForm'))?>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" id="username" size="30" class="form-control"
								   value="<?php echo set_value('username') ? set_value('username') : '';?>"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" name="password" size="30" class="form-control"/>
						</div>

						<div class="form-group">
							<div class="col-md-6">
								<?php /*?>
								<a href="<?php echo c('base_url').'account/recovery';?>" >Forgot Username/ Password</a>
								<?php */?>
							</div>
								<input type="submit" name="login" class="btn btn-primary pull-right form-control" id="submit_btn btn-default" value="Login"/>

						</div>
						<?php echo form_close(); ?>
					</div>
				</div>

			<?php /*?>
			<div class="col-md-2">
				- Or -
			</div>


			<div class="col-md-3">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php showMessage();?>
						<div class="form-group text-center">
							<?php if ( ! $this->facebook->is_authenticated()) { ?>
								<div class="login">
									<a href="<?php echo $this->facebook->login_url(); ?>" class="btn btn-default">Login with Facebook</a>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<?php */?>

		</div>

	</div>
</div>
