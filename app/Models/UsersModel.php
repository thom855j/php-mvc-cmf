<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Models;

use WebSupportDK\PHPMvcFramework\Model;

class UsersModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}
	
	public function getUsers()
	{
		$this->_db->query('SELECT * FROM Users');
		return $this->_db->results();
	}
}
