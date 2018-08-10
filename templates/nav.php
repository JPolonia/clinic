<div class="header">
    <div class="logo">
        <i class="fa fa-heartbeat"></i>
        <span>BC RECORDS</span>
    </div>
    <a href="#" class="nav-trigger"><span></span></a>
</div>
<div class="side-nav">
    <div class="logo">
        <i class="fa fa-heartbeat"></i>
        <span>BC RECORDS</span>
    </div>
    <nav>
        <ul>
                <li class="active"><a href="home.php"><span><i class="fa fa-tachometer"></i></span><span>Dashboard</span></a></li>
            <?php if ($_SESSION['role'] == "patient") { ?>
                <li><a href="my_profile.php"><span><i class="fa fa-user-md"></i></span><span>My Profile</span></a></li>
            <?php }if ($_SESSION['role'] == "medic") { ?>
                <li><a href="my_profile.php"><span><i class="fa fa-user-md"></i></span><span>My Profile</span></a></li>
                <li><a href="list_patients.php"><span><i class="fa fa-users"></i></span><span>Manage Patients</span></a></li>
                <li><a href="list_conditions.php"><span><i class="fa fa-medkit "></i></span><span>Manage Conditions</span></a></li>
                <li><a href="bc_record.php"><span><i class="fa fa-heartbeat "></i></span><span>BC Record App</span></a></li>
            <?php }if ($_SESSION['role'] == "admin") { ?>
                <li><a href=""><span><i class="fa fa-users"></i></span><span>Manage Users</span></a>
                <ul>
                    <li><a href=""><span><i class="fa fa-plus"></i></span><span>Add</span></a></li>
                    <li><a href=""><span><i class="fa fa-edit"></i></span><span>Edit</span></a></li>
                    <li><a href=""><span><i class="fa fa-remove"></i></span><span>Remove</span></a></li>
                </ul>
                </li>
            <?php }else{?> 
                <li><a href="chat.php"><span><i class="fa  fa-pencil-square-o "></i></span><span>Forum</span></a></li>
                <li><a href="list_appointments.php"><span><i class="fa fa-calendar-check-o "></i></span><span>Appointments</span></a></li>
            <?php } ?> 
                <li><a href="action_logout.php"><span><i class="fa fa-sign-out "></i></span><span>Logout</span></a></li>
        </ul>
    </nav>
    <footer>
        <div >
		    &copy; 2017  
        </div>
        <div>
            BC Records
        </div>
    </footer>
</div>