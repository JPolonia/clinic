<section id="content">
		<div class="main-content">
			<div class="title">
				Manage Conditions
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">List of all Conditions</div>
					<div class="box">
						<div style="overflow-x:auto;">
							<table>
								<tr>
									<th>Ref</th>
									<th>Designation</th>
								</tr>
								<?php foreach ($conditions as $condition) { ?>
									<tr>
										<td><?=$condition['ref']?></th>
										<td><?=$condition['designation']?></th>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>				
			</div>
		</div>	
</section>