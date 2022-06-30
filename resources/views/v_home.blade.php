<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran-if430</title>
    
    <link rel="stylesheet" href="{{asset('css/v_home.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
   {{-- CONTENTS:
        1.HERO CONTAINER
        2.NAVBAR
        3.SIDEBAR
        4.PRODUCT CONTAINER
        5.PLACE ORDER MODAL 
        6.ORDERS MODAL
        7.DESCRIPTION MODAL
        8.FEATURE CONTAINER
        9.FOOTER
    --}}

    {{-- HERO CONTAINER --}}
    <div class="HeroContainer">

        {{-- NAVBAR --}}
        <nav class="NavContainer">
            <h1 class="NavLink">Restoran-if430</h1>
            
            <img class="NavIconimg" src="{{ asset('images/bx-menu.svg') }}"/>
            <div class="NavIcon" onclick="openNav()">
                <h1>Menu</h1>
                
            </div>
        </nav>


        {{-- SIDEBAR --}}
        <aside class="SidebarContainer" id="Sidebar">
            <div class="Icon" onclick="closeNav()">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAw0lEQVRIS+2U3Q2CQBCEPzqwEyxBO5BKtQMtQTuxBDOJJCfuHyYXX+ANssy3Ozt3A52fobM+GyB1+O8WnYAb8HRa3QEH4OKNEk0g8TNwB44GROJXYA9MHiQCSEDdjwakFX+8pzCnzHZgQeTG3HkorsIMoJolRN9kSypeBSwhei+JrwXMtug/b/FfYapa1HouEWvxZlIzgJUWCXnpWjVBFMUowh+QykHzFtpCfjpo6qTrVZHelJWCbMkVjbBmA6QWdrfoBQwINBmYmmoWAAAAAElFTkSuQmCC"/>
            </div>
            <div class="SidebarMenu">
                <a href="/" class="SidebarLink">Home</a>
                <a href="#pizzas" class="SidebarLink">Pizzas</a>
                <a href="#drinks" class="SidebarLink">Drinks</a>

                <button class="SidebarLink" data-toggle="modal" data-target="#MyOrderModal">My Order</button>

                @if (session()->has('LoggedUser'))
                    <a href="/logout" class="SidebarLink">Logout</a>
                @endif
                
                @if (!session()->has('LoggedUser'))
                    <a href="/login" class="SidebarLink">Login</a>
                    <a href="/register" class="SidebarLink">Register</a>
                @endif
            </div>
        </aside>

        <div class="HeroContent">
            <div class="HeroItems">
                <h1 class="Hero">Best Pizza in Town</h1>
                <p class="Hero">Ready in Seconds!</p>
                <button class="Hero"><a href="#pizzas">Order Now</a></button>
            </div>
        </div>
    </div>

    {{-- PRODUCT CONTAINER --}}
    <div class="ProductsContainer" id="pizzas">
        <h1 class="ProductsHeading">Delicious Foods!</h1>
        <div class="ProductWrapper">

            @foreach ($product as $data)

                @if ($data->category === "food")
                    <div class="ProductCard">
                        <button type="button" data-toggle="modal" data-target="#DescModal{{ $data->product_id }}">
                            <img class="ProductImg" src="{{ asset('product_images/' . $data->picture) }}"/>
                        </button>
                        <div class="ProductInfo">
                            <h2 class="ProductTitle">{{ $data->name }}</h2>
                            <p class="ProductPrice">{{ $data->price }}</p>
                            <button class="ProductButton" data-toggle="modal" data-target="#PlaceOrderModal{{ $data->product_id }}">Order</button>
                        </div>
                    </div>
                @endif
                
            @endforeach
            
        </div>
    </div>


    {{-- PLACE ORDER MODAL --}}
    @foreach ($product as $data)
        <div class='modal fade' id='PlaceOrderModal{{ $data->product_id }}' tabindex='-1' role='dialog' aria-hidden="true">
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title text-center'>Place Order: {{ $data->name }}</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class='modal-body'>
                        <form method='post' action='{{ route('order') }}'>
                            @csrf
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1">
                            <input hidden name="product_id" value={{ $data->product_id }}>
                            <div class="text-danger">           
                                @error('quantity'){{ $message }}@enderror
                            </div>
                    </div>
                    <div class="modalFooter">
                        <button type='submit' class='ProductButton'>Place Order</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- ORDERS MODAL --}}
    <div class='modal fade' id='MyOrderModal' tabindex='-1' role='dialog' aria-hidden="true">
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title text-center'>Your orders</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    @if (session()->has('LoggedUser'))
                    <?php $total = 0 ?>
                        <table class="myOrderTable">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shopping as $data)

                                    @if ($data->user_id == session('LoggedUser'))

                                        @foreach ($product as $item)

                                            @if ($item->product_id == $data->product_id)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $data->quantity }}</td>
                                                    <td>Rp {{ $data->total }}</td>
                                                    <td><a class="deleteOrderButton" href="{{ "/delete-order/" . $data->shopping_cart_id }}">&times;</a></td>
                                                </tr>
                                                <?php $total += $data->total ?>
                                            @endif
                                        
                                        @endforeach
                                        
                                    @endif

                                @endforeach

                                <tr>
                                    <td colspan="3">Grand Total</td>
                                    <td><?php echo "Rp ".$total ?></td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                    @if (!session()->has('LoggedUser'))
                        <h4>Please log in to see your order</h4> 
                    @endif
                </div>  
            </div>
        </div>
    </div>



    {{-- DESCRIPTION MODAL --}}
    @foreach ($product as $data)

        <div class="modal fade" id="DescModal{{ $data->product_id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="col-12 modal-title text-center" id="exampleModalLongTitle">{{ $data->name }}</h5>
                </div>
                <div class="modal-body">
                    <img class="modal-img" src="{{ asset('product_images/' . $data->picture) }}"/>
                    {{ $data->description }} <br>
                    Rp. {{ $data->price }}
                </div>
                <div class="modalFooter">
                <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
          
      @endforeach





    {{-- FEATURE CONTAINER --}}
    <div class="FeatureContainer">
        <h1>Pizza of the Day</h1>
        <p>Truffle alfredo sauce topped with 24 carat gold dust.</p>
    </div>


    {{-- PRODUCT CONTAINER --}}
    <div class="ProductsContainer" id="drinks">
        <h1 class="ProductsHeading">Refreshing Beverages!</h1>
        <div class="ProductWrapper">

            @foreach ($product as $data)

                @if ($data->category === "drink")
                    <div class="ProductCard">
                        <button type="button" data-toggle="modal" data-target="#DescModal{{ $data->product_id }}">
                            <img class="ProductImg" src="{{ asset('product_images/' . $data->picture) }}"/>
                        </button>
                        <div class="ProductInfo">
                            <h2 class="ProductTitle">{{ $data->name }}</h2>
                            <p class="ProductPrice">{{ $data->price }}</p>
                            <button class="ProductButton" data-toggle="modal" data-target="#PlaceOrderModal{{ $data->product_id }}">Order</button>
                        </div>
                    </div>
                @endif
                
            @endforeach

        </div>
    </div>


    {{-- FOOTER --}}
    <footer class="FooterContainer">
        <div class="FooterWrap">
            <section class="SocialMedia">
                <div class="SocialMediaWrap">
                    <p class="SocialLogo">Restoran-if430</p>
                    <div class="SocialIcons">
                        <a href="http://www.facebook.com" target="_blank" aria-label="Facebook" class="SocialIconLink" rel="noopener noreferrer"><img src="{{ asset('images/bxl-facebook-square.svg') }}"/></a>
                        <a href="http://www.instagram.com" target="_blank" aria-label="Instagram" class="SocialIconLink" rel="noopener noreferrer"><img src="{{ asset('images/bxl-instagram.svg') }}"/></a>
                        <a href="http://www.twitter.com" target="_blank" aria-label="Twitter" class="SocialIconLink" rel="noopener noreferrer"><img src="{{ asset('images/bxl-twitter.svg') }}"/></a>
                        <a href="http://www.youtube.com" target="_blank" aria-label="Youtube" class="SocialIconLink" rel="noopener noreferrer"><img src="{{ asset('images/bxl-youtube.svg') }}"/></a>
                    </div>
                </div>
            </section>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.addEventListener("scroll", function () {
            var navbar = document.querySelector("nav.NavContainer");
            var navLink = document.querySelector("h1.NavLink");
            var navIcon = document.querySelector("div.NavIcon");
            var NavIconimg = document.querySelector("img.NavIconimg");
            navbar.classList.toggle("active", window.scrollY > 20);
            navLink.classList.toggle("activeh1",window.scrollY > 20);
            navIcon.classList.toggle("activediv",window.scrollY > 20);
            NavIconimg.classList.toggle("activeimg",window.scrollY>20);
        });
        

        function openNav() {
          document.getElementById("Sidebar").style.right = "0px";
          
        }
        
        function closeNav() {
          document.getElementById("Sidebar").style.right = "-1000px";
        }
    </script>
</body>
</html>