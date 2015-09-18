<?php

/*
 * Class for manage different post to use on frontend
 * @author Thomas Elvin
 */

use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPAuthFramework\Auth,
    thom855j\PHPHttp\Input,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPHttp\Router,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Validator,
    thom855j\PHPSecurity\Session,
    thom855j\PHPScrud\DB;

class PostsController extends Controller
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
            $this->validateInput();

            // update
            DB::load()->insert('Posts', array(
                'Created'    => time(),
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
                'User_ID'    => Session::getKey('User', 'ID'),
                'Thumbnail'  => Input::get('thumbnail'),
                'Post_type'  => 'house'
            ));

            $post_last_id = DB::load()->lastInsertId();

            //update records 
            if (isset($_POST['uploads']))
            {
                foreach ($_POST['uploads'] as $upload_id)
                {
                    DB::load()->insert('Meta_items', array(
                        'Meta_ID' => $post_last_id,
                        'Item_ID' => $upload_id,
                        'User_ID' => Session::getKey('User', 'ID'),
                        'Type'    => 'uploads'
                    ));
                }
            }

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to($this->data['project_url'] . 'admin/read/posts/house');
        }
        $uploads = DB::load()->query('SELECT
        ID, Timestamp, Slug 
        FROM Uploads WHERE User_ID = ? ORDER BY ID DESC ', array(Session::getKey('User', 'ID')))->results();

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
        If (!Auth::load()->role('admin'))
        {
            $post = DB::load()->query(
                            "SELECT 
        Posts.ID, Posts.Created, Posts.Updated, Posts.Type,
        Users.Username, Users.Name,
        Status.Label 
        FROM Posts
        LEFT JOIN Users ON Posts.User_ID = Users.ID
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
        AND User_ID = ?
         ORDER BY Posts.ID DESC", array($type, Session::getKey('User', 'ID')), 'Posts', array('start' => $start, 'end' => $end, 'max' => $max)
                    )->results();
        }
        else
        {
            $post = DB::load()->query(
                            "SELECT 
        Posts.ID, Posts.Created, Posts.Updated, Posts.Type,
        Users.Username, Users.Name,
        Status.Label 
        FROM Posts
        LEFT JOIN Users ON Posts.User_ID = Users.ID
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
         ORDER BY Posts.ID DESC", array($type), 'Posts', array('start' => $start, 'end' => $end, 'max' => $max)
                    )->results();
        }

        return (object) array(
                    'data'  => $post,
                    'total' => DB::load()->_records
        );
    }

    public
            function update($type, $ID)
    {

        if (Input::exists('post'))
        {
            //Update post 
            $this->validateInput();
            // update
            DB::load()->update('Posts', 'ID', Input::get('ID'), array(
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
                'User_ID'    => Session::getKey('User', 'ID'),
                'Thumbnail'  => Input::get('thumbnail'),
                'Post_type'  => 'house'
            ));

            //clean up 
            DB::load()->delete('Meta_items', array(
                array('Meta_ID', '=', Input::get('ID')),
                array('Type', '=', 'uploads')
            ));

            if (isset($_POST['uploads']))
            {
                //update records 
                foreach ($_POST['uploads'] as $upload_id)
                {
                    DB::load()->insert('Meta_items', array(
                        'Meta_ID' => Input::get('ID'),
                        'Item_ID' => $upload_id,
                        'User_ID' => Session::getKey('User', 'ID'),
                        'Type'    => 'uploads'
                    ));
                }
            }

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to($this->data['project_url'] . "admin/read/posts/house");
        }
        else
        {
            $post = DB::load()->query(
                            "SELECT 
        Posts.ID, Posts.Created, Posts.Updated, Posts.Slug, Posts.Country, Posts.City,
        Posts.Type, Posts.M2, Posts.Rooms, Posts.Bath_rooms, Posts.Price, Posts.Thumbnail,
        Posts.Content, Posts.Excerpt,
        Status.Label 
        FROM Posts
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
        AND Posts.ID = ?
        ORDER BY Posts.ID DESC", array('house', $ID)
                    )->results();

            $uploads = DB::load()->query('SELECT
        ID, Timestamp, Slug 
        FROM Uploads ORDER BY ID DESC ')->results();

            $upload_items = DB::load()->query('SELECT
        Item_ID FROM Meta_items WHERE Type = ? AND Meta_ID = ? ORDER BY ID DESC ', array('uploads',$ID))->results();

            return (object) array(
                        'posts'        => $post,
                        'uploads'      => $uploads,
                        'upload_items' => $upload_items
            );
        }
    }

    public
            function delete($type)
    {
        if (Input::exists())
        {
            DB::load()->delete('Meta_items', array(
                array('Meta_ID', '=', Input::get('ID')),
                array('Type' => 'uploads')
            ));

            DB::load()->delete('Posts', array(array(
                    'ID', '=', Input::get('ID')
            )));

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
        }
        Redirect::to($this->data['project_url'] . "admin/read/posts/house");
    }

    public
            function validateInput()
    {

        $v = Validator::load();
        $v->checkPost($_POST, array(
            'city'      => array(
                'required' => true,
                'min'      => 1,
                'max'      => 32
            ),
            'country'   => array(
                'required' => true,
                'min'      => 1,
                'max'      => 32
            ),
            'thumbnail' => array(
                'required' => true
            ),
            'excerpt'   => array(
                'required' => true,
                'max'      => 150,
                'min' => 25
            )
        ));

        if (!$v->passed())
        {
//            Session::set($title, Input::get($title));
            foreach ($v->errors() as $error)
            {
                $_SESSION['ERRORS'][] = $error;
            }
            Redirect::to($this->data['current_url']);
            exit();
        }
    }

    public
            function favorite($param)
    {
        if (Input::exists())
        {
            if (empty($param))
            {
                $check = DB::load()->query(
                        'SELECT Meta_ID, Item_ID
                    FROM Meta_items 
                    WHERE Meta_ID = ?
                    AND Item_ID = ?
                    AND Type = ?', array(Input::get('post_id'), Input::get('user_id'), 'favorite'));

                if ($check->results() && $check->_error == false)
                {
                    Session::set('INFO', 'Favorit eksiterer allerede.');
                    Redirect::to(Input::get('current_url'));
                }

                DB::load()->insert('Meta_items', array(
                    'Meta_ID' => Input::get('post_id'),
                    'Item_ID' => Input::get('user_id'),
                    'User_ID' => Input::get('user_id'),
                    'Type'    => 'favorite'
                ));
                Session::set('SUCCESS', 'Favorit gemt!');
                Redirect::to(Input::get('current_url'));
            }
            else
            {
                DB::load()->delete('Meta_items', array(
                    array('Item_ID', '=', Input::get('user_id')),
                    array('Type', '=', 'favorite'),
                    array('User_ID', '=', Input::get('user_id'))
                ));
                Session::set('SUCCESS', 'Favorit slettet!');
                Redirect::to(Input::get('current_url'));
            }
        }
    }

}
