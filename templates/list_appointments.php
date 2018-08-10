<section id="content">
		<div class="main-content">
			<div class="title">
				Appointments
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">Appointments for the Week</div>
					<div class="box">
							<?php
								$calendar= new Calendar();
								echo $calendar->show();
							?>
						</div>
					</div>
				</div>				
			</div>
		</div>	
</section>