<?php if(!empty($siswa)): foreach($siswa as $siswa): ?>
<tr>
    <td><?php echo $siswa->nama_lengkap; ?></td>
    <td><?php echo $siswa->angkatan; ?></td>
    <td><?php echo $siswa->jurusan; ?></td>
    <td><?php echo $siswa->nomor_kelas; ?></td>
    <td><?php echo $siswa->poin; ?></td>
    <td>
        <span class="return" onclick="editSiswa(<?= $siswa->id_anggota; ?>)">Edit</span>
        <span class="return" onclick="hapusSiswa(<?= $siswa->id_anggota; ?>)">Hapus</span>
    </td>
</tr>
<?php endforeach; else: ?>
<p>Member(s) not available.</p>
<?php endif; ?>
