<div class="w-600">
	
	<?php echo form::open('examples/validate/submit', array('id' => 'frm_validate', 'method' => 'post', 'onsubmit' => 'return false;')) ?>
	
	<div>
		<div class="label">
			<?php echo form::label('username', 'Username *') ?>
		</div>
		<div>
			<span><?php echo form::input('username', '', array('id' => 'username')) ?></span>
			<span id="username_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('password', 'Password *') ?>
		</div>
		<div>
			<span><?php echo form::password('password', '', array('id' => 'password')) ?></span>									
			<span id="password_detail" class="detail"></span>
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('password_confirm', 'Confirm Password *') ?>
		</div>
		<div>
			<span><?php echo form::password('password_confirm', '', array('id' => 'password_confirm')) ?></span>
			<span id="password_confirm_detail" class="detail"></span>									
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('email', 'Email Address *') ?>
		</div>
		<div>
			<span><?php echo form::input('email', '', array('id' => 'email')) ?></span>
			<span id="email_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('first_name', 'First Name *') ?>
		</div>
		<div>
			<span><?php echo form::input('first_name', '', array('id' => 'first_name')) ?></span>	
			<span id="first_name_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('last_name', 'Last Name *') ?>
		</div>
		<div>
			<span><?php echo form::input('last_name', '', array('id' => 'last_name')) ?></span>	
			<span id="last_name_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('birthday', 'Birthday') ?>
		</div>
		<div>
			<span><?php echo form::input('birthday', '', array('id' => 'birthday')) ?></span>	
			<span id="birthday_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('phone', 'Phone') ?>
		</div>
		<div>
			<span><?php echo form::input('phone', '', array('id' => 'phone')) ?></span>	
			<span id="phone_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('website', 'Website') ?>
		</div>
		<div>
			<span><?php echo form::input('website', '', array('id' => 'website')) ?></span>	
			<span id="website_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div>
		<div class="label">
			<?php echo form::label('ip', 'IP') ?>
		</div>
		<div>
			<span><?php echo form::input('ip', '', array('id' => 'ip')) ?></span>	
			<span id="ip_detail" class="detail"></span>								
		</div>							
	</div>
	
	<div class="p-t-25">
		<?php echo form::hidden('auth_token', $auth_token, array('id' => 'auth_token')) ?>
		<?php echo form::submit('submit', '', array('id' => 'submit')) ?>
	</div>
			
	<?php echo form::close() ?>
	
</div>