<section id="content">
		<div class="main-content">
			<div class="title">
				Welcome to BCRecord Clinic! 
			</div>
			<div class="main">
				
				<div class="widget">
					<div class="title">My Profile - <?=$_SESSION['username']?></div>
					<div class="box">
						<img src="images/profile/<?=$_SESSION['username']?>.jpg" alt="My photo" width="200" height="200">
						<a href="upload_profile_photo.php?username=<?=$_SESSION['username']?>"><i class="fa fa-upload" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="widget">
					<div class="title">Top Conditions</div>
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
				<div class="widget">
					<div class="title">Server Messages</div>
					<div class="box">
						<? if ($_SESSION['message']) { ?>
							<div class="message">
								<?= $_SESSION['message']; unset($_SESSION['message']) ?>
							</div>
						<? } ?>
					</div>
				</div>

				
				<div class="widget">
					<div class="title">Medical Chat</div>
					<div class="box" >
						<div id="chatbox">
							<div id="chat"></div>
							<form >
								<input type="hidden" name="username" id="sessionUser"  value="<?= $_SESSION['username'] ?>">
								<input type="text"  class="form-control" name="message" placeholder="message" autocomplete="off">
								<button type="submit" class="btn btn-chat"><i class="fa fa-paper-plane"></i></button>
							</form>
						</div>
					</div>
				</div>

				<div class="widget">
					<div class="title">Appointments</div>
					<div class="box">
						<?php
							$calendar= new Calendar();

							echo $calendar->show();
						?>
					</div>
				</div>
				
			</div>
		</div>	
</section>