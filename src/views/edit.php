<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/7/2016
 * Time: 8:35 AM
 */
?>

<h3>Edit</h3>
<div class="row">
	<form method="post" action="">
		<input type="hidden" name="id" value="<?=$model['id'];?>">
		<div class="form-group">
			<label for="message">Message</label>
			<textarea name="message" id="message" cols="40" rows="10" class="form-control">
				<?=$model['message'];?>
			</textarea>
		</div>
		<div class="form-group">
			<label for="is_published">Publish</label>
			<input type="checkbox" name="is_published" id="is_published" <?php  if ( $model['is_publish'] == 0 ) :?>checked<?php endif;?>>
		</div>
		<button type="submit" class="btn btn-success">Update</button>
	</form>
</div>