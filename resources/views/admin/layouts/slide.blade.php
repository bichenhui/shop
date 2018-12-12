<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{asset('org/assets/')}}/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{asset('org/assets/')}}/images/users/profile.png"  alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text">
                <a href="{{route ('admin.index')}}">
                    {{auth ('admin')->user ()->username}}
                </a>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="active">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="true"><i class="mdi mdi-gauge"></i><span class="hide-menu">商城系统 </span></a>
                    <ul aria-expanded="true" class="collapse">
                        <li><a href="{{route ('admin.category.index')}}">栏目管理</a></li>
                        <li><a href="{{route ('admin.good.index')}}">商品管理</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{route ('admin.logout')}}">退出</a>
    </div>
    <!-- End Bottom points-->
</aside>
