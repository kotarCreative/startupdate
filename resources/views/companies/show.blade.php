@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="company__info-wrapper">
            <div class="company__profile-logo">
              @if ($company->image)
              <img src="{{ $company->image }}" />
              @else
              <div class="company__default-logo"></div>
              @endif
            </div>
            <div class="company__info">
              <h1>{{ $company->name }}</h1>
              <h4>{{ $company->description }}</h4>
              <div class="company__labels">
                @if ($company->from_startup_school)
                <div  class="company__label">
                  SUS
                </div>
                @endif
                <div class="company__label">
                    {{ $company->vertical->name }}
                </div>
                <div class="company__label">
                    {{ $company->progressType->name }}
                </div>
              </div>
              <div class="company__actions">
                @if ($company->url)
                  <a class="btn btn-primary" href="{{ $company->url }}">Website</a>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="progress-section__header">
          <h2>Progress</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 company__progress-updates">
        @if ($company->progressUpdates->count() > 0)
          @foreach ($company->progressUpdates as $update)
            <progress-update :update="{{ $update }}" :read-only="true"></progress-update>
          @endforeach
        @else
          <h4>No progress updates yet.</h4>
      </div>
      @endif
    </div>
</div>
@endsection
