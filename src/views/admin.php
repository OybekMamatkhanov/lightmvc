<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/7/2016
 * Time: 8:03 AM
 */
?>


<div class="container">
	<div class="row">
		<?php if( isset($model) ):?>
			<table class="table table-striped" style="width: 100%">
				<thead>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>
						<a class="sort-link" href="/user/sort/date">
							date
							<span class="caret"></span>
						</a>
					</th>
					<th>published</th>
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
				<?php foreach ( $model as $key => $value ) :?>
				<tr class="odd">
						<td style="width:5%;"><img src="<?='http://testask.app/assets/uploads/thumb/'.$value['image'];?>" class="img-circle"></td>
						<td style="width:5%;"><?=$value['username'];?></td>
						<td style="width:5%;"><?=$value['email'];?></td>
						<td style="width:25%;"><?=$value['message'];?></td>
						<td style="width:10%;"><?=$value['created_date'];?></td>

							<?php if( (int)$value['is_publish'] == 1 ) :?>
								<td style="width:5%;" class="alert-danger">declined</td>
							<?php else:?>
								<td style="width:5%;" class="alert-success">accepted</td>
							<?php endif;?>
						</td>

						<td style="width:5%;"><a href="/site/edit/<?=$value['id'];?>"><button class="btn btn-sm btn-primary">edit</button></a></td>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		<?php endif;?>
	</div>
</div>