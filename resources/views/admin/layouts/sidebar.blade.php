<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>

        <li class="menu-title">
          <span>Main</span>
        </li>

        <!-- Dashboard -->
        <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
            <i data-feather="book-open"></i>
            <span>
              {{ __('sidebar.dashboard') }}
            </span>
          </a>
        </li>
        <!-- /Dashboard -->

        <!-- CMS -->
        @if (auth()->user()->can('cms.blog:list') ||
            auth()->user()->can('cms.category:list'))
          <li class="submenu">
            <a class="" href="javascript:void(0)" aria-expanded="false">
              <i data-feather="file-text"></i>
              <span class="hide-menu">{{ __('sidebar.cms.title') }} </span>
              <span class="menu-arrow"></span>
            </a>

            <ul style="display: none;">
              @can('cms.category:list')
                <li>
                  <a href="{{ route('cms.categories.index') }}" title="{{ __('sidebar.cms.categories') }}"
                     class="sidebar-link {{ request()->is('admin/cms/categories*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.cms.categories') }}</span>
                  </a>
                </li>
              @endcan

              @can('cms.blog:list')
                <li>
                  <a href="{{ route('cms.blogs.index') }}" title="{{ __('sidebar.cms.blogs') }}"
                     class="sidebar-link {{ request()->is('admin/cms/blogs*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.cms.blogs') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif
        <!-- /CMS -->

        <!-- Horses -->
        @if (auth()->user()->can('listedHorses:list') ||
            auth()->user()->can('horseType-list'))
          <li class="submenu">
            <a class="" href="javascript:void(0)" aria-expanded="false">
              <i data-feather="file-text"></i>
              <span class="hide-menu">{{ __('sidebar.horses.menu_title') }} </span>
              <span class="menu-arrow"></span>
            </a>

            <ul style="display: none;">
              @can('horseType-list')
                <li>
                  <a href="{{ route('horses.types.index') }}" title="{{ __('sidebar.horses.types_title') }}"
                     class="sidebar-link {{ request()->is('admin/horses/types*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.horses.types') }}</span>
                  </a>
                </li>
              @endcan

              @can('horsePassport-list')
                <li>
                  <a href="{{ route('horses.passports.index') }}" title="{{ __('sidebar.horses.passports_title') }}"
                     class="sidebar-link {{ request()->is('admin/horses/passports*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.horses.passports') }}</span>
                  </a>
                </li>
              @endcan

              @can('horses-list')
                <li>
                  <a href="{{ route('horses.listed-horses.index') }}" title="{{ __('sidebar.horses.listed_horses') }}"
                     class="sidebar-link {{ request()->is('admin/horses/listed-horses*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.horses.listed_horses') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif
        <!-- /Horses -->

        <!-- Users -->
        @if (auth()->user()->can('user-list') ||
            auth()->user()->can('role-list') ||
            auth()->user()->can('permission-list') ||
            auth()->user()->can('user-activity'))
          <li class="submenu">
            <a class="" href="javascript:void(0)" aria-expanded="false">
              <i data-feather="users"></i>
              <span class="hide-menu">{{ __('sidebar.user') }} </span>
              <span class="menu-arrow"></span>
            </a>

            <ul style="display: none;">
              @can('user-list')
                <li>
                  <a href="{{ route('users.index') }}" title="{{ __('sidebar.user') }}"
                     class="sidebar-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.user') }}</span>
                  </a>
                </li>
              @endcan
              <li>
                <a href="{{ route('admin.customers.index') }}" title="{{ __('sidebar.customers') }}"
                   class="sidebar-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                  <span class="hide-menu">{{ __('sidebar.customers') }}</span>
                </a>
              </li>

              @can('role-list')
                <li>
                  <a href="{{ route('roles.index') }}" title="{{ __('sidebar.roles') }}"
                     class="sidebar-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.roles') }}</span>
                  </a>
                </li>
              @endcan

              @can('permission-list')
                <li>
                  <a href="{{ route('permissions.index') }}" title="{{ __('sidebar.permissions') }}"
                     class="sidebar-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.permission') }}</span>
                  </a>
                </li>
              @endcan

              @can('user-activity')
                <li>
                  <a href="/admin/user-activity" title="{{ __('sidebar.user-activity') }}"
                     class="sidebar-link {{ request()->is('admin/setting/useractivity*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.user-activity') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif
        <!-- /Users -->

        <!-- Settings -->
        @if (auth()->user()->can('file-manager') ||
            auth()->user()->can('currency-list') ||
            auth()->user()->can('websetting-edit') ||
            auth()->user()->can('log-view'))
          <li class="submenu">
            <a class="" href="javascript:void(0)" aria-expanded="false">
              <i data-feather="settings"></i>
              <span class="hide-menu">{{ __('sidebar.settings') }} </span>
              <span class="menu-arrow"></span>
            </a>

            <ul style="display: none;">
              @can('currency-list')
                <li>
                  <a href="{{ route('currencies.index') }}" title="{{ __('sidebar.currencies') }}"
                     class="sidebar-link {{ request()->is('admin/currencies*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.currency') }}</span>
                  </a>
                </li>
              @endcan

              @can('websetting-edit')
                <li>
                  <a href="{{ route('website-setting.edit') }}" title="{{ __('sidebar.website-setting') }}"
                     class="sidebar-link {{ request()->is('admin/setting/website-setting*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.website-setting') }}</span>
                  </a>
                </li>
              @endcan

              @can('file-manager')
                <li>
                  <a href="{{ route('filemanager.index') }}" title="{{ __('sidebar.file-manager') }}"
                     class="sidebar-link {{ request()->is('admin/setting/file-manager*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.file-manager') }}</span>
                  </a>
                </li>
              @endcan

              @can('log-view')
                <li>
                  <a href="/admin/log-reader" title="{{ __('sidebar.read-logs') }}"
                     class="sidebar-link {{ request()->is('admin/setting/log*') ? 'active' : '' }}">
                    <span class="hide-menu">{{ __('sidebar.read-logs') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif
        <!-- /Settings -->

      </ul>
    </div> <!-- /Sidebar-Menu -->
  </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
