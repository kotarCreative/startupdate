@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <edit-user-profile :profile="{{ $user }}"></edit-user-profile>
        </div>
    </div>
</div>
@endsection
