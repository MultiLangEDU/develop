<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <div class="list-group">
        <a href="<?=base_url('admin/courses')?>" class="list-group-item <?=($section == 'courses') ? 'active' : '' ;?>">Course manager <span class="badge"><?=$all_courses_count?></span></a>
        <a href="#" class="list-group-item">All Course Statistics</a>
        <a href="<?=base_url('admin/users/index/students')?>" class="list-group-item <?=($section == 'users' && $subsection2 == 'students') ? 'active' : '' ;?>">Student Manager <span class="badge"><?=$all_students_count?></span></a>
        <a href="#" class="list-group-item">All Student Statistics</a>
        <a href="#" class="list-group-item">All Finance View</a>
        <a href="#" class="list-group-item">Product Manager</a>
    </div>
</div><!--/span-->