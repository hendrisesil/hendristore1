@extends('Layouts.Master')

@section('title')
Daftar Produk
@endsection

@section('breadcrumb')
@parent
<li class="active">Daftar Produk</li>
@endsection

@section('content')

<!-- Main row -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button href="{{route('produk.store')}}" onclick="addForm()" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah Produk</button>
                    <button id="bulk_delete" onclick="deleteSelected()" class="btn btn-danger btn-xs btn-flat" href="{{route('produk.delete_selected')}}"><i class="fa fa-trash"></i>Hapus</button>
                    <button onclick=" cetakBarcode()" href="{{route('produk.cetak_barcode')}}" class=" btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i>Cetak Barcode</button>
                </div>
                <!-- <a href="{{route('kategori.store')}}" onclick="addForm()"><i class="fa fa-plus-circle"></i> Tambah kategori</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-produk">
                    @csrf
                    <table id="produk_table" class="table table-stiped table-bordered">
                        <thead>
                            <th>
                                <input type="checkbox" name="select_all" id="select_">
                            </th>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Harga Beli</th>
                            <th>Diskon</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@includeIf('produk.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function() {
        table = $('#produk_table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: "{{route('produk.data')}}",
            },
            columns: [{
                    data: 'select_all',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'kode_produk'
                },
                {
                    data: 'nama_produk'
                },
                {
                    data: 'nama_kategori'
                },
                {
                    data: 'merk'
                },
                {
                    data: 'harga_beli'
                },
                {
                    data: 'diskon'
                },
                {
                    data: 'harga_jual'
                },
                {
                    data: 'stok'
                },
                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ],

        });
        $('#modal-form').validator().on('submit', function(e) {
            if (!e.preventDefault()) {
                $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: 'post',
                        data: $('#modal-form form').serialize()
                    })
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('tidak dapat menyimpan data');
                        return;
                    });
            }
        });
        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form.modal-title').text('Tambah Produk');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_produk]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form.modal-title').text('Edit Produk');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_produk]').val(response.nama_produk);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=merk]').val(response.merk);
                $('#modal-form [name=harga_beli]').val(response.harga_beli);
                $('#modal-form [name=diskon]').val(response.diskon);
                $('#modal-form [name=harga_jual]').val(response.harga_jual);
                $('#modal-form [name=stok]').val(response.stok);
            })
            .fail((errors) => {
                alert('tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('yakin akan menghapus data terpilih ?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('tidak dapat menghapus data');
                    return;
                });
        }
    }

    $(document).on('click', '#bulk_delete', function() {
        var id = [];
        console.log($('#select_allx:checked').val());
        if (confirm("Are you sure you want to Delete this data?")) {
            $('.form-produk:checked').each(function() {
                id.push($(this).val());
            });
            if (id.length > 0) {
                $.ajax({
                    url: "{{ route('produk.delete_selected')}}",
                    method: "post",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        alert(data);
                        $('#produk_table').DataTable().ajax.reload();
                    }
                });
            } else {
                alert("Please select atleast one checkbox");
            }
        }
        // if ($('input:checked').length > 1) {
        //     if (confirm('Yakin ingin menghapus data terpilih?')) {
        //         $.post(url, $('.form-produk').serialize())
        //             .done((response) => {
        //                 table.ajax.reload();
        //             })
        //             .fail((errors) => {
        //                 alert('Tidak dapat menghapus data');
        //                 return;
        //             });
        //     }
        // } else {
        //     alert('Pilih data yang akan dihapus');
        //     return;
        // }
    });

    function cetakBarcode(url) {
        if ($('input:checked').length < 1) {
            alert('pilih data yang akan dicetak');
            return;
        } else if ($('input:checked').length < 3) {
            alert('pilih minimal 3 data untuk dicetak');
            return;
        } else {
            $('.form-produk')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>


@endpush