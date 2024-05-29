<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">Anything you want</div><strong>
        Copyright &copy; 2024&nbsp;
        <a href="https://mdwitech.vercel.app" target="_blank" class="text-decoration-none">Mdwishop</a>.
    </strong>
    All rights reserved.
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="/admin/assets/js/adminlte.js"></script>
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- apexcharts -->
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> -->
<?php
if (isset($_SESSION['success'])) {
    echo '<script>
        Swal.fire({
            title: "Success!",
            text: "' . $_SESSION['success'] . '",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<script>
        Swal.fire({
            title: "Error!",
            text: "' . $_SESSION['error'] . '",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>';
    unset($_SESSION['error']);
}
?>

<script>
    function confirmDelete(element) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to delete this data?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = element.target.href;
            }
        });
    }
</script>
</script>
</body>

</html>