<?php
/*
 * Class for manage options on frontend
 * @author Thomas Elvin
 */

use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPHttp\Input,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPHttp\Router,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Validator,
    thom855j\PHPSecurity\Session,
    thom855j\PHPSecurity\Cookie,
    thom855j\PHPScrud\DB;

class OptionsController extends Controller
{

    public
            $data;

    /**
     * Construct this object by extending the base Controller class 
     */
    public
            function __construct()
    {
        parent::__construct();
        // get project url
        $this->data['project_url'] = Router::getProjectUrl();
        $this->data['current_url'] = Router::getUrl();
    }

    public
            function create($type)
    {
        if (Input::exists('post'))
        {
            var_dump($_POST);
            die;
            //Update post 
            $this->validateInput();

            // update
            DB::load()->insert('Posts', array(
                'Updated'    => time(),
                'City'       => Input::get('city'),
                'Country'    => Input::get('country'),
                'M2'         => Input::get('m2'),
                'Content'    => Input::get('content'),
                'Excerpt'    => Input::get('excerpt'),
                'Price'      => Input::get('price'),
                'Rooms'      => Input::get('rooms'),
                'Bath_rooms' => Input::get('bath_rooms'),
                'Type'       => Input::get('type'),
                'Status_ID'  => Input::get('status'),
                'Thumbnail'  => Input::get('thumbnail')
            ));

            $post_last_id = DB::load()->getLastInsertId();

            //update records 
            foreach ($_POST['upload'] as $upload_id)
            {
                DB::load()->insert('Meta_items', array(
                    'Meta_ID' => $post_last_id,
                    'Item_ID' => $upload_id,
                    'Type'    => 'uploads'
                ));
            }

            //Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            //Redirect::to(Input::get('current'));
        }
        $uploads = DB::load()->query('SELECT
        ID, Timestamp, Slug 
        FROM Uploads ORDER BY ID DESC ')->results();

        $upload_items = DB::load()->query('SELECT
        Item_ID FROM Meta_items WHERE Type = ? ORDER BY Item_ID DESC ', array('uploads'))->results();

        return (object) array(
                    'uploads'      => $uploads,
                    'current_url'  => $this->data['current_url'],
                    'upload_items' => $upload_items
        );
    }

    public
            function read($type, $start, $end, $max)
    {
        $options = DB::load()->query(
                        "SELECT 
        ID,Label, Name, Value FROM Options ORDER BY ID DESC", null, 'Options', array('start' => $start, 'end' => $end, 'max' => $max)
                )->results();

        return (object) array(
                    'data'  => $options,
                    'total' => DB::load()->_records
        );
    }

    public
            function update($type, $ID)
    {

        if (Input::exists('post') && $ID == Input::get('ID'))
        {
            //Update post 
            $this->validateInput();

            // update
            DB::load()->update('Options', 'ID', Input::get('ID'), array(
                'Value'    => Input::get('editor'),
            ));


            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to(Input::get('current_url'));
        }
        else
        {
            $options = DB::load()->query(
                            "SELECT 
        ID,Label, Name, Value FROM Options WHERE ID = ? ORDER BY ID DESC", array($ID)
                    )->results();

            return (object) array(
                        'options'        => $options

            );
        }
    }

    public
            function delete($type)
    {
        var_dump($this);
        die;
        PostMetaModel::load()->delete('Post_ID', Input::get('id'));
        UploadItemModel::load()->delete('Post_ID', Input::get('id'));
        PostModel::load($type)->delete('ID', Input::get('ID'));
        Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
        Redirect::to($this->project_url . "admin/read/post/$type/");
    }

    public
            function validateInput()
    {

        $v = Validator::load();
        $v->checkPost($_POST, array(
            'editor'    => array(
                'required'   => true,
                'min'        => 1
            )
        ));

        if (!$v->passed())
        {
//            Session::set($title, Input::get($title));
            foreach ($v->errors() as $error)
            {
                $_SESSION['ERRORS'][] = $error;
            }
            Redirect::to(Input::get('current_url'));
            exit();
        }
    }

}