<section id="content">
		<div class="main-content">
			<div class="title">
				My Profile
			</div>
			<div class="main">
				<div class="widget">
					<div class="title"><?= $_SESSION['username'] ?>  Profile</div>
					<div class="box">
					<img src="images/profile/<?=$_SESSION['username']?>.jpg" alt="My photo" width="200" height="200">
						<form enctype="multipart/form-data" method="post" action="action_upload_profile_photo.php">
								<input type="hidden" name="username" value="<?=$username?>">
							<label for="photo">Photo:</label>
								<input type="file" name="photo">
							<button class="button" type="submit" style="vertical-align:middle"><span>Upload </span></button>
						</form>
					</div>
				</div>				
			</div>
		</div>	
</section>