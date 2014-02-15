<div class="col-xs-12 col-sm-9">

    <div class="table-responsive">
        
        <div class="page-title">
            Courses
            <div class="pull-right"><a href="<?=base_url('admin/courses/add_edit')?>" class="btn btn-default btn-xs">Add</a></div>
        </div>
    
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($courses as $course): ?>
                <tr>
                    <td><?=$course->id?></td>
                    <td><?=e($course->name)?></td>
                    <td><?=$course->create_date?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?=base_url('admin/courses/add_edit/'.$course->id)?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a></li>
                                <li><a href="<?=base_url('admin/courses/delete/'.$course->id)?>" onclick="javascript:if(!confirm('Are you sure?')){return false}"><span class="glyphicon glyphicon-remove"></span> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="widget-foot">
            <?=$pagination?>
            <div class="clearfix"></div> 
        </div>

    </div>

</div>