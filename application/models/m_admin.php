<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Admin extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function GetAllData($table)
    {
        return $this->db->get($table)->result();
    }

    public function GetData($where, $table)
    {
        return $this->db->where($where)->get($table)->row();
    }

    public function GetDataSetting()
    {
        return $this->db->get('setting')->row();
    }

    public function GetPeminjaman($where)
    {
        return $this->db->query("SELECT * FROM peminjaman INNER JOIN siswa ON peminjaman.id_siswa = siswa.id_siswa
            INNER JOIN barcode ON peminjaman.barcode = barcode.barcode INNER JOIN buku ON
            barcode.id_buku = buku.id_buku WHERE $where")->result();
    }

    public function GetSpecificSiswa($where)
    {
        return $this->db->query("SELECT * FROM siswa WHERE $where")->result();
    }

    public function ChangeSetting($field)
    {
        $this->db->update('setting', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMAadmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/M_Admin/:application/models/${1/(.+)/lMAadmin.php/}} */
