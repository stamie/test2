<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaction
 *
 * @author Emese
 */
class transaction {
    
    private $id;
    private $name;
    private $succes;
    private $scilent;
    private $tcilent;
    private $amount;
    private $currency;
    private $date;
    private $comment;
    
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
    
    public function update ($Id, $Name, $Succes, $Scilent, $Tcilent, $Amount, $Currency, $Date, $Comment) {
        
        if (empty($Id)) {
            return FALSE;
        }
            
        
        if (empty($Name) && empty($Succes) && empty($Scilent) && empty($Tcilent) && empty($Amount) && 
            empty($Currency) && empty($Date) && empty($Comment)) {
            return FALSE;
        }
        
        $sql = 'update transaction set ';
        
        if (isset($Name)) {
            $sql .= 'name="'.$Name.'", ';
        }
        if (isset($Succes)) {
            
            $i = $Succes-1;
            $sql .= 'succes='.$i.', ';
            
        }
        if (isset($Scilent)) {
            $sql .= 'sclient='.$Scilent.', ';
        }
        if (isset($Tcilent)) {
            $sql .= 'tclient='.$Tcilent.', ';
        }
        if (isset($Amount)) {
            $sql .= 'amount='.$Amount.', ';
            
        }
        if (isset($Currency)) {
            $sql .= 'currency="'.$Currency.'", ';
        }
        if (isset($Date)) {
            $sql .= 'date="'.$Date.'", ';
        }
        if (isset($Comment)) {
            $sql .= 'comment="'.$Comment.'", ';
        }
        
        $sql = substr($sql, 0, strrpos($sql, ', '));
        $sql .= " where id=".$Id;

        
        $res = mysql_query($sql);
            
        
        $this->search_id($Id);
        return $res;
        
    }
    
    public function search($src, $am, $suc, $dat, $cur) {
        
        $sql = 'select t.*, c1.name sclient, c2.name tclient from transaction t, client c1, client c2 where t.sclient=c1.id and t.tclient=c2.id and '
                . '(upper(t.name) like upper("%'. $src.'%") or upper(c1.name) like upper("%'. $src.'%") or upper(c2.name) like upper("%'. $src.'%") or upper(t.comment) like upper("%'. $src.'%"))';
        
        $sql = str_replace('"%%"', '"%"', $sql);
        
        if (!empty($am)) {
            $sql.=' and amount = '.$am;
        }
        
        if (!empty($suc)) {
            $dat= $suc-1;
            $sql.=' and succes = '.$dat;
            
        }
        
        if (!empty($cur)) {
            
            $sql.=' and currency like "'.$cur.'"';
        }
        
        if (!empty($dat)) {
            
            $sql.= ' and date_format(date, \'%Y %m %d\') = date_format("'.$dat.'", \'%Y %m %d\') ';
            
        }
        
        $res = mysql_query($sql);
        
        if(!$res){
            return FALSE;
        }
        
        $return = array();
        
        while ($row = mysql_fetch_assoc($res)){
            
            $return[]=$row;
            
        }
             
        return $return;
     
    }
    
    public function search_id($Id) {
        
        $sql = 'select t.*, c1.id sid, c1.name sclient, c2.id tid, c2.name tclient from transaction t, client c1, client c2 where t.id = '. $Id.' and t.sclient=c1.id and t.tclient=c2.id';
//        print_r($sql);
        $res = mysql_query($sql);
        
        if(!$res){
            return FALSE;
        }
        
        $row = mysql_fetch_assoc($res);
        
        $this->id = $Id;
        $this->name = $row['name'];
        $this->succes = $row['succes'];
        $this->scilent = $row['sclient'];
        $this->tcilent = $row['tclient'];
        $this->amount = $row['amount'];
        $this->currency = $row['currency'];
        $this->date = $row['date'];
        $this->comment = $row['comment'];
        return $row;
     
    }

    public function __destruct() {
        
    //    mysql_close($this->link);
        
        return TRUE;
        
    }
    
    
}
