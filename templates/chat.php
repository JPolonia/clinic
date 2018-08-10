<section id="content">
		<div class="main-content">
			<div class="title">
				Forum
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">Chat</div>
					<div class="box">
                            <section id="chatbox">
                            <div id="chat"></div>
                            <form >
                                <input type="text" name="username" placeholder="username" value="<?= $_SESSION['username'] ?>"  disabled>
                                <input type="text" name="message" placeholder="message">
                                <input type="submit" value="Send">
                            </form>
                        </section>
						</div>
					</div>
				</div>				
			</div>
		</div>	
</section>
