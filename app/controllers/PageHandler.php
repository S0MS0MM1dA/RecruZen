<?php

class PageHandler
{
    public static function load($page)
    {
        $base = __DIR__ . '/../views/';

        $dashboardPages = [
            // Jobseeker
            'js_dashboard','js_saved_jobs','js_applied_jobs','js_profile','js_settings',

            // Recruiter
            'rec_dashboard','rec_post_job','rec_manage_jobs','rec_applicants','rec_applicant_details','rec_company_profile',

            // Admin
            'admin_dashboard','admin_manage_user','admin_manage_jobs','admin_manage_category','admin_recruter','admin_settings',
        ];

        $isDashboard = in_array($page, $dashboardPages);

        if ($isDashboard) {
            include $base . 'layouts/dash_header.php';
        } else {
            include $base . 'layouts/site_header.php';
        }

        switch ($page) {
            // Public
            case 'home':            include $base . 'home.php'; break;
            case 'about':           include $base . 'about.php'; break;
            case 'contact':         include $base . 'contact.php'; break;

            // Auth
            case 'login':           include $base . 'auth/login.php'; break;
            case 'register':        include $base . 'auth/registration.php'; break;
            case 'forgot_password': include $base . 'auth/forgot_password.php'; break;
            case 'reset_password':  include $base . 'auth/reset_password.php'; break;
            case 'admin_login':     include $base . 'auth/admin_login.php'; break;

            // Jobs
            case 'jobs':            include $base . 'jobs/job.php'; break;
            case 'job_details':     include $base . 'jobs/jobDetails.php'; break;

            // Jobseeker dashboard
            case 'js_dashboard':    include $base . 'dashboard/jobseeker/js_dashboard.php'; break;
            case 'js_saved_jobs':   include $base . 'dashboard/jobseeker/js_save_jobs.php'; break;
            case 'js_applied_jobs': include $base . 'dashboard/jobseeker/js_applied_jobs.php'; break;
            case 'js_profile':      include $base . 'dashboard/jobseeker/js_profile.php'; break;
            case 'js_settings':      include $base . 'dashboard/jobseeker/js_settings.php'; break;

            // Recruiter dashboard
            case 'rec_dashboard':         include $base . 'dashboard/recruiter/rec_dashboard.php'; break;
            case 'rec_post_job':          include $base . 'dashboard/recruiter/rec_post_job.php'; break;
            case 'rec_manage_jobs':       include $base . 'dashboard/recruiter/rec_manage_jobs.php'; break;
            case 'rec_applicants':        include $base . 'dashboard/recruiter/rec_applicants.php'; break;
            case 'rec_applicant_details': include $base . 'dashboard/recruiter/rec_applicant_details.php'; break;
            case 'rec_company_profile':   include $base . 'dashboard/recruiter/rec_company_profile.php'; break;

            // Admin dashboard
            case 'admin_dashboard':       include $base . 'dashboard/admin/admin_dashboard.php'; break;
            case 'admin_manage_user':     include $base . 'dashboard/admin/admin_manage_user.php'; break;
            case 'admin_manage_jobs':     include $base . 'dashboard/admin/admin_manage_jobs.php'; break;
            case 'admin_manage_category': include $base . 'dashboard/admin/admin_manage_category.php'; break;
            case 'admin_recruter':        include $base . 'dashboard/admin/admin_recruter.php'; break;
            case 'admin_settings':        include $base . 'dashboard/admin/admin_settings.php'; break;

            default: include $base . 'home.php'; break;
        }

        if ($isDashboard) {
            include $base . 'layouts/dash_footer.php';
        } else {
            include $base . 'layouts/site_footer.php';
        }
    }
}
