<?php

/*
 * Admin controller for manage admininstration
 * @author Thomas Elvin
 */

// use following classes
use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPAuthFramework\Auth,
    thom855j\PHPHttp\Router,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPSecurity\Session,
    thom855j\PHPMultilingual\I18n;

class AdminController extends Controller
{

    public
            $header,
            $footer,
            $sidebar,
            $data;

    public
            function __construct()
    {
// construct controller
        parent::__construct();

// setup admin
        $this->bootstrap();

// check login
        $this->checkLogin();

// check permissions
        $this->checkRole('broker');

        $this->setupAdminMenus();
    }

    public
            function index()
    {
        $this->View->render(array(
            $this->header,
            $this->sidebar,
            PATH_APP_VIEWS . 'admin/default/index',
            $this->footer
                ), $this->data);
    }

    public
            function read($controller, $type = null, $start = null, $end = null, $max = null)
    {

        $class                 = ucfirst($controller) . 'Controller';
        require_once(PATH_APP_CONTROLLERS . $class . '.php');
        $app                   = new $class($this->data['project_url']);
        $this->data['results'] = $app->read($type, $start, $end, $max);
        $this->data['type']    = $type;

        $this->View->render(array(
            $this->header,
            $this->sidebar,
            PATH_APP_VIEWS . 'admin/' . $controller . '/read',
            $this->footer
                ), $this->data
        );
    }

    public
            function create($controller, $type = null)
    {
        $class                 = ucfirst($controller) . 'Controller';
        require_once(PATH_APP_CONTROLLERS . $class . '.php');
        $app                   = new $class($this->data['project_url']);
        $this->data['results'] = $app->create($type);
        $this->data['type']    = $type;

        $this->View->render(array(
            $this->header,
            $this->sidebar,
            PATH_APP_VIEWS . 'admin/' . $controller . '/create',
            $this->footer
                ), $this->data
        );
    }

    public
            function update($controller, $type = null, $ID)
    {
        $class                 = ucfirst($controller) . 'Controller';
        require_once(PATH_APP_CONTROLLERS . $class . '.php');
        $app                   = new $class($this->data['project_url']);
        $this->data['results'] = $app->update($type, $ID);
        $this->data['type']    = $type;

        $this->View->render(array(
            $this->header,
            $this->sidebar,
            PATH_APP_VIEWS . 'admin/' . $controller . '/update',
            $this->footer
                ), $this->data
        );
    }

    public
            function delete($controller, $type = null)
    {
        $class = ucfirst($controller) . 'Controller';
        require_once(PATH_APP_CONTROLLERS . $class . '.php');
        $app   = new $class($this->data['project_url']);
        $app->delete($type);
    }

    public
            function checkLogin()
    {
// check user login
        if (!Auth::load()->check())
        {
            Session::set('ERRORS', I18n::get('AUTH_ACCESS_DENIED'));
            Redirect::to($this->data['project_url']);
        }
    }

    public
            function checkRole($role)
    {
        if (!Auth::load()->role($role))
        {
            Session::set('WARNINGS', I18n::get('AUTH_NO_PERMISSION'));
            Redirect::to($this->data['project_url'] . 'login#form');
        }
    }

    public
            function bootstrap()
    {
// set urls
        $this->data['project_url'] = Router::getProjectUrl();
        $this->data['current_url'] = Router::getUrl();

// set date format
        $this->data['date_format'] = App::load()->date_format;

// set default includes
        $this->header  = PATH_APP_VIEWS . 'admin/default/assets/inc/_header';
        $this->sidebar = PATH_APP_VIEWS . 'admin/default/assets/inc/_sidebar';
        $this->footer  = PATH_APP_VIEWS . 'admin/default/assets/inc/_footer';
    }

    public
            function setupAdminMenus()
    {
        if (Auth::load()->role('broker'))
        {
//set posts menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#posts' class='list-group-item list-group-item-info' data-toggle='collapse'>" . I18n::get('POSTS_HEADER') . "</a> 
    <div class='collapse' id='posts'> 
       <a href='" . $this->data['project_url'] . "admin/read/posts/house/' class='list-group-item'>" . I18n::get('POSTS_SUB_HEADER') . "</a> 
      <a href='" . $this->data['project_url'] . "admin/create/posts/house/' class='list-group-item'>" . I18n::get('POSTS_CREATE') . "</a> 
    </div> 
  </div>"
            ));

//set uploads menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#uploads' class='list-group-item list-group-item-info' data-toggle='collapse'>" . I18n::get('UPLOADS_HEADER') . "</a> 
    <div class='collapse' id='uploads'> 
       <a href='" . $this->data['project_url'] . "admin/read/uploads/' class='list-group-item'>" . I18n::get('UPLOADS_SUB_HEADER') . "</a> 
      <a href='" . $this->data['project_url'] . "admin/create/uploads/' class='list-group-item'>" . I18n::get('UPLOADS_CREATE') . "</a> 
    </div> 
  </div>"
            ));
        }

        if (Auth::load()->role('admin'))
        {
//set users menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#users' class='list-group-item list-group-item-info' data-toggle='collapse'>" . I18n::get('USERS_HEADER') . "</a> 
    <div class='collapse' id='users'> 
       <a href='" . $this->data['project_url'] . "admin/read/users/all' class='list-group-item'>" . I18n::get('USERS_SUB_HEADER') . "</a> 
       <a href='" . $this->data['project_url'] . "admin/read/users/2' class='list-group-item'>Mæglere</a>     
        <a href='" . $this->data['project_url'] . "admin/read/users/3' class='list-group-item'>Alm. brugere</a>
</div> 
  </div>"
            ));


//set messages menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#messages' class='list-group-item list-group-item-info' data-toggle='collapse'>" . I18n::get('MESSAGES_HEADER') . "</a> 
    <div class='collapse' id='messages'> 
       <a href='" . $this->data['project_url'] . "admin/read/messages/' class='list-group-item'>" . I18n::get('MESSAGES_SUB_HEADER') . "</a> 
    </div> 
  </div>"
            ));

            //set messages menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#menus' class='list-group-item list-group-item-info' data-toggle='collapse'>Menuer</a> 
    <div class='collapse' id='menus'> 
        <a href='" . $this->data['project_url'] . "admin/create/menus/all/' class='list-group-item'>Opret  link</a> 
       <a href='" . $this->data['project_url'] . "admin/read/menus/header/' class='list-group-item'>Hoved menu</a> 
       <a href='" . $this->data['project_url'] . "admin/read/menus/footer/' class='list-group-item'>Fod menu</a>     
</div> 
  </div>"
            ));

//set messages menu
            App::load()->register('nav', array(
                " 
  <div class='list-group panel'> 
    <a href='#options' class='list-group-item list-group-item-info' data-toggle='collapse'>Indstillinger</a> 
    <div class='collapse' id='options'> 
       <a href='" . $this->data['project_url'] . "admin/read/options/all/' class='list-group-item'>Alle indstillinger</a> 
    </div> 
  </div>"
            ));
        }

        App::load()->register('nav', array(
            " 
  <div class='list-group panel'> 
    <a href='#profil' class='list-group-item list-group-item-info' data-toggle='collapse'>Profil</a> 
    <div class='collapse' id='profil'> 
      <a href='" . $this->data['project_url'] . "min-side' class='list-group-item'>Min side</a> 
       <a href='" . $this->data['project_url'] . "auth/logout' class='list-group-item'>Log ud</a> 
    </div> 
  </div>"
        ));
    }

}
