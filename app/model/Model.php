<?php

namespace thom855j\PHPMvcFramework;

use thom855j\PHPScrud\DB ;

/*
 * THIS IS JUST an example model to show how to use
 * the framework together with the DB class.
 */

abstract
        class Model
{

    // object instance 
    protected static
            $_instance = null;
    private
            $_db,
            $_table,
            $_attributes,
            $_total,
            $_pages,
            $_perPage;

    public
            function __construct()
    {
        $this->_table      = 'TABLE_NAME';
        $this->_attributes = "$this->_table.ID";
        $this->_db         = DB::load();
    }

    // init a singleton object of class
    public static
            function load()
    {
        if ( !isset( self::$_instance ) )
        {
            // absctract models cannot be instanciated. But yours can!
            //self::$_instance = new Model( $_db ) ;
        }
        return self::$_instance ;
    }
    
    /*
     * Useful for changing different properties of the model during runtime,
     * like the db attributes etc.
     */
    public
            function setModel( $name , $value )
    {
        $this->$name = $value ;
    }

       public
            function search($query)
    {
        return $this->_db->search($this->_table, $this->_attributes, $query, array($this->_attributes));
    }

    // create 
    public
            function create($fields = array())
    {
        return $this->_db->insert($this->_table, $fields);
    }

    // read
    public
            function read($paging = null, $where = array(array()))
    {
        if (!empty($paging))
        {
            return $this->paging($paging['start'], $paging['end'], $paging['max'], $where);
        }
        else
        {
            $this->_db->select(array($this->_attributes), $this->_table, $where);
            return $this->_db->results();
        }
    }

    // get page by specific search 
    public
            function get($where = array(array()), $paging = array(), $options = array())
    {

        if (!empty($paging))
        {
            return $this->paging($paging['start'], $paging['end'], $paging['max'], $where);
        }
        else
        {
            $this->_db->select(array($this->_attributes), $this->_table, $where, $options);
            return $this->_db->results();
        }
    }

    /*
     * You can define your own methods with custom sql and more
     * for specific joins, custom sql etc.
     */
    public
            function custom($ID, $type, $order, $paging = null)
    {
        $sql    = 'SELECT 
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
        ORDER BY ?';
        $params = array($type, $ID, $order);
        $this->_db->query($sql, $params, $this->_table, $paging);
        return $this->_db->results();
    }

    // get last ind fro SQL INSERT
    public
            function getLastInsertId()
    {
        return $this->_db->lastInsertId();
    }

    public
            function paging($start, $end, $max, $where = array(array()))
    {

        $page           = isset($start) ? (int) $start : 1;
        $this->_perPage = isset($end) && $end <= $max ? (int) $end : 5;

        $this->_pages = ($page > 1) ? ($page * $this->_perPage ) - $this->_perPage : 0;

        $this->_total = (ceil($this->count($where)[0]->Total / $this->_perPage));
    }

    public
            function count($where = array(array()))
    {
        $this->_db->select(array("count(*) AS Total"), $this->_table, $where);
        return $this->_db->results();
    }

    public
            function _total()
    {
        return $this->_total;
    }

// update page by id
    public
            function update($fields = array(), $ID = null)
    {
        return $this->_db->update($this->_table, 'ID', $ID, $fields);
    }

// delete
    public
            function delete($where = array(array()))
    {
        return $this->_db->delete($this->_table, $where);
    }

}
