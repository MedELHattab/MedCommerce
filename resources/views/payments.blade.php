@extends('partials.header')

@section('content')
<div class="container" style="padding-top: 10em;padding-bottom:10em">
    <table id="paymentsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Download</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            
            <tr>
                <td>{{ $payment->product_name }}</td>
                <td>{{ $payment->quantity }}</td>
                <td>${{ $payment->amount }}</td>
                <td>
                    <form action="{{ route('download.pdf', $payment->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Download PDF</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('content')