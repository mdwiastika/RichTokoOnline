<?php
$title = 'Home';
include_once './../partials/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
    exit;
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!-- Start Hero -->
<section class="relative lg:pb-24 pb-16">
    <div class="md:container container-fluid relative">
        <div class="relative overflow-hidden md:rounded-md h-52 bg-[url('../../assets/images/hero/pages.html')] bg-center bg-no-repeat bg-cover"></div>
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="md:flex justify-center">
            <div class="w-full md:px-3 mt-6 md:mt-0">
                <div class="p-6 rounded-md shadow-sm bg-white">
                    <h5 class="text-lg font-semibold mb-4">Personal Detail :</h5>
                    <form method="post" action="/api/update-user.php">
                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                            <div>
                                <label class="form-label font-medium">Name : <span class="text-red-600">*</span></label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="user" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input type="text" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Name:" id="name" name="name" required="" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Username : <span class="text-red-600">*</span></label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="user-check" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input type="text" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Username:" id="username" name="username" required="" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Email : <span class="text-red-600">*</span></label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="mail" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input type="email" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Email" name="email" required="" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Password (Fill if you want to change) : </label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="key" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input type="password" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Province : </label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="map-pin" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input name="province" id="province" type="text" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Province :" value="<?php echo isset($user['province']) ? $user['province'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">City : </label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="map-pin" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input name="city" id="city" type="text" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="City :" value="<?php echo isset($user['city']) ? $user['city'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Address : </label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="map-pin" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input name="address" id="address" type="text" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Address :" value="<?php echo isset($user['address']) ? $user['address'] : ''; ?>">
                                </div>
                            </div>
                            <div>
                                <label class="form-label font-medium">Phone Number : </label>
                                <div class="form-icon relative mt-2">
                                    <i data-feather="phone" class="w-4 h-4 absolute top-3 start-4"></i>
                                    <input name="phone_number" id="phone_number" type="number" class="ps-12 w-full py-2 px-3 h-10 bg-transparent  rounded outline-none border border-gray-300 focus:ring-0" placeholder="Phone Number :" value="<?php echo isset($user['phone_number']) ? $user['phone_number'] : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <input type="submit" id="submit" name="send" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md mt-5" value="Save Changes">
                    </form><!--end form-->
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<?php
include_once './../partials/footer.php';
?>
<?php
if (isset($_SESSION['success'])) {
    echo "<script>Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '" . $_SESSION['success'] . "'
        });</script>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '" . $_SESSION['error'] . "'
        });</script>";
    unset($_SESSION['error']);
}
?>