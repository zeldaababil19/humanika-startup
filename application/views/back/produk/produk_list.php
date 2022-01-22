<?php $this->load->view('back/meta') ?>
  <div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><?php echo $title ?></h1>
        <ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#"><?php echo $module ?></a></li>
					<li class="active"><?php echo $title ?></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12">
						<div class="box box-primary">
              <div class="box-body">
								<a href="<?php echo base_url('admin/produk/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
			          <a href="#" class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Refresh</a>
								<hr>
								<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <div class="table-responsive no-padding">
									<table id="datatable" class="table table-striped">
										<thead>
											<tr>
												<th style="text-align: center">No.</th>
												<th style="text-align: center">Judul Barang</th>
												<th style="text-align: center">Kategori</th>
												<th style="text-align: center">SubKategori</th>
												<th style="text-align: center">SuperSubKategori</th>
												<th style="text-align: center">Harga Normal</th>
                        <th style="text-align: center">Harga Diskon</th>
												<th style="text-align: center">Aksi</th>
											</tr>
										</thead>
										<tbody>
      
                    <?php $no=1; foreach ($produk_data as $produk):?>
                          <tr>
                            <td style="text-align:center"><?php echo $no++ ?></td>
                            <td style="text-align:left"><?php echo $produk->judul_produk ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_kategori ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_subkategori ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_supersubkategori ?></td>
                            <td style="text-align:center"><?php echo number_format($produk->harga_normal) ?></td>
                            <td style="text-align:center"><?php echo number_format($produk->harga_diskon) ?></td>
                            <td style="text-align:center">
                            <?php
                            echo anchor(site_url('admin/produk/update/'.$produk->id_produk),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                            echo anchor(site_url('admin/produk/delete/'.$produk->id_produk),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                            ?>
                            </td>
                          </tr>
                          <?php endforeach;?>
                          </tbody>
									</table>
                </div>
							</div>
						</div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div><!-- ./wrapper -->
  <?php $this->load->view('back/js') ?>
	<!-- DATA TABLES-->
  <link href="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript">
  var table;
  $(document).ready(function() {
    table = $('#datatable').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
      "aaSorting": [[0,'desc']],
      "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]],

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('admin/produk/ajax_list')?>",
        "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
      {
        "targets": [ -1 ], //last column
      },
      ],
    });
  });

  function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
  }
  </script>
</body>
</html>
