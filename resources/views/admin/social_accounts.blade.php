@extends('layouts.admin')
@section('title', 'Social Accounts')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-secondary p-3 text-white mb-2"
            style="color: white !important">
            <h4 class="mb-sm-0 font-size-18" style="color: white !important">Social Accounts</h4>
            {{-- {{ $errors }} --}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0 text-white">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" ript style="color: white !important">
                            DASHBOARD </a> / SOCIAL ACCOUNTS</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="w-100">
    <div class="card p-4 rounded cShadow text-center">
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <!-- Instagram Login Button -->
            <a href="{{ route('instagram.login') }}" 
               style="
                   display: inline-flex;
                   align-items: center;
                   gap: 10px;
                   background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
                   color: white;
                   padding: 10px 20px;
                   border-radius: 50px;
                   text-decoration: none;
                   font-weight: bold;
                   font-size: 16px;
                   transition: 0.3s ease;
               "
               onmouseover="this.style.opacity='0.9'"
               onmouseout="this.style.opacity='1'"
            >
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" 
                     alt="Instagram" 
                     style="width: 24px; height: 24px;">
                Login with Instagram
            </a>

            <!-- TikTok Login Button -->
            <a href="" 
               style="
                   display: inline-flex;
                   align-items: center;
                   gap: 10px;
                   background: #010101;
                   color: white;
                   padding: 10px 20px;
                   border-radius: 50px;
                   text-decoration: none;
                   font-weight: bold;
                   font-size: 16px;
                   transition: 0.3s ease;
               "
               onmouseover="this.style.opacity='0.9'"
               onmouseout="this.style.opacity='1'"
            >
                <img src="https://www.tiktok.com/favicon.ico" 
                     alt="TikTok" 
                     style="width: 24px; height: 24px;">
                Login with TikTok
            </a>
        </div>
    </div>
</div>



@endsection