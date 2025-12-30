<?php

class PageHandler
{
    public static function load($page)
    {
        $base = __DIR__ . '/../views/';

        // pages that should NOT show site header/footer (dashboard/with sidebar)
        $dashboardPages = [
            'js_dashboard','js_saved','js_applied','js_manage',
            'rec_dashboard','rec_postjob',
            'admin_dashboard','profile'
        ];

        $isDashboard = in_array($page, $dashboardPages);

        // Choose layout dynamically
        if ($isDashboard) {
            include $base . 'layouts/dash_header.php';
        } else {
            include $base . 'layouts/site_header.php';
        }

        switch ($page) {
            case 'home':           include $base . 'home.php'; break;
            case 'jobs':           include $base . 'jobs/job.php'; break;
            case 'job_details':    include $base . 'jobs/jobDetails.php'; break;

            case 'login':          include $base . 'auth/login.php'; break;
            case 'register':       include $base . 'auth/registration.html'; break;

            case 'js_dashboard':   include $base . 'dashboard/jobseeker/js_dashboard.php'; break;
            case 'js_saved':       include $base . 'dashboard/jobseeker/saveJobs.php'; break;
            case 'js_applied':     include $base . 'dashboard/jobseeker/appliedJobs.php'; break;
            case 'js_manage':      include $base . 'dashboard/jobseeker/manageJobs.php'; break;

            case 'rec_dashboard':  include $base . 'dashboard/recruter/rec_dashboard.php'; break;
            case 'rec_postjob':    include $base . 'dashboard/recruter/postjob.php'; break;

            case 'admin_dashboard':include $base . 'dashboard/admin/admin_dashboard.php'; break;

            case 'profile':        include $base . 'profile/userprofile.php'; break;

            default:               include $base . 'home.php'; break;
        }

        // Close layout dynamically
        if ($isDashboard) {
            include $base . 'layouts/dash_footer.php';
        } else {
            include $base . 'layouts/site_footer.php';
        }
    }
}
