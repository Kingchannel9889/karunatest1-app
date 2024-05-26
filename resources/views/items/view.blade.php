@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Item Details</h2>
            <strong>Name:</strong> {{ $item->name }} <br>
            <strong>Price(RM):</strong> {{ $item->price }} <br>
            <strong>Details:</strong> {{ $item->details }} <br>
            <strong>Published:</strong> {{ $item->status ? 'Yes' : 'No' }} <br>
            <strong>Created At:</strong> {{ $item->created_at->format('Y-m-d H:i:s') }} <br>
            <strong>Updated At:</strong> {{ $item->updated_at->format('Y-m-d H:i:s') }} <br>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('items.index') }}" class="btn btn-danger">Discard</a>
        </div>
    </div>
</div>

@endsection
