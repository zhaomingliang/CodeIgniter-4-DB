<?php
namespace App\Models;

use CodeIgniter\Model;
class Data extends Model
{
    var $table = '';
    public function getSingle($getwhere = "", $table = '')
    {
        $table = $table == '' ? $this->table : $table;
        $db = $this->db->table($table);
        if ($getwhere) {
            $db->where($getwhere);
        }
        $row = $db->get()->getRowArray();
        return $row;
    }
    public function addData($data, $table = '')
    {
        $table = $table == '' ? $this->table : $table;
        if ($data) {
            $this->insert($table, $data);
            return $this->insertID();
        } else {
            return false;
        }
    }
    public function getData($getwhere = "", $order = '', $pagenum = "0", $exnum = "0", $table = '')
    {
        $table = $table == '' ? $this->table : $table;
        $db = $this->db->table($table);
        if ($getwhere) {
            $db->where($getwhere);
        }
        if ($order) {
            $db->orderBy($order);
        }
        if ($pagenum > 0) {
            $db->limit($pagenum, $exnum);
        }
        $data = $db->get()->getResultArray();
        return $data;
    }
    public function getFieldData($table = '', $getwhere = "", $field = array())
    {
        $table = $table == '' ? $this->table : $table;
        $db = $this->db->table($table);
        if ($field) {
            switch ($field[0]) {
                case 'selectSum':
                    $db->select_sum($field[1]);
                    break;
                case 'selectAvg':
                    $db->select_avg($field[1]);
                    break;
                case 'selectMin':
                    $db->select_min($field[1]);
                    break;
                case 'selectMax':
                    $db->select_max($field[1]);
                    break;
                default:
                    break;
            }
        }
        $data = $this->db->get()->getRowArray();
        return $data;
    }
}
