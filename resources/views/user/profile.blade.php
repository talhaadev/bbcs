@extends('user.layouts.app')
@section('content')
    <style>
        .image-listview>li a.item:after {
            display: none;
        }
    </style>
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="/assets/user/images/avatar1.jpg" alt="avatar" class="imaged w100 rounded">

                </a>
            </div>
        </div>

        {{-- <div class="listview-title mt-1">Theme</div>
        <ul class="listview image-listview text inset no-line">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Dark Mode
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul> --}}

        {{-- <div class="listview-title mt-1">Notifications</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Payment Alert
                            <div class="text-muted">
                                Send notification when new payment received
                            </div>
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault1">
                            <label class="form-check-label" for="SwitchCheckDefault1"></label>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Notification Sound</div>
                        <span class="text-primary">Beep</span>
                    </div>
                </a>
            </li>
        </ul> --}}

        <div class="listview-title mt-1">Profile Settings</div>
        <ul class="listview image-listview text inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Name</div>
                        <div>{{ auth()->user()->name }}</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Email</div>
                        <div>{{ auth()->user()->email }}</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Mobile</div>
                        <div> +{{ auth()->user()->phone_number }}</div>
                    </div>
                </a>
            </li>

        </ul>

        <div class="listview-title mt-1">Referral Url</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div id="referralLink">{{ url('/register?code=' . auth()->user()->referral_code) }}</div>
                        <div class="CopyClickBoard" onclick="copyReferralLink()">
                            <i class="fas fa-clipboard"></i>
                        </div>
                    </div>
                </a>
            </li>



        </ul>


        <a href="{{ url('user/profile/update') }}" class="bg-red-500 text-white px-4 py-2 rounded inline-block hover:bg-red-600 transition">
            Update
        </a>


    </div>


    <script>
        function copyReferralLink() {
            const link = document.getElementById("referralLink").textContent.trim();
            navigator.clipboard.writeText(link).then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Referral link copied to clipboard!'
                });
            }).catch(err => {
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to copy the link.'
                });
            });
        }
    </script>
@endsection
