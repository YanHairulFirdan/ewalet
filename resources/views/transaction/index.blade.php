@extends('layouts.app')

@section('title')
    <title>Transaksi Anda</title>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <h3>
                Transaksi
                {{-- <button>Tam</button> --}}
            </h3>

            <table id="transactions" class="mt-10 table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th>
                            no
                        </th>
                        <th>
                            Tanggal Transaksi
                        </th>
                        <th>
                            Pembeli
                        </th>
                        <th>
                            Berat
                        </th>
                        <th>
                            Harga Perkilo
                        </th>
                        <th>
                            Total Harga
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- insert modal --}}
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of insert modal --}}

    {{-- update modal --}}
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of update modal --}}

@endsection
@push('js')
    {{-- @include('layouts.datatable') --}}
    <script src="{{ asset('js/datatable.js') }}"></script>
@endpush
