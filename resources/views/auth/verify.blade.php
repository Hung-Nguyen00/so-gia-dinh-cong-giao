<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đặt lại mặt khẩu</div>
                  <div class="card-body">
                   @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           {{ __('A fresh verification link has been sent to your email address.') }}
                       </div>
                   @endif
                      <p>Click vào nút bên dưới để chuyển sang trang đặt lại mặt khẩu</p>
                   <button class="btn btn-outline-primary" href="{{ url('/reset-password/'.$token) }}">Đặt lại mật khẩu</button>
               </div>
           </div>
       </div>
   </div>
</div>
