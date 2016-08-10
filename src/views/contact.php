
	<div></div>
	<div class="row">
		<?php if( isset($model) ):?>
			<table class="table table-condensed">
				<thead>
					<tr>
						<th></th>
						<th>
							<a class="sort-link" href="/user/contact/username">
								name
								<span class="caret"></span>
							</a>
						</th>
						<th>
							<a class="sort-link" href="/user/contact/email">
								email
								<span class="caret"></span>
							</a>
						</th>
						<th></th>
						<th>
							<a class="sort-link" href="/user/contact/created_date">
								date
								<span class="caret"></span>
							</a>
						</th>
						<th>
						</th>
	<!--					<th id="report-grid_c6">
							<a class="sort-link" href="/report/transactions?Payment_sort=value">
								Сумма
								<span class="caret"></span>
							</a>
							http://testask.app/assets/uploads/79-usa-flagge.jpg
						</th>-->
					</tr>
				</thead>
				<tbody>
				<?php foreach ( $model['dataProvider'] as $key => $value ) :?>
					<?php  if ( $value['is_publish'] == 0 ) :?>
					<tr class="odd">
						<td><img src="<?='http://testask.app/assets/uploads/'.$value['image'];?>" class="img-circle"></td>
						<td><?=$value['username'];?></td>
						<td><?=$value['email'];?></td>
						<td><?=$value['message'];?></td>
						<td><?=$value['created_date'];?></td>
							<?php if( (int)$value['status'] == 1 ):?>
								<td style="width:5%;">changed by admin</td>
							<?php endif;?>
					<?php endif;?>
				<?php endforeach;?>
				</tbody>
			</table>
		<?php endif;?>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<!--<div class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span><strong> Error! Please check the inputs. (If form error!)</strong></div>-->
			</div>
			<form id="contact-form"  enctype="multipart/form-data" role="form" action="/user/contact" method="post">

				<div class="col-lg-6">
					<div class="form-group">
					<?php if ( isset($model['error']) ):?>
						<?php if ( $model['error'] == 'Success' ):?>
							<div class="alert alert-success"><strong><span class="glyphicon glyphicon-send"></span> Success! Message sent.</strong></div>
						<?php else:?>
							<div class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span><strong> Error! Please check the inputs <?php echo $model['error']?>. </strong></div>
						<?php endif;?>
					<?php endif;?>
					</div>
					<div class="form-group">
						<label for="InputIMage">Your Photo</label>
						<div class="input-group">
							<input type="file" class="form-control" name="image" id="InputImage" placeholder="Image" required>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
					</div>
					<div class="form-group">
						<label for="InputName">Your Name</label>
						<div class="input-group">
							<input type="text" class="form-control" name="name" id="InputName" placeholder="Enter Name" required>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
					</div>
					<div class="form-group">
						<label for="InputEmail">Your Email</label>
						<div class="input-group">
							<input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter Email" required  >
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
					</div>
					<div class="form-group">
						<label for="InputMessage">Message</label>
						<div class="input-group">
							<textarea name="message" id="InputMessage" class="form-control" rows="5" required></textarea>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
					</div>
					<button class="btn btn-primary btn-ln pull-left" data-toggle="modal" data-target="#myModal">
						preview
					</button>
					<input type="submit" name="submit" id="submit" value="Send" class="btn btn-info pull-right">
				</div>
			</form>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Preview</h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped" style="width: 100%">
							<thead>
								<tr>
									<th></th>
									<th>name</th>
									<th>email</th>
									<th>message</th>
								</tr>
							</thead>
							<tbody>
							<tr class="odd">
								<td id="image_content" style="width:5%;"></td>
								<td id="image_name" style="width:5%;"></td>
								<td id="image_email" style="width:5%;"></td>
								<td id="image_message" style="width:25%;"></td>
							</tr>
							</tbody>
						</table>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					</div>
				</div>
			</div>
		</div>