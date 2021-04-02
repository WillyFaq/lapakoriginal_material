<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Lapak Original">
    <meta name="author" content="WillyFaq">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2B3E4D">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#2B3E4D">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#2B3E4D">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.ico'); ?>?v=2">
    <title>Material | Lapak Original</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"  type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/style.css?').time(); ?>" rel="stylesheet" type="text/css">
    <?php if($this->session->userdata('user') && $this->session->userdata('user')->level == 0 ): ?>
    <link href="<?= base_url('assets/css/style_atasan.css?').time(); ?>" rel="stylesheet" type="text/css">
    <?php endif; ?>

    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css">

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
</head>