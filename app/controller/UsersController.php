<?php

use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPHttp\Input,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPHttp\Router,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Validator,
    thom855j\PHPSecurity\Password,
    thom855j\PHPSecurity\Token,
    thom855j\PHPSecurity\Session,
    thom855j\PHPScrud\DB;

class UsersController extends Controller
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
        $this->data['project_url'] = Router::getProjectUrl();
        $this->data['current_url'] = Router::getUrl();
    }

    public
            function create()
    {
        if (Input::exists())
        {
            $username = Input::get('username');
            $password = Input::get('password');

            $org = Input::get('org');

            $email = Input::get('email');

            $role = Input::get('user_type');

            $validate   = Validator::load(DB::load());
            $validation = $validate->checkPost($_POST, array(
                'username'  => array(
                    'required' => true,
                    'min'      => 3,
                    'max'      => 32,
                    'notTaken' => 'Users'
                ),
                'full_name' => array(
                    'required' => true,
                    'min'      => 3,
                    'max'      => 50
                ),
                'password'  => array(
                    'required'  => true,
                    'min'       => 3,
                    'max'       => 32,
                    'validPass' => $password
                ),
                'email'     => array(
                    'required'   => true,
                    'min'        => 3,
                    'max'        => 32,
                    'validEmail' => $email
                )
            ));

            if ($validation->passed())
            {

                DB::load()->insert('Users', array(
                    'Created'    => time(),
                    'Username'   => $username,
                    'Password'   => Password::hash($password),
                    'Email'      => $email,
                    'Name'       => Input::get('full_name'),
                    'Org'        => $org,
                    'Role_ID'    => $role,
                    'Status_ID'  => 2,
                    'Auth_token' => Token::create(46)
                ));

                Session::set('SUCCESS', I18n::get('AUTH_CREATE_SUCCESS'));
                Redirect::to($this->data['project_url'] . 'login#form');
            }
            else
            {
                // gather the errorrs and echo them out
                foreach ($validation->errors() as $error)
                {
                    $_SESSION['ERRORS'][] = $error;
                }
                Redirect::to($this->data['project_url'] . 'login#form');
            }
        }
    }

    public
            function read($type, $start = 1, $end, $max)
    {
        if ($type == 'all')
        {
            $users = DB::load()->query(
                            "SELECT Users.ID, Users.Created, Users.Updated, Users.Name, Users.Last_login, Users.Username, Status.ID AS Status, Status.Label FROM Users
              LEFT JOIN Status ON Users.Status_ID = Status.ID
            ORDER BY Users.ID DESC"
                            , null, 'Users', array('start' => $start, 'end' => $end, 'max' => $max))->results();
        }
        else
        {
            $users = DB::load()->query(
                            "SELECT Users.ID, Users.Created, Users.Updated, Users.Name, Users.Last_login, Users.Username, Status.ID AS Status, Status.Label FROM Users
            LEFT JOIN Status ON Users.Status_ID = Status.ID
            WHERE Users.Role_ID = ?
            ORDER BY Users.ID DESC"
                            , array($type), 'Users', array('start' => $start, 'end' => $end, 'max' => $max))->results();
        }

        return (object) array(
                    'data'  => $users,
                    'type'  => $type,
                    'total' => DB::load()->_records
        );
    }

    public
            function update($type = null, $ID = null)
    {
        if (Input::exists('post'))
        {

            if ($type == 'block')
            {
                DB::load()->update('Users', 'ID', Input::get('ID'), array(
                    'Status_ID' => 1
                ));

                Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
                Redirect::to(Input::get('current'));
            }

            if ($type == 'unblock')
            {
                DB::load()->update('Users', 'ID', Input::get('ID'), array(
                    'Status_ID' => 2
                ));
                Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
                Redirect::to(Input::get('current'));
            }
            //Update post
            //$this->validateInput();
            // update

            DB::load()->update('Users', 'ID', Input::get('ID'), array(
                'Updated' => time(),
                'Email'   => Input::get('email'),
                'Name'    => Input::get('full_name')
            ));



            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to(Input::get('current'));
        }
        else
        {
            $user = DB::load()->query(
                            'SELECT Users.ID, Users.Username, Users.Name, Users.Email,
                      Users.Org
                      FROM Users
                      WHERE Users.ID = ? ', array($ID)
                    )->results();

            return (object) array(
                        'data' => $user
            );
        }
    }

    public
            function delete($type)
    {

        DB::load()->delete('Users', array(
            array('ID', '=', Input::get('ID'))
        ));

        DB::load()->delete('Posts', array(
            array('User_ID', '=', Input::get('ID'))
        ));
        
         DB::load()->delete('Meta_items', array(
            array('User_ID', '=', Input::get('ID'))
        ));


        Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
        Redirect::to(Input::get('current'));
    }

    public
            function validateInput()
    {
        $validate   = Validator::load(DB::load());
        $validation = $validate->checkPost($_POST, array(
            'username'  => array(
                'required' => true,
                'min'      => 3,
                'max'      => 32,
                'notTaken' => 'Users'
            ),
            'full_name' => array(
                'required' => true,
                'min'      => 3,
                'max'      => 50
            ),
            'org'       => array(
                'required' => false,
                'max'      => 32
            ),
            'password'  => array(
                'required'  => true,
                'min'       => 3,
                'max'       => 64,
                'ValidPass' => Input::get('password')
            ),
            'email'     => array(
                'required'   => true,
                'min'        => 3,
                'max'        => 32,
                'validEmail' => Input::get('email')
            )
        ));

        if (!$v->passed())
        {

            foreach ($v->errors() as $error)
            {
                Session::addKey('WARNINGS', $error, $error);
            }
            Redirect::to(Input::get('current'));
            exit();
        }
    }

}
