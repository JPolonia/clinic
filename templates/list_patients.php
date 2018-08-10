<section id="content">
		<div class="main-content">
			<div class="title">
				Manage Patients
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">List of all Patients</div>
					<div class="box">
						<div style="overflow-x:auto;">
							<table>
								<tr>
									<th></th>
									<th>Code</th>
									<th>Name</th>
									<th>Address</th>
								</tr>
								<?php foreach ($patients as $patient) { ?>
									<tr>
										<td class="table-icon"><a href=""><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href=""><i class="fa fa-remove"></i></a></th>
										<td><?=$patient['code']?></th>
										<td><?=$patient['name']?></th>
										<td><?=$patient['address']?></th>
										<!--<td><a href="" class="btn btn-table"><i class="fa fa-edit"></i></a></th>-->
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>				
			</div>
		</div>	
</section>