@extends('partials.app')

@section('content')
    <div class="pl-16 pt-6">
        <a href="javascript:history.go(-1)" class="back-arrow font-semibold text-lg">&larr; Back</a>
    </div>

    <div class="lg:px-10">

        <form class="max-w-sm mx-auto" action="{{ route('categories.update', $category) }}" method="post"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-5">
                <label for="username-success"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <textarea name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('name', $category->name) }}</textarea>
            </div>
            <div class="mb-5">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <input type="text" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('description', $category->description) }}">

            </div>
            <div class="mb-5">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                <input type="file" name="image"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('image', $category->image) }}">

            </div class="mb-5">
            <div class="py-3">
                <button type="submit"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Submit</button>
            </div>
        </form>
    </div>

    @endsection