<?php

/*
 * controller for manageing menus
 * @author Thomas Elvin
 */

use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPHttp\Input,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPHttp\Router,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Validator,
    thom855j\PHPSecurity\Session,
    thom855j\PHPScrud\DB;

class MenusController extends Controller
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

            //Update post 
            //$this->validateInput();
            // update
            DB::load()->insert('Menus', array(
                'Label' => Input::get('label'),
                'Name'  => Input::toSlug(Input::get('name')),
                'Sort'  => Input::get('sort'),
                'Type'  => Input::get('type')
            ));

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to($this->data['project_url'] . 'admin/read/menus/' . Input::get('type'));
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
        $menus = DB::load()->query(
                        "SELECT Menus.ID, Menus.Label, Menus.Name, Menus.Sort, Menus.Parent_ID, 
Menus.Type FROM Menus WHERE Menus.Type = ? ORDER BY Menus.Sort", array($type), 'Menus', array('start' => $start, 'end' => $end, 'max' => $max), array(array('Type', '=', $type))
                )->results();

        return (object) array(
                    'data'  => $menus,
                    'type'  => $type,
                    'total' => DB::load()->_records
        );
    }

    public
            function update($type, $ID)
    {

        if (Input::exists('post') && $ID == Input::get('ID'))
        {

            //validate input
            $this->validateInput();
            //update
            DB::load()->update('Menus', 'ID', Input::get('ID'), array(
                'Label' => Input::get('label'),
                'Name'  =>Input::toSlug(Input::get('name')),
                'Sort'  => Input::get('sort')
            ));

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to(Input::get('current_url'));
        }
        else
        {
            $menus = DB::load()->query(
                 "SELECT Menus.ID, Menus.Label, Menus.Name, Menus.Sort, Menus.Parent_ID, 
                    Menus.Type FROM 
                    Menus 
                    WHERE Menus.Type = ? 
                    AND Menus.ID = ? ORDER BY Menus.Sort", array($type, $ID)
                    )->results();

            return (object) array(
                        'menu' => $menus
            );
        }
    }

    public
            function delete($type)
    {
        if (Input::exists())
        {
            DB::load()->delete('Menus', array(
                array('ID', '=', Input::get('ID'))
            ));

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to(Input::get('current_url'));
        }
        Redirect::back();
    }

    public
            function validateInput()
    {

        $v = Validator::load();
        $v->checkPost($_POST, array(
            'label' => array(
                'required'   => true,
                'min'        => 1,
                'max'        => 254
            ),
            'name'  => array(
                'required'   => true,
                'min'        => 1,
                'max'        => 254
            ),
        ));

        if (!$v->passed())
        {

            foreach ($v->errors() as $error)
            {
                $_SESSION['ERRORS'][] = $error;
            }
            Redirect::to(Input::get('current_url'));
            exit();
        }
    }

    public
            function favorite()
    {
        if (Input::exists())
        {

            $check = DB::load()->query(
                    'SELECT Meta_ID, Item_ID
                    FROM Meta_items 
                    WHERE Meta_ID = ?
                    AND Item_ID = ?
                    AND Type = ?', array(Input::get('post_id'), Input::get('user_id'), 'favorite'));

            if ($check->results() && $check->_error == false)
            {
                Session::set('INFO', 'Favorit eksitere allerede.');
                Redirect::to(Input::get('current_url'));
            }

            DB::load()->insert('Meta_items', array(
                'Meta_ID' => Input::get('post_id'),
                'Item_ID' => Input::get('user_id'),
                'Type'    => 'favorite'
            ));
            Session::set('SUCCESS', 'Favorit gemt!');
            Redirect::to(Input::get('current_url'));
        }
    }

}
