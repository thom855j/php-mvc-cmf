<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;
?>
<h2 class="sub-header"><?php
    I18n::get('MESSAGES_SUB_HEADER', false);
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
            I18n::get('MESSAGES_CREATED'),
            I18n::get('MESSAGES_NAME'),
            I18n::get('MESSAGES_EMAIL'),
            I18n::get('MESSAGES_CONTENT'),
            I18n::get('MESSAGES_ACTIONS')
        ));

        foreach ($this->results->data as $view)
        {
            // Check dates 
            $created = "";

            if ($view->Created > 0)
            {
                $created = date($this->date_format, $view->Created);
            }

            $form = "<form action='" . $this->project_url . "admin/delete/messages/' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                    . "<input type='submit' value='" . I18n::get('POSTS_DELETE') . "' class='btn btn-danger'></form>";

            Table::data(array(
                "#" . $view->ID,
                $created,
                $view->Name,
                $view->Email,
                $view->Content,
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
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/messages/" . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}
