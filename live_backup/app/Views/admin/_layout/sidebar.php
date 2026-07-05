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
          
          <li class="nav-item nav-category">Course Management</li>
          <?php if(is_privilege(12) || is_privilege(13) || is_privilege(14)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if($segment2 == 'course_category' || $segment2 == 'courses' || $segment2 == 'instructor'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#course" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Courses</span>
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
          <li class="nav-item nav-category">Enquiry & Enrollment</li>
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

          
          <?php if(is_privilege(7)){
            $active = ''; 
            if($segment2 == 'cms'){
             $active = 'active'; 
            }
          ?>
          <li class="nav-item nav-category">Home Page Element</li>
          <li class="nav-item <?=$active?>">
            <a class="nav-link" href="<?=base_url('admin/cms')?>">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">CMS</span>
            </a>
          </li>
          <?php } ?>

          <?php if(is_privilege(8)){
            $active = ''; 
            if($segment2 == 'blogs'){
             $active = 'active'; 
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link" href="<?=base_url('admin/blogs')?>">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Blogs</span>
            </a>
          </li>
          <?php } ?>

          <?php if(is_privilege(9)){
            $active = ''; 
            if($segment2 == 'faq'){
             $active = 'active'; 
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link" href="<?=base_url('admin/faq')?>">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Faq</span>
            </a>
          </li>
          <?php } ?>

          <?php if(is_privilege(10)){
            $active = ''; 
            if($segment2 == 'testimonial'){
             $active = 'active'; 
            }
          ?>
          <li class="nav-item <?=$active?>">
            <a class="nav-link" href="<?=base_url('admin/testimonial')?>">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Testimonial</span>
            </a>
          </li>
          <?php } ?>

          <?php if(is_privilege(11)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';

            if($segment2 == 'banner'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item nav-category">Banner</li>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#banner" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Manage Banner</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?=$show?>" id="banner">
              <ul class="nav flex-column sub-menu">
                <?php if(is_privilege(11)){ ?>
                <li class="nav-item <?=($segment2=='banner')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/banner')?>">Banner</a></li>
                <?php } ?>
                <?php /*if(is_privilege(2)){ ?>
                <li class="nav-item <?=($segment2=='user_groups')?'active':''?>"> <a class="nav-link" href="<?=base_url('admin/user_groups')?>">  </a></li>
                <?php } */?>
              </ul>
            </div>
          </li>
          <?php } ?>
          <!-- <li class="nav-item nav-category">UI Elementss</li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item nav-category">Forms and Datas</li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li> -->
          <?php if(is_privilege(1) || is_privilege(2)){
            $collapsed = 'collapsed'; $show = ''; $active = ''; $areaexpanded = 'false';
            if($segment2 == 'users' || $segment2 == 'user_groups' || $segment2 == 'edit_user' || $segment2 == 'user_profile' || $segment2 == 'editgroup' || $segment2 == 'addgroup' || $segment2 == 'add_user'){
              $collapsed = ''; $show = 'show'; $active = 'active'; $areaexpanded = 'true';
            }
          ?>
          <li class="nav-item nav-category">Authentication</li>
          <li class="nav-item <?=$active?>">
            <a class="nav-link <?=$collapsed?>" data-bs-toggle="collapse" href="#auth" aria-expanded="<?=$areaexpanded?>" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User</span>
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