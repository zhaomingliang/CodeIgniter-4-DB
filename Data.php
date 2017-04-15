<?php 
namespace App\Models;
use CodeIgniter\Model;

class Data extends Model
{
    var $table;
    
    
    public function getData($getwhere="",$order='',$pagenum="0",$exnum="0"){
		
		$db = $this->db->table($this->table);
		if($getwhere){
		 	$db->where($getwhere);
		}
		if($order){
			$db->orderBy($order);
		}
		if($pagenum>0){
			$db->limit($pagenum,$exnum);
		}

		$data =$db->get()->getResultArray();
		return $data;
	}
}
