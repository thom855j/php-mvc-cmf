<?php

namespace App\Model;

use thom855j\PHPMvcFramework\Model;
use thom855j\PHPScrud\DB;

class PostsModel extends Model
{

    // object instance 
    protected static
            $instance = null;
    private
            $db,
            $table,
            $attributes,
            $total,
            $pages,
            $perPage;

    public
            function __construct()
    {
        $this->table      = DB_PREFIX . 'Posts';
        $this->attributes = "$this->table.ID, $this->table.Created, $this->table.Updated, $this->table.Posts.Start, $this->table.End, $this->table.Title, $this->table.Slug, $this->table.Content, $this->table.Excerpt, $this->table.I18n, $this->table.Status_ID, $this->table.User_ID";
        $this->db         = DB::load();
    }

    public static
            function load()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new PostsModel();
        }
        return self::$instance;
    }
 public
            function setModel($name, $value)
    {
        $this->$name = $value;
    }

    public
            function search($query)
    {
        return $this->db->search($this->table, $this->rows, $query, array($this->attributes));
    }

    // create 
    public
            function create($fields = array())
    {
        return $this->db->insert($this->table, $fields);
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
            $this->db->select(array($this->attributes), $this->table, $where);
            return $this->db->results();
        }
    }


    // get page by specific search 
    public
            function get($where =array(array()), $paging = array(), $options = array())
    {

        if (!empty($paging))
        {
            return $this->paging($paging['start'], $paging['end'], $paging['max'], $where);
        }
        else
        {
            $this->db->select(array($this->attributes), $this->table, $where, $options);
            return $this->db->results();
        }
    }
    
        public
            function join($sql, $params = array(), $paging = false, $where = array(array()))
    {

        if ($paging)
        {
            $this->paging($paging['start'], $paging['end'], $paging['max'], $where);
            $params = array_merge($params, array($this->pages, $this->perPage));
        }

        $this->db->query($sql, $params);
        return $this->db->results();
    }

    // get last ind fro SQL INSERT
    public
            function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public
            function paging($start, $end, $max,$where =array(array()))
    {

        $page          = isset($start) ? (int) $start : 1;
        $this->perPage = isset($end) && $end <= $max ? (int) $end : 5;

        $this->pages = ($page > 1) ? ($page * $this->perPage ) - $this->perPage : 0;

        $this->total = (ceil($this->count($where)[0]->Total / $this->perPage));
    }


    public
            function count($where = array(array()))
    {
        $this->db->select(array("count(*) AS Total"), $this->table, $where);
        return $this->db->results();
    }

    public
            function total()
    {
        return $this->total;
    }

// update page by id
    public
            function update($fields = array(), $ID = null)
    {
        return $this->db->update($this->table, 'ID', $ID, $fields);
    }

// delete
    public
            function delete($where = array(array()))
    {
        return $this->db->delete($this->table, $where);
    }

}
