<!-- Form area -->
<div class="admin-form">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <!-- Widget starts -->
                <div class="widget worange">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <i class="icon-lock"></i> Login 
                    </div>

                    <div class="widget-content">
                        <div class="padd">
                            <!-- Login form -->
                            <form class="form-horizontal" method="POST" action="<?=base_url('admin/login/doLogin')?>">
                                <!-- Email -->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="email">Email</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="password">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <!-- Remember me checkbox and sign in button -->
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <button type="submit" class="btn btn-danger">Sign in</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                                <br />
                            </form>

                        </div>
                    </div>

                    <div class="widget-foot">
                        Not Registred? <a href="#">Register here</a>
                    </div>
                </div>  
            </div>
        </div>
    </div> 
</div>