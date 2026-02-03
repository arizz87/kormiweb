<?php
if (user()->level =="admin"){
?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="card"> 
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
        <th style=text-align:center>Judul Video</th>
        <th width=30% style=text-align:center>Link Video</th>
        <th width=30% style=text-align:center>Kata Sambutan</th> 
        <th width=10% style=text-align:center>Action</th>  
      </tr>
      </thead>
      <tbody>

        <?php $no=1; foreach ($video as $row): 
        ?>
          <tr>
        <th style=text-align:center><?= $no++ ?></th>
        <td><?= $row['judul_video'] ?></td>
        <td><b><?= $row['link_video'] ?></b><div style=color:brown>Nama File : <?= $row['nama_file'] ?></td> 
        <td><?= $row['sambutan'] ?></td>
        <td style=text-align:center>
          <a href="<?= base_url('admin/video-header/edit/').aes_encrypt_id($row['id_video']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Update</a>
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