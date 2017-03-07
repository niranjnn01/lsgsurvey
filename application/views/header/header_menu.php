<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $c_base_url;?>">
              <img src="<?php echo $c_static_image_url, c('logo_image_name');?>" alt="<?php echo $c_website_title;?>" width="199" height="52" />
            </a>
        </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav">

                <li><a href="<?php echo $c_base_url;?>">home</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Services <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu">

                        <li><a href="<?php echo $c_base_url;?>services/v/chauffer">Chauffer</a></li>
                        <li><a href="<?php echo $c_base_url;?>services/v/house-maid">House Maid</a></li>
                        <li><a href="<?php echo $c_base_url;?>services/v/companion">Companion</a></li>
                        <li><a href="<?php echo $c_base_url;?>services/v/special-events">Special events</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $c_base_url;?>event">Events</a></li>
                <li><a href="<?php echo $c_base_url;?>pricing">Pricing</a></li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                    About <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo $c_base_url;?>about_us" class="">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo $c_base_url;?>objectives" class="">Objectives</a>
                    </li>
										<li>
                        <a href="<?php echo $c_base_url;?>organizational-structure" class="">Organizational structure</a>
                    </li>
										<li>
                        <a href="<?php echo $c_base_url;?>procedure" class="">Procedure</a>
                    </li>
										<li>
                        <a href="<?php echo $c_base_url;?>ethics-committee" class="">Ethics committee</a>
                    </li>
                  </ul>
                </li>

                <li><a href="<?php echo $c_base_url;?>contact_us">Contact</a></li>
            </ul>
        </div>
    </div>
</div>
