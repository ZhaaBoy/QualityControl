@php
$menus = Spatie\Permission\Models\Permission::orderBy('position', 'ASC')
->where('level', 1)
->get();
@endphp

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <div class="d-flex align-items-center gap-3" >
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" style="margin-left:70%;" src="{{ asset('logo/logo.png') }}" class="h-50px app-sidebar-logo-default">
                <img alt="Logo" src="{{ asset('logo/logo.png') }}" class="h-25px app-sidebar-logo-minimize">
                {{-- <img alt="Logo" src="" class="h-80px app-sidebar-logo-default" /> --}}
            </a>

            <h1 id="text-logo" style="font-size: 30x" class="m-0 text-white app-sidebar-logo-default"></h1>
            <h1 id="text-logo" style="font-size: 30x" class="m-0 text-white app-sidebar-logo-minimize"></h1>
        </div>

        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                @foreach ($menus as $menu)
                    @php
                        $string = $menu->name;
                        $nama_menu = str_replace(' ', '', $string);
                    @endphp

                    @can($menu->name)
                        @if ($menu->level == 1)
                            @if ($menu->type == 'static')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs($menu->route.'*') ? 'active' : '' }}" href="{{ route($menu->route, ['first_group' => $menu->first_group]) }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <i class="{{ $menu->icon }} fs-5"></i>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ $menu->name }}</span>
                                    </a>
                                </div>
                            @else
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Str::startsWith(Route::currentRouteName(), $menu->route) ? 'here show' : '' }}">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <i class="{{ $menu->icon }} fs-5"></i>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ $menu->name }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    @php
                                        $submenus = Spatie\Permission\Models\Permission::orderBy('position', 'ASC')
                                            ->where('level', 2)
                                            ->where('group', $menu->group)
                                            ->get();

                                    @endphp

                                    <div class="menu-sub menu-sub-accordion">
                                        @foreach ($submenus as $item)
                                            @can($item->name)
                                                <div class="menu-item">
                                                    <a class="menu-link {{ request()->routeIs($item->route.'*') ? 'active' : '' }}" href="{{ route($item->route, ['first_group' => $item->first_group]) }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ $item->name }}</span>
                                                    </a>
                                                </div>
                                            @endcan
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endcan
                @endforeach
            </div>
        </div>
    </div>
</div>