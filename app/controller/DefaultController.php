<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
use thom855j\PHPMvcFramework\Controller;
use thom855j\PHPHttp\Router;
use thom855j\PHPHttp\Redirect;
use thom855j\PHPHttp\Input;
use thom855j\PHPSecurity\Session;
use thom855j\PHPScrud\DB;

class DefaultController extends Controller
{

    public
            $theme,
            $header,
            $footer,
            $content,
            $sidebar,
            $data;

    /**
     * Construct this object by extending the base Controller class
     */
    public
            function __construct()
    {
        // construct controller
        parent::__construct();
        $this->setup();
        $this->checkUrl();
        $this->parseRequest();
        $this->loadAction($this->data['action'], $this->data['params']);
        $this->index($this->data['current_page']);
    }

    private
            function setup()
    {
        // set default includes
        $this->theme   = THEME;
        $this->header  = PATH_APP_VIEWS . "theme/$this->theme/assets/inc/_header";
        //$this->sidebar = PATH_APP_VIEWS . "theme/$this->theme/assets/inc/_sidebar";
        $this->content = PATH_APP_VIEWS . "theme/$this->theme/";
        $this->footer  = PATH_APP_VIEWS . "theme/$this->theme/assets/inc/_footer";
    }

    private
            function checkUrl()
    {
        // get project url
        $this->data['project_url'] = Router::getProjectUrl();
        // parsed url
        $this->data['request']     = Router::parseUrl('url');
        // get current url
        $this->data['current_url'] = Router::getUrl();
        // get current page
        if (empty($this->data['request'][0]))
        {
            $this->data['current_page'] = 'index';
        }
        else
        {
            $this->data['current_page'] = str_replace('-', '', $this->data['request'][0]);
        }

        if ($this->data['request'])
        {
            if (file_exists(PATH_APP_VIEWS . 'theme/' . THEME . '/' . $this->data['current_page'] . '.php'))
            {
                return true;
            }
            else
            {
                Redirect::to($this->data['project_url'] . 'error/404');
            }
        }
        else
        {
            $this->index('index');
            exit();
        }
    }

    private
            function parseRequest()
    {
        $this->data['request'] = Router::parseUrl('url');
        $action                = str_replace('-', '', $this->data['request'][0]);
        $this->data['action']  = $action;
        unset($this->data['request'][0]);

        if (!empty($this->data['request']))
        {
            $this->data['params'] = $this->data['request'];
        }
        else
        {
            $this->data['params'] = array();
        }
        unset($this->data['request']);
    }

    private
            function loadAction($action = 'index', $params = array())
    {
        if (!method_exists('DefaultController', $action))
        {
            Redirect::to($this->data['project_url'] . 'error/404');
        }
        
        $this->data['data'] = $this->$action($params);
    }

    // pages
    public
            function ejendom($params = null)
    {
        if (empty($params))
        {
            Redirect::back();
        }
        $post = DB::load()->query(
                        'SELECT 
        Posts.ID, Posts.Created, Posts.Content, Posts.Updated, Posts.Title, Posts.Slug,
        Posts.Price, Posts.Country, Posts.City, Posts.M2, Posts.Rooms, Posts.Thumbnail,
        Posts.Bath_rooms, Posts.Type,
        Users.Username, 
        Status.Label 
        FROM Posts
        LEFT JOIN Users ON Posts.User_ID = Users.ID
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
        AND Posts.ID = ?
        GROUP BY Posts.ID DESC', array('house', $params[1])
                )->results();


        $uploads = DB::load()->query(
                        'SELECT Uploads.Slug 
                FROM Uploads 
                LEFT OUTER JOIN Meta_items ON Meta_items.Item_ID = Uploads.ID 
                WHERE Meta_items.Meta_ID = ? 
                AND Meta_items.Type = ?', array($params[1], 'uploads')
                )->results();

        if (empty($post))
        {
            Session::set('INFO', 'Ingen ejendom matcher det du søger, desværre :(');
        }

        return (object) array(
                    'post'    => $post,
                    'uploads' => $uploads
        );
    }

    public
            function ejendomme($params = null)
    {
        // check if a searh is submitted
        if (!is_null(Input::get('search_submit')))
        {
            // return search results
            return $this->search();
        }
        
    //check for what should be shown in whick order
        if (empty($params[1]))
        {
            $params[1] = 'alle';
            $params[2] = 1;
        }
        if (empty($params[2]))
        {
            $params[2] = 1;
        }

        $order = ' ORDER BY Posts.ID DESC';
        if (!empty($params[1]))
        {

            Session::set('ORDER', $params[1]);

            if ($params[1] == 'pris')
            {
                $order = ' ORDER BY Posts.Price';
            }
            if ($params[1] == 'seneste')
            {
                $order = ' ORDER BY Posts.ID DESC';
            }
        }

        $post = DB::load()->query(
                        "SELECT 
        Posts.ID, Posts.Created, Posts.Excerpt, Posts.Updated, Posts.Title, Posts.Slug,
        Posts.Price, Posts.Country, Posts.City, Posts.M2, Posts.Rooms, Posts.Thumbnail,
        Posts.Bath_rooms, Posts.Type,
        Users.Username, 
        Status.Label 
        FROM Posts
        LEFT JOIN Users ON Posts.User_ID = Users.ID
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
         $order", array('house'), 'Posts', array('start' => $params[2], 'end' => 4, 'max' => 4)
                )->results();


        return (object) array(
                    'post'  => $post,
                    'total' => DB::load()->_records
        );
    }

