@extends('layouts.app')

@section('content')
    <h1>Import Contacts from XML</h1>

    <form action="{{ route('contacts.importpost') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="xml_file" class="form-label">XML File</label>
            <input type="file" class="form-control" id="xml_file" name="xml_file" accept=".xml" required>
            <div class="form-text">Upload an XML file with contacts data.</div>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection