<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $c_base_url;?>">
                LSG Survey App - (Alpha 1.0)
            </a>
        </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav pull-right">
		          <?php if( $this->authentication->is_user_logged_in() ):?>
                <li class="<?php echo (isset($menu_active) && 'survey_new' == $menu_active) ? 'active': '';?>"><a href="<?php echo $c_base_url;?>survey">New Survey</a></li>
                <li class="<?php echo (isset($menu_active) && 'survey_search' == $menu_active) ? 'active': '';?>"><a href="<?php echo $c_base_url;?>search">Search</a></li>
                <li><a href="<?php echo $c_base_url;?>logout">Log out</a></li>
              <?php else:?>
                <li><a href="<?php echo $c_base_url;?>user/login">Login</a></li>
              <?php endif?>
            </ul>
        </div>
    </div>
</div>
