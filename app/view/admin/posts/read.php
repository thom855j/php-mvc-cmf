<?php
use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_SUB_HEADER',false);
    ?></h2> 
<?php

if (!empty($this->results->data))
{
    ?> 
    <div class="table-responsive"> 
        <?php
        Table::start("class='table table-striped'");
        Table::head(array(
            'ID',
            I18n::get('POSTS_CREATED'),
            I18n::get('POSTS_UPDATED'),
            'Type',
            I18n::get('POSTS_AUTHOR'),
            I18n::get('POSTS_ACTIONS')
        ));

        foreach ($this->results->data as $view)
        {
            // Check dates 
            $updated = "";
            $created = "";

            if ($view->Updated < 0)
            {
                $updated = date($this->date_format, $view->Updated);
            }

            if ($view->Created > 0)
            {
                $created = date($this->date_format, $view->Created);
            }

            $form = "<form action='" . $this->project_url . "admin/delete/posts/" . $this->type . "' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                    . "<input type='submit' value='" . I18n::get('POSTS_DELETE') . "' class='btn btn-danger'></form>";

            Table::data(array(
                "<a href='" .$this->project_url . "ejendom/" . $view->ID."'>#" .  $view->ID. "</a>",
                $created,
                $updated,
                $view->Type,
                $view->Name ." <small>(" . $view->Username . ")</small>",
                "<a class='btn btn-success' href='" . $this->project_url . 'admin/update/posts/' . $this->type . '/' . $view->ID . "'>" . I18n::get('POSTS_UPDATE') . "</a>",
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
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/posts/house/" . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}
