<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Emese
 */
class user {
    
    private $id;
    private $uname;
    private $name;
    private $password;
    
    public function __construct($Host, $User, $DB, $Password=NULL) {
        
        $this->link = mysql_connect($Host, $User, $Password);
        
        if (!$this->link) {
            
            die('Could not connect: '.  mysql_error());
            return FALSE;
        }
        
        mysql_select_db($DB);
        
        return TRUE;
    }


    public function add_row($UName, $Name, $Password) {
        
        
        $this->uname = $UName;
        $this->name = $Name;
        $this->password = hash('md5', $Password);
        
        $sql = 'insert into user (name, uname, password) values ("'.$this->name.'", "'.$this->uname.'", "'.$this->password.'")';
        print_r($sql);
        
        mysql_query($sql);
        $this->id = mysql_insert_id();
        
        return $this->id;
        
    }
    
    public function login($Uname, $Password) {
        
        $this->uname = $Uname;
        $this->password = hash('md5', $Password);
        
        $sql = 'select * from user where uname like "'.$this->uname.'" and password like "'.$this->password.'"';
//        print_r($sql);
//        die();
        $res = mysql_query($sql);
        
        if(!$res){
            return FALSE;
        }
        
        $row = mysql_fetch_assoc($res);
        
        $this->id = $row['id'];
        $this->name = $row['name'];
             
        return $row;
     
    }
    
    
    public function user_id() {
        
        return $this->id;
        
    }
    
    
    public function __destruct() {
        
        mysql_close($this->link);
        
        return TRUE;
        
    }
    
    
}
