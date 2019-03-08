<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Http\Controllers;

use Datalaere\PHPMvcFramework\Controller;
use App\Exceptions\Handler;

class DefaultController extends Controller
{

    // variable for storing view data
    public $data;

    /**
     * Construct this object by extending the base Controller class and view
     */
    public function __construct()
    {
        // construct Controller
        parent::__construct();
        // Parse default data about app
        $this->data['App'] = $this->App;
    }

    public function index()
    {
        return $this->View->render(array('home'), $this->data);
    }

    public function test()
    {
    }
}
