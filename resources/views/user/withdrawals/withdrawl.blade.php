@extends('user.layouts.app')
@section('content')
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section mt-4">
        <div class="section-heading">
            <h2 class="title">Withdraw</h2>
            <a href="{{route('user.create.withdrawl')}}" class="btn btn-success">Add Withdraw</a>
        </div>
        <div class="transactions">
            @if(count($withdrawl) > 0)
            @foreach ($withdrawl as $withdraw)
            <a href="#" class="item">
                <div class="detail">
                    <div>
                        <strong>Withdraw</strong>
                        <p>{{$withdraw->status}}</p>
                    </div>
                </div>
                <div class="right">
                    <div class="price ">  $ {{$withdraw->amount}}</div>
                </div>
            </a>
            @endforeach
            @else
            <div class="appFooter">
                <div class="footer-title">
                  No withdrawl found
              </div>
          </div>
          @endif
      </div>
  </div>
</div>
<!-- * App Capsule -->
@endsection