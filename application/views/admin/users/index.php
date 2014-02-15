<div class="col-xs-12 col-sm-9">

    <div class="table-responsive">
        
        <div class="page-title">
            Users
            <div class="pull-right"><a href="<?=base_url('admin/users/add_edit')?>" class="btn btn-default btn-xs">Add</a></div>
        </div>
    
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Zip</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?=$user->id?></td>
                    <td><?=$user->email?></td>
                    <td><?=e($user->first_name)?> <?=e($user->last_name)?></td>
                    <td><?=$user->country?></td>
                    <td><?=$user->city?></td>
                    <td><?=$user->address?></td>
                    <td><?=$user->telephone?></td>
                    <td><?=$user->zip?></td>
                    <td><?=$user->create_date?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?=base_url('admin/users/add_edit/'.$user->id)?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a></li>
                                <li><a href="<?=base_url('admin/users/delete/'.$user->id)?>" onclick="javascript:if(!confirm('Are you sure?')){return false}"><span class="glyphicon glyphicon-remove"></span> Delete</a></li>
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