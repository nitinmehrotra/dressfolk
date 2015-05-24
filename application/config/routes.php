<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');
    /*
      | -------------------------------------------------------------------------
      | URI ROUTING
      | -------------------------------------------------------------------------
      | This file lets you re-map URI requests to specific controller functions.
      |
      | Typically there is a one-to-one relationship between a URL string
      | and its corresponding controller class/method. The segments in a
      | URL normally follow this pattern:
      |
      |	example.com/class/method/id/
      |
      | In some instances, however, you may want to remap this relationship
      | so that a different class/function is called than the one
      | corresponding to the URL.
      |
      | Please see the user guide for complete details:
      |
      |	http://codeigniter.com/user_guide/general/routing.html
      |
      | -------------------------------------------------------------------------
      | RESERVED ROUTES
      | -------------------------------------------------------------------------
      |
      | There area two reserved routes:
      |
      |	$route['default_controller'] = 'welcome';
      |
      | This route indicates which controller class should be loaded if the
      | URI contains no data. In the above example, the "welcome" class
      | would be loaded.
      |
      |	$route['404_override'] = 'errors/page_missing';
      |
      | This route will tell the Router what URI segments to use if those provided
      | in the URL cannot be matched to a valid route.
      |
     */
//$route['module_name'] = 'admin';
    $route['default_controller'] = "index";
    $route['404_override'] = 'index/pageNotFound';

    $route['static/(:any)'] = 'staticpages/index/$1';
    $route['about-us'] = 'staticpages/index/about-us';
    $route['disclaimer'] = 'staticpages/index/disclaimer';
    $route['privacy-policy'] = 'staticpages/index/privacy-policy';
    $route['return-policy'] = 'staticpages/index/return-policy';
    $route['shipping-details'] = 'staticpages/index/shipping-details';
    $route['terms'] = 'staticpages/index/terms';
    $route['contact-us'] = 'staticpages/contactUs';
    
    $route['about-us'] = 'staticpages/index/about-us';
    $route['login'] = 'index/login';
    $route['signup'] = 'index/signup';
    $route['forgot-password'] = 'index/forgotPassword';
    
    $route['my-account'] = 'user/myAccount';

    /* End of file routes.php */
/* Location: ./application/config/routes.php */