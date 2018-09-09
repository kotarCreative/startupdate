@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <edit-user-profile :company="{{ $company }}" :metrics="{{ $metrics }}" :profile="{{ $user }}" :progress-types="{{ $progress_types }}" :verticals="{{ $verticals }}"></edit-user-profile>
        </div>
    </div>
</div>
@endsection
