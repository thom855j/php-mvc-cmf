<?php

/*
 * Auth controller for manage authentication
 * @author Thomas Elvin
 */

// use following classes
use  thom855j\PHPMvcFramework\Controller,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPHttp\Router,
    thom855j\PHPHttp\Input,
    thom855j\PHPAuthFramework\Auth,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Session,
    thom855j\PHPScrud\DB;

class AuthController extends Controller
{

    public
            $header,
            $content,
            $footer,
            $sidebar,
            $data;

    /**
     * Construct this object by extending the basic Controller class 
     */
    public
            function __construct()
    {
        parent::__construct();
        // set urls
        $this->data['project_url'] = Router::getProjectUrl();
        $this->data['current_url'] = Router::getUrl();
        $this->header              = PATH_APP_VIEWS . 'auth/assets/inc/_header';
        $this->content             = PATH_APP_VIEWS . 'auth/';
        $this->footer              = PATH_APP_VIEWS . 'auth/assets/inc/_footer';
    }

    /**
     * Handles what happens when user moves to URL/default/index - or - as this is the default controller, also 
     * when user moves to /index or enter your application at base level 
     */
    public
            function index()
    {

        Redirect::to($this->data['current_url'] . 'auth/login');
    }

    public
            function login()
    {
        if (Auth::load()->check())
        {
            Redirect::to($this->data['current_url'] . 'admin');
        }

        $this->View->render(array(
            $this->header,
            $this->content . 'login',
            $this->footer
                ), $this->data);
    }

    public
            function register()
    {
        $this->View->render(array(
            $this->header,
            $this->content . 'register',
            $this->footer
                ), $this->data);
    }

    public
            function verify()
    {
        if (Input::exists())
        {
            //$remember = (Input::get('remember-me') === 'on') ? true : false;
            $login = Auth::load()->login(Input::get('username'), Input::get('password'));
            if ($login)
            {
                $status = DB::load()->query('SELECT 
              Status_ID FROM Users WHERE ID = ?', array(Session::getKey('User', 'ID')))->results();

                if ($status[0]->Status_ID == 1)
                {
                    $url = $this->data['project_url'];
                    Session::set('ERRORS', "Din bruger er blevet deaktiveret. <a href='$url#kontakt'>Kontakt</a> os venligst for at høre nærmere.");
                    Auth::load()->logout();
                    Redirect::to($this->data['project_url'] . 'login#form');
                    exit();
                }

                if (Auth::load()->role('admin') || Auth::load()->role('broker'))
                {
                    Session::set('SUCCESS', I18n::get('AUTH_LOGIN_SUCCESS'));
                    Redirect::to($this->data['project_url'] . 'admin');
                }
                else
                {
                    Session::set('SUCCESS', I18n::get('AUTH_LOGIN_SUCCESS'));
                    Redirect::to($this->data['project_url'] . 'min-side');
                }
            }
            else
            {
                Session::set('ERRORS', I18n::get('AUTH_LOGIN_FAILED'));
                Redirect::to($this->data['project_url'] . 'login#form');
            }
        }
    }

    public
            function create()
    {
        if (Input::exists())
        {
            Redirect::to($this->data['project_url'] . 'users/create');
        }
    }

    public
            function logout()
    {
        Auth::load()->logout();
        Session::set('SUCCESS', I18n::get('AUTH_LOGOUT'));
        Redirect::to($this->data['project_url'] . 'login#form');
    }

    public
            function activate($key)
    {
        if (isset($key))
        {
            $user = UserModel::load()->get(array(array('Auth_token', '=', $key)));
            if ($user)
            {
                if ($user[0]->Status_ID == 0)
                {
                    UserModel::load()->update(array('Status_ID' => 1), $user[0]->ID);
                    Session::set('SUCCESS', 'User activated!');
                    Redirect::to($this->url);
                }
                elseif ($user[0]->Status_ID == 1)
                {
                    Session::set('WARNING', 'User already activated!');
                    Redirect::to($this->url);
                }
                elseif ($user[0]->Status_ID == 2)
                {
                    Session::set('ERRORS', 'User blocked!');
                    Redirect::to($this->url);
                }
            }
            Session::set('ERRORS', 'User key invalid!');
            Redirect::to($this->url);
        }
    }

    public
            function reset($key)
    {
        if (isset($key))
        {
            $user = UserModel::load()->get(array(array('Reset_token', '=', $key)));
            if ($user)
            {
                if ($user[0]->Status_ID == 0)
                {
                    UserModel::load()->update(array('Status_ID' => 1), $user[0]->ID);
                    Session::set('SUCCESS', 'User activated!');
                    Redirect::to($this->url);
                }
                elseif ($user[0]->Status_ID == 1)
                {
                    Session::set('WARNING', 'User already activated!');
                    Redirect::to($this->url);
                }
                elseif ($user[0]->Status_ID == 2)
                {
                    Session::set('ERRORS', 'User blocked!');
                    Redirect::to($this->url);
                }
            }
            Session::set('ERRORS', 'User key invalid!');
            Redirect::to($this->url);
        }
    }

}
