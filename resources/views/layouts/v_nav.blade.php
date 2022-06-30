<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header">MAIN NAVIGATION</li>
        
        <li class="nav-item">
            <a href="/user" 
            class="nav-link {{ request()->is('user') ? 'active' : ' '}}">
            <i class="far fa-user nav-icon"></i>
            <p>User</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/product" 
            class="nav-link {{ request()->is('product') ? 'active' : ' '}}">
            <i class="fa fa-box nav-icon"></i>
            <p>Product</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="/shopping_cart" 
            class="nav-link {{ request()->is('shopping_cart') ? 'active' : ' '}}">
            <i class="fas fa-shopping-cart nav-icon"></i>
            <p>Shopping Cart</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/logout" 
            class="nav-link">
            <i class="fa fa-power-off nav-icon"></i>
            <p>Log Out</p>
            </a>
        </li>
    </ul>
</nav>