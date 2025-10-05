<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body
    class="antialiased flex flex-col items-center justify-center py-6 px-4 lg:px-0 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">


    <div class="container mb-6 h-12 bg-slate-300 shadow rounded-xl flex items-center justify-between px-4">
        <h1 class="text-xl ">Quick
            Commerce</h1>

        <ul class="flex gap-6 font-bold text-lg">
            <li><a href="">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">FAQ</a></li>
        </ul>


    </div>


    <div class="container">
        <div class=" bg-slate-200 shadow-xl rounded-lg flex flex-col gap-3  p-6 border border-gray-300">

            <div class="mb-6 text-center flex flex-row justify-between items-center gap-4">
                <h1 class="font-bold">Products</h1>



                <form action="">
                    search: <input type="text" name="search" value="{{ request('search') }}"
                        class="border border-black rounded px-2 py-1">
                </form>
            </div>

            <table
                class="w-full  mx-auto border border-[#e3e3e0] rounded-sm bg-white shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)]">
                <thead>
                    <tr class="bg-[#dbdbd7] dark:bg-[#161615]">
                        <th class="py-2 px-5 text-left font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Name</th>
                        <th class="py-2 px-5 text-left font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Price</th>
                        <th class="py-2 px-5 text-left font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Available</th>
                        <th class="py-2 px-5 text-left font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                            <td class="py-2 px-5">{{ $product->name }}</td>
                            <td class="py-2 px-5">${{ number_format($product->price, 2) }}</td>
                            <td class="py-2 px-5">
                                @if ($product->available)
                                    <span class="text-green-600 font-medium">Yes</span>
                                @else
                                    <span class="text-red-600 font-medium">No</span>
                                @endif
                            </td>
                            <td class="py-2 px-5">
                                <a href="{{ route('products.show', $product) }}"
                                    class="underline text-[#F53003] dark:text-[#F61500] underline-offset-4">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $products->onEachSide(5)->links() }}
            </div>

        </div>
    </div>



</body>

</html>
