@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp
<x-layout>
@php
    $avatar = AuthController::imageAdapter($cons->avatar);
@endphp
<div class="d-flex justify-content-center mt-5 mb-1">
    <div style="width: 80%">
        <h3 style="color: blueviolet; font-family: 'Comfortaa'; ">Pay</h3>

        <div class="my-5 d-flex flex-row justify-content-between">
            <div id="snap-container"></div>
            <div class="col-7" >
                <div class="d-flex flex-row">
                    <div class="ms-4 my-3 d-flex flex-row justify-content-between align-items-end w-100" >
                        <div>
                            @if($cons->avatar != null) 
                            <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" width="100" height="100px" style="object-fit: cover;">
                            @else
                            <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" width="100" height="100px" style="object-fit: cover;">
                            @endif
                            <p  class="mb-2" style="font-size: 18px; font-weight: bold">{{$cons->title}}</p>
<!--                        <p class="mb-2">
                                <i class="bi bi-geo-alt">{{$cons->type}}</i>
                            </p> -->

                            <p  class="mb-2 mt-0">
                            @php
                                echo date_format(date_create($cons->consult_datetime),"l, d F Y");
                            @endphp
                            </p>
                            <p  class="m-0" style="font-size: 18px; font-weight: bold; color: #3DA43A">
                            @php
                                echo "Rp". number_format($cons->price, 0, ",", ".");
                            @endphp
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
            </div> 

            <div class="col-4">

                <div class="d-flex flex-row justify-content-between">
                    <div class="border" style="width: 100%;  border-radius: 15px">
                        <div style="margin: 30px">
                            <div class="d-flex flex-row justify-content-between mb-1 " >
                                <p class="mb-3" style="font-weight: bold; font-size: 20px ">Review Order Details</p>
                            </div>
                            <div class="d-flex flex-row justify-content-between mb-1" >
                                <p class="m-0">Subtotal</p>
                                <p class="m-0">
                                @php
                                    echo "Rp". number_format($cons->price, 2, ",", ".");
                                @endphp
                                </p>
                            </div>
<!--                            <div class="d-flex flex-row justify-content-between mb-1">
                                <p class="m-0">Booking Fee</p>
                                <p class="m-0">Rp0,00</p>
                            </div> -->
                            
                            <div class="d-flex flex-row justify-content-between" style="font-size: 16px; font-weight: bold">
                                <p>Total</p>
                                <p>
                                @php
                                    echo "Rp". number_format($cons->price, 2, ",", ".");
                                @endphp
                                </p>
                            </div>
                            
                            <p class="mb-3" style="font-size: 12px">Please recheck your order</p>
                            <input type="hidden" name="consultationId" id="consultationId" value="{{ $cons->id }}">
                            
                            <button type="submit" id="paybutton" class="btn btn-primary form-control text-white" onclick="handlePay()">Pay</button>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div>
</div>

<script type="text/javascript">
    function handlePay() {
        console.log('abcd');
        var consultationId = document.getElementById('consultationId');
        console.log(consultationId);
        // Set up the request
        var requestData = {
            consultationId: consultationId.value, // Use .value to get the value of the input field
        };

        // Make an AJAX request to the server using fetch

        fetch('/pay', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            body: JSON.stringify(requestData),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(response => {
            // Parse the response from the server
            var snapToken = response.snapToken;
            console.log(snapToken);
            window.snap.pay(snapToken, {
            onSuccess: function(result){  
                window.location.href = 'http://127.0.0.1:8000/';
            },
            onPending: function(result){
                alert("Wating your payment!"); 
            },
            onError: function(result){
                alert("Payment failed!"); 
            },
            onClose: function(){
                alert('You closed the popup without finishing the payment');
            }
        })
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    };
</script>
</x-layout>