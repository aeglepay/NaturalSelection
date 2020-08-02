<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ ucfirst($title) }}</span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>
        @isset($table)
        @if($table !== 'settings')
        <ul class="navbar-nav flex-row ml-auto mr-4">
            <li class="nav-item more-dropdown">
                <button type="button" class="btn bg-dark btn-block btn-sm" data-toggle="modal" data-target="#addModal">
                    Add New {{ ucfirst(str_singular(__($table))) }}
                </button>
            </li>
        </ul>
        @endif
        @endisset
    </header>
</div>
<!--  END NAVBAR  -->
