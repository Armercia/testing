<!-- ========== MAIN CONTENT ========== -->
<!-- Breadcrumb -->
<?php
function isActive($page) {
    $current_page = basename($_SERVER['REQUEST_URI'], ".php");
    return $current_page === $page ? 'bg-gray-100 text-neutral-700' : 'text-neutral-700';
}
?>


<div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden ">
    <div class="flex justify-between items-center py-2">
        <!-- Breadcrumb -->
        <ol class="ms-3 flex items-center whitespace-nowrap">
            <li class="flex items-center text-sm text-gray-800 ">
                Application Layout
                <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 " width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </li>
            <li class="text-sm font-semibold text-gray-800 truncate " aria-current="page">
                Dashboard
            </li>
        </ol>
        <!-- End Breadcrumb -->

        <!-- Sidebar -->
        <button type="button" class="py-2 px-3 flex justify-center items-center gap-x-1.5 text-xs rounded-lg border border-gray-200 text-gray-500 hover:text-gray-600 " data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Sidebar">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
            </svg>
            <span class="sr-only">Sidebar</span>
        </button>
        <!-- End Sidebar -->
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Sidebar -->
<div id="application-sidebar" class="hs-overlay [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-[260px]
  hidden
  fixed inset-y-0 start-0 z-[60]
  bg-white border-e border-gray-200
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
 ">
    <div class="px-8 pt-4">
        <!-- Logo -->
        <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80" href="../templates/admin/index.html" aria-label="Preline">
            Abari
        </a>
        <!-- End Logo -->
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
            <li>
                <a class="flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('dashboard'); ?> rounded-lg hover:bg-gray-100" href="dashboard">
                  
                    Home
                </a>
            </li>

            <li>
                <a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('register-elections'); ?> rounded-lg hover:bg-gray-100" href="register-elections">
                    Register for elections
                </a>
            </li>
          
            <?php if ($_SESSION['user']['user_type'] == 'admin') : ?>
            <li>
                <a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('create-elections'); ?> rounded-lg hover:bg-gray-100" href="create-elections">
                    Create elections
                </a>
            </li>
            <li>
                <a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('admin'); ?> rounded-lg hover:bg-gray-100" href="admin">
                    Admin
                </a>
            </li>
            <?php endif ?>

            <li>
                <a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('profile'); ?> rounded-lg hover:bg-gray-100" href="profile">
                    Profile
                </a>
            </li>

            <li>
                <a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 <?php echo isActive('logout'); ?> rounded-lg hover:bg-gray-100" href="logout">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- End Sidebar -->

<!-- Content -->
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">
    <!-- your content goes here ... -->
    <?php loadComponent($component) ?>
</div>
<!-- End Content -->
<!-- ========== END MAIN CONTENT ========== -->
