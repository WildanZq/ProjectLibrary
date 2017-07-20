<?php if(!empty($buku)): foreach($buku as $buku): ?>
<tr>
    <td><?php echo $buku->register; ?></td>
    <td><?php echo $buku->judul; ?></td>
    <td><?php echo $buku->pengarang; ?></td>
    <td><?php echo $buku->penerbit; ?></td>
    <td><?php echo $buku->tahun_terbit; ?></td>
    <td>
        <span class="return" onclick="editBuku()">Edit</span>
        <span class="return">Hapus</span>
    </td>
</tr>
<?php endforeach; else: ?>
<p>Book(s) not available.</p>
<?php endif; ?>
