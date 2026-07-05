<?php

    use App\Models\Auth_model;

    if(!function_exists('is_privilege')){
        function is_privilege($menu_id, $functionId = null){
            if(session()->has('userlogin')){
                $auth = model('App\Models\Auth_model', false);
                $authenticData = $auth->is_user_privilege(session('privilege_id'), $menu_id, $functionId);
                if(!empty($authenticData)){
                    //print_r($data); exit;
                    return $menu_id;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }

    if(!function_exists('alertBS')){
        function alertBS($message, $type){
            return '<div class="alert alert-'.$type.' alert-dismissible">
                        <strong class="text-primary">'.$message.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }

    if(!function_exists('display_error')){
        function display_error($validation, $field){
            if($validation->hasError($field)){
                return $validation->getError($field);
            }else{
                return false;
            }
        }
    }

    if(!function_exists('get_error')){
        function get_error($validation, $field){
            if(isset($validation[$field])){
                return $validation[$field];
            }else{
                return false;
            }
        }
    }
?>