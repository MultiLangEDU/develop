<div class="col-xs-12 col-sm-9">

    <div class="page-title mrgbot">
        <?=($row->id) ? 'Edit Course' : 'Add Course' ;?>
        <span class="pull-right"><a href="<?=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('admin/courses') ;?>"  class="btn btn-default btn-xs">back</a></span>
    </div>

    <form class="form-horizontal col-xs-12 col-sm-10" role="form" method="POST">
        
        <!--Name-->
    
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?=(set_value('name')) ? set_value('name') : e($row->name) ; ?>">
                <span class="help-block red"><?=form_error('name')?></span>
            </div>
        </div>
        
        <!--Description-->
    
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" placeholder="Description"><?=(set_value('description')) ? set_value('description') : $row->description ; ?></textarea>
                <span class="help-block red"><?=form_error('description')?></span>
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