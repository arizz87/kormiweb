<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="card">
  <div class="card-header bg-white" style=text-align:right>
    <a href="<?= base_url('admin/video/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-fw"></i> 
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
        <th style=text-align:center>Judul Video</th>
        <th width=20% style=text-align:center>Link Video</th>
        <th width=10% style=text-align:center>Gambar Cover</th>
        <th width=20% style=text-align:center>Keterangan</th>
        <th width=10% style=text-align:center>Action</th>  
      </tr>
      </thead>
      <tbody>

        <?php $no=1; foreach ($video as $row): 
          
          if ($row['tampil']=="Ya"){
            $status="Ya";
          }else{
            $status="Tidak";  
          }
        ?>
          <tr>
        <th style=text-align:center><?= $no++ ?></th>
        <td><?= $row['judul_video'] ?></td>
        <td><b><?= $row['link_video'] ?></b><div style=color:brown>Nama File : <?= $row['nama_file'] ?></td>
        <td style=text-align:center>
          <?php
          if(!empty($row['video_img'])){
          ?>
          <img src="<?= base_url() ?>home/image/<?= $row['video_img'] ?>" class="img-responsive padding-right-10" style=width:100px><p>
          <?php
          }
          ?> 
        </td>
        <td><?= '<b>Tampil di Web : '.$status ?></td>
        <td style=text-align:center>
          <a href="<?= base_url('admin/video/edit/').aes_encrypt_id($row['id_video']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
          <a href="<?= base_url('admin/video/delete/').aes_encrypt_id($row['id_video']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"><i class="fas fa-fw fa-trash"></i></a>
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