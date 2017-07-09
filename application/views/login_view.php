<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_login_style.css">
    </head>
    <body>
        <div class="bg"></div>
        <form action="<?php echo base_url('admin'); ?>" method="post">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"></a>
            <div class="i-wrapper">
                <h1><i class="fa fa-lock" aria-hidden="true"></i> Admin</h1>
                <?php if (!empty($notif)): ?>
                    <div style="color: red"><?php echo $notif; ?></div>
                <?php endif; ?>
                <label>Username</label>
                <input type="text" name="username" autofocus>
                <label>Password</label>
                <input type="password" name="password" autofocus>
                <input type="submit" name="submit" value="Masuk">
            </div>
        </form>
    </body>
</html>
