<?php
        $date=$_POST['date'];

        if(isset($date)){
            $time  = strtotime($date);
            $day   = date('d',$time);
            $month = date('m',$time);
            $year  = date('Y',$time);

        }else{
            $day = $_GET['day'];
            $month = $_GET['month'];
            $year = $_GET['year'];
        }
        ?>

<section id="content">
		<div class="main-content">
			<div class="title">
				Appointments
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">Appointments For this day</div>
					<div class="box">
                            <form method="post" action="action_makeappointment.php">
                                <input type="search" name="patient" placeholder="Patient"/>
                                <input type="text" name="room" placeholder="Room"/>
                                <input type="number" name="hour"  value="0" min="8" max="18" step="1"/>
                                <input type="number" name="min" value="0" min="0" max="45" step="5"/>
                                <input type="hidden" name="day" value="<?php echo $day;?>"/>
                                <input type="hidden" name="month" value="<?php echo $month;?>"/>
                                <input type="hidden" name="year" value="<?php echo $year;?>"/>
                                <input type="submit" value="Make Appoitment"/>
                            </form>
                            <?php
                                $timestamp = mktime(1,0,0, $month, $day, $year);
                                $appointments= getAppointmentsInDay($timestamp);
                                foreach ($appointments as $appoint){
                                echo "This appointment will be in the room ".$appoint['room'].' with number '.$appoint['num'].' for patient '.getPatientById($appoint['code'])['name'].' at '.date('H:i',$appoint['date']).'<br>';
                                }
                            ?>
						</div>
					</div>
				</div>				
			</div>
		</div>	
</section>