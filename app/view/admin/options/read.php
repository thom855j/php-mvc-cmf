<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;
?>
<h2 class="sub-header">Alle Indstillinger</h2> 
<?php

if (!empty($this->results))
{
    ?> 
    <div class="table-responsive"> 
        <?php
        Table::start("class='table table-striped'");
        Table::head(array(
            'ID',
            'Indstilling',
            I18n::get('POSTS_ACTIONS')
        ));

        foreach ($this->results->data as $view)
        {
            // Check dates 
        

            Table::data(array(
                "#" . $view->ID,
                $view->Label,
                "<a class='btn btn-success' href='" . $this->project_url . 'admin/update/options/all/' . $view->ID . "'>" . I18n::get('POSTS_UPDATE') . "</a>"
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
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/options/all/" . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}