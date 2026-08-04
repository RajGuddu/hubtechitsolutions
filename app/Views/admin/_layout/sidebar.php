    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <?php 
        $request = \Config\Services::request();
        $uri = $request->getUri();
        $segment1 = $uri->getSegment(1);
        $segment2 = $uri->getSegment(2);
        if($segment1 == 'authentication-failed'){
          helper('custom');
        }
      ?>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('admin'); ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <?php if(is_privilege([12,13,14,17,18,20])){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if(in_array($segment2, ['course_category', 'courses','instructor','batches','admission_list','certificate_list'])){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#course" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Academic Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="course">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(12)){ ?>
                <li class="nav-item <?=($segment2=='course_category')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/course_category')?>">Course Category</a></li>
                <?php } ?>
                <?php if(is_privilege(14)){ ?>
                <li class="nav-item <?=($segment2=='instructor')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/instructor')?>">Instructor</a></li>
                <?php } ?>
                <?php if(is_privilege(13)){ ?>
                <li class="nav-item <?=($segment2=='courses')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/courses')?>">Courses  </a></li>
                <?php } ?>
                <?php if(is_privilege(18)){ ?>
                <li class="nav-item <?=($segment2=='batches')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/batches')?>">Batch</a></li>
                <?php } ?>
                <?php if(is_privilege(17)){ ?>
                <li class="nav-item <?=($segment2=='admission_list')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/admissions')?>">Admissions</a></li>
                <?php } ?>
                <?php if(is_privilege(20)){ ?>
                <li class="nav-item <?=($segment2=='certificate_list')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/certificate_list')?>">Certificate List</a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <?php } ?>
         
          <?php if(is_privilege(19)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if($segment2 == 'centers' || $segment2 == 'center_cu'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#franchise" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Franchise Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="franchise">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(19)){ ?>
                <li class="nav-item <?=($segment2=='centers')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/centers')?>">Centers</a></li>
                <?php } ?>
                <?php /* 
                <?php if(is_privilege(17)){ ?>
                <li class="nav-item <?=($segment2=='admission_list')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/admissions')?>">Admissions</a></li>
                <?php } ?>
                
                <?php if(is_privilege(13)){ ?>
                <li class="nav-item <?=($segment2=='courses')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/courses')?>">Courses  </a></li>
                <?php }*/ ?>
              </ul>
            </div>
          </li>
          <?php } ?>

          <?php if(is_privilege([21,22,23])){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if(in_array($segment2, ['intern-students','intern_course','question_bank'])){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#internship" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Internship Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="internship">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(21)){ ?>
                <li class="nav-item <?=($segment2=='intern-students')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/intern-students')?>">Student List</a></li>
                <?php } ?>
                <?php if(is_privilege(22)){ ?>
                <li class="nav-item <?=($segment2=='intern_course')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/intern_course')?>">Intern Course</a></li>
                <?php } ?>
                <?php if(is_privilege(23)){ ?>
                <li class="nav-item <?=($segment2=='question_bank')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/question_bank')?>">Question Bank</a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <?php } ?>
          
          <?php if(is_privilege(15) || is_privilege(16)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if($segment2 == 'contact_us_listing' || $segment2 == 'enrolled_listing'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#enquiry" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Enquiry</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="enquiry">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(15)){ ?>
                <li class="nav-item <?=($segment2=='contact_us_listing')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/contact_us_listing')?>">Contact Us List</a></li>
                <?php } ?>
                <?php if(is_privilege(16)){ ?>
                <li class="nav-item <?=($segment2=='enrolled_listing')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/enrolled_listing')?>">Course Enrollment List</a></li>
                <?php } ?>
                
              </ul>
            </div>
          </li>
          <?php } ?>

          <?php if(is_privilege(7) || is_privilege(8) || is_privilege(9) || is_privilege(10) || is_privilege(11)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if(in_array($segment2, ['cms','blogs','faq','testimonial','banner'])){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#manageWebsite" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Website Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="manageWebsite">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(7)){ ?>
                <li class="nav-item <?=($segment2=='cms')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/cms')?>">CMS</a></li>
                <?php } ?>
                <?php if(is_privilege(8)){ ?>
                <li class="nav-item <?=($segment2=='blogs')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/blogs')?>">Blogs</a></li>
                <?php } ?>
                <?php if(is_privilege(9)){ ?>
                <li class="nav-item <?=($segment2=='faq')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/faq')?>">Faq</a></li>
                <?php } ?>
                <?php if(is_privilege(10)){ ?>
                <li class="nav-item <?=($segment2=='testimonial')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/testimonial')?>">Testimonial</a></li>
                <?php } ?>
                <?php if(is_privilege(11)){ ?>
                <li class="nav-item <?=($segment2=='banner')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/banner')?>">Banner</a></li>
                <?php } ?>
                
              </ul>
            </div>
          </li>
          <?php } ?>

          <?php if(is_privilege(1) || is_privilege(2)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';
            if($segment2 == 'users' || $segment2 == 'user_groups' || $segment2 == 'edit_user' || $segment2 == 'user_profile' || $segment2 == 'editgroup' || $segment2 == 'addgroup' || $segment2 == 'add_user'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#auth" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="auth">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(1)){ ?>
                <li class="nav-item <?=($segment2=='users')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/users')?>"> Users </a></li>
                <?php } ?>
                <?php if(is_privilege(2)){ ?>
                <li class="nav-item <?=($segment2=='user_groups')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/user_groups')?>"> User Group </a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <?php } ?>

          <?php if(is_privilege(6)){
            $active = ''; 
            if($segment2 == 'setting'){
             $active = 'active'; 
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link" href="<?=base_url('admin/setting')?>">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>
          <?php } ?>
          
          <!-- <li class="nav-item nav-category">help</li>
          <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul>
    </nav>