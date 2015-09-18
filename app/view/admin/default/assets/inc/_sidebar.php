<!-- Sidebar --> 
<div id="sidebar-wrapper"> 
    <ul class="sidebar-nav"> 
        <li class="sidebar-brand"> 
            <a href="<?php echo $this->project_url; ?>"> 
            <?php echo App; ?> 
            </a> 
        </li> 
        <?php App::load()->get('nav'); ?> 
    </ul> 
</div> 
<!-- /#sidebar-wrapper --> 
<!-- Page Content --> 
<div id="page-content-wrapper"> 
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12"> 
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"> 
                    Menu 
                </a> 
                <?php  $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php') ; ?>