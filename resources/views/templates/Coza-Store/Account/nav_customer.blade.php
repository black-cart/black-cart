<ul class="sidebar-link w-full">
    <li class="p-b-13">
        <a href="{{ bc_route('customer.index') }}" class="stext-102 cl2 hov-cl1 trans-04">
            {{ trans('front.my_account') }}
        </a>
    </li>

    <li class="p-b-13">
        <a href="{{ bc_route('customer.change_password') }}" class="stext-102 cl2 hov-cl1 trans-04">
            {{ trans('account.change_password') }}
        </a>
    </li>

    <li class="p-b-13">
        <a href="{{ bc_route('customer.address_list') }}" class="stext-102 cl2 hov-cl1 trans-04">
            {{ trans('account.address_list') }}
        </a>
    </li>

    <li class="p-b-13">
        <a href="{{ bc_route('customer.order_list') }}" class="stext-102 cl2 hov-cl1 trans-04">
            {{ trans('account.order_list') }}
        </a>
    </li>
</ul>