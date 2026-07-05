<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
class Admin extends BaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Admin-Users';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->adminmodel = model('App\Models\Admin_model', false);
    }
    
    public function index()
    {
        //$this->data['users'] = $this->commonmodel->getAllRecord('tbl_admin');
        return view("admin/dashboard",$this->data);
        
    }
    public function users()
    {
        $this->data['users'] = $this->adminmodel->getAllUsers();
        return view("admin/users/index",$this->data);
        
    }
    public function add_user(){
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
              'name'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Your Full name is required'
                  ]
                  ],
              'email' =>[
                  'rules'=>'required|valid_email|is_unique[tbl_admin.email]',
                  'errors'=>[
                      'required'=>'Email is required',
                      'valid_email'=>'You must enter a valid email',
                      'is_unique'=>'Email already taken'
                  ]
                  ],
              'password'=>[
                  //'rules'=>'required|min_length[5]|max_length[12]|regex_match[^[A-Z]+(?=.*?[a-z])(?=.*?[0-9])(?=.*?\W).*$]',
                  'rules'=>'required|min_length[5]|max_length[12]',
                  'errors'=>[
                      'required'=>'Password is required',
                      'min_length'=>'Password must have atleast 5 character in length',
                      'max_length'=>'Password must not have characters more than 12 in length',
                      'regex_match'=>'Password must start with capital letter, and containing at least 1 lowercase, 1 special character and 1 digit.',
                  ]
                  ],
              'cpassword'=>[
                  'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                  'errors'=>[
                      'required'=>'Confirm password is required',
                      'min_length'=>'Confirm Password must have atleast 5 character in length',
                      'max_length'=>'Confirm Password must not have characters more than 12 in length',
                      'matches'=>'Confirm Password not matches to password'
                  ]
                  ],
              'phone'=>[
                  'rules'=>'required|numeric|min_length[10]|max_length[10]',
                  'errors'=>[
                      'required'=>'Phone is required',
                      'numeric'=>'You must enter numeric value',
                      'min_length'=>'Phone Number must be 10 digit in length',
                      'max_length'=>'Phone Number must not have more than 10 digit in length'
                  ]
                  ],
              'address'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Address is required'
                  ]
                  ],
              'image' =>[
                  //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                  'rules'=>'max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                  'errors'=>[
                      //'uploaded'=>lang('User.validation.image.uploaded'),
                      'max_size'=>'Image should not greater than 100 KB of size.',
                      'ext_in'=>'Image must be extension with png,jpg,jpeg,bmp,gif.',
                  ]
              ],
              'privilege_id'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Privilege is required'
                  ]
                ], 
              'status'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Status must be select'
                  ]
              ]
          ]);
          if(!$validation){
              $this->data['validation'] = $this->validator;
              //return view('admin/users/add_user',$this->data);
          }else{
              if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $data['image'] = $newName;
              }
              $data['name'] = $_POST['name'];
              $data['email'] = $_POST['email'];
              $password = $_POST['cpassword'];
              $data['password'] = Hash::make($password);
              //$data['password'] = md5($_POST['password']);
              //$data['cpass'] = $_POST['password'];
              $data['ip_address'] = $this->request->getIPAddress();
              $data['phone'] = $_POST['phone'];
              $data['privilege_id'] = $this->request->getVar('privilege_id');
              $data['added_by'] = session('user_id');
              $data['address'] = $_POST['address'];
              $data['status'] = $_POST['status'];
  
              $inserted = $this->commonmodel->insertRecord('tbl_admin', $data);
              if($inserted){
                session()->setFlashdata(['message'=>'User Added Successfully','type'=>'success']);
                  //return redirect()->to(base_url('/admin/users'));
              }else{
                session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                  
              }
              return redirect()->to(base_url('/admin/users'));
            } //request post close
        }
        $this->data['rolePrivilege'] = $this->commonmodel->getAllRecord('tbl_role_privilege', ['status'=>1, 'privilege_id !='=>1]);
        return view("admin/users/add_user",$this->data);
    }
    public function edit_user($id){
        if ($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('name', 'Username', 'required',['required'=>'Your Full name is required']);
            $validation->setRule('phone','Phone','required|numeric|min_length[10]|max_length[10]',['required'=>'Phone is required','numeric'=>'You must enter numeric value','min_length'=>'Phone Number must be 10 digit in length','max_length'=>'Phone Number must not have more than 10 digit in length']);
            $validation->setRule('address', 'Address', 'required',['required'=>'Address is required']);
            if($id != 1){
                $validation->setRule('email','Email','required|valid_email',['required'=>'Email is required','valid_email'=>'You must enter a valid email']);
                $validation->setRule('privilege_id', 'Privilege', 'required',['required'=>'Privilege is required']);
                $validation->setRule('status', 'Status', 'required',['required'=>'Privilege is required']);
            }
           
          if(!$validation->withRequest($this->request)->run()){
              $this->data['validation'] = $validation->getErrors();
          }else{
              if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $data['image'] = $newName;
              }
              $data['name'] = $_POST['name'];
              $data['ip_address'] = $this->request->getIPAddress();
              $data['phone'] = $_POST['phone'];
              $data['update_by'] = session('user_id');
              $data['address'] = $_POST['address'];
              $data['updated'] = date('Y-m-d H:i:s');
              if($id != 1){
                $data['email'] = $_POST['email'];
                $data['privilege_id'] = $this->request->getVar('privilege_id');
                $data['status'] = $_POST['status'];
              }
  
              $updated = $this->commonmodel->updateRecord('tbl_admin', $data, ['user_id'=>$id]);
              if($updated){
                  session()->setFlashdata(['message'=>'User Updated Successfully','type'=>'success']);
                  //return redirect()->to(base_url('/admin/users'));
              }else{
                  session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                  
              }
              return redirect()->to(base_url('/admin/users'));
            } //request post close
        }
        $this->data['rolePrivilege'] = $this->commonmodel->getAllRecord('tbl_role_privilege', ['status'=>1, 'privilege_id !='=>1]);
        $this->data['user'] = $this->commonmodel->getOneRecord('tbl_admin', ['user_id'=>$id]);
        return view("admin/users/edit_user",$this->data);
    }
    public function user_profile($id){
        $this->data['user'] = $this->adminmodel->getAllUsers($id);
        return view("admin/users/user_profile",$this->data);
    }
    public function user_delete($id){
        if($id==1){
            session()->setFlashdata(['message'=>'Admin can not delete','type'=>'danger']);
            return redirect()->to(base_url('/admin/users')); 
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_admin', ['user_id'=>$id]);
            if($deleted){
                session()->setFlashdata(['message'=>'User Deleted Successfully','type'=>'success']);
                //return redirect()->to(base_url('/admin/users'));
            }else{
                session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                
            }
            return redirect()->to(base_url('/admin/users'));
        }
    }
    /*******************************************Users Group******************************************* */
    public function user_groups(){
        $this->data['usersgrouplist'] = $this->commonmodel->getAllRecord('tbl_role_privilege');
        return view("admin/users/usergroupindex",$this->data);
    }
    public function addgroup(){
        if($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('post_name', 'Group Name', 'required',['required'=>'Group name is required']);
            $validation->setRule('status', 'Status', 'required',['required'=>'Status is required']);
            if($validation->withRequest($this->request)->run()){
                $post = $this->request->getPost();
                $data = array();
                $data['post_name'] = $this->request->getPost('post_name');
                $data['status'] = $this->request->getPost('status');
                $data['created_at'] = date('Y-m-d');
                $groupId = $this->commonmodel->insertRecord('tbl_role_privilege', $data);
                if(isset($post['menu_id']) && isset($post['crudid'])){
					foreach($post['menu_id'] as $key=>$menuid){
						$prvlgarr = array();
						$prvlgarr['privilege_id'] = $groupId;
						$prvlgarr['menu_id'] = $menuid;
						$prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
						$prvlgarr['added_at'] = date('Y-m-d');
						$this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
					}
					//echo '<pre>';print_r($post);exit;	
				}
                if($groupId){
                    session()->setFlashdata(['message'=>'User Group Added Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/user_groups'));
            }else{
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status'=>1]);
        return view('admin/users/add_group', $this->data);
    }
    public function editgroup($id){
        if($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('post_name', 'Group Name', 'required',['required'=>'Group name is required']);
            $validation->setRule('status', 'Status', 'required',['required'=>'Status is required']);
            if($validation->withRequest($this->request)->run()){
                $post = $this->request->getPost();
                $id = $this->request->getPost('id');
                $data = array();
                $data['post_name'] = $this->request->getPost('post_name');
                $data['status'] = $this->request->getPost('status');
                $data['updated_at'] = date('Y-m-d');
                $updated = $this->commonmodel->updateRecord('tbl_role_privilege', $data,['privilege_id'=>$id]);
                $loginId = session('user_id');
                //echo $loginId; exit;
                if($loginId == 1){
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id,'menu_id !='=>2]);
                }else{
                    $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id]);
                }
                if(isset($post['menu_id']) && isset($post['crudid'])){
					foreach($post['menu_id'] as $key=>$menuid){
						$prvlgarr = array();
						$prvlgarr['privilege_id'] = $id;
						$prvlgarr['menu_id'] = $menuid;
						$prvlgarr['crud_ids'] = implode(',', $post['crudid'][$key]);
						$prvlgarr['added_at'] = date('Y-m-d');
						$inserted = $this->commonmodel->insertRecord('tbl_privilege', $prvlgarr);
					}
					//echo '<pre>';print_r($post);exit;	
				}
                if($updated){
                    session()->setFlashdata(['message'=>'User Group Updated Successfully','type'=>'success']);
                }else if(isset($inserted) || $deleteAllPrivilege){
                    session()->setFlashdata(['message'=>'Privilege Updated Successfully','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
                }
                return redirect()->to(base_url('/admin/editgroup/'.$id));
            }else{
                $this->data['validation'] = $validation->getErrors();
            }
        }
        $this->data['prev_details'] = $this->commonmodel->getOneRecord('tbl_role_privilege', array('privilege_id'=>$id));
        $this->data['menulist'] = $this->commonmodel->getAllRecord('tbl_menu_list', ['status'=>1]);
        return view('admin/users/edit_group', $this->data);
    }
    public function deletegroup($id=false){
        if($id == 1){
            session()->setFlashdata(['message'=>'Admin Group can not delete!','type'=>'danger']);
            return redirect()->to('/admin/user_groups');
        }
        $deleteAllPrivilege = $this->commonmodel->deleteRecord('tbl_privilege',['privilege_id'=>$id]);
        $deleted = $this->commonmodel->deleteRecord('tbl_role_privilege', array('privilege_id'=>$id));
        if($deleted && $deleteAllPrivilege){
            session()->setFlashdata(['message'=>'Group deleted successfully','type'=>'success']);
        }else{
            session()->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
        }
        return redirect()->to(base_url('/admin/user_groups'));
    }

    /*******************************************Settings************************************** */
    public function setting()
    {
        if ($this->request->getMethod() === 'post'){
            $data = array();
            $data = $_POST;
            $updated = $this->commonmodel->update_setting($data, 1);
            if($updated){
                $this->session->setFlashdata(['message'=>'Setting Update Successfully','type'=>'success']);
                return redirect()->to(base_url('/admin/setting'));
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
                return redirect()->to(base_url('/admin/setting'));
            }
        }
        else{
        $this->data['settings'] = $this->commonmodel->get_setting(1);
        
        return view("admin/setting/setting_edit",$this->data);
        }
        
    }
    /**************************************CMS************************************************ */
    public function cms()
	{
        $this->data['cms'] = $this->commonmodel->getAllRecord('tbl_cms');
        return view('admin/cms/cms_index', $this->data);
	}
    public function add_edit_cms($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                'banner_title'=>'required',
                'banner_head'=>'required',
                'cms_banner'=>[
                    //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    'rules'=>'max_size[cms_banner,524288000]|ext_in[cms_banner,png,jpg,jpeg,bmp,gif]',
                    'errors'=>[
                    //'uploaded'=>'Image is required.',
                    'max_size'=>'Image must not have size more than 500 MB in length.',
                    'ext_in'=>'File must have extension with png, gif, jpg, jpeg, bmp.',
                    ]
                ],
                //'description1'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
                //return view('admin/cms/add_edit_cms', $this->data);
            }else{
                //$id = $this->request->getPost('id');
                if($_FILES['cms_banner']['name'] != ''){
                    if($img = $this->request->getFile('cms_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $data['cms_banner'] = $newName;
                        }
                    }
                }
                $data['page'] = $_POST['page'];
                $data['banner_title'] = $_POST['banner_title'];
                $data['banner_head'] = $_POST['banner_head'];
                $data['description1'] = $_POST['description1'];
                //$data['description2'] = $_POST['description2'];
                //$data['description3'] = $_POST['description3'];
                //$data['description4'] = $_POST['description4'];
                //$data['description5'] = $_POST['description5'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_cms', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'CMS added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_cms', $data, ['id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'CMS Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/cms'));
            }
            
        }
        if($id){
            $this->data['cms'] = $this->commonmodel->getOneRecord('tbl_cms', ['id'=>$id]);
        }
        return view('admin/cms/add_edit_cms', $this->data);
    }
    public function delete_cms($id){
        if(!$id){
            return redirect()->to(site_url('admin/cms'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_cms',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'CMS Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'CMS Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/cms'));
        }
    }
    /******************************************Blogs*********************************** */
    public function blogs(){
        $this->data['blogs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_blog','',['blg_id','desc']);
        return view('admin/blogs/index', $this->data);
	}
    public function add_edit_blog($id=''){
        date_default_timezone_set('Asia/Kolkata');
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'blog_title'=>'required',
                'blog_url'=>'required',
                'blog_details'=>'required',
                'meta_title'=>'required',
                'meta_description'=>'required',
                'meta_keyword'=>'required',
                'post_date'=>'required',
                'blog_added_by'=>'required',
                'blog_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['blog_image']['name'] != ''){
                    if($img = $this->request->getFile('blog_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'b_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['blog_image'] = $newName;
                }
                $data['blog_title'] = $_POST['blog_title'];
                $data['blog_url'] = $_POST['blog_url'];
                $data['blog_details'] = $_POST['blog_details'];
                $data['meta_title'] = $_POST['meta_title'];
                $data['meta_description'] = $_POST['meta_description'];
                $data['meta_keyword'] = $_POST['meta_keyword'];
                $data['post_date'] = $_POST['post_date'];
                $data['blog_added_by'] = $_POST['blog_added_by'];
                $data['blog_status'] = $_POST['blog_status'];
                $data['added_at'] = date('Y-m-d H:i:s');
                if(!$id){
                    $inserted = $this->commonmodel->insertRecord('tbl_blog', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'Blogs added successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }else{
                    $updated = $this->commonmodel->updateRecord('tbl_blog', $data, ['blg_id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Blogs updated successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/blogs'));
            }
        }
        if($id){
            $this->data['blog'] = $this->commonmodel->getOneRecord('tbl_blog', ['blg_id'=>$id]);
        }
        return view('admin/blogs/add_edit_blog', $this->data);
    }
    public function delete_blog($id){
        if(!$id){
            return redirect()->to(site_url('admin/blogs'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_blog',['blg_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Blog Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Blog Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/blogs'));
        }
    }
    /******************************************Faq*********************************** */
    public function faq(){
        $this->data['faqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_faqs','',['faq_id','desc']);
        return view('admin/faq/index', $this->data);
	}
    public function add_edit_faq($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                //'faq_for'=>'required',
                'faq_title'=>'required',
                'faq_description'=>'required',
                //'faq_position'=>'required',
                'faq_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                //$id = $this->request->getPost('faq_id');
                //if($_FILES['logo']['name'] != ''){
                //    if($img = $this->request->getFile('logo')){ 
                //        $imgname = $img->getName();
                //        if($img->isValid() && !$img->hasMoved()){
                //            $ext = explode('.',$imgname);
                //            $ext = end($ext);
                //            $newName = 't_'.time().'.'.$ext;
                //            $img->move('./public/assets/images/upload/testimonial/',$newName);
                //        }
                //    }
                //    $data['logo'] = $newName;
                //}else{
                //    if($id){
                //        $data['logo'] = $_POST['logo2'];
                //    }else{
                //        $data['logo'] = '';
                //    }
                //}
                //$data['faq_for'] = $_POST['faq_for'];
                $data['faq_title'] = $_POST['faq_title'];
                $data['faq_description'] = $_POST['faq_description'];
                //$data['faq_position'] = $_POST['faq_position'];
                $data['faq_status'] = $_POST['faq_status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_faqs', $data);
                }else{
                    $data['modified_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_faqs', $data, ['faq_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Faq added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Faq updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/faq'));
            }

        }
        if($id){
            $this->data['faq'] = $this->commonmodel->getOneRecord('tbl_faqs', ['faq_id'=>$id]);
        }
        return view('admin/faq/add_edit_faq', $this->data);
    }
    public function delete_faq($id){
        if(!$id){
            return redirect()->to(site_url('admin/faq'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_faqs',['faq_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'faq Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Faq Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/faq'));
        }
    }
    /***************************************Testimonial****************************** */
    public function testimonial()
	{
        $this->data['testimonial'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_testimonial','',['id','desc']);
        return view('admin/testimonial/index', $this->data);
	}
    public function add_edit_testimonial($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'name'=>'required',
                'description'=>'required',
                'post'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['logo']['name'] != ''){
                    if($img = $this->request->getFile('logo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 't_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['logo'] = $newName;
                }
                $data['name'] = $_POST['name'];
                $data['description'] = $_POST['description'];
                $data['post'] = $_POST['post'];
                $data['status'] = $_POST['status'];

                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_testimonial', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_testimonial', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/testimonial'));
                
            }

        }
        if($id){
            $this->data['testimonial'] = $this->commonmodel->getOneRecord('tbl_testimonial', ['id'=>$id]);
        }
        return view('admin/testimonial/add_edit_testimonial', $this->data);
    }
    public function delete_testimonial($id){
        if(!$id){
            return redirect()->to(site_url('admin/testimonial'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_testimonial',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/testimonial'));
        }
    }
    /***********************************************Manage Banner************************************** */
    public function banner()
	{
        $this->data['banner'] = $this->commonmodel->get_banners();
        return view('admin/banner/index', $this->data);
	}
    public function add_edit_banner($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                //'url'=>'required',
                'main_title'=>'required',
                'sub_title'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['brochure']['name'] != ''){
                    if($img = $this->request->getFile('brochure')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['brochure'] = $newName;
                }
                $data['page'] = $_POST['page'];
                //$data['url'] = $_POST['url'];
                $data['main_title'] = $_POST['main_title'];
                $data['sub_title'] = $_POST['sub_title'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_banner', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_banner', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/banner'));
                
            }

        }
        if($id){
            $this->data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['id'=>$id]);
        }
        $this->data['pages'] = $this->commonmodel->getAllRecord('tbl_page',['status'=>'1']);
        return view('admin/banner/add_edit_banner', $this->data);
    }
    public function delete_banner($id){
        if(!$id){
            return redirect()->to(site_url('admin/banner'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_banner',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/banner'));
        }
    }
    /****************************************COURSE MANAGEMENT******************************************* */
    public function course_category(){
        $this->data['course_categories'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_course_category','', ['ccat_id','DESC']);
        return view('admin/course/category_index', $this->data);
    }
    public function course_category_cu($id = false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'course_category_name'=>'required',
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                /*if($_FILES['brochure']['name'] != ''){
                    if($img = $this->request->getFile('brochure')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['brochure'] = $newName;
                }*/
                $data['course_category_name'] = $_POST['course_category_name'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_course_category', $data);
                }else{
                    $updated = $this->commonmodel->updateRecord('tbl_course_category', $data, ['ccat_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/course_category'));
                
            }

        }
        if($id){
            $this->data['ccdata'] = $this->commonmodel->getOneRecord('tbl_course_category', ['ccat_id'=>$id]);
        }
        return view('admin/course/category_cu', $this->data);
    }
    public function instructor(){
        $this->data['instructor'] = $this->commonmodel->getAllRecord('tbl_instructor');
        return view('admin/course/instructor_index', $this->data);
    }
    public function instructor_cu($id = false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'ins_name'=>'required',
                'post'=>'required',
                'details'=>'required',
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['ins_image']['name'] != ''){
                    if($img = $this->request->getFile('ins_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'dp_ins_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['ins_image'] = $newName;
                }
                $data['ins_name'] = $_POST['ins_name'];
                $data['post'] = $_POST['post'];
                $data['details'] = $_POST['details'];
                $data['facebook_link'] = $_POST['facebook_link'];
                $data['twitor_link'] = $_POST['twitor_link'];
                $data['linkedin_link'] = $_POST['linkedin_link'];
                $data['youtube_link'] = $_POST['youtube_link'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_instructor', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_instructor', $data, ['ins_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/instructor'));
                
            }

        }
        if($id){
            $this->data['ccdata'] = $this->commonmodel->getOneRecord('tbl_instructor', ['ins_id'=>$id]);
        }
        return view('admin/course/instructor_cu', $this->data);
    }
    public function courses(){
        $this->data['courses'] = $this->adminmodel->get_all_courses();
        return view('admin/course/courses_index', $this->data);
    }
    public function add_edit_course($id=false){
        if($this->request->getMethod() == 'post'){
            $id = (isset($_POST['course_id']) && $_POST['course_id'] != '')?$_POST['course_id']:0;
            if($this->request->getPost('submit') == 'basic'){
                $tabname = 'Basic';
                $validation = $this->validate([
                    'course_name'=>'required',
                    //'url'=>'required',
                    'course_full_name'=>'required',
                    'ccat_id'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Course Category is required',
                        ]
                    ],
                    'short_description'=>'required',
                    'description'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'About course is required',
                        ]
                    ],
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    if($_FILES['image']['name'] != ''){
                        if($img = $this->request->getFile('image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'c_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['image'] = $newName;
                    }
                    $data['course_name'] = $_POST['course_name'];
                    $data['course_full_name'] = $_POST['course_full_name'];
                    $data['url'] = $_POST['url'];
                    $data['ccat_id'] = $_POST['ccat_id'];
                    $data['short_description'] = $_POST['short_description'];
                    $data['description'] = $_POST['description'];
                    $data['youtube_vlink'] = $_POST['youtube_vlink'];
                    $data['complete_tab'] = 1;
                   
                }
            }
            if($this->request->getPost('submit') == 'slbs'){
                //print_r($_POST);exit;
                $tabname = 'Syllabus';
                /*$validation = $this->validate([
                    'module_name[0]'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Module Name 1 is required',
                        ]
                    ],
                    'syllabus[0]'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Syllabus 1 is required',
                        ]
                    ],
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{ */
                $modulenamearr = $_POST['module_name'];
                $syllabusarr = $_POST['syllabus'];
                $slbdata = array();
                for($i=0; $i < count($modulenamearr); $i++){
                    if($modulenamearr[$i] != '' && $syllabusarr[$i] != ''){
                        $slbdata[$i]['module_name'] = $modulenamearr[$i];
                        $slbdata[$i]['syllabus'] = $syllabusarr[$i];
                    }
                }
                $jsonslbdata = json_encode($slbdata);
                if(!empty($slbdata)){
                    $data['syllabus'] = $jsonslbdata;
                    $data['complete_tab'] = 2;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
                //}

            }
            if($this->request->getPost('submit') == 'learn'){
                $tabname = 'What you\'ll learn';
                if(count(array_filter($_POST['what_learn'])) > 0){
                    $data['what_learn'] = json_encode(array_filter($_POST['what_learn']));
                    $data['complete_tab'] = 3;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }

            }
            if($this->request->getPost('submit') == 'require'){
                $tabname = 'Requirements';
                if(count(array_filter($_POST['requirements'])) > 0){
                    $data['requirements'] = json_encode(array_filter($_POST['requirements']));
                    $data['complete_tab'] = 4;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }

            }
            if($this->request->getPost('submit') == 'courseincludes'){
                //print_r($_POST);exit;
                $tabname = 'Course Includes';
                $validation = $this->validate([
                    'course_fee' => 'required',
                    'adm_fee'=> 'required',
                    'ins_fee'=> 'required',
                    'duration'=> 'required',
                    'ins_id'=> 'required',
                    'enrolled'=> 'required',
                    'language'=> 'required',
                    'is_cert'=> 'required',
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{ 
                    $data['course_fee'] = $_POST['course_fee'];
                    $data['adm_fee'] = $_POST['adm_fee'];
                    $data['ins_fee'] = $_POST['ins_fee'];
                    $data['duration'] = $_POST['duration'];
                    $data['ins_id'] = $_POST['ins_id'];
                    $data['enrolled'] = $_POST['enrolled'];
                    $data['lesson'] = $_POST['lesson'];
                    $data['course_level'] = $_POST['course_level'];
                    $data['language'] = $_POST['language'];
                    $data['is_cert'] = $_POST['is_cert'];
                    $data['complete_tab'] = 5;
                }

            }
            if($this->request->getPost('submit') == 'publish'){
                //print_r($_POST);exit;
                $tabname = 'Publish';
                
                $data['status'] = $_POST['status'];
                //$data['complete_tab'] = 6;

            }
            if(isset($data) && !empty($data)){
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_courses', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_courses', $data, ['course_id '=>$id]);
                }
                    
                if(isset($inserted)){
                    $id = $inserted;
                    session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                if($id){
                    return redirect()->to(site_url('admin/add_edit_course/'.$id));
                }else{
                    return redirect()->to(site_url('admin/courses'));
                }
            }
        }
        if($id){
            $this->data['course'] = $this->commonmodel->getOneRecord('tbl_courses', ['course_id'=>$id]);
        }
        $this->data['course_category'] = $this->commonmodel->getAllRecord('tbl_course_category',['status'=>'1']);
        $this->data['instructors'] = $this->commonmodel->getAllRecord('tbl_instructor',['status'=>1]);
        return view('admin/course/add_edit_course', $this->data);
    }
    public function delete_course($id){
        if(!$id){
            return redirect()->to(site_url('admin/courses'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_courses',['course_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/courses'));
        }
    }
    /*************************************Enquiry & Enrollment************************* */
    public function contact_us_listing(){
        $this->data['page_title'] = 'Contact Us List';
        $this->data['page_type'] = 'Contact';
        $this->data['count_new'] = $this->adminmodel->count_enquiry_and_enrollment_list('contact', 1);
        $this->data['count_admitted'] = $this->adminmodel->count_enquiry_and_enrollment_list('contact', 2);
        $this->data['count_cancelled'] = $this->adminmodel->count_enquiry_and_enrollment_list('contact', 3);
        $this->data['listing'] = $this->adminmodel->enquiry_and_enrollment_list('contact');
        return view('admin/enquiry/enq_enroll_list', $this->data);
    }
    public function enrolled_listing(){
        $this->data['page_title'] = 'Course Enrollment List';
        $this->data['page_type'] = 'Enrolled';
        $this->data['count_new'] = $this->adminmodel->count_enquiry_and_enrollment_list('Enrolled', 1);
        $this->data['count_admitted'] = $this->adminmodel->count_enquiry_and_enrollment_list('Enrolled', 2);
        $this->data['count_cancelled'] = $this->adminmodel->count_enquiry_and_enrollment_list('Enrolled', 3);
        $this->data['listing'] = $this->adminmodel->enquiry_and_enrollment_list('Enrolled');
        return view('admin/enquiry/enq_enroll_list', $this->data);
    }
    public function enq_status($id=false){
        if($this->request->getMethod() == 'post'){
            $status = $this->request->getVar('status');
            $data['status'] = $status;
            $back_url = $this->request->getVar('back_url');
            if($status == 1 || $status == 3){
                $message = 'Record updated successfully.';
            }else{
                $message = 'Record updated successfully.';
                
            }
            $updated = $this->commonmodel->updateRecord('tbl_contact_us', $data, ['id'=>$id]);
            if($updated){
                $this->session->setFlashdata(['message'=>$message, 'type'=>'success']);
            }
            return redirect()->to($back_url);
        }
        $this->data['page_title'] = 'Change Status of Enquiry & Enrollment';
        $this->data['value'] = $this->commonmodel->getOneRecord('tbl_contact_us', ['id'=>$id]);
        return view('admin/enquiry/change_status', $this->data);
    }
}
?>