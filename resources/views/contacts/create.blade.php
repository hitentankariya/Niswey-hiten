@extends('layouts.app')

@section('content')
    <h1>Add New Contact</h1>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection