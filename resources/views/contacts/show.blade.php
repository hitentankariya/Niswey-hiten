@extends('layouts.app')

@section('content')
    <h1>Contact Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $contact->name }}</h5>
            <p class="card-text"><strong>Phone:</strong> {{ $contact->phone }}</p>
            <p class="card-text"><small class="text-muted">Created: {{ $contact->created_at->format('M d, Y H:i') }}</small></p>
            <p class="card-text"><small class="text-muted">Updated: {{ $contact->updated_at->format('M d, Y H:i') }}</small></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection