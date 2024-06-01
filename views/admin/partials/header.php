<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
    exit;
}
if (!in_array($_SESSION['user']['role'], ['admin', 'super admin'])) {
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE | <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../assets/logo-2.png" type="image/x-icon">
    <meta name="title" content="AdminLTE | Dashboard v2">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="/admin/assets/css/adminlte.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
        .img-rounded {
            width: 100px;
            height: 100px;
            margin-top: 1em;
            object-fit: cover;
            border-radius: 1.3em;
            display: none;
        }
    </style>
    <style>
        html,
        body {
            font-family: 'Poppins';
        }

        /* Admin Start */
        .anak-judul {
            font-weight: 100;
            font-size: 15px;
            color: #878787;
            margin: 5px 0 10px 0;
        }

        .judul {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .btn {
            border-radius: 20px;
            padding: 6px 20px;
        }

        /* Dtagrid Start */
        .table thead th {
            background-color: #fff !important;
        }

        #paging li a {
            /* background-color: #5f76e8; */
            background-color: #eee;
            padding: 10px 20px;
            border-radius: 10px;
            /* color: #fff; */
            color: #000;
            text-decoration: none;
        }

        #paging li a:hover {
            background-color: #d3d3d3;
        }

        #paging li.active a {
            background-color: #97A6F4;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
        }

        #paging li.disabled a {
            background-color: #eee;
            padding: 10px 20px;
            border-radius: 10px;
            color: #000;
            text-decoration: none;
        }

        #paging li {
            padding: 2px;
        }

        /* Datagrid End */

        /* Button Start */
        .btn-primary {
            /* background-color: white;
        color:#0500FF;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #0500FF;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-warning {
            /* background-color: white;
        color:#FFB800;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #FFB800;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-success {
            /* background-color: white;
        color:#68EA65;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #68EA65;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-danger {
            /* background-color: white;
        color:#FC6969;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #FC6969;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-info {
            /* background-color: white;
        color:#97A6F4;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #97A6F4;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-info-outline {
            /* background-color: white;
        color:#97A6F4;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: white;
            outline: 1.5px solid #97A6F4;
            color: #97A6F4;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-dark {
            /* background-color: white;
        color:#2b2c33;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
            background-color: #2b2c33;
            color: white;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Button End */
        /* Another Button Start */
        .btn-shadow {
            box-shadow: rgb(149 157 165 / 46%) 0px 11px 18px 0px;
        }

        #btn-add {
            box-shadow: rgb(149 157 165 / 46%) 0px 11px 18px 0px;
            background-color: #97A6F4;
            color: white;
        }

        #btn-detail {
            background-color: white;
            color: #FFB800;
            box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
        }

        #btn-edit {
            background-color: white;
            color: #0500FF;
            box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
        }

        #btn-delete {
            background-color: white;
            color: #FC6969;
            box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
        }

        .img-bukti {
            width: 120px;
            height: 80px;
            border-radius: 5%;
            object-fit: cover;
        }

        .img-show {
            width: 240px;
            height: 160px;
            border-radius: 10%;
            object-fit: cover;
            display: block;
        }

        .img-show-portrait {
            width: 200px;
            height: 350px;
            border-radius: 5%;
            object-fit: cover;
            display: block;
        }

        .img-icon {
            width: 50px;
            height: 50px;
            border-radius: 5%;
            object-fit: cover;
            display: block;
        }

        /* Another Button End */

        .ui-datepicker-calendar {
            display: none;
        }

        ​
        /* Admin End */
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="/admin/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline"><?= $_SESSION['user']['name'] ?></span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="/admin/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?= $_SESSION['user']['name'] ?> - Web Developer
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Profile</a> <a href="/auth/logout.php" class="btn btn-default btn-flat float-end">Sign out</a> </li> <!--end::Menu Footer-->
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>