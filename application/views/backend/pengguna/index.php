<?php
if (user()->level =="admin"){
?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="card">
  <div class="card-header bg-white" style=text-align:right>
    <a href="<?= base_url('admin/data-pengguna/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-fw"></i> 
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
        <th width=26% style=text-align:center>Username</th>
        <th width=26% style=text-align:center>Nama Pengguna</th>
        <th width=23% style=text-align:center>Email</th>
        <th width=12% style=text-align:center>Level</th>
        <th width=10% style=text-align:center>Action</th>  
      </tr>
      </thead>
      <tbody>

        <?php $no=1; foreach ($pengguna as $row): 
          
          if ($row['level']=="admin"){
            $status="admin";
          }else{
            $status="user";  
          }
        ?>
          <tr>
        <th style=text-align:center><?= $no++ ?></th>
        <td><?= $row['username'] ?></td> 
        <td><?= $row['nama_pengguna'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?=$status ?></td>
        <td style=text-align:center>
          <a href="<?= base_url('admin/data-pengguna/edit/').aes_encrypt_id($row['id_user']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
          <?php
          if ($row['username']=="admin"){
          ?>
          <button type=button class="btn btn-secondary btn-sm" disabled title="Terkunci"><i class="fas fa-lock"></i></button>
          <?php
          }else{
          ?>
          <a href="<?= base_url('admin/data-pengguna/delete/').aes_encrypt_id($row['id_user']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"><i class="fas fa-fw fa-trash"></i></a>
          <?php
          }
          ?>
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