<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Table;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_SUB_HEADER', false);
    ?></h2> 
<?php
if (!empty($this->results))
{
    ?> 
    <div class="table-responsive"> 
        <?php
        Table::start("class='table table-striped'");
        Table::head(array(
            'ID',
            I18n::get('USERS_CREATED'),
            I18n::get('USERS_UPDATED'),
            'Sidste login',
            'Status',
            I18n::get('USERS_USERNAME'),
            I18n::get('USERS_ACTIONS')
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

            $form_delete = "<form action='" . $this->project_url . "admin/delete/users/null' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                    . "<input type='hidden' name='current' value='" . $this->current_url . "'><input type='submit' value='" . I18n::get('POSTS_DELETE') . "' class='btn btn-danger'></form>";
            if ($view->Status == 2)
            {
                $form_status = "<form action='" . $this->project_url . "admin/update/users/block/null' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                        . "<input type='hidden' name='current' value='" . $this->current_url . "'><input type='submit' value='Deaktivér' class='btn btn-warning'></form>";
            }
            else
            {
                $form_status = "<form action='" . $this->project_url . "admin/update/users/unblock/null' method='post' onsubmit=\"return confirm('Er du sikker?')\"><input type='hidden' name='ID' value='" . $view->ID . "'>"
                        . "<input type='hidden' name='current' value='" . $this->current_url . "'><input type='submit' value='Genaktivér' class='btn btn-success'></form>";
            }

            Table::data(array(
                "#" . $view->ID,
                $created,
                $updated,
                date($this->date_format, $view->Last_login),
                $view->Label,
                $view->Name . " <small>(" . $view->Username . ")</small>",
                "<a class='btn btn-info' href='" . $this->project_url . 'admin/update/users/' . $this->type . '/' . $view->ID . "'>Info</a>",
                $form_status,
                $form_delete
            ));
        }
        Table::end();
        ?> 
    </div> 
    <p>Sider:</p> 
    <?php
    for ($x = 1; $x <= $this->results->total; $x++)
    {
        ?> 
        <a class="btn btn-default" href="<?php echo $this->project_url . "admin/read/users/all/" . $x; ?>"><?php echo $x; ?></a> 
        <?php
    }
}
else
{
    ?> 
    <p><?php I18n::get('POSTS_EMPTY', false) ?></p> 
    <?php
}
