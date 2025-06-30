@extends('user.layouts.app')
@section('content')
<style>
.plan-card {
    border: 2px solid #e9ecef;
    border-radius: 15px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.plan-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.plan-popular {
    border-color: #28a745;
    transform: scale(1.05);
}

.popular-badge {
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 5px 20px;
    border-radius: 0 0 15px 15px;
    font-size: 12px;
    font-weight: bold;
}

.plan-icon .icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 24px;
    color: white;
}

.plan-title {
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.plan-price {
    margin-bottom: 20px;
}

.plan-price .currency {
    font-size: 18px;
    vertical-align: top;
    color: #666;
}

.plan-price .amount {
    font-size: 36px;
    font-weight: 700;
    color: #333;
}

.plan-price .period {
    font-size: 14px;
    color: #666;
    vertical-align: bottom;
}

.plan-features {
    text-align: left;
    padding-left: 0;
}

.plan-features li {
    padding: 8px 0;
    font-size: 14px;
}

.btn-block {
    width: 100%;
    padding: 12px;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40,167,69,0.3);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255,193,7,0.3);
    color: #333;
}

@media (max-width: 768px) {
    .plan-popular {
        transform: none;
        margin-top: 20px;
    }

    .plan-card {
        margin-bottom: 20px;
    }
}
</style>

