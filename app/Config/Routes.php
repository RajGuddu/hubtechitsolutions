<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/authentication-failed', function(){
    return view('admin/auth-fail');
});
$routes->set404Override(function(){
        echo view('errors/html/error_404_2');
});
$routes->get('404', function(){
    echo view('errors/html/error_404_2');
});

$routes->get('about-us', 'Home::about_us');
$routes->get('courses', 'Home::courses');
$routes->get('course-details/(:any)', 'Home::course_details/$1');
$routes->get('contact-us', 'Home::contact_us');
$routes->match(['get','post'],'home/save_contact_us', 'Home::save_contact_us');
$routes->match(['get','post'],'certificate-verification', 'Home::certificate_verification');
$routes->match(['get','post'],'enroll-internship', 'Home::enroll_internship');
$routes->match(['get','post'],'enrollment-payment-verify', 'Home::enrollment_payment_verify');
$routes->match(['get','post'],'intern-certificate-verification', 'Home::intern_certificate_verification');
$routes->match(['get','post'],'download-intern-letter/(:num)', 'Home::download_intern_letter/$1');

//test route
$routes->get('testmail', 'Home::testmail');
$routes->get('testpdf', 'Home::testpdf');

//
//Filter on route group
$routes->group('', ['filter' => 'AuthCheck'], function($routes){
    //Add all routes need protected by this filter
    $routes->add('/logout', 'Auth::logout');
    $routes->add('/profile', 'Auth::edit_profile');
    $routes->add('/change-password', 'Auth::change_password');
    $routes->get('/admin', 'Admin::index');
    /******************************Users****************************** */
    $routes->get('/admin/users', 'Admin::users');
    $routes->match(['get','post'],'/admin/add_user', 'Admin::add_user');
    $routes->match(['get','post'],'/admin/edit_user/(:num)', 'Admin::edit_user/$1');
    $routes->match(['get','post'],'/admin/user_profile/(:num)', 'Admin::user_profile/$1');
    $routes->match(['get','post'],'/admin/user_delete/(:num)', 'Admin::user_delete/$1');
    /******************************Users Group****************************** */
    $routes->get('/admin/user_groups', 'Admin::user_groups');
    $routes->match(['get','post'],'/admin/addgroup', 'Admin::addgroup');
    $routes->match(['get','post'],'/admin/editgroup/(:num)', 'Admin::editgroup/$1');
    $routes->match(['get','post'],'/admin/deletegroup/(:num)', 'Admin::deletegroup/$1');
    /****************************setting************************************ */
    $routes->match(['get','post'],'/admin/setting', 'Admin::setting');
    /****************************CMS**************************************** */
    $routes->get('/admin/cms', 'Admin::cms');
    $routes->match(['get','post'],'/admin/add_edit_cms', 'Admin::add_edit_cms');
    $routes->match(['get','post'],'/admin/add_edit_cms/(:num)', 'Admin::add_edit_cms/$1');
    $routes->match(['get','post'],'/admin/delete_cms/(:num)', 'Admin::delete_cms/$1');
    /****************************Blogs**************************************** */
    $routes->get('/admin/blogs', 'Admin::blogs');
    $routes->match(['get','post'],'/admin/add_edit_blog', 'Admin::add_edit_blog');
    $routes->match(['get','post'],'/admin/add_edit_blog/(:num)', 'Admin::add_edit_blog/$1');
    $routes->match(['get','post'],'/admin/delete_blog/(:num)', 'Admin::delete_blog/$1');
    /****************************Faq**************************************** */
    $routes->get('/admin/faq', 'Admin::faq');
    $routes->match(['get','post'],'/admin/add_edit_faq', 'Admin::add_edit_faq');
    $routes->match(['get','post'],'/admin/add_edit_faq/(:num)', 'Admin::add_edit_faq/$1');
    $routes->match(['get','post'],'/admin/delete_faq/(:num)', 'Admin::delete_faq/$1');
    /*********************************Testimonial********************************* */
    $routes->get('/admin/testimonial', 'Admin::testimonial');
    $routes->match(['get','post'],'/admin/add_edit_testimonial', 'Admin::add_edit_testimonial');
    $routes->match(['get','post'],'/admin/add_edit_testimonial/(:num)', 'Admin::add_edit_testimonial/$1');
    $routes->match(['get','post'],'/admin/delete_testimonial/(:num)', 'Admin::delete_testimonial/$1');
    /*********************************Manage Banner********************************* */
    $routes->get('/admin/banner', 'Admin::banner');
    $routes->match(['get','post'],'/admin/add_edit_banner', 'Admin::add_edit_banner');
    $routes->match(['get','post'],'/admin/add_edit_banner/(:num)', 'Admin::add_edit_banner/$1');
    $routes->match(['get','post'],'/admin/delete_banner/(:num)', 'Admin::delete_banner/$1');
    /**********************************Course Management******************************** */
    $routes->get('/admin/course_category', 'Admin::course_category');
    $routes->match(['get','post'],'/admin/course_category_cu', 'Admin::course_category_cu');
    $routes->match(['get','post'],'/admin/course_category_cu/(:num)', 'Admin::course_category_cu/$1');

    $routes->get('/admin/courses', 'Admin::courses');
    $routes->match(['get','post'],'/admin/add_edit_course', 'Admin::add_edit_course');
    $routes->match(['get','post'],'/admin/add_edit_course/(:num)', 'Admin::add_edit_course/$1');
    $routes->match(['get','post'],'/admin/delete_course/(:num)', 'Admin::delete_course/$1');

    $routes->get('/admin/instructor', 'Admin::instructor');
    $routes->match(['get','post'],'/admin/instructor_cu', 'Admin::instructor_cu');
    $routes->match(['get','post'],'/admin/instructor_cu/(:num)', 'Admin::instructor_cu/$1');
    /*****************************enquiry & enrollment************************ */
    $routes->get('/admin/contact_us_listing', 'Admin::contact_us_listing');
    $routes->get('/admin/enrolled_listing', 'Admin::enrolled_listing');
    $routes->match(['get','post'],'/admin/enq_status/(:num)', 'Admin::enq_status/$1');
    /*****************************Institution management*************************** */
    $routes->get('/admin/admissions', 'Admin::admissions');
    $routes->match(['get','post'],'/admin/admissions_cu', 'Admin::admissions_cu');
    $routes->match(['get','post'],'/admin/admissions_cu/(:num)', 'Admin::admissions_cu/$1');
    $routes->get('/admin/admissions_r/(:num)', 'Admin::admissions_r/$1');
    $routes->get('/admin/admissions_d/(:num)', 'Admin::admissions_d/$1');

    $routes->get('/admin/batches', 'Admin::batches');
    $routes->match(['get','post'],'/admin/batch_cu', 'Admin::batch_cu');
    $routes->match(['get','post'],'/admin/batch_cu/(:num)', 'Admin::batch_cu/$1');

    $routes->get('/admin/centers', 'Admin::centers');
    $routes->match(['get','post'],'/admin/center_cu', 'Admin::center_cu');
    $routes->match(['get','post'],'/admin/center_cu/(:num)', 'Admin::center_cu/$1');

    /*************************Internship Management**************************** */
    $routes->match(['get','post'],'/admin/intern-students', 'Internship::index');
    $routes->match(['get','post'],'/admin/intern-students/(:num)', 'Internship::index/$1');
    $routes->get('admin/intern-students/reset-search', 'Internship::reset_search');


    $routes->get('/admin/certificate_list', 'Admin::certificate_list');
    $routes->match(['get','post'],'/admin/certificate_cu', 'Admin::certificate_cu');
    $routes->match(['get','post'],'/admin/certificate_cu/(:num)', 'Admin::certificate_cu/$1');
    $routes->get('/admin/certificate_d/(:num)', 'Admin::certificate_d/$1');

});
$routes->group('', ['filter' => 'AlreadyLoggedIn'], function($routes){
    //Add all routes need protected after logged in
    $routes->match(['get','post'],'/hockey', 'Auth::login');
});
$routes->group('', ['filter' => 'NoAccessFilter'], function($routes){
    //Add all routes need protected from Direct Access
    $routes->get('/auth/login', 'Auth::login');
    $routes->get('/auth/logout', 'Auth::logout');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
