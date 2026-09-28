@if(session('success'))<div style="background:#dcfce7;color:#166534;padding:15px;border-radius:8px;margin-bottom:20px">{{session('success')}}</div>@endif
@if(session('error'))<div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:8px;margin-bottom:20px">{{session('error')}}</div>@endif
@if($errors->any())<div style="background:#fef2f2;color:#991b1b;padding:15px;border-radius:8px;margin-bottom:20px"><strong>Periksa kembali input:</strong><ul>@foreach($errors->all() as $error)<li>{{$error}}</li>@endforeach</ul></div>@endif