<!-- App Capsule -->
<div id="appCapsule">

    <!-- Wallet Card -->
    <div class="section wallet-card-section pt-1">
        <div class="wallet-card">
            <!-- Balance -->
            <div class="balance">
                <div class="left">
                    <span class="title">Total Balance</span>
                    <h1 class="total">$ {{auth()->user()->balance}}</h1>
                </div>
                {{-- <div class="right">
                    <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                        <i class="fas fa-plus"></i>
                    </a>
                </div> --}}
            </div>
            <!-- * Balance -->
            <!-- Wallet Footer -->
            <div class="wallet-footer">
                <div class="item">
                    <a href="{{route('user.deposits')}}" >
                        <div class="icon-wrapper bg-danger">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <strong>Deposit</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="{{route('user.withdrawl')}}" >
                        <div class="icon-wrapper bg-success">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <strong>Withdraw</strong>
                    </a>
                </div>
                {{-- <div class="item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                        <div class="icon-wrapper">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <strong>Send</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="app-cards.html">
                        <div class="icon-wrapper bg-success">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <strong>Cards</strong>
                    </a>
                </div>
                <div class="item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exchangeActionSheet">
                        <div class="icon-wrapper bg-warning">
                            <i class="fas fa-exchange-alt fa-rotate-90"></i>
                        </div>
                        <strong>Exchange</strong>
                    </a>
                </div> --}}

            </div>
            <!-- * Wallet Footer -->
        </div>
    </div>
    <!-- Wallet Card -->

    <!-- Deposit Action Sheet -->
    {{-- <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Balance</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="account1">From</label>
                                    <select class="form-control custom-select" id="account1">
                                        <option value="0">Savings (*** 5019)</option>
                                        <option value="1">Investment (*** 6212)</option>
                                        <option value="2">Mortgage (*** 5021)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">Enter Amount</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addona1">$</span>
                                    <input type="text" class="form-control" placeholder="Enter an amount" value="100">
                                </div>
                            </div>


                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Deposit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- * Deposit Action Sheet -->

    <!-- Withdraw Action Sheet -->
    {{-- <div class="modal fade action-sheet" id="withdrawActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw Money</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="account2d">From</label>
                                    <select class="form-control custom-select" id="account2d">
                                        <option value="0">Savings (*** 5019)</option>
                                        <option value="1">Investment (*** 6212)</option>
                                        <option value="2">Mortgage (*** 5021)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text11d">To</label>
                                    <input type="email" class="form-control" id="text11d" placeholder="Enter IBAN">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">Enter Amount</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addonb1">$</span>
                                    <input type="text" class="form-control" placeholder="Enter an amount" value="100">
                                </div>
                            </div>

                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- * Withdraw Action Sheet -->

    <!-- Send Action Sheet -->
    {{-- <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Money</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="account2">From</label>
                                    <select class="form-control custom-select" id="account2">
                                        <option value="0">Savings (*** 5019)</option>
                                        <option value="1">Investment (*** 6212)</option>
                                        <option value="2">Mortgage (*** 5021)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text11">To</label>
                                    <input type="email" class="form-control" id="text11" placeholder="Enter bank ID">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">Enter Amount</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input type="text" class="form-control" placeholder="Enter an amount" value="100">
                                </div>
                            </div>

                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- * Send Action Sheet -->

    <!-- Exchange Action Sheet -->
    {{-- <div class="modal fade action-sheet" id="exchangeActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exchange Money</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="currency1">From</label>
                                            <select class="form-control custom-select" id="currency1">
                                                <option value="1">EUR</option>
                                                <option value="2">USD</option>
                                                <option value="3">AUD</option>
                                                <option value="4">CAD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="currency2">To</label>
                                            <select class="form-control custom-select" id="currency2">
                                                <option value="1">USD</option>
                                                <option value="1">EUR</option>
                                                <option value="2">AUD</option>
                                                <option value="3">CAD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">Enter Amount</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                    <input type="text" class="form-control" placeholder="Enter an amount" value="100">
                                </div>
                            </div>



                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Exchange</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- * Exchange Action Sheet -->

    <!-- Stats -->
    <div class="section">
        <div class="row mt-2">
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Total Deposit</div>
                    <div class="value text-success">$ {{$totalDeposit}}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Total Withdrawals</div>
                    <div class="value text-danger">$ {{$totalWithdrawal}}</div>
                </div>
            </div>
        </div>

    </div>
    <!-- * Stats -->
@if(count($users) > 0)
    <!-- Transactions -->
    <div class="section mt-4">
        <div class="section-heading">
            <h2 class="title">Teams</h2>

        </div>
        <div class="transactions">
            @foreach ($users as $user)
            <a href="app-transaction-detail.html" class="item">
                <div class="detail">
                    <img src="/assets/user/images/avatar3.jpg" alt="img" class="image-block imaged w48">
                    <div>
                        <strong>{{@$user->name}}</strong>
                        <p>{{@$user->email}}</p>
                        <p>+ {{@$user->phone_number}}</p>
                    </div>
                </div>
                <div class="right">
                    <div class="price "> $ {{@$user->balance}}</div>
                </div>
            </a>
            @endforeach



        </div>
    </div>
    <!-- * Transactions -->
@endif

@if(count($plans) > 0)
<!-- Plans Section -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Plans</h2>

    </div>

    <div class="row">
       @foreach ($plans as $plan)
       <div class="col-12 col-md-4 mb-3">
           <div class="card plan-card">
               <div class="card-body text-center">
                   <div class="plan-icon mb-3">
                       <div class="icon-wrapper bg-primary">
                           <i class="fas fa-star"></i>
                       </div>
                   </div>
                   <h4 class="plan-title">{{@$plan->title}}</h4>
                   <div class="plan-price mb-3">
                       <span class="currency">$</span>
                       <span class="amount">{{@$plan->price}}</span>

                   </div>
                   <div>
                    <p>
                        {{@$plan->description}}
                    </p>
                   </div>

                   <button class="btn btn-success btn-block">Buy Now {{@$plan->title}}</button>
               </div>
           </div>
       </div>

       @endforeach



    </div>
</div>
<!-- * Plans Section -->
@endif












    <!-- app footer -->
    <div class="appFooter">
        <div class="footer-title">
            Copyright © {{ env('APP_NAME') }} @php echo date('Y'); @endphp. All Rights Reserved.
        </div>
    </div>
    <!-- * app footer -->

</div>
<!-- * App Capsule -->


@endsection
