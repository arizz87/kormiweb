<?php
if (user()->level =="admin"){
?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="card">
  <div class="card-header bg-white" style=text-align:right>
    <a href="<?= base_url('admin/daftar-pertanyaan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-fw"></i> 
      Tambah Data
    </a>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <div class="row">
      <div class="col-md-5 float-right">
    </div>
    </div>  
    <div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th width=3% style=text-align:center>No</th>
        <th width=33% style=text-align:center>Pertanyaan</th>
        <th width=34% style=text-align:center>Jawaban</th>
        <th width=20% style=text-align:center>Keterangan</th>
        <th width=10% style=text-align:center>Action</th>  
      </tr>
      </thead>
      <tbody>

        <?php $no=1; foreach ($pertanyaan as $row): 
          
          if ($row['tampil']=="Ya"){
            $status="Ya";
          }else{
            $status="Tidak";  
          }
        ?>
          <tr>
        <th style=text-align:center><?= $no++ ?></th>
        <td><?= $row['pertanyaan'] ?></td> 
        <td><?= $row['jawaban'] ?></td>
        <td>Tampil di Web : <?=$status ?></td>
        <td style=text-align:center>
          <a href="<?= base_url('admin/daftar-pertanyaan/edit/').aes_encrypt_id($row['id_pertanyaan']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
          <a href="<?= base_url('admin/daftar-pertanyaan/delete/').aes_encrypt_id($row['id_pertanyaan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"><i class="fas fa-fw fa-trash"></i></a>
        </td>
      </tr>  

        <?php endforeach; ?>
      
      </tbody>
    </table>
    </div>
   </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<?php
}else{
?>        
<span style="color:red">Maaf anda tidak memiliki akses !</span>
<?php
}
?>  