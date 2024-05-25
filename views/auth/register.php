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
    <link href="./../assets/css/tailwind.min.css" rel="stylesheet" type="text/css">

</head>

<body class="dark:bg-slate-900">
    <section class="md:h-screen py-36 flex items-center bg-orange-500/10 dark:bg-orange-500/20 bg-[url('../../assets/images/hero/bg-shape.html')] bg-center bg-no-repeat bg-cover">
        <div class="container relative">
            <div class="grid grid-cols-1">
                <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                    <div class="grid md:grid-cols-2 grid-cols-1 items-center">
                        <div class="relative md:shrink-0">
                            <img class="h-full w-full object-cover md:h-[44rem]" src="./../assets/images/signup.jpg" alt="">
                        </div>

                        <div class="p-8 lg:px-20">
                            <div class="text-center">
                                <a href="index.html">
                                    <img src="./../assets/logo-2.png" class="mx-auto w-10 h-auto" alt="">
                                </a>
                            </div>

                            <form class="text-start lg:py-20 py-8">
                                <div class="grid grid-cols-1">
                                    <div class="mb-4">
                                        <label class="font-semibold" for="RegisterName">Your Name:</label>
                                        <input id="RegisterName" type="text" class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0" placeholder="Harry">
                                    </div>

                                    <div class="mb-4">
                                        <label class="font-semibold" for="LoginEmail">Email Address:</label>
                                        <input id="LoginEmail" type="email" class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0" placeholder="name@example.com">
                                    </div>

                                    <div class="mb-4">
                                        <label class="font-semibold" for="LoginPassword">Password:</label>
                                        <input id="LoginPassword" type="password" class="mt-3 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0" placeholder="Password:">
                                    </div>

                                    <div class="mb-4">
                                        <div class="flex items-center w-full mb-0">
                                            <input class="form-checkbox rounded border-gray-100 dark:border-gray-800 text-orange-500 focus:border-orange-300 focus:ring focus:ring-offset-0 focus:ring-orange-200 focus:ring-opacity-50 me-2" type="checkbox" value="" id="AcceptT&C">
                                            <label class="form-check-label text-slate-400" for="AcceptT&C">I Accept <a href="#" class="text-orange-500">Terms And Condition</a></label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <input type="submit" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md w-full" value="Register">
                                    </div>

                                    <div class="text-center">
                                        <span class="text-slate-400 me-2">Already have an account ? </span> <a href="login.html" class="text-black dark:text-white font-bold inline-block">Sign in</a>
                                    </div>
                                </div>
                            </form>

                            <div class="text-center">
                                <p class="mb-0 text-slate-400">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Cartzio. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.</p>
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