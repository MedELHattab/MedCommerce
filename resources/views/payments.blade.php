@extends('partials.header')

@section('content')
<div class="container" style="padding-top: 10em;padding-bottom:10em">
    <table id="paymentsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Amount</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            
            <tr>
                <td>{{ $payment->product_name }}</td>
                <td>{{ $payment->amount }}</td>
                <td>${{ $payment->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('content')