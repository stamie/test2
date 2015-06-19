<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of client
 *
 * @author Emese
 */
class client {

    
    private $id;
    private $name;
    private $gender;
    private $link;


    public function __construct($Host, $User, $DB, $Password=NULL) {
        
        $this->link = mysql_connect($Host, $User, $Password);
        
        if (!$this->link) {
            
            die('Could not connect: '.  mysql_error());
            return FALSE;
        }
        
        mysql_select_db($DB);
        
        return TRUE;
    }
    
    
    public function select($Id) {
        
        $sql = 'select * from client where id = '. $Id;
        
        $res = mysql_query($sql);
        
        if(!$res){
            return FALSE;
        }
        
        $row = mysql_fetch_assoc($res);
        
        $this->id = $Id;
        $this->name = $row['name'];
        $this->gender = $row['gender'];
     
        return $row;
     
    }
    
    public function searcher() {
        
        $sql = 'select * from client';
        
        $res = mysql_query($sql);
        
        if(!$res){
            return FALSE;
        }
        
        $return = array();
        
        while ($row = mysql_fetch_assoc($res)) {
            $return[]=$row;
        }
     
        return $return;
     
    }
    
    public function add_row($Name, $Gender) {
        
        $this->name = $Name;
        if ($Gender == 'male') {
            $this->gender = 1;
        } else {
            $this->gender = 0;
        }
        $sql = 'insert into client (name, gender) values ("'.$this->name.'", '.$this->gender.')';
        print_r($sql);
        
        mysql_query($sql);
        $this->id = mysql_insert_id();
        
        return $this->id;
        
    }
    
    
    public function __destruct() {
        
        mysql_close($this->link);
        
        return TRUE;
        
    }
            
    
    
}
