<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Admin extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function setLoggedUser()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->db->where('username', $username)
                            ->where('password', $password)
                            ->get('anggota');
        if ($result->num_rows() === 1) {
            $array = array(
                md5('logged_in')         => true,
                md5('logged_role')       => $result->row()->role,
                md5('logged_admin_id')   => $result->row()->id_anggota
            );
            $this->session->set_userdata( $array );
            return true;
        } else {
            return false;
        }
    }

    public function GetAllData($table)
    {
        return $this->db->get($table)->result();
    }

    public function GetWhereAllData($where, $table)
    {
        return $this->db->where($where)->get($table)->result();
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
        return $this->db->query("SELECT * FROM peminjaman INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
            INNER JOIN barcode ON peminjaman.barcode = barcode.barcode INNER JOIN buku ON
            barcode.id_buku = buku.id_buku WHERE $where")->result();
    }

    public function GetSpecificSiswa($where)
    {
        return $this->db->query("SELECT * FROM anggota WHERE $where")->result();
    }

    public function Delete($where, $table)
    {
        $this->db->where($where)->delete($table);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ChangeSetting($field)
    {
        $this->db->update('setting', $field);
        return true;
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
            return false;
        } else {
            $where = [
                'nama_lengkap'  => $nama,
                'angkatan'      => $angkatan,
                'jurusan'       => $jurusan,
                'nomor_kelas'   => $nkelas
            ];
            $id = $this->GetData($where, 'anggota')->id_anggota;
            $this->db->insert('peminjaman', array(
                'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
                'tanggal'       => date('Y-m-d'),
                'deadline'      => date('Y-m-d', strtotime("+1 week")),
                'id_anggota'    => $id,
                'barcode'       => $barcode
            ));
            if ($this->db->affected_rows() == 1) {
                $id_buku = $this->GetData(['barcode' => $barcode], 'barcode')->id_buku;
                $this->db->query("UPDATE buku SET jumlah = jumlah - 1 WHERE id_buku = '$id_buku'");
                if ($this->db->affected_rows() == 1) {
                    $this->db->insert('laporan', array(
                        'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
                        'tanggal'       => date('Y-m-d'),
                        'keterangan'    => 'melayani peminjaman buku'
                    ));
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
        $data_peminjaman = $this->GetData(['id_peminjaman' => $id_peminjaman], 'peminjaman');
        $id_buku = $this->GetData(array('barcode' => $data_peminjaman->barcode), 'barcode')->id_buku;
        $denda = $data[1];

        $this->db->where('id_peminjaman', $id_peminjaman)->update('peminjaman', array(
            'kembali'   => 1
        ));
        $this->db->insert('pengembalian', array(
            'id_peminjaman' => $id_peminjaman,
            // 'id_pengurus'   => $data_peminjaman->id_pengurus,
            'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
            'tgl_kembali'   => date('Y-m-d'),
            'denda'         => $denda
        ));
        if ($this->db->affected_rows() > 0) {
            $this->db->query("UPDATE buku SET jumlah = jumlah + 1 WHERE id_buku = '$id_buku'");
            if ($this->db->affected_rows() > 0) {
                $this->db->insert('laporan', array(
                    'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
                    'tanggal'       => date('Y-m-d'),
                    'keterangan'    => 'melayani pengembalian buku'
                ));
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
        $data_peminjaman = $this->GetData(['id_peminjaman' => $id_peminjaman], 'peminjaman');
        $id_buku = $this->GetData(array('barcode' => $data_peminjaman->barcode), 'barcode')->id_buku;
        $denda = $data[1];

        $this->db->where('id_peminjaman', $id_peminjaman)->update('peminjaman', array(
            'kembali'   => 1
        ));
        $this->db->insert('pengembalian', array(
            'id_peminjaman' => $id_peminjaman,
            'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
            'tgl_kembali'   => date('Y-m-d'),
            'denda'         => $this->GetDataSetting()->hilang
        ));
        if ($this->db->affected_rows() > 0) {
            $this->db->insert('laporan', array(
                'id_pengurus'   => $this->session->userdata(md5('logged_admin_id')),
                'tanggal'       => date('Y-m-d'),
                'keterangan'    => 'melayani buku hilang'
            ));
            return true;
        } else {
            return false;
        }
    }

    public function GetLastId($field, $table) {
        return $this->db->order_by($field, 'desc')->limit(1)->get($table)->row($field);
    }

    public function addBuku($barcode) {
        $count = 0;
        foreach ($barcode as $bar) {
            $count += $this->db->where('barcode', $bar)->get('barcode')->num_rows();
        }
        if ($count > 0) {
            return false;
        } else {
            $this->db->insert('buku', array(
                'register'      => $this->input->post('register'),
                'judul'         => $this->input->post('judul'),
                'pengarang'     => $this->input->post('pengarang'),
                'penerbit'      => $this->input->post('penerbit'),
                'tahun_terbit'  => $this->input->post('tahun'),
                'jumlah'        => count($barcode)
            ));
            $insert_id = $this->db->insert_id();
            for ($i=0; $i < count($barcode); $i++) {
                $this->db->insert('barcode', array(
                    'id_buku'   => $insert_id,
                    'barcode'   => $barcode[$i],
                    'checked'   => 1
                ));
            }
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updateBuku($barcode) {
        $id = $this->input->post('id');
        $count = 0;
        foreach ($barcode as $bar) {
            $count += $this->db->where('barcode', $bar)->where('id_buku !=', $id)->get('barcode')->num_rows();
        }
        if ($count > 0) {
            return false;
        } else {
            $this->db->where('id_buku', $id)->update('buku', array(
                'register'      => $this->input->post('register'),
                'judul'         => $this->input->post('judul'),
                'pengarang'     => $this->input->post('pengarang'),
                'penerbit'      => $this->input->post('penerbit'),
                'tahun_terbit'  => $this->input->post('tahun'),
                'jumlah'        => $this->input->post('jumlah')
            ));
            $total_last_barcode = $this->db->where('id_buku', $id)->get('barcode')->num_rows();
            $total_new_barcode = count($barcode);
            $this->db->where('id_buku', $id)->delete('barcode');
            for ($i=0; $i < $total_new_barcode; $i++) {
                $this->db->insert('barcode', array(
                    'id_buku'   => $id,
                    'barcode'   => $barcode[$i],
                    'checked'   => 1
                ));
            }
            $total_barcode = $total_new_barcode - $total_last_barcode;
            if ($total_barcode != 0) {
                $query = "UPDATE buku SET jumlah = jumlah + $total_barcode WHERE id_buku = '$id' and jumlah > 0";
                $this->db->query($query);
            }
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function addEvent($foto)
    {
        $this->db->insert('event', array(
            'judul_event'   => $this->input->post('judul'),
            'foto_event'    => $foto['file_name'],
            'tgl_mulai'     => $this->input->post('tgl_mulai'),
            'tgl_akhir'     => $this->input->post('tgl_akhir'),
            'konten'        => $this->input->post('konten')
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetBook($params = array()) {
        if (!empty($params['data'])) $data = $params['data'];
        else $data = "";

        $field = ['judul', 'register', 'pengarang', 'penerbit', 'tahun_terbit'];
        $kondisi = array();
        foreach ($field as $as) {
            $kondisi[] = "$as LIKE '$data%'";
        }
        $query = "SELECT * FROM buku";
        if (count($kondisi) > 0) {
            $query .= " WHERE ".implode(' OR ', $kondisi);
        }
        //set start and limit
        if (array_key_exists("start",$params) && array_key_exists("limit",$params)) {
            $query .= " LIMIT ".$params['start'].", ".$params['limit'];
        } elseif (!array_key_exists("start",$params) && array_key_exists("limit",$params)) {
            $query .= " LIMIT ".$params['limit'];
        }
        return $this->db->query($query)->result();
    }

    public function GetSiswa($params = array()) {
        if (!empty($params['data'])) $data = $params['data'];
        else $data = "";

        $field = ['nama_lengkap', 'angkatan', 'jurusan', 'nomor_kelas', 'poin'];
        $kondisi = array();
        foreach ($field as $as) {
            $kondisi[] = "$as LIKE '$data%'";
        }
        $query = "SELECT * FROM anggota";
        if (count($kondisi) > 0) {
            $query .= " WHERE ".implode(' OR ', $kondisi);
        }
        //set start and limit
        if (array_key_exists("start",$params) && array_key_exists("limit",$params)) {
            $query .= " LIMIT ".$params['start'].", ".$params['limit'];
        } elseif (!array_key_exists("start",$params) && array_key_exists("limit",$params)) {
            $query .= " LIMIT ".$params['limit'];
        }
        return $this->db->query($query)->result();
    }

    public function addSiswa() {
        $this->db->insert('anggota', array(
            'nama_lengkap'  => $this->input->post('nama'),
            'foto'          => $this->input->post('foto') ? $this->input->post('foto') : 'logo.png',
            'poin'          => $this->input->post('poin') ? $this->input->post('poin') : 0,
            'role'          => $this->input->post('role') ? $this->input->post('role') : 'anggota',
            'username'      => $this->input->post('username') ? $this->input->post('username') : '',
            'password'      => $this->input->post('password') ? $this->input->post('password') : '',
            'angkatan'      => $this->input->post('angkatan'),
            'jurusan'       => $this->input->post('jurusan'),
            'nomor_kelas'   => $this->input->post('nomor_kelas')
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSiswa() {
        $id = $this->input->post('id');
        if ($this->db->where('username', $this->input->post('username'))->get('anggota')->num_rows() > 0) {
            return false;
        } else {
            $this->db->where('id_anggota', $id)->update('anggota', array(
                'nama_lengkap'  => $this->input->post('nama'),
                'foto'          => $this->input->post('foto') ? $this->input->post('foto') : 'logo.png',
                'poin'          => $this->input->post('poin') ? $this->input->post('poin') : 0,
                'role'          => $this->input->post('role') ? $this->input->post('role') : 'anggota',
                'username'      => $this->input->post('username'),
                'password'      => $this->input->post('password'),
                'angkatan'      => $this->input->post('angkatan'),
                'jurusan'       => $this->input->post('jurusan'),
                'nomor_kelas'   => $this->input->post('nomor_kelas')
            ));
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function GetEvent($where)
    {
        return $this->db->query("SELECT * FROM event WHERE $where")->result();
    }

    public function DeleteData($key, $table) {
        if ($table == 'event') {
            $where = [ 'id_event' => $key ];
            $current_file = $this->GetData($where, $table)->foto_event;
            $path = './assets/images/event/'.$current_file;
            $this->db->where($where)->delete('event');
            unlink($path);
        } elseif ($table == 'buku') {
            $where = [ 'id_buku' => $key ];
            $this->db->where($where)->delete('buku');
            $this->db->where($where)->delete('barcode');
        } elseif ($table == 'anggota') {
            $where = [ 'id_anggota' => $key ];
            $current_file = $this->GetData($where, $table)->foto;
            $path = './assets/images/siswa/'.$current_file;
            $this->db->where($where)->delete('anggota');
            unlink($path);
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetLaporan($case) {
        if ($case == 'all') {
            $peminjaman = $this->GetWhereAllData([ 'kembali' => 0 ], 'peminjaman');
            $pengembalian = $this->GetAllData('pengembalian');
            $jml_peminjaman = [];
            $jml_pengembalian = [];
            $month = (int) date('m');
            foreach ($peminjaman as $peminjaman) {
                if (date('Y') == date('Y', strtotime($peminjaman->tanggal))) {
                    for ($i = 1; $i <= $month; $i++) {
                        $x = sprintf("%02d", $i);
                        if (date('m', strtotime($peminjaman->tanggal)) == $x) $jml_peminjaman[$i-1][] = 1;
                    }
                }
            }
            foreach ($pengembalian as $pengembalian) {
                if (date('Y') == date('Y', strtotime($pengembalian->tgl_kembali))) {
                    for ($i = 1; $i <= $month; $i++) {
                        $x = sprintf("%02d", $i);
                        if (date('m', strtotime($pengembalian->tgl_kembali)) == $x) $jml_pengembalian[$i-1][] = 1;
                    }
                }
            }
            $peminjaman = "";
            $pengembalian = "";
            for ($i=0; $i < $month; $i++) {
                if (empty($jml_peminjaman[$i])) $jml_peminjaman[$i] = 0;
                if (empty($jml_pengembalian[$i])) $jml_pengembalian[$i] = 0;
                $count = 0;
                for ($x=0; $x < count($jml_peminjaman[$i]); $x++) {
                    if ($jml_peminjaman[$i] != 0) $count++;
                }
                $peminjaman .= $count."|";
                $count = 0;
                for ($x=0; $x < count($jml_pengembalian[$i]); $x++) {
                    if ($jml_pengembalian[$i] != 0) $count++;
                }
                $pengembalian .= $count."|";
            }
            $peminjaman = rtrim($peminjaman, "|");
            $pengembalian = rtrim($pengembalian, "|");
            return [$peminjaman, $pengembalian];
        } elseif ($case == 'denda') {
            $data = $this->GetAllData('pengembalian');
            $jml_denda = [];
            $month = (int) date('m');
            foreach ($data as $data) {
                if (date('Y') == date('Y', strtotime($data->tgl_kembali))) {
                    for ($i = 1; $i <= $month; $i++) {
                        $x = sprintf("%02d", $i);
                        if (date('m', strtotime($data->tgl_kembali)) == $x) $jml_denda[$i-1][] = $data->denda;
                    }
                }
            }
            $data = "";
            for ($i=0; $i < $month; $i++) {
                if (empty($jml_denda[$i])) $jml_denda[$i] = 0;
                $denda = 0;
                for ($x=0; $x < count($jml_denda[$i]); $x++) {
                    if ($jml_denda[$i] != 0) $denda += $jml_denda[$i][$x];
                }
                $data .= $denda."|";
            }
            $data = rtrim($data, "|");
            return $data;
        } elseif ($case == 'peminjaman') {
            $peminjaman = $this->GetWhereAllData([ 'kembali' => 0 ], 'peminjaman');
            $jml_peminjamanx = [];
            $jml_peminjamanxi = [];
            $jml_peminjamanxii = [];
            $month = (int) date('m');
            foreach ($peminjaman as $peminjaman) {
                if (date('Y') == date('Y', strtotime($peminjaman->tanggal))) {
                    $kls = $this->GetData([ 'id_anggota' => $peminjaman->id_anggota ], 'anggota')->angkatan;
                    $kls = $kls + 1992;
                    $tahun = (int) date('Y');
                    if ($kls == $tahun) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($peminjaman->tanggal)) == $x) $jml_peminjamanx[$i-1][] = 1;
                        }
                    } elseif ($kls == $tahun - 1) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($peminjaman->tanggal)) == $x) $jml_peminjamanxi[$i-1][] = 1;
                        }
                    } elseif ($kls == $tahun - 2) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($peminjaman->tanggal)) == $x) $jml_peminjamanxii[$i-1][] = 1;
                        }
                    }
                }
            }
            $peminjamanx = "";
            $peminjamanxi = "";
            $peminjamanxii = "";
            for ($i=0; $i < $month; $i++) {
                if (empty($jml_peminjamanx[$i])) $jml_peminjamanx[$i] = 0;
                if (empty($jml_peminjamanxi[$i])) $jml_peminjamanxi[$i] = 0;
                if (empty($jml_peminjamanxii[$i])) $jml_peminjamanxii[$i] = 0;
                $count = 0;
                for ($x=0; $x < count($jml_peminjamanx[$i]); $x++) {
                    if ($jml_peminjamanx[$i] != 0) $count++;
                }
                $peminjamanx .= $count."|";
                $count = 0;
                for ($x=0; $x < count($jml_peminjamanxi[$i]); $x++) {
                    if ($jml_peminjamanxi[$i] != 0) $count++;
                }
                $peminjamanxi .= $count."|";
                $count = 0;
                for ($x=0; $x < count($jml_peminjamanxii[$i]); $x++) {
                    if ($jml_peminjamanxii[$i] != 0) $count++;
                }
                $peminjamanxii .= $count."|";
            }
            $peminjamanx = rtrim($peminjamanx, "|");
            $peminjamanxi = rtrim($peminjamanxi, "|");
            $peminjamanxii = rtrim($peminjamanxii, "|");
            return [$peminjamanx, $peminjamanxi, $peminjamanxii];
        } elseif ($case == 'pengembalian') {
            $pengembalian = $this->GetAllData('pengembalian');
            $jml_pengembalianx = [];
            $jml_pengembalianxi = [];
            $jml_pengembalianxii = [];
            $month = (int) date('m');
            $a = "";
            foreach ($pengembalian as $pengembalian) {
                if (date('Y') == date('Y', strtotime($pengembalian->tgl_kembali))) {
                    $id_anggota = $this->db->where(['id_peminjaman' => $pengembalian->id_peminjaman])->get('peminjaman')->row('id_anggota');
                    $kls = $this->db->where(['id_anggota' => $id_anggota])->get('anggota')->row('angkatan');
                    $kls = $kls + 1992;
                    $tahun = (int) date('Y');
                    if ($kls == $tahun) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($pengembalian->tgl_kembali)) == $x) $jml_pengembalianx[$i-1][] = 1;
                        }
                    } elseif ($kls == $tahun - 1) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($pengembalian->tgl_kembali)) == $x) {
                                $jml_pengembalianxi[$i-1][] = 1;
                            }
                        }
                    } elseif ($kls == $tahun - 2) {
                        for ($i = 1; $i <= $month; $i++) {
                            $x = sprintf("%02d", $i);
                            if (date('m', strtotime($pengembalian->tgl_kembali)) == $x) $jml_pengembalianxii[$i-1][] = 1;
                        }
                    }
                }
            }
            $pengembalianx = "";
            $pengembalianxi = "";
            $pengembalianxii = "";
            for ($i=0; $i < $month; $i++) {
                if (empty($jml_pengembalianx[$i])) $jml_pengembalianx[$i] = 0;
                if (empty($jml_pengembalianxi[$i])) $jml_pengembalianxi[$i] = 0;
                if (empty($jml_pengembalianxii[$i])) $jml_pengembalianxii[$i] = 0;
                $count = 0;
                for ($x=0; $x < count($jml_pengembalianx[$i]); $x++) {
                    if ($jml_pengembalianx[$i] != 0) $count++;
                }
                $pengembalianx .= $count."|";
                $count = 0;
                for ($x=0; $x < count($jml_pengembalianxi[$i]); $x++) {
                    if ($jml_pengembalianxi[$i] != 0) $count++;
                }
                $pengembalianxi .= $count."|";
                $count = 0;
                for ($x=0; $x < count($jml_pengembalianxii[$i]); $x++) {
                    if ($jml_pengembalianxii[$i] != 0) $count++;
                }
                $pengembalianxii .= $count."|";
            }
            $pengembalianx = rtrim($pengembalianx, "|");
            $pengembalianxi = rtrim($pengembalianxi, "|");
            $pengembalianxii = rtrim($pengembalianxii, "|");
            return [$pengembalianx, $pengembalianxi, $pengembalianxii];
        }
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMAadmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/M_Admin/:application/models/${1/(.+)/lMAadmin.php/}} */