    public
            function search()
    {
        if (Input::exists())
        {

            $city   = Input::get('city');
            $type   = Input::get('type');
            $status = Input::get('status');

            $post = DB::load()->query(
                            "SELECT 
        Posts.ID, Posts.Created, Posts.Excerpt, Posts.Slug,
        Posts.Price, Posts.Country, Posts.City, Posts.M2, Posts.Rooms, Posts.Thumbnail,
        Posts.Bath_rooms, Posts.Type,
        Status.Label 
        FROM Posts
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
        AND Posts.Type = ?
        AND Posts.Status_ID = ?
        AND City LIKE ?", array('house', $type, $status, "%$city%")
                    )->results();

            if (empty($post))
            {
                Session::set('INFO', "Ingen ejendom matcher '$city', desværre. Prøv en anden søgning.");
            }

            return (object) array(
                        'post'  => $post,
                        'total' => DB::load()->_records
            );
        }
    }

    public
            function minside($params = null)
    {
        // check for login before rendering "my site"
        if (Session::exists('User'))
        {
            $params[2] = 1;
            if (isset($params[1]))
            {
                if ($params[1] == 'favoritter')
                {
                    $user_id = Session::getKey('User', 'ID');

                    $saves   = DB::load()->query(
                                    'SELECT Posts.ID, Posts.Created, Posts.Excerpt, Posts.Updated, Posts.Title, Posts.Slug,
            Posts.Price, Posts.Country, Posts.City, Posts.M2, Posts.Rooms, Posts.Thumbnail, Status_ID,
            Posts.Bath_rooms, Posts.Type,
              Status.Label 
            From Posts
             LEFT JOIN Status ON Posts.Status_ID = Status.ID
            LEFT JOIN Meta_items On Meta_items.Meta_ID = Posts.ID
            WHERE Meta_items.Item_ID = ?', array($user_id), array('start' => $params[2]))->results();

                    if (empty($saves))
                    {
                        Session::set('INFO', 'Du har ikke nogle favoritter, endnu.');
                    }
                    return (object) array(
                                'saves' => $saves,
                                'total' => DB::load()->_records
                    );
                }
                if ($params[1] == 'oplysninger')
                {
                    $user = DB::load()->query(
                                    'SELECT Users.ID, Users.Username, Users.Name, Users.Email,
                      Users.Org   
                      FROM Users 
                      WHERE Users.ID = ? ', array(Session::getKey('User', 'ID'))
                            )->results();

                    return (object) array(
                                'user' => $user
                    );
                }
            }
        }
        else
        {
            Session::set('WARNINGS', 'Du skal logge ind først.');
            Redirect::to($this->data['project_url'] . 'login#form');
        }
    }

    public
            function login()
    {
        if (Session::exists('User'))
        {
            Session::set('INFO', 'Du er allerede logget ind.');
            Redirect::to($this->data['project_url'] . 'min-side');
        }
    }

    // error page
    public
            function error($code = 404)
    {
        $this->View->render(array(
            $this->header,
            //$this->sidebar,
            $this->content . $this->data['current_page'],
            $this->footer
                ), $this->data);
    }

    // view
    public
            function index($page = null)
    {

        if ($page == 'index' && empty($this->data['data']))
        {

            $post = DB::load()->query(
                            "SELECT 
        Posts.ID, Posts.Created, Posts.Excerpt, Posts.Updated, Posts.Title, Posts.Slug,
        Posts.Price, Posts.Country, Posts.City, Posts.M2, Posts.Rooms, Posts.Thumbnail,
        Posts.Bath_rooms, Posts.Type,
        Users.Username, 
        Status.Label 
        FROM Posts
        LEFT JOIN Users ON Posts.User_ID = Users.ID
        LEFT JOIN Status ON Posts.Status_ID = Status.ID
        WHERE Posts.Post_type = ?
         ORDER BY Posts.ID DESC LIMIT 0,3", array('house')
                    )->results();


            $uploads = DB::load()->query(
                            'SELECT Uploads.Slug 
                FROM Uploads 
                LEFT OUTER JOIN Post_meta ON Post_meta.Item_ID = Uploads.ID 
                WHERE Post_meta.Type = ?', array('uploads')
                    )->results();

            $this->data['data'] = (object) array(
                        'post'    => $post,
                        'uploads' => $uploads
            );
        }

        // rendering of page
        $this->View->render(array(
            $this->header,
            //$this->sidebar,
            $this->content . $page,
            $this->footer
                ), $this->data);
    }

}
