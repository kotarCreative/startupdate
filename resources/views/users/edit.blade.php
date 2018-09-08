@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <edit-user-profile :profile="{{ $user }}" :company="{{ $company }}" :verticals="{{ $verticals }}" :progress-types="{{ $progress_types }}"></edit-user-profile>
        </div>
    </div>
</div>
@endsection
