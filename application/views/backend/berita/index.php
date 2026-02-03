<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="card">
  <div class="card-header bg-white" style=text-align:right>
    <a href="<?= base_url('admin/berita/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-fw"></i> 
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
        <th style=text-align:center>Judul Berita/ Artikel</th>
        <th width=10% style=text-align:center>Gambar</th>
        <th width=20% style=text-align:center>Author</th>
        <th width=10% style=text-align:center>Action</th>  
      </tr>
      </thead>
      <tbody>

        <?php $no=1; foreach ($blogs as $row): 
          
          if ($row['posting']=="Posting"){
            $status="Posting";
          }else{
            $status="Draft";  
          }
        ?>
          <tr>
        <th style=text-align:center><?= $no++ ?></th>
        <td><?= $row['blog_title'].'<br><font style=font-size:12px;color:brown><i class="fa fa-clock"></i> '.format_indo($row['blog_tgl']) ?></td>
        <td style=text-align:center>
          <?php
          if(!empty($row['blog_img'])){
          ?>
          <img src="<?= base_url() ?>home/image/<?= $row['blog_img'] ?>" class="img-responsive padding-right-10" style=width:100px><p>
          <?php
          }
          ?> 
        </td>
        <td><?= $row['blog_author'].'<br><b>Status : '.$status ?></td>
        <td style=text-align:center>
          <a href="<?= base_url('admin/berita/edit/').aes_encrypt_id($row['id_blog']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
          <a href="<?= base_url('admin/berita/delete/').aes_encrypt_id($row['id_blog']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"><i class="fas fa-fw fa-trash"></i></a>
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