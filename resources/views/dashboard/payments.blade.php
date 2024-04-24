@extends('partials.app')

@section('content')



<div class="relative overflow-x-auto lg:px-10">
<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                id
            </th>
            <th scope="col" class="px-6 py-3">
                Description
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
            <th scope="col" class="px-6 py-3">
                Quantity      
            </th>
            <th scope="col" class="px-6 py-3">
                Customer     
            </th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
             <td class="px-6 py-4">
                {{ $payment->payment_id}}
            </td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $payment->product_name }}
            </th>
            <td class="px-6 py-4">
                {{ $payment->amount }}
            </td>
            <td class="px-6 py-4">
                {{ $payment->quantity }}
            </td>
            <td class="px-6 py-4">
                @foreach ($users as $user)
                @if ($user->id=$payment->user_id)
                    {{ $user->name }}
                @endif
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-9 p-3">
</div>
</div>
</div>

@if(session("success"))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'Okay'
    });
</script>
@endif

@endsection