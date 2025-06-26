@extends('user.layouts.app')
@section('content')
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section mt-4">
        <div class="section-heading">
            <h2 class="title">Deposit Create</h2>
        </div>
        <div class="transactions">
            <div  class="item" style="display:block;">
              <form action="{{route('user.store.withdrawl')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="email2">Amount</label>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="number" class="form-control" id="email2" value="" name="amount" placeholder="Enter Amount" required>
                    </div>

                </div>

            </div>

            <div class="card-action mt-2">
              <button type="submit" class="btn btn-success">Submit</button>
          </div>
      </form>
  </div>
</div>
</div>

</div>
<!-- * App Capsule -->

@endsection