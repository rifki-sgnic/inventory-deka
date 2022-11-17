@extends('layouts.main')

@section('main-content')

<div id="content-barangreturn">
  <h1 class="h3 mb-2 text-gray-800">Data Barang Return</h1>
  <p class="mb-4">Inventory <sup>App</sup></p>

  <div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">

      <div class="d-flex flex-row mb-3">
        <button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalTambahData">Tambah Data</button>
        <button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalCetakPdf">Cetak Data</button>
      </div>

      <div class="table-responsive">
        <table id="tableBarangReturn" class="table table-bordered table-hover">
          <thead bgcolor="eeeeee" align="center">
            <tr>
              <th>Id Transaksi</th>
              <th>Tanggal</th>
              <th>kd produk</th>
              <th>Type</th>
              <th>Qty</th>
              <th>Supplier</th>
              <th>Note</th>
              <th class="text-center"> Action </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal" id="modalTambahData">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Input Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label for="id">ID Transaksi</label>
            <input type="text" name="id" placeholder="id" class="form-control">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" placeholder="tanggal" class="form-control">
          </div>
          <div class="form-group">
            <label for="kd produk">KD Produk</label>
            <select name="kd produk" class="form-control" required>
              <option value="#">pilih produk</option>
              <option value="RAM">External Hardisk</option>
              <option value="RAM">RAM</option>
              <option value="RAM">Mouse</option>
              <option value="RAM">Batre</option>
            </select>
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" placeholder="type" class="form-control">
          </div>
          <div class="form-group">
            <label for="qty">QTY</label>
            <input type="number" name="qty" placeholder="qty" class="form-control">
          </div>
          <div class="form-group">
            <label for="kd supplier">Supplier</label>
            <input type="text" name="kd supplier" placeholder="kd supplier" class="form-control">
          </div>
          <div class="form-group">
            <label for="note">Noted</label>
            <input type="text" name="Note" placeholder="Note" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        </div>

      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="modalCetakPdf">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cetak PDF</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./report/cetak_barang.php" method="post" target="_blank">
            <table>
              <tr>
                <td>
                  <div class="form-group">Nama Produk</div>
                </td>
                <td align="center" width="5%"">
                  <div class=" form-group">:
        </div>
        </td>
        <td>
          <select name="satuan" class="form-control" required>
            <option value="#">All Item</option>
            <option value="RAM">External Hardisk</option>
            <option value="RAM">RAM</option>
            <option value="RAM">Mouse</option>
            <option value="RAM">Batre</option>
          </select>
        </td>
        </tr>
        <tr>
          <td>
            <div class="form-group">Dari Tanggal</div>
          </td>
          <td align="center" width="5%">
            <div class="form-group">:
            </div>
          </td>
          <td>
            <input type="date" class="form-control" name="tgl_a" required>
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group">Sampai Tanggal</div>
          </td>
          <td align="center" width="5%">
            <div class=" form-group">:</div>
          </td>
          <td>
            <input type="date" class="form-control" name="tgl_a" required>
          </td>
        </tr>
        </table>
        </form>
      </div>

      <div class="modal-footer">
        <a href="./report/cetak_barang.php" target="_blank" class="btn btn-primary">Cetak Semua Data</a>
      </div>
    </div>
  </div>
</div>

</div>

@endsection