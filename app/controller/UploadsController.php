<?php

/*
 * Controller for uploading and manage uploadds
 */

use thom855j\PHPMvcFramework\Controller,
    thom855j\PHPAuthFramework\Auth,
    thom855j\PHPHttp\Input,
    thom855j\PHPHttp\Router,
    thom855j\PHPHttp\Redirect,
    thom855j\PHPMultilingual\I18n,
    thom855j\PHPSecurity\Validator,
    thom855j\PHPSecurity\Session,
    thom855j\PHPFilesystem\Upload,
    thom855j\PHPFilesystem\Image,
    thom855j\PHPScrud\DB;

class UploadsController extends Controller
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
        if (Input::exists('files'))
        {

            $this->validateFile();

            //Create post
            $source = PATH_ROOT . 'public/uploads/source/';
            $thumbs = PATH_ROOT . 'public/uploads/thumbs/';
            Upload::load($source)->file('files');
            $rename = Upload::load($source)->renames();

            foreach ($rename as $slug)
            {
                DB::load()->insert('Uploads', array(
                    'Timestamp' => time(),
                    'Slug'      => $slug,
                    'User_ID'   => Session::getKey('User', 'ID')
                ));

                Image::load()->open($source . $slug);

                Image::load()->resize(150, 100);

                Image::load()->save($thumbs . $slug);
            }


            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
            Redirect::to($this->data['current_url']);
        }
    }

    public
            function read($type, $start, $end, $max)
    {
        if (!Auth::load()->role('admin'))
        {
            $uploads = DB::load()->query(
                            "SELECT ID, Timestamp, Slug FROM Uploads WHERE User_ID = ? "
                            . "ORDER BY ID DESC", array(Session::getKey('User', 'ID')), 'Uploads', array('start' => $start, 'end' => $end, 'max' => $max))->results();
        }
        else
        {
            $uploads = DB::load()->query(
                            "SELECT ID, Timestamp, Slug FROM Uploads "
                            . "ORDER BY ID DESC", null, 'Uploads', array('start' => $start, 'end' => $end, 'max' => $max))->results();
        }
        return (object) array(
                    'data'  => $uploads,
                    'total' => DB::load()->_records
        );
    }

    public
            function delete($type)
    {
        if (Input::exists())
        {
            $source = PATH_ROOT . 'public/uploads/source/';
            $thumbs = PATH_ROOT . 'public/uploads/thumbs/';
            $upload = DB::load()->select(array('ID, Slug'), 'Uploads', null, array(array('ID', '=', Input::get('ID'))))->results();
            $file   = $upload[0]->Slug;

            Upload::load($source)->remove($file);
            Upload::load($source)->remove($file, $thumbs);

            DB::load()->delete('Uploads', array(array('ID', '=', Input::get('ID'))));

            Session::set('SUCCESS', I18n::get('SYSTEM_CRUD_SUCCESS'));
        }
        Redirect::to($this->data['project_url'] . 'admin/read/uploads');
    }

    public
            function validateFile()
    {

        $v = Validator::load();
        $v->checkFile($_FILES, array(
            // name of file input field
            'files' => array(
                //allowed extensions for files
                'ext'  => array('png', 'jpg', 'jpeg'),
                //set allowed size in bytes
                'size' => 3000000
            )
        ));
        if (!$v->passed())
        {

            foreach ($v->errors() as $error)
            {
                $_SESSION['ERRORS'][] = $error;
            }
            var_dump($v->errors());
            Redirect::to($this->data['current_url']);
            exit();
        }
    }

}
