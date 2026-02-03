<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>    
<?php endif ?>
<?php
    if (user()->level =="admin"){
?> 
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Berita/ Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count_data('tbl_blog') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Galeri Photo</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count_data('tbl_galeri') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-camera fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Galeri Video
                        </div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count_data('tbl_video') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-play fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count_data('tbl_user') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<?php
 }
?> 
<div class="row mt-4">
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-dark" style=color:white>Log Aktifitas</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style=text-align:center>No</th>
                        <th><center>Aktifitas Pengguna</th>
                        <th><center>User</th>
                        <th><center>Tanggal dan Waktu</th>
                        <th><center>Metode</th>
                        <th><center>Browser Pengguna</th>
                      </tr>
                      </thead>
                      <tbody> 
                        <?php  
                        $username=user()->username;
                        $level=user()->level;
                        if ($level=="admin"){ 
		                $logactivity= $this->db->query("SELECT * FROM tbl_log_activity ORDER BY created_at DESC")->result_array(); 
                        }else{
		                $logactivity= $this->db->query("SELECT * FROM tbl_log_activity WHERE log_activity_user= '$username' ORDER BY created_at DESC")->result_array(); 
                        }
                        $no=1; foreach ($logactivity as $row): ?>
                        <tr>
                        <td align=center width=3%><?= $no++ ?></th>
                        <td width=32%><?= $row['log_activity_name'] ?></td>
                        <td width=12%><?= $row['log_activity_user'] ?></td>
                        <td width=15% style=font-size:14px>
                          <?= format_indo5($row['created_at']) ?>
                        </td>
                        <td width=16%><?= $row['metode'] ?></td>
                        <td width=22% style=font-size:13px><?= $row['browser_pengguna'] ?></td>
                      </tr>   
                        <?php endforeach; ?> 
                      </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>  
</div>