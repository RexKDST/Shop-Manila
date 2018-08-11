 <div class="col-md-2">
        <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-shopping-cart" aria-hidden="true"></i>Dashboard
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin')}}"><i class="fa fa-plus" aria-hidden="true"></i> View Dashboard</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-shopping-cart" aria-hidden="true"></i>Products
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin/addProduct')}}"><i class="fa fa-plus" aria-hidden="true"></i> Add Products</a></li>
                            <li><a href="{{url('/admin/products')}}"><i class="fa fa-search" aria-hidden="true"> </i> View Products</a></li>
                        </ul>
                    </li>

                     <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-star"></i> Categories
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin/addCat')}}"><i class="fa fa-plus" aria-hidden="true"></i> Add Categories</a></li>
                            <li><a href="{{url('/admin/categories')}}"><i class="fa fa-search" aria-hidden="true"> </i> View Categories</a></li>
                        
                        </ul>
                    </li>
                   
                    <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-tags" aria-hidden="true"></i></i> Stocks
                            <span class="caret pull-right"></span>
                         </a>

                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin/addStocks')}}"><i class="fa fa-plus" aria-hidden="true"></i> Add Stocks</a></li>
                            <li><a href="{{url('/admin/stockDetails')}}"><i class="fa fa-suitcase" aria-hidden="true"></i> Stocks Purchased</a></li>
                            <li><a href="{{url('/admin/stocks')}}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></i> Stocks Available</a></li>
                           
                        </ul>
                    </li>
                             <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-list"></i> Orders
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin/orderDetails')}}"><i class="fa fa-plus" aria-hidden="true"></i> View Orders </a></li>
                            
                            
                        </ul>

                        <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-money" aria-hidden="true"></i> Sales
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                        
                            <li><a href="{{url('/admin/sales')}}"><i class="fa fa-search" aria-hidden="true"> </i> View Sales</a></li>
                        </ul>
                          <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-envelope" aria-hidden="true"></i> Messages
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                           
                            <li><a href="{{url('/admin/message')}}"><i class="fa fa-search" aria-hidden="true"> </i> View Messages</a></li>
                        </ul>
                    
                    </li>
                     <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-user" aria-hidden="true"></i> Users
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                           
                            <li><a href="{{url('/admin/users')}}"><i class="fa fa-search" aria-hidden="true"> </i> View Users</a></li>
                        </ul>
                          <li class="submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-envelope" aria-hidden="true"></i>Mail
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="{{url('/admin/email')}}"><i class="fa fa-plus" aria-hidden="true"></i> Send Mail</a></li>
                            
                        </ul>
                    </li>
                    
                    </li>
                    </li>

                </ul>
             </div>
      </div>