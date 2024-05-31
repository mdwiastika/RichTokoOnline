<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>MdwiShop | Form Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Online Shop" name="description">
    <meta content="Shop, Fashion, eCommerce, Cart, Shop Cart, tailwind css, Admin, Landing" name="keywords">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="./../assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="./../assets/css/output.css" rel="stylesheet" type="text/css">

</head>

<body class="">
    <section class="md:h-screen py-36 flex items-center bg-orange-500/10 bg-center bg-no-repeat bg-cover">
        <div class="container relative mx-auto">
            <div class="grid grid-cols-1">
                <div class="relative overflow-hidden rounded-md shadow bg-white ">
                    <div class="grid md:grid-cols-2 grid-cols-1 items-center">
                        <div class="relative md:shrink-0 h-full">
                            <img class="h-full w-full object-cover md:h-[55rem]" src="./../assets/images/ms-login-banner.jpg" alt="">
                        </div>

                        <div class="p-8 lg:px-20">
                            <div class="text-center">
                                <a href="index.html" class="flex justify-center items-center gap-2">
                                    <img src="./../assets/logo-2-no-bg.png" class="w-40 h-auto" alt="">
                                </a>
                            </div>

                            <form class="text-start lg:py-20 py-8" action="./post-register.php" method="POST">
                                <div class="grid grid-cols-1">
                                    <div class="mb-4">
                                        <label class="font-semibold" for="name">Name:</label>
                                        <input id="name" type="text" name="name" class="mt-3 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Enter Name">
                                    </div>
                                    <div class="mb-4">
                                        <label class="font-semibold" for="username">Username:</label>
                                        <input id="username" type="text" name="username" class="mt-3 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Enter Username">
                                    </div>
                                    <div class="mb-4">
                                        <label class="font-semibold" for="email">Email Address:</label>
                                        <input id="email" type="email" name="email" class="mt-3 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Enter Email">
                                    </div>
                                    <div class="mb-4">
                                        <label class="font-semibold" for="password">Password:</label>
                                        <input id="password" type="password" name="password" class="mt-3 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Enter Password">
                                    </div>
                                    <div class="mb-4">
                                        <label class="font-semibold" for="address">Address:</label>
                                        <input id="address" type="text" name="address" class="mt-3 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Enter Address">
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md w-full">Register</button>
                                    </div>

                                    <div class="text-center">
                                        <span class="text-slate-400 me-2">Already have an account ? </span> <a href="./login.php" class="text-black font-bold inline-block">Sign In</a>
                                    </div>
                                </div>
                            </form>

                            <div class="text-center">
                                <p class="mb-0 text-slate-400">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Mdwishop. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://mdwitech.vercel.app/" target="_blank" class="text-reset">Mdwiastika</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="./../assets/libs/feather-icons/feather.min.js"></script>
    <script src="./../assets/js/plugins.init.js"></script>
    <script src="./../assets/js/app.js"></script>
</body>

</html>