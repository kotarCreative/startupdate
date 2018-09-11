@extends('layouts.app')

@section('content')
<div class="container">
    <companies-table :progress-types="{{ $progress_types }}" :verticals="{{ $verticals }}"></companies-table>
</div>
@endsection
