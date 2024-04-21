
@extends('partials.app')

@section('content')



<div class="relative overflow-x-auto lg:px-10">
<div class="row  flex justify-start m-3 gap-3 ">
    <div class="col-lg-12 margin-tb  w-40 ">
        <div class="pull-right">
            <a class="btn btn-primary text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="{{ route('coupons.create') }}"> Create Coupon</a>
        </div>
    </div>
    <div class="col-lg-12 margin-tb w-40 ">
        <div class="pull-right">
        </div>
    </div>
</div>
<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                id
            </th>
            <th scope="col" class="px-6 py-3">
                Code
            </th>
            <th scope="col" class="px-6 py-3">
                Discount Percentage
            </th>
            <th scope="col" class="px-6 py-3">
                Limit Usage       
            </th>
            <th scope="col" class="px-6 py-3">
                Expiration Date      
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($coupons as $coupon)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
             <td class="px-6 py-4">
                {{ $coupon->id }}
            </td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $coupon->code }}
            </th>
            <td class="px-6 py-4">
                {{ $coupon->percentage_discount }}
            </td>
            <td class="px-6 py-4">
                {{ $coupon->usage_limit }}
            </td>
            <td class="px-6 py-4">
                {{ $coupon->expires_at }}
            </td>
            <td class="px-6 py-4">
                <a href="{{ route('coupons.edit', $coupon) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('coupons.destroy', $coupon) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                </form>
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

