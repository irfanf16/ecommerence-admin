<div class="row clearfix">
    {{-- <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0">
           <a href="{{ URL::to('/admin/vendor/profiles') }}">
            <div class="body pb-1">
                <div class="row">
                    <div class="col-8">
                        <h5>Total</h5>
                        @if(Session::has('vendors'))
                        <h2>{{ $vendors->toal_vendors_count }}</h2>
                        @endif
                    </div>
                </div>
            </div>
           </a>
        </div>
    </div> --}}
    <div class="col-lg-3 col-md-6 col-sm-12">
      <a href="{{ URL::to('/admin/vendor/profiles/incomplete') }}">
        <div class="card border-0">
            <div class="body pb-1">
                <div class="row">
                    <div class="col-8">
                        <h5>Incomplete</h5>
                         <h2> {{ $vendors['incomplete_vendors_count'] }}</h2>
                    </div>
                    {{-- <div class="col-4 px-2">
                        <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"
                            class="rounded w-100 stats-icons" alt="Active Store Default Image">
                    </div> --}}
                </div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
     <a href="{{ URL::to('/admin/vendor/profiles/under-review') }}">
        <div class="card border-0">
            <div class="body pb-1">
                <div class="row">
                    <div class="col-8">
                        <h5>Under Review</h5>
                        <h2>{{ $vendors['under_review_vendors_count'] }}</h2>
                    </div>
                    {{-- <div class="col-4 px-2">
                        <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"
                            class="rounded w-100 stats-icons" alt="Verified Store Default Image">
                    </div> --}}
                </div>
            </div>
        </div>
     </a>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0">
           <a href="{{ URL::to('/admin/vendor/profiles/approved') }}">
            <div class="body pb-1">
                <div class="row">
                    <div class="col-8">
                        <h5>Approved</h5>
                        <h2>{{ $vendors['approved_vendors_count'] }}</h2>
                    </div>
                    {{-- <div class="col-4 px-2">
                        <img src="{{ URL::to('admin/images/icons/stores/store.svg') }}"
                            class="rounded w-100 stats-icons" alt="Store Default Image">
                    </div> --}}
                </div>
            </div>
           </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      <a href="{{ URL::to('/admin/vendor/profiles/rejected') }}">
        <div class="card border-0">
            <div class="body pb-1">
                <div class="row">
                    <div class="col-8">
                        <h5>Rejected</h5>
                        <h2>{{ $vendors['rejected_vendors_count'] }}</h2>
                    </div>
                    {{-- <div class="col-4 px-2">
                        <img src="{{ URL::to('admin/images/icons/stores/featured.svg') }}"
                            class="rounded w-100 stats-icons" alt="Featured Store Default Image">
                    </div> --}}
                </div>
            </div>
        </div>
      </a>
    </div>
</div>
