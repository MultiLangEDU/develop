<div class="col-xs-12 col-sm-9">

    <div class="page-title mrgbot">
        <?=($row->id) ? 'Edit User' : 'Add User' ;?>
        <span class="pull-right"><a href="<?=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('admin/users') ;?>"  class="btn btn-default btn-xs">back</a></span>
    </div>

    <form class="form-horizontal col-xs-12 col-sm-10" role="form" method="POST">
        
        <!--First Name-->
    
        <div class="form-group">
            <label for="first_name" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?=(set_value('first_name')) ? set_value('first_name') : e($row->first_name) ; ?>">
                <span class="help-block red"><?=form_error('first_name')?></span>
            </div>
        </div>
        
        <!--Last Name-->
    
        <div class="form-group">
            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?=(set_value('last_name')) ? set_value('last_name') : e($row->last_name) ; ?>">
                <span class="help-block red"><?=form_error('last_name')?></span>
            </div>
        </div>
        
        <!--Email-->
    
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?=(set_value('email')) ? set_value('email') : e($row->email) ; ?>">
                <span class="help-block red"><?=form_error('email')?></span>
            </div>
        </div>

        <!--Password-->
        
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                <span class="help-block red"><?=form_error('password')?></span>
            </div>
        </div>
        
        <!--User Type-->
        
        <div class="form-group">
            <label for="type" class="col-sm-2 control-label">User Type</label>
            <div class="col-sm-10">
                <select class="form-control" id="type" name="type">
                    <?php foreach($users_types as $type): ?>
                        <option value="<?=$type->id?>" <?=(set_value('type') && set_value('type') == $type->id) ? 'selected="selected"' : (($row->user_type == $type->id) ? 'selected="selected"' : '' ) ;?>><?=$type->type_name?></option>
                    <?php endforeach; ?>
                </select>
                <span class="help-block red"><?=form_error('type')?></span>
            </div>
        </div>
        
        <!--Country-->
        
        <div class="form-group">
            <label for="country" class="col-sm-2 control-label">Country</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?=(set_value('country')) ? set_value('country') : e($row->country) ; ?>">
                <span class="help-block red"><?=form_error('country')?></span>
            </div>
        </div>
        
        <!--City-->
        
        <div class="form-group">
            <label for="city" class="col-sm-2 control-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?=(set_value('city')) ? set_value('city') : e($row->city) ; ?>">
                <span class="help-block red"><?=form_error('city')?></span>
            </div>
        </div>
        
        <!--Address-->
        
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=(set_value('address')) ? set_value('address') : e($row->address) ; ?>">
                <span class="help-block red"><?=form_error('address')?></span>
            </div>
        </div>
        
        <!--Zip-->
        
        <div class="form-group">
            <label for="zip" class="col-sm-2 control-label">Zip</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="<?=(set_value('zip')) ? set_value('zip') : e($row->zip) ; ?>">
                <span class="help-block red"><?=form_error('zip')?></span>
            </div>
        </div>
        
        <!--Telephone-->
        
        <div class="form-group">
            <label for="telephone" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" value="<?=(set_value('telephone')) ? set_value('telephone') : e($row->telephone) ; ?>">
                <span class="help-block red"><?=form_error('telephone')?></span>
            </div>
        </div>

        <!--Submit-->
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

    </form>

</div>