<?php
/*
 * Controller for manage messages from user
 * @author Thomas Elvin
 */

use thom855j\PHPMvcFramework\Controller;
use thom855j\PHPHttp\Router;
use thom855j\PHPHttp\Redirect;
use thom855j\PHPHttp\Input;
use thom855j\PHPSecurity\Session;
use thom855j\PHPSecurity\Validator;
use thom855j\PHPScrud\DB;
use thom855j\PHPMultilingual\I18n;

class MessagesController extends Controller
{

    public
            $data;

    public
            function __construct()
    {
        // construct controller
        parent::__construct();
        // get project url
        $this->data['project_url'] = Router::getProjectUrl();
        $this->data['current_url'] = Router::getUrl();
    }

    public
            function index()
    {
        Redirect::back();
    }

    public
            function create()
    {

        if (Input::exists())
        {

            $validation = $this->validate();

            if ($validation->passed())
            {
                DB::load()->insert('Messages', array(
                    'Created' => time(),
                    'Name'    => Input::get('name'),
                    'Email'   => Input::get('email'),
                    'Content' => Input::get('content'),
                ));
                Session::set('SUCCESS', I18n::get('MESSAGES_CREATE_SUCCESS'));
                Redirect::to($this->data['project_url']);
            }
            else
            {
                // gather the errorrs and echo them out
                foreach ($validation->errors() as $error)
                {
                    $_SESSION['ERRORS'][] = $error;
                }

                Redirect::to($this->data['project_url']);
            }
        }
        Redirect::to($this->data['project_url']);
    }

    private
            function validate()
    {
        $validate   = Validator::load(DB::load());
        $validation = $validate->checkPost($_POST, array(
            'name'    => array(
                'required'   => true,
                'min'        => 1,
                'max'        => 32,
                'validInput' => Input::get('name')
            ),
            'email'   => array(
                'required'   => true,
                'min'        => 5,
                'max'        => 32,
                'validEmail' => Input::get('email')
            ),
            'content' => array(
                'required' => false,
                'max'      => 500
            )
        ));
        return $validation;
    }

    public
            function delete()
    {
        if (Input::exists())
        {
            DB::load()->delete('Messages', array(
                array('ID', '=', Input::get('ID'))
            ));
        }

        Redirect::to($this->data['project_url'] . 'admin/read/messages');
    }

    public
            function read($type, $start = 1, $end, $max)
    {
        $messages = DB::load()->query(
                        "SELECT ID, Created, Name, Email, Content FROM Messages ORDER BY ID DESC"
                        , null, 'Messages', array('start' => $start, 'end' => $end, 'max' => $max))->results();

        return (object) array(
                    'data'  => $messages,
                    'total' => DB::load()->_records
        );
    }

}
