
<!-- <div class="splash-page" id="splash-page"></div> -->

<!--Start Navbar-->
<div class="headers ">
    <div class="header navbar" id="menu-cart-Header">
        <div class="container">
            <div class="site-title">
                <a href="#categories">
                    <h1><i class="fa fa-coffee"></i></h1>
                </a>
            </div>
            <div class="panel-control-right">

                <a onclick="reloadPage()" class="nav-control-right">
                    <i class="fa fa-refresh"></i>
                </a>

                <a class="nav-control-right" href="#cart" style="position: relative">
                    <i class="fa fa-shopping-cart" id="cart-icon"></i>
                    <span id="cart-badge" style="display: none;position: absolute;left: -4px;background: #ff0000;color: #fff;border-radius: 100%;height: 15px;vertical-align: text-bottom;width: 15px;padding: 1px 1px 0 0;top: -8px;font-size: 10px;">4</span>
                </a>

                <a data-activates="slide-out-right" class="sidenav-control-right">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="header navbar" id="menu-Header">
        <div class="container">
            <div class="site-title">
                <h1><i class="fa fa-coffee"></i></h1>
            </div>
            <div class="panel-control-right">
                <a data-activates="slide-out-right" class="sidenav-control-right">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!--End Navbar-->
<!-- panel control right -->
<div class="panel-control-right">
    <ul id="slide-out-right" class="side-nav collapsible" data-collapsible="accordion">
        <li>
            <div class="photos">
                <img id="userAvatar" src="img/avatar.png" alt="">
                <h3 id="userFullName">کاربر میهمان</h3>
            </div>
        </li>

        <li class="no-session-slide">
            <a href="#mobile" data-sidenav="slide-out-right">
                <i class="fa fa-key"></i>ورود
            </a>
        </li>

        <li class="has-session-slide">
            <a href="#categories"><i class="fa fa-cube"></i>دسته بندی ها</a>
        </li>

        <li class="has-session-slide">
            <a href="#cart"><i class="fa fa-shopping-cart"></i>سبد خرید</a>
        </li>


        <li class="has-session-slide">
            <a href="#orders"><i class="fa fa-list-alt"></i>لیست سفارشات من</a>
        </li>

        <li>
            <a href="#rules"><i class="fa fa-question-circle"></i>قوانین کافه</a>
        </li>

        <li class="has-session-slide">
            <a onclick="logout();"><i class="fa fa-times-circle-o"></i>خروج از اکانت</a>
        </li>

    </ul>
</div>
<!-- end panel control right -->