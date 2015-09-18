<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;
?>
<h2 class="sub-header"><?php
    I18n::get('UPLOADS_SUB_HEADER', false);
    ?></h2> 
<div class="table-responsive"> 
    <?php
    if (!empty($this->results->data))
    {
        Table::start("class='table table-striped'");
        Table::head(array(
            'ID',
            I18n::get('POSTS_CREATED'),
            I18n::get('POSTS_CREATED'),
            I18n::get('POSTS_ACTIONS')
        ));
        $thumbs = $this->project_url . 'public/uploads/thumbs/';
        $source = $this->project_url . 'public/uploads/source/';
        $form   = '';


        foreach ($this->results->data as $view)
        {
            foreach ($this->results->data as $upload)
            {

                $form = "<form action='" . $this->project_url . "admin/delete/uploads/' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                        . "<input type='submit' value='" . I18n::get('POSTS_DELETE') . "' class='btn btn-danger'></form>";
            }
            Table::data(array(
                "#" . $view->ID,
                "<a  href='" . $source . $view->Slug . "'><img  src='" . $thumbs . $view->Slug . "' ></a>",
                date($this->date_format, $view->Timestamp),
                $form
            ));
        }
        Table::end();
        ?> 
    </div> 
    <p><?php I18n::get('POSTS_PAGES', false); ?>:</p> 
    <?php
    for ($x = 1; $x <= $this->results->total; $x++)
    {
        ?> 
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/uploads/all/" . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}
