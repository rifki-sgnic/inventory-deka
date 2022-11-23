@extends('layouts.main')

@section('main-content')

<div id="content-listbarang">
  <h1 class="h3 mb-2 text-gray-800">List Barang</h1>
  <p class="mb-4">Inventory <sup>App</sup></p>

  <div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">

      @if ($message = session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @elseif($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      <div class="d-flex flex-row mb-3">
        <button class="btn btn-sm btn-primary mx-1" data-toggle="modal" data-target="#modalTambahData"><i
            class="fa fa-plus text-white"></i> Tambah Data</button>
        <button class="btn btn-sm btn-success mx-1"><i class="fa fa-print text-white"></i> Cetak Data</button>
      </div>

      <div class="table-responsive-sm">
        <table id="tableListBarang" class="table table-bordered text-center table-hover w-100 table-sm">
          <thead bgcolor="eeeeee" align="center" class="w-100">
            <tr>
              <th>No.</th>
              <th>ID List</th>
              <th>Tanggal</th>
              <th>No Request Barang</th>
              <th>No Pre Order</th>
              <th>File</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal" id="modalTambahData">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Input List Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form action="{{ route("list-barang.tambah") }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="no_request_product">No Request Barang</label>
              <input type="text" name="no_request_product" placeholder="No Request Barang" class="form-control">
            </div>
            <div class="form-group">
              <label for="no_pre_order">No Pre Order</label>
              <input type="text" name="no_pre_order" placeholder="No Pre Order" class="form-control">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="">Pilih Status ...</option>
                <option value="receive">Receive</option>
                <option value="indend">Indend</option>
              </select>
            </div>
            <div class="form-group">
              <label for="created_at">Tanggal</label>
              <input type="date" name="created_at" placeholder="tanggal" class="form-control">
            </div>
            <label for="fileInput">File</label>
            <div id="fileInput" class="custom-file">
              <input type="file" class="form-control" name="file" id="file" accept="application/pdf" required>
              <label class="custom-file-label" for="file">Choose file</label>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <!-- Modal Ubah Data -->
  <div class="modal" id="modalUpdateData">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update List Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form action="{{ route("list-barang.update") }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="no_request_product">No Request Barang</label>
              <input type="text" name="no_request_product" placeholder="No Request Barang" class="form-control">
            </div>
            <div class="form-group">
              <label for="no_pre_order">No Pre Order</label>
              <input type="text" name="no_pre_order" placeholder="No Pre Order" class="form-control">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control" required>
                <option value="">Pilih Status ...</option>
                <option value="receive">Receive</option>
                <option value="indend">Indend</option>
              </select>
            </div>
            <div class="form-group">
              <label for="created_at">Tanggal</label>
              <input type="date" name="created_at" placeholder="tanggal" class="form-control">
            </div>
            <label for="fileInput">File</label>
            <div id="fileInput" class="custom-file">
              <input type="file" class="form-control" name="file" id="file" accept="application/pdf">
              <label class="custom-file-label" for="file">Choose file</label>
            </div>
            <input type="hidden" name="id" required readonly>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <!-- Modal Hapus Data -->
  <div class="modal" id="modalHapusData">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p class="my-2">Apakah Anda yakin ingin menghapus data "<strong class="text-dark"></strong>"?</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{ route('list-barang.hapus') }}" method="POST">
            @csrf
            <input type="hidden" name="id" required readonly>
            <button type="submit" class="btn btn-primary">Hapus</button>
          </form>
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
                  <div class=" form-group">:</div>
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

@endsection
