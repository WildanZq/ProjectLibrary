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

    public function AddPeminjaman()
    {
        $kelas      = $this->input->post('kelas');
        $nkelas     = $this->input->post('nkelas');
        $nama       = $this->input->post('nama');
        $barcode    = $this->input->post('barcode');
        $kls        = rtrim(substr($kelas, 0, -3), " ");
        $jurusan    = rtrim(substr($kelas, -3), " ");
        $angkatan   = "";
        if ($kls == "x") $angkatan = date('Y') - 1992;
        else if ($kls == "xi") $angkatan = (date('Y') - 1992) - 1;
        else if ($kls == "xii") $angkatan = (date('Y') - 1992) - 2;
        if ($nama == "" || $angkatan == "" || $jurusan == "" || $nkelas == "" || $barcode == "") {
            echo "onok sg gak lengkap";
            return false;
        } else {
            $where = [
                'nama_lengkap'  => $nama,
                'angkatan'      => $angkatan,
                'jurusan'       => $jurusan,
                'nomor_kelas'   => $nkelas
            ];
            $id = $this->GetData($where, 'siswa')->id_siswa;
            $this->db->insert('peminjaman', array(
                'tanggal'   => date('Y-m-d'),
                'id_siswa'  => $id,
                'barcode'   => $barcode
            ));
            if ($this->db->affected_rows() == 1) {
                $id_buku = $this->GetData(['barcode' => $barcode], 'barcode')->id_buku;
                $this->db->query("UPDATE buku SET jumlah = jumlah - 1 WHERE id_buku = '$id_buku'");
                if ($this->db->affected_rows() == 1) {
                    return true;
                } else {
                    // menghapus peminjaman yang buku gagal diperbarui
                    // $id = $this->GetLastId('id_peminjaman', 'peminjaman');
                    // $this->db->where('id_peminjaman', $id)->delete('peminjaman');
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function SetKembali($data)
    {
        $id_peminjaman = $data[0];
        $id_buku = $data[1];
        $denda = $data[2];

        $this->db->where('id_peminjaman', $id_peminjaman)->update('peminjaman', array(
            'kembali'   => 1,
            'denda'     => $denda
        ));
        if ($this->db->affected_rows() > 0) {
            $this->db->query("UPDATE buku SET jumlah = jumlah + 1 WHERE id_buku = '$id_buku'");
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function SetHilang($data)
    {
        $id_peminjaman = $data[0];
        $id_buku = $data[1];
        $denda = $data[2];

        $this->db->where('id_peminjaman', $id_peminjaman)->update('peminjaman', array(
            'kembali'   => 1,
            'denda'     => $denda
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetLastId($field, $table) {
        return $this->db->order_by($field, 'desc')->limit(1)->get($table)->row($field);
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMAadmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/M_Admin/:application/models/${1/(.+)/lMAadmin.php/}} */
