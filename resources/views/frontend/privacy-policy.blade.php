@extends('frontend.layouts.home')

@section('title', __('frontend/navigation.privacy_policy'))

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.consent.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          <p>{{ __('frontend/privacy_policy.consent.body') }}</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.information_collection.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.information_collection.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.information_use.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          <p>{{ __('frontend/privacy_policy.information_use.body') }}</p>
          <ul>
            @foreach (__('frontend/privacy_policy.information_use.list') as $body)
              <li>{{ $body }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.log_files.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          <p>{{ __('frontend/privacy_policy.log_files.body') }}</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.third_party.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.third_party.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.advertising.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.advertising.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.third_party.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.third_party.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.ccpa_data.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.ccpa_data.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.gdpr_data.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.gdpr_data.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="card col-12 mb-4 rounded bg-white p-4">
        <h2 class="card-title">{{ __('frontend/privacy_policy.children_information.title') }}</h2>
        <hr style="border: 1px solid rgb(59, 59, 59)" />
        <div class="card-body text-large">
          @foreach (__('frontend/privacy_policy.children_information.body') as $body)
            <p>{{ $body }}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
