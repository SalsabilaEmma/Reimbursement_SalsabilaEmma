@extends('layout.app')
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        {{--  --}}
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="col-xl-12 col-lg-12 xl-50 morning-sec box-col-12">
        <div class="card profile-greeting">
          <div class="card-body pb-0">
            <div class="media">
              <div class="media-body">
                <div class="greeting-user">
                  <h4 class="f-w-600 font-primary" id="greeting">Good Morning</h4>
                  <p>Enjoy your day, {{ Auth::user()->nama }} !!</p>
                  <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a></div>
                </div>
              </div>
              <div class="badge-groups">
                <div class="badge f-10"><i class="me-1" data-feather="clock"></i><span id="txt"></span></div>
              </div>
            </div>
            <div class="cartoon"><img class="img-fluid" src="{{ url('cuba') }}/assets/images/dashboard/cartoon.png" alt=""></div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
@endsection
