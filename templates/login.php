<div id="login">
    <h1><i class="fa fa-heartbeat" aria-hidden="true" style="font-size:250%"></i> </h1>
    <h1>BC Record</h1>
    <? if ($_SESSION['message']) { ?>
    <div class="message">
        <?= $_SESSION['message'];
        unset($_SESSION['message']) ?>
    </div>
    <?
} ?>
    <form method="post" action="action_login.php">
        <input type="text" name="username" placeholder="Patient-ID/Medic-ID" value="<?= $_SESSION[form_values][username] ?>" required autofocus/>
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" id="login-btn" name="login" value="Login" />
    </form>
</div>
<footer>
    &copy; 2018 &middot; BCRecord
</footer>
</body>

</html>