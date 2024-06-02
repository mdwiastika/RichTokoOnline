<?php
session_start();
include_once './../connection/connection.php';
$parent_categories = $pdo->query("SELECT 
                                pc.id_parent_category,
                                pc.name_parent_category,
                                JSONB_AGG(JSONB_BUILD_OBJECT(
                                    'slug_category', c.slug_category, 
                                    'name_category', c.name_category
                                    )) AS categories
                                FROM 
                                parent_categories pc
                                INNER JOIN 
                                categories c 
                                ON 
                                pc.id_parent_category = c.parent_category_id
                                GROUP BY 
                                pc.id_parent_category, 
                                pc.name_parent_category
                                ORDER BY 
                                pc.id_parent_category;")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>MdwiShop - <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?= $title ?>" name="description">
    <meta content="Shop, Fashion, eCommerce, Cart, Shop Cart, tailwind css, Admin, Landing" name="keywords">
    <meta name="author" content="Shreethemes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/logo-2.png">
    <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet">
    <!-- Main Css -->
    <link href="assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="/assets/css/output.css?modified=<?= microtime() ?>" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="">
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div> -->
    <div class="tagline bg-slate-900">
        <div class="container relative">
            <div class="grid grid-cols-1">
                <div class="text-center">
                    <h6 class="text-white font-medium">Welcome to MdwiShop. Get Up to 50% Discount 🎉</h6>
                </div>
            </div>
        </div>
    </div>
    <nav id="topnav" class="defaultscroll is-sticky tagline-height">
        <div class="container relative">
            <a class="logo" href="index.html">
                <div>
                    <img src="assets/logo-2-no-bg.png" class="h-[50px] inline-block" alt="">
                </div>
            </a>

            <!-- Start Mobile Toggle -->
            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- End Mobile Toggle -->

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">

                <li class="inline-block ps-0.5">
                    <a href="/cart" class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-orange-500 text-white">
                        <i data-feather="shopping-cart" class="h-4 w-4"></i>
                    </a>
                </li>

                <li class="dropdown inline-block relative ps-3">
                    <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center" type="button">
                        <span class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full border border-orange-500 bg-orange-500 text-white"><img src="assets/images/ms-user.png" class="rounded-full" alt=""></span>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-48 rounded-md overflow-hidden bg-white shadow hidden" onclick="event.stopPropagation();">
                        <ul class="py-2 text-start">
                            <li>
                                <?php

                                $name = 'Guest';
                                if (isset($_SESSION['user'])) {
                                    $name = $_SESSION['user']['username'];
                                }
                                ?>
                                <p class="text-slate-400 pt-2 px-4">Welcome. <?= $name ?> </p>
                            </li>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <li>
                                    <a href="/my-profile" class="flex items-center font-medium py-2 px-4 hover:text-orange-500"><i data-feather="user" class="h-4 w-4 me-2"></i>My Profile</a>
                                </li>
                                <li>
                                    <a href="/history-transaction" class="flex items-center font-medium py-2 px-4 hover:text-orange-500"><i data-feather="credit-card" class="h-4 w-4 me-2"></i>Transaction</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <?php
                                if (isset($_SESSION['user'])) {
                                ?>
                                    <a href="/auth/logout.php" class="flex items-center font-medium py-2 px-4 hover:text-orange-500"><i data-feather="log-out" class="h-4 w-4 me-2"></i>Logout</a>
                                <?php
                                } else {
                                ?>
                                    <a href="/auth/login.php" class="flex items-center font-medium py-2 px-4 hover:text-orange-500"><i data-feather="log-in" class="h-4 w-4 me-2"></i>Login</a>
                                <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu parent-menu-item <?= $title == 'Home' ? 'active' : '' ?>">
                        <a href="/">Home</a>
                    </li>

                    <li class="has-submenu parent-parent-menu-item <?= $title == 'Products' ? 'active' : '' ?>">
                        <a href="/products">Products</a>
                    </li>
                    <li class="has-submenu parent-parent-menu-item <?= $title == 'Categories' ? 'active' : '' ?>"><a href="javascript:void(0)"> Category </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <?php foreach ($parent_categories as $parent_category) : ?>
                                <li class="has-submenu parent-menu-item">
                                    <a href="javascript:void(0)"> <?= $parent_category['name_parent_category'] ?> </a><span class="submenu-arrow"></span>
                                    <ul class="submenu">
                                        <?php
                                        $categories = json_decode($parent_category['categories'], true);
                                        foreach ($categories as $category) : ?>
                                            <li><a href="/products?category=<?= $category['slug_category'] ?>" class="sub-menu-item"><?= $category['name_category'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="/about-us" class="sub-menu-item <?= $title == 'About Us' ? 'active' : '' ?>">About Us</a></li>
                    <li><a href="/contact" class="sub-menu-item <?= $title == 'Contact' ? 'active' : '' ?>">Contact</a></li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </nav>