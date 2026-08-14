<?php

    use App\Models\Auth_model;

    if(!function_exists('is_privilege')){
        /*function is_privilege($menu_id, $functionId = null){
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
        }*/
        function is_privilege($menu_id, $functionId = null){
            if (!session()->has('userlogin')) {
                return 0;
            }

            $auth = model('App\Models\Auth_model', false);

            // Agar array mila hai
            if (is_array($menu_id)) {
                foreach ($menu_id as $id) {
                    $authenticData = $auth->is_user_privilege(
                        session('privilege_id'),
                        $id,
                        $functionId
                    );

                    if (!empty($authenticData)) {
                        return $id; 
                    }
                }

                return 0;
            }

            // Single menu id
            $authenticData = $auth->is_user_privilege(
                session('privilege_id'),
                $menu_id,
                $functionId
            );

            return !empty($authenticData) ? $menu_id : 0;
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
    if(!function_exists('custom_pagination')){
        function custom_pagination($page_config){
            $tot_record = $page_config['tot_record'];
            $rec_limit = $page_config['rec_limit'];
            $btn_limit = $page_config['btn_limit'];
            $page = $page_config['current_page'];
            $url = $page_config['url'];
            $url_param = $page_config['url_param'];
            $colspan = $page_config['colspan'];

            if($tot_record <= $rec_limit){
                $out['limit'] = $rec_limit;
                $out['offset'] = 0;
                $out['pagination_html'] = '';
                $out['caption'] = ($tot_record<1)?'0':'1'.' to '.$tot_record.' of '.$tot_record;
                
            }else{
                $total_page = ceil($tot_record / $rec_limit);
                $offset = 0;
                $fromRecord = 1;
                if($page){
                    $offset = ($page * $rec_limit) - $rec_limit;
                    $fromRecord = $offset+1;
                }
                if(floor($page/$btn_limit) < 1){
                    $i_ = 1;
                }else{
                    $i_ = floor($page/$btn_limit)*$btn_limit;
                }
                $toRecord = $fromRecord + $rec_limit -1;
                if($toRecord > $tot_record) $toRecord = $tot_record;
                $pagination_html = 
                        '<div class="d-flex justify-content-center gap-1 mt-3">';
                if($i_ > 1){
                    $f_URL = $url.'?'.$url_param.'=1';
                    $pre_URL = $url.'?'.$url_param.'='.$i_-1;
                    
                    
                    $pagination_html .= '<a href="'.$f_URL.'" class="btn btn-outline-secondary btn-sm"><strong><<</strong></a>';
                    $pagination_html .= '<a href="'.$pre_URL.'" class="btn btn-outline-secondary btn-sm"><strong><</strong></a>';
                }
                for($i=$i_; $i<($i_+$btn_limit) && $i<=$total_page; $i++){ 
                    $cur_URL = $url.'?'.$url_param.'='.$i;
                    $actv = ($page == $i)?'active':'';
                    $pagination_html .= '<a href="'.$cur_URL.'" class="btn btn-outline-primary '.$actv.' btn-sm">'.$i.'</a>';
                }
                if($page != $total_page && $i <= $total_page){
                    $next_URL = $url.'?'.$url_param.'='.$i;
                    $l_URL = $url.'?'.$url_param.'='.$total_page;
                    $pagination_html .= '<a href="'.$next_URL.'" class="btn btn-outline-secondary btn-sm"><strong>></strong></a>';
                    $pagination_html .= '<a href="'.$l_URL.'" class="btn btn-outline-secondary btn-sm"><strong>>></strong></a>';
                }
                $pagination_html .= '</div>';
                $out['limit'] = $rec_limit;
                $out['offset'] = $offset;
                $out['pagination_html'] = $pagination_html;
                $out['caption'] = $fromRecord.' to '.$toRecord.' of '.$tot_record;
            }
            return $out;
        }
    }
    if(!function_exists('get_intern_stu_status')){
        function get_intern_stu_status($status){
            $statusTxt = '<span class="badge bg-warning">Pending</span>';
            if($status == 1){
                $statusTxt = '<span class="badge bg-success">Approved</span>';
            }
            return $statusTxt;
        }
    }
    if(!function_exists('get_intern_program_status')){
        function get_intern_program_status($status){
            switch ($status){
                case 1:
                    return '<span class="badge bg-success text-light mb-1 d-inline-block">Payment Completed</span>';
                    break;
                case 2:
                    return '<span class="badge bg-primary text-light mb-1 d-inline-block">Exam In Progress</span>';
                    break;
                case 3:
                    return '<span class="badge bg-success text-light mb-1 d-inline-block">Exam Completed (Passed)</span>';
                    break;
                case 4:
                    return '<span class="badge bg-warning text-dark mb-1 d-inline-block">Exam Completed (Failed)</span>';
                    break;
                case 5:
                    return '<span class="badge bg-danger text-light mb-1 d-inline-block">Payment Refund</span>';
                    break;
                default:
                    return '<span class="badge bg-warning text-light mb-1 d-inline-block">Application Incomplete</span>';
                    break;
            }
        }
    }
?>