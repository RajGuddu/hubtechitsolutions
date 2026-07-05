<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Admin\Auth_model;
class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $msg = '';        
        if(!session()->has('userlogin')){
            if(url_is('admin/*')){
                $msg = '<div class="alert alert-danger">You must be logged in!</div>';
            }
            return redirect()->to('/hockey')->with('message', $msg);
        }else{
            $menuId = $this->check_privilege();
            if(! $menuId){
                return redirect()->to('/authentication-failed');
            }
        }

    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
    public function check_privilege(){
        //$request = \Config\Services::request(); 
        helper('custom');
        /**************Users****************** */
        if(url_is('/admin/users')){
            return is_privilege(1);
        }else if(url_is('/admin/add_user')){
            return is_privilege(1,2);
        }else if(url_is('/admin/edit_user/*')){
            return is_privilege(1,3);
        }else if(url_is('/admin/user_profile/*')){
            return is_privilege(1,4);
        }else if(url_is('/admin/user_delete/*')){
            return is_privilege(1,5);
        /**************Users group****************** */
        }else if(url_is('/admin/user_groups')){
            return is_privilege(2);
        }else if(url_is('/admin/addgroup')){
            return is_privilege(2,2);
        }else if(url_is('/admin/editgroup/*')){
            return is_privilege(2,3);
        }else if(url_is('/admin/deletegroup/*')){
            return is_privilege(2,4);
        /********************setting****************** */
        }else if(url_is('/admin/setting')){
            return is_privilege(6);
        /*********************CMS*********************** */
        }else if(url_is('/admin/cms')){
            return is_privilege(7);
        }else if(url_is('/admin/add_edit_cms')){
            return is_privilege(7,2);
        }else if(url_is('/admin/add_edit_cms/*')){
            return is_privilege(7,3);
        }else if(url_is('/admin/delete_cms/*')){
            return is_privilege(7,4);
        
        /*********************Blogs*********************** */
        }else if(url_is('/admin/blogs')){
            return is_privilege(8);
        }else if(url_is('/admin/add_edit_blog')){
            return is_privilege(8,2);
        }else if(url_is('/admin/add_edit_blog/*')){
            return is_privilege(8,3);
        }else if(url_is('/admin/delete_blog/*')){
            return is_privilege(8,4);
        /*********************Faq*********************** */
        }else if(url_is('/admin/faq')){
            return is_privilege(9);
        }else if(url_is('/admin/add_edit_faq')){
            return is_privilege(9,2);
        }else if(url_is('/admin/add_edit_faq/*')){
            return is_privilege(9,3);
        }else if(url_is('/admin/delete_faq/*')){
            return is_privilege(9,4);
        /*********************testimonial*********************** */
        }else if(url_is('/admin/testimonial')){
            return is_privilege(10);
        }else if(url_is('/admin/add_edit_testimonial')){
            return is_privilege(10,2);
        }else if(url_is('/admin/add_edit_testimonial/*')){
            return is_privilege(10,3);
        }else if(url_is('/admin/delete_testimonial/*')){
            return is_privilege(10,4);
        /*********************Manage Banner*********************** */
        }else if(url_is('/admin/banner')){
            return is_privilege(11);
        }else if(url_is('/admin/add_edit_banner')){
            return is_privilege(11,2);
        }else if(url_is('/admin/add_edit_banner/*')){
            return is_privilege(11,3);
        }else if(url_is('/admin/delete_banner/*')){
            return is_privilege(11,4);
        /*********************Course Management*********************** */
        }else if(url_is('/admin/course_category')){
            return is_privilege(12);
        }else if(url_is('/admin/course_category_cu')){
            return is_privilege(12,2);
        }else if(url_is('/admin/course_category_cu/*')){
            return is_privilege(12,3);
        }else if(url_is('/admin/courses')){
            return is_privilege(13);
        }else if(url_is('/admin/add_edit_course')){
            return is_privilege(13,2);
        }else if(url_is('/admin/add_edit_course/*')){
            return is_privilege(13,3);
        }else if(url_is('/admin/delete_course/*')){
            return is_privilege(13,5);
        }else if(url_is('/admin/instructor')){
            return is_privilege(14);
        }else if(url_is('/admin/instructor_cu')){
            return is_privilege(14,2);
        }else if(url_is('/admin/instructor_cu/*')){
            return is_privilege(14,3);
        /******************enquiry & enrollment**************** */
        }else if(url_is('/admin/contact_us_listing')){
            return is_privilege(15);
        }else if(url_is('/admin/enrolled_listing')){
            return is_privilege(16);
        }else if(url_is('/admin/enq_status/*')){
            if(is_privilege(16,3)){
                return is_privilege(16,3);
            }else{
                return is_privilege(15,3);
            }
        /*******************student management****************** */
        }else if(url_is('/admin/admissions')){
            return is_privilege(17);
        }
        return true; //for common url
    }
}