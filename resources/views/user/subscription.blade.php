@extends('layouts.app')

@section('title')
    <title>Mulai Berlangganan</title>
@endsection

@section('content')
   <div class="d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('subscribe.post') }}" id="subscribeForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class=" mb-3 mb-md-0">
                            <label for="type">Jenis Layanan</label>
                            <select name="type" id="type" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}} {{$type->price>0?number_format($type->price):$type->price}} selama {{$type->subscription_days}} hari</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-submit">pilih</button>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="login.html">Have an account? Go to login</a></div>
            </div>
        </div>
    </div>
   </div>
@endsection

@push('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$clientKey}}"></script>

    <script>
        $('.btn-submit').click(function(event){
            event.preventDefault();
            let url = $('#subscribeForm').attr('action');
            let formData = new FormData(document.getElementById('subscribeForm'));
            let dataObj = {};

            formData.forEach(function (value, key) {
                dataObj[key] = value;
            })
            
            $.post(url, dataObj, function (response) {
                snap.pay(response.token,
                {
                    onSuccess: function(result){console.log('success');console.log(result);},
                    onPending: function(result){console.log('pending');console.log(result);},
                    onError: function(result){console.log('error');console.log(result);},
                    onClose: function(){console.log('customer closed the popup without finishing the payment');}
                });
            })
        })
    </script>
@endpush