<?=$form->open()?>
	<p>
		<label>Name:</label>
		<?=$form->name?> 
		<span class="<?=$form->name->error_msg_class?>"><?=$form->name->error?></span>
	</p>
	<p>
		<label>Email:</label>
		<input type="text" name="email" value="<?=$form->email->value?>" class="<?=$form->email->class?>" onclick="<?=$form->email->onclick?>" />
		<span class="<?=$form->email->error_msg_class?>"><?=$form->email->error?></span>
	</p>
	<p>
		<label>Image:</label>
		<?=$form->image?> 
		<span class="<?=$form->image->error_msg_class?>"><?=$form->image->error?></span>
	</p>
	<p>
		<?=$form->submit?> 
	</p>
<?=$form->close()?>