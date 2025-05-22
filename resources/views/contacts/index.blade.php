@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Contacts</h1>
                    <div>
                        <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Contact
                        </a>
                        <a href="{{ route('contacts.import') }}" class="btn btn-success">
                            <i class="fas fa-file-import"></i> Import XML
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <table id="contacts-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    {{-- DataTables Scripts --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
$(document).ready(function(){
    $('#contacts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('contacts.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection