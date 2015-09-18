<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;

?>
<h2 class="sub-header">Menuer</h2> 
<?php
if (!empty($this->results))
{
    ?> 
    <div class="table-responsive"> 
        <?php
        Table::start("class='table table-striped'");
        Table::head(array(
            'ID',
            'Menu',
            'URL',
            I18n::get('POSTS_ACTIONS')
        ));

        foreach ($this->results->data as $view)
        {
            // Check dates 

   $form = "<form action='" . $this->project_url . "admin/delete/menus/' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                    . "<input type='hidden' name='current' value='" . $this->current_url . "'><input type='submit' value='" . I18n::get('POSTS_DELETE') . "' class='btn btn-danger'></form>";
            Table::data(array(
                "#" . $view->ID,
                $view->Label,
                $view->Name,
                "<a class='btn btn-success' href='" . $this->project_url . 'admin/update/menus/' . $this->type . "/" . $view->ID . "'>" . I18n::get('POSTS_UPDATE') . "</a>",
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
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/menus/" . $this->type . '/' . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}