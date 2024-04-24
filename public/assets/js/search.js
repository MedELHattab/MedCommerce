// function confurmDelete(e) {
//     e.preventDefault();
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!"
//     }).then((result) => {
//         if (result.isConfirmed) {

//             e.target.closest('form').submit();
//         }
//     });
// }
 
$(document).ready(function () {
    document.getElementById('search_input').addEventListener('input', fetchData);
    document.getElementById('category').addEventListener('change', fetchData);
   
    function fetchData() {
        var search_string = document.getElementById('search_input').value;
        var category = document.getElementById('category').value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       
       
        searchLoading()
        fetch(`/search?search_string=${search_string}&category=${category}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data)
                 
                if (data.status) {
                    showProduct(data.products, data.token);
                } else noResult();
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
    }

    function searchLoading() {
        $("#place_result").html(`
            <div aria-label="Loading..." role="status" class="flex items-center space-x-2">
            <svg class="h-20 w-20 animate-spin stroke-gray-500" viewBox="0 0 256 256">
                <line x1="128" y1="32" x2="128" y2="64" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="195.9" y1="60.1" x2="173.3" y2="82.7" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="224" y1="128" x2="192" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="195.9" y1="195.9" x2="173.3" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="128" y1="224" x2="128" y2="192" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="60.1" y1="195.9" x2="82.7" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="32" y1="128" x2="64" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="60.1" y1="60.1" x2="82.7" y2="82.7" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
            </svg>
            <span class="text-4xl font-medium text-gray-500">Loading...</span>
        </div>
            `)
    }
    function noResult() {
        $("#place_result").html(`
            <div class="w-full flex justify-center" >
                <img src="https://cdn.dribbble.com/users/235730/screenshots/2936116/no-resultfound.jpg" alt="">
            </div>
        `)
    }

    function showProduct(products, token) {
        $("#place_result").html("")
        products.forEach(product => {
            $("#place_result").append(`
            <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="http://127.0.0.1:8000/uploads/products/${product.image}" alt="${ product.name }" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                     <form method="POST" action="http://127.0.0.1:8000/addProducttoCart/${product.id}">
                                        <input type="hidden" name="_token" value="${token}" />
                                        <div class="d-flex gap-2">
                                            <select name="color" id="color" class="my-2 rounded bg-black text-white">
                                                 
                                            
                                            <option value="1">black</option>
                                            <option value="2">white</option>
                                            
                                            <option value="3">grey</option>
                                            </select>
                                            
                                            <select name="size" id="size" class="my-2 rounded bg-black text-white">
                                            
                                            
                                            <option value="1">large</option>
                                            <option value="2">medium</option>
                                            
                                            <option value="3">small</option>
                                                
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-medium btn-black">Add to Cart
                                            <svg class="cart-outline">
                                                <use xlink:href="#cart-outline"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="http://127.0.0.1:8000/product/${product.id}"> ${product.name}</a>
                                </h3>
                                <span class="item-price text-primary">$ ${product.price}</span>
                            </div>
                        </div>
                    </div>`);


        });
    }


});