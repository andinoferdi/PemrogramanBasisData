     @extends('dashboard.layouts.main')
     @section('content')
         <div class="card rounded-0 bgi-no-repeat bgi-position-x-end bgi-size-cover"
             style="background-color: #663259;background-size: auto 100%; background-image: url(assets/media/misc/taieri.svg)">
             <div class="card-body container-xxl pt-10 pb-8">
                 <div class="d-flex align-items-center">
                     <h1 class="fw-bold me-3 text-white">Search</h1>
                 </div>
                 <div class="d-flex flex-column">
                     <div class="d-lg-flex align-lg-items-center">
                         <form action="{{ route('dashboard') }}" method="GET">
                             <div
                                 class="rounded d-flex flex-column flex-lg-row align-items-lg-center bg-white p-5 w-xxl-850px h-lg-60px me-lg-10 my-5">
                                 <div class="row flex-grow-1 mb-5 mb-lg-0">
                                     <div class="col-lg-4 d-flex align-items-center mb-3 mb-lg-0">
                                         <span class="svg-icon svg-icon-1 svg-icon-gray-400 me-1">
                                         </span>
                                         <input type="text" class="form-control form-control-flush flex-grow-1"
                                             name="search" autocomplete="off" value="{{ request('search') }}" placeholder="Your Search" />
                                     </div>
                                 </div>
                                 <div class="min-w-150px text-end">
                                     <button type="submit" class="btn btn-dark"
                                         id="kt_advanced_search_button_1">Search</button>
                                 </div>
                             </div>
                         </form>

                         @if (request('search'))
                             <div class="mt-5 p-3 rounded bg-light">
                                 <h3 class="text-dark mb-3">Search Results for '{{ request('search') }}':</h3>

                                 <ul class="list-group">
                                     @if ($barangResults->isNotEmpty())
                                         <li class="list-group-item"><strong>Barang:</strong></li>
                                         @foreach ($barangResults as $item)
                                             <li class="list-group-item">{{ $item->nama_barang }}</li>
                                         @endforeach
                                     @endif

                                     @if ($vendorResults->isNotEmpty())
                                         <li class="list-group-item"><strong>Vendor:</strong></li>
                                         @foreach ($vendorResults as $item)
                                             <li class="list-group-item">{{ $item->nama_vendor }}</li>
                                         @endforeach
                                     @endif

                                     @if ($roleResults->isNotEmpty())
                                         <li class="list-group-item"><strong>Role:</strong></li>
                                         @foreach ($roleResults as $item)
                                             <li class="list-group-item">{{ $item->nama_role }}</li>
                                         @endforeach
                                     @endif

                                     @if ($userResults->isNotEmpty())
                                         <li class="list-group-item"><strong>User:</strong></li>
                                         @foreach ($userResults as $item)
                                             <li class="list-group-item">{{ $item->username }}</li>
                                         @endforeach
                                     @endif

                                     @if ($satuanResults->isNotEmpty())
                                         <li class="list-group-item"><strong>Satuan:</strong></li>
                                         @foreach ($satuanResults as $item)
                                             <li class="list-group-item">{{ $item->nama_satuan }}</li>
                                         @endforeach
                                     @endif

                                     @if (
                                         $barangResults->isEmpty() &&
                                             $vendorResults->isEmpty() &&
                                             $roleResults->isEmpty() &&
                                             $userResults->isEmpty() &&
                                             $satuanResults->isEmpty())
                                         <li class="list-group-item text-dark">No results found.</li>
                                     @endif
                                 </ul>
                             </div>
                         @endif

                     </div>
                 </div>
             </div>
         </div>
         <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
             <div class="container-xxl" id="kt_content_container">
                 <div class="row g-5 g-xl-8">
                     <div class="col-xxl-4">
                         <div class="card card-xxl-stretch">
                             <div class="card-header border-0 py-5">
                                 <h3 class="card-title align-items-start flex-column">
                                     <span class="card-label fw-bolder fs-3 mb-1">Barang</span>
                                     <span class="text-muted fw-bold fs-7">Total Barang</span>
                                 </h3>
                                 <div class="card-toolbar">
                                 </div>
                             </div>
                             <div class="card-body d-flex flex-column">
                                 <div class="mixed-widget-5-chart card-rounded-top" id="trendsChart" style="height: 150px;">
                                 </div>
                                 <div class="mt-5">
                                     @foreach ($topBarangs as $barang)
                                         <div class="d-flex flex-stack mb-5">
                                             <div class="d-flex align-items-center me-2">
                                                 <div class="symbol symbol-50px me-3">
                                                     <div class="symbol-label bg-light">
                                                         <i class="fas fa-box-open fa-2x text-primary"></i>
                                                     </div>
                                                 </div>
                                                 <div>
                                                     <a href="#"
                                                         class="fs-6 text-gray-800 text-hover-primary fw-bolder">{{ $barang->nama_barang }}</a>
                                                     <div class="fs-7 text-muted fw-bold mt-1">Status: {{ $barang->status }}
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="badge badge-light fw-bold py-4 px-3">+82$</div>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="col-xxl-8">
                         <div class="card card-xxl-stretch mb-5 mb-xl-8">
                             <div class="card-header border-0 pt-5">
                                 <h3 class="card-title align-items-start flex-column">
                                     <span class="card-label fw-bolder fs-3 mb-1">User</span>
                                     <span class="text-muted mt-1 fw-bold fs-7">Ada {{ $users->count() }} User</span>
                                 </h3>
                             </div>
                             <div class="card-body py-3">
                                 <div class="table-responsive">
                                     <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                         <thead>
                                             <tr class="fw-bolder text-muted">
                                                 <th class="w-25px">
                                                     <div
                                                         class="form-check form-check-sm form-check-custom form-check-solid">
                                                         <input class="form-check-input" type="checkbox" value="1"
                                                             data-kt-check="true" data-kt-check-target=".widget-9-check" />
                                                     </div>
                                                 </th>
                                                 <th class="min-w-150px">Username</th>
                                                 <th class="min-w-140px">Role</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($users as $user)
                                                 <tr>
                                                     <td>
                                                         <div
                                                             class="form-check form-check-sm form-check-custom form-check-solid">
                                                             <input class="form-check-input widget-9-check" type="checkbox"
                                                                 value="{{ $user->iduser }}" />
                                                         </div>
                                                     </td>
                                                     <td>
                                                         <div class="d-flex align-items-center">
                                                             <div class="symbol symbol-45px me-5">
                                                                 <img src="{{ asset('assets/media/avatars/150-11.jpg') }}"
                                                                     alt="" />
                                                             </div>
                                                             <div class="d-flex justify-content-start flex-column">
                                                                 <a href="#"
                                                                     class="text-dark fw-bolder text-hover-primary fs-6">{{ $user->username }}</a>
                                                                 <span
                                                                     class="text-muted fw-bold text-muted d-block fs-7">{{ $user->role->nama_role }}</span>
                                                             </div>
                                                         </div>
                                                     </td>
                                                     <td>
                                                         <a href="#"
                                                             class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $user->role->nama_role }}</a>
                                                         <span class="text-muted fw-bold text-muted d-block fs-7">User
                                                             Role</span>
                                                     </td>
                                                     <td class="text-end">
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!--end::Col-->
                 </div>
                 <!--end::Row-->
                 <!--begin::Row-->
                 <div class="row gy-5 g-xl-8">
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::List Widget 5-->
                         <div class="card card-xl-stretch mb-xl-8">
                             <!--begin::Header-->
                             <div class="card-header align-items-center border-0 mt-4">
                                 <h3 class="card-title align-items-start flex-column">
                                     <span class="fw-bolder mb-2 text-dark">Activities</span>
                                     <span class="text-muted fw-bold fs-7">890,344 Sales</span>
                                 </h3>
                                 <div class="card-toolbar">
                                     <!--begin::Menu-->
                                     <button type="button"
                                         class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                         data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                         <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                         <span class="svg-icon svg-icon-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                 viewBox="0 0 24 24">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                     <rect x="5" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" />
                                                     <rect x="14" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="5" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="14" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                 </g>
                                             </svg>
                                         </span>
                                         <!--end::Svg Icon-->
                                     </button>
                                     <!--begin::Menu 1-->
                                     <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                         id="kt_menu_614852366e481">
                                         <!--begin::Header-->
                                         <div class="px-7 py-5">
                                             <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                         </div>
                                         <!--end::Header-->
                                         <!--begin::Menu separator-->
                                         <div class="separator border-gray-200"></div>
                                         <!--end::Menu separator-->
                                         <!--begin::Form-->
                                         <div class="px-7 py-5">
                                             <!--begin::Input group-->
                                             <div class="mb-10">
                                                 <!--begin::Label-->
                                                 <label class="form-label fw-bold">Status:</label>
                                                 <!--end::Label-->
                                                 <!--begin::Input-->
                                                 <div>
                                                     <select class="form-select form-select-solid" data-kt-select2="true"
                                                         data-placeholder="Select option"
                                                         data-dropdown-parent="#kt_menu_614852366e481"
                                                         data-allow-clear="true">
                                                         <option></option>
                                                         <option value="1">Approved</option>
                                                         <option value="2">Pending</option>
                                                         <option value="2">In Process</option>
                                                         <option value="2">Rejected</option>
                                                     </select>
                                                 </div>
                                                 <!--end::Input-->
                                             </div>
                                             <!--end::Input group-->
                                             <!--begin::Input group-->
                                             <div class="mb-10">
                                                 <!--begin::Label-->
                                                 <label class="form-label fw-bold">Member Type:</label>
                                                 <!--end::Label-->
                                                 <!--begin::Options-->
                                                 <div class="d-flex">
                                                     <!--begin::Options-->
                                                     <label
                                                         class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                         <input class="form-check-input" type="checkbox"
                                                             value="1" />
                                                         <span class="form-check-label">Author</span>
                                                     </label>
                                                     <!--end::Options-->
                                                     <!--begin::Options-->
                                                     <label
                                                         class="form-check form-check-sm form-check-custom form-check-solid">
                                                         <input class="form-check-input" type="checkbox" value="2"
                                                             checked="checked" />
                                                         <span class="form-check-label">Customer</span>
                                                     </label>
                                                     <!--end::Options-->
                                                 </div>
                                                 <!--end::Options-->
                                             </div>
                                             <!--end::Input group-->
                                             <!--begin::Input group-->
                                             <div class="mb-10">
                                                 <!--begin::Label-->
                                                 <label class="form-label fw-bold">Notifications:</label>
                                                 <!--end::Label-->
                                                 <!--begin::Switch-->
                                                 <div
                                                     class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                     <input class="form-check-input" type="checkbox" value=""
                                                         name="notifications" checked="checked" />
                                                     <label class="form-check-label">Enabled</label>
                                                 </div>
                                                 <!--end::Switch-->
                                             </div>
                                             <!--end::Input group-->
                                             <!--begin::Actions-->
                                             <div class="d-flex justify-content-end">
                                                 <button type="reset"
                                                     class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                     data-kt-menu-dismiss="true">Reset</button>
                                                 <button type="submit" class="btn btn-sm btn-primary"
                                                     data-kt-menu-dismiss="true">Apply</button>
                                             </div>
                                             <!--end::Actions-->
                                         </div>
                                         <!--end::Form-->
                                     </div>
                                     <!--end::Menu 1-->
                                     <!--end::Menu-->
                                 </div>
                             </div>
                             <!--end::Header-->
                             <!--begin::Body-->
                             <div class="card-body pt-5">
                                 <!--begin::Timeline-->
                                 <div class="timeline-label">
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">08:42</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-warning fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Text-->
                                         <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest.
                                             And keep structure</div>
                                         <!--end::Text-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-success fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Content-->
                                         <div class="timeline-content d-flex">
                                             <span class="fw-bolder text-gray-800 ps-3">AEOL meeting</span>
                                         </div>
                                         <!--end::Content-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-danger fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Desc-->
                                         <div class="timeline-content fw-bolder text-gray-800 ps-3">Make deposit
                                             <a href="#" class="text-primary">USD 700</a>. to ESL
                                         </div>
                                         <!--end::Desc-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-primary fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Text-->
                                         <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly
                                             driving and keep structure keep great</div>
                                         <!--end::Text-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-danger fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Desc-->
                                         <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                             <a href="#" class="text-primary">#XF-2356</a>.
                                         </div>
                                         <!--end::Desc-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-primary fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Text-->
                                         <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly
                                             driving and keep structure keep great</div>
                                         <!--end::Text-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-danger fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Desc-->
                                         <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                             <a href="#" class="text-primary">#XF-2356</a>.
                                         </div>
                                         <!--end::Desc-->
                                     </div>
                                     <!--end::Item-->
                                     <!--begin::Item-->
                                     <div class="timeline-item">
                                         <!--begin::Label-->
                                         <div class="timeline-label fw-bolder text-gray-800 fs-6">10:30</div>
                                         <!--end::Label-->
                                         <!--begin::Badge-->
                                         <div class="timeline-badge">
                                             <i class="fa fa-genderless text-success fs-1"></i>
                                         </div>
                                         <!--end::Badge-->
                                         <!--begin::Text-->
                                         <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app
                                             launch preparion meeting</div>
                                         <!--end::Text-->
                                     </div>
                                     <!--end::Item-->
                                 </div>
                                 <!--end::Timeline-->
                             </div>
                             <!--end: Card Body-->
                         </div>
                         <!--end: List Widget 5-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::Mixed Widget 12-->
                         <div class="card card-xl-stretch mb-5 mb-xl-8">
                             <!--begin::Header-->
                             <div class="card-header border-0 bg-primary py-5">
                                 <h3 class="card-title fw-bolder text-white">Sales Progress</h3>
                                 <div class="card-toolbar">
                                     <!--begin::Menu-->
                                     <button type="button"
                                         class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3"
                                         data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                         <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                         <span class="svg-icon svg-icon-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                 viewBox="0 0 24 24">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                     <rect x="5" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" />
                                                     <rect x="14" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="5" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="14" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                 </g>
                                             </svg>
                                         </span>
                                         <!--end::Svg Icon-->
                                     </button>
                                     <!--begin::Menu 3-->
                                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                         data-kt-menu="true">
                                         <!--begin::Heading-->
                                         <div class="menu-item px-3">
                                             <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                             </div>
                                         </div>
                                         <!--end::Heading-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link px-3">Create Invoice</a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                 <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                     title="Specify a target name for future usage and reference"></i></a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link px-3">Generate Bill</a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                             data-kt-menu-placement="right-end">
                                             <a href="#" class="menu-link px-3">
                                                 <span class="menu-title">Subscription</span>
                                                 <span class="menu-arrow"></span>
                                             </a>
                                             <!--begin::Menu sub-->
                                             <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Plans</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Billing</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Statements</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu separator-->
                                                 <div class="separator my-2"></div>
                                                 <!--end::Menu separator-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <div class="menu-content px-3">
                                                         <!--begin::Switch-->
                                                         <label
                                                             class="form-check form-switch form-check-custom form-check-solid">
                                                             <!--begin::Input-->
                                                             <input class="form-check-input w-30px h-20px" type="checkbox"
                                                                 value="1" checked="checked" name="notifications" />
                                                             <!--end::Input-->
                                                             <!--end::Label-->
                                                             <span class="form-check-label text-muted fs-6">Recuring</span>
                                                             <!--end::Label-->
                                                         </label>
                                                         <!--end::Switch-->
                                                     </div>
                                                 </div>
                                                 <!--end::Menu item-->
                                             </div>
                                             <!--end::Menu sub-->
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3 my-1">
                                             <a href="#" class="menu-link px-3">Settings</a>
                                         </div>
                                         <!--end::Menu item-->
                                     </div>
                                     <!--end::Menu 3-->
                                     <!--end::Menu-->
                                 </div>
                             </div>
                             <!--end::Header-->
                             <!--begin::Body-->
                             <div class="card-body p-0">
                                 <!--begin::Chart-->
                                 <div class="mixed-widget-12-chart card-rounded-bottom bg-primary" data-kt-color="primary"
                                     style="height: 225px"></div>
                                 <!--end::Chart-->
                                 <!--begin::Stats-->
                                 <div class="card-rounded bg-body mt-n10 position-relative card-px py-15">
                                     <!--begin::Row-->
                                     <div class="row g-0 mb-7">
                                         <!--begin::Col-->
                                         <div class="col mx-5">
                                             <div class="fs-6 text-gray-400">Avarage Sale</div>
                                             <div class="fs-2 fw-bolder text-gray-800">$650</div>
                                         </div>
                                         <!--end::Col-->
                                         <!--begin::Col-->
                                         <div class="col mx-5">
                                             <div class="fs-6 text-gray-400">Comissions</div>
                                             <div class="fs-2 fw-bolder text-gray-800">$29,500</div>
                                         </div>
                                         <!--end::Col-->
                                     </div>
                                     <!--end::Row-->
                                     <!--begin::Row-->
                                     <div class="row g-0">
                                         <!--begin::Col-->
                                         <div class="col mx-5">
                                             <div class="fs-6 text-gray-400">Revenue</div>
                                             <div class="fs-2 fw-bolder text-gray-800">$55,000</div>
                                         </div>
                                         <!--end::Col-->
                                         <!--begin::Col-->
                                         <div class="col mx-5">
                                             <div class="fs-6 text-gray-400">Expenses</div>
                                             <div class="fs-2 fw-bolder text-gray-800">$1,130,600</div>
                                         </div>
                                         <!--end::Col-->
                                     </div>
                                     <!--end::Row-->
                                 </div>
                                 <!--end::Stats-->
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::Mixed Widget 12-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::List Widget 4-->
                         <div class="card card-xl-stretch mb-5 mb-xl-8">
                             <!--begin::Header-->
                             <div class="card-header border-0 pt-5">
                                 <h3 class="card-title align-items-start flex-column">
                                     <span class="card-label fw-bolder text-dark">Trends</span>
                                     <span class="text-muted mt-1 fw-bold fs-7">Latest tech trends</span>
                                 </h3>
                                 <div class="card-toolbar">
                                     <!--begin::Menu-->
                                     <button type="button"
                                         class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                         data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                         <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                         <span class="svg-icon svg-icon-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                 viewBox="0 0 24 24">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                     <rect x="5" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" />
                                                     <rect x="14" y="5" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="5" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                     <rect x="14" y="14" width="5" height="5" rx="1"
                                                         fill="#000000" opacity="0.3" />
                                                 </g>
                                             </svg>
                                         </span>
                                         <!--end::Svg Icon-->
                                     </button>
                                     <!--begin::Menu 3-->
                                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                         data-kt-menu="true">
                                         <!--begin::Heading-->
                                         <div class="menu-item px-3">
                                             <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                             </div>
                                         </div>
                                         <!--end::Heading-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link px-3">Create Invoice</a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                 <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                     title="Specify a target name for future usage and reference"></i></a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <a href="#" class="menu-link px-3">Generate Bill</a>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                             data-kt-menu-placement="right-end">
                                             <a href="#" class="menu-link px-3">
                                                 <span class="menu-title">Subscription</span>
                                                 <span class="menu-arrow"></span>
                                             </a>
                                             <!--begin::Menu sub-->
                                             <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Plans</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Billing</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <a href="#" class="menu-link px-3">Statements</a>
                                                 </div>
                                                 <!--end::Menu item-->
                                                 <!--begin::Menu separator-->
                                                 <div class="separator my-2"></div>
                                                 <!--end::Menu separator-->
                                                 <!--begin::Menu item-->
                                                 <div class="menu-item px-3">
                                                     <div class="menu-content px-3">
                                                         <!--begin::Switch-->
                                                         <label
                                                             class="form-check form-switch form-check-custom form-check-solid">
                                                             <!--begin::Input-->
                                                             <input class="form-check-input w-30px h-20px" type="checkbox"
                                                                 value="1" checked="checked" name="notifications" />
                                                             <!--end::Input-->
                                                             <!--end::Label-->
                                                             <span class="form-check-label text-muted fs-6">Recuring</span>
                                                             <!--end::Label-->
                                                         </label>
                                                         <!--end::Switch-->
                                                     </div>
                                                 </div>
                                                 <!--end::Menu item-->
                                             </div>
                                             <!--end::Menu sub-->
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3 my-1">
                                             <a href="#" class="menu-link px-3">Settings</a>
                                         </div>
                                         <!--end::Menu item-->
                                     </div>
                                     <!--end::Menu 3-->
                                     <!--end::Menu-->
                                 </div>
                             </div>
                             <!--end::Header-->
                             <!--begin::Body-->
                             <div class="card-body pt-5">
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center mb-7">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/plurk.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Top
                                                 Authors</a>
                                             <span class="text-muted fw-bold d-block fs-7">Mark, Rowling, Esther</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+82$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center mb-7">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/telegram.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#"
                                                 class="text-gray-800 text-hover-primary fs-6 fw-bolder">Popular
                                                 Authors</a>
                                             <span class="text-muted fw-bold d-block fs-7">Randy, Steve, Mike</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+280$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center mb-7">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">New
                                                 Users</a>
                                             <span class="text-muted fw-bold d-block fs-7">John, Pat, Jimmy</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+4500$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center mb-7">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/bebo.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#"
                                                 class="text-gray-800 text-hover-primary fs-6 fw-bolder">Active
                                                 Customers</a>
                                             <span class="text-muted fw-bold d-block fs-7">Mark, Rowling, Esther</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+686$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center mb-7">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/kickstarter.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#"
                                                 class="text-gray-800 text-hover-primary fs-6 fw-bolder">Bestseller
                                                 Theme</a>
                                             <span class="text-muted fw-bold d-block fs-7">Disco, Retro, Sports</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+726$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                                 <!--begin::Item-->
                                 <div class="d-flex align-items-sm-center">
                                     <!--begin::Symbol-->
                                     <div class="symbol symbol-50px me-5">
                                         <span class="symbol-label">
                                             <img src="assets/media/svg/brand-logos/fox-hub.svg"
                                                 class="h-50 align-self-center" alt="" />
                                         </span>
                                     </div>
                                     <!--end::Symbol-->
                                     <!--begin::Section-->
                                     <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                         <div class="flex-grow-1 me-2">
                                             <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Fox
                                                 Broker App</a>
                                             <span class="text-muted fw-bold d-block fs-7">Finance, Corporate, Apps</span>
                                         </div>
                                         <span class="badge badge-light fw-bolder my-2">+145$</span>
                                     </div>
                                     <!--end::Section-->
                                 </div>
                                 <!--end::Item-->
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::List Widget 4-->
                     </div>
                     <!--end::Col-->
                 </div>
                 <!--end::Row-->
                 <!--begin::Row-->
                 <div class="row gy-0 gx-5 gx-xl-8">
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::Mixed Widget 9-->
                         <div class="card card-xl-stretch mb-5 mb-xl-0">
                             <!--begin::Body-->
                             <div class="card-body d-flex flex-column pb-10 pb-lg-15">
                                 <div class="flex-grow-1">
                                     <!--begin::Info-->
                                     <div class="d-flex align-items-center pe-2 mb-5">
                                         <span class="text-muted fw-bolder fs-5 flex-grow-1">7 hours ago</span>
                                         <div class="symbol symbol-50px">
                                             <span class="symbol-label bg-light">
                                                 <img src="assets/media/svg/brand-logos/plurk.svg"
                                                     class="h-50 align-self-center" alt="" />
                                             </span>
                                         </div>
                                     </div>
                                     <!--end::Info-->
                                     <!--begin::Link-->
                                     <a href="#" class="text-dark fw-bolder text-hover-primary fs-4">PitStop -
                                         Multiple Email Generator</a>
                                     <!--end::Link-->
                                     <!--begin::Desc-->
                                     <p class="py-3">Pitstop creates quick email campaigns.
                                         <br />We help to strengthen your brand.
                                     </p>
                                     <!--end::Desc-->
                                 </div>
                                 <!--begin::Team-->
                                 <div class="d-flex align-items-center">
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Ana Stone">
                                         <img src="assets/media/avatars/150-1.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Mark Larson">
                                         <img src="assets/media/avatars/150-4.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Sam Harris">
                                         <img src="assets/media/avatars/150-8.jpg" alt="" />
                                     </a>
                                 </div>
                                 <!--end::Team-->
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::Mixed Widget 9-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::Mixed Widget 9-->
                         <div class="card card-xl-stretch mb-5 mb-xl-0">
                             <!--begin::Body-->
                             <div class="card-body d-flex flex-column pb-10 pb-lg-15">
                                 <div class="flex-grow-1">
                                     <!--begin::Info-->
                                     <div class="d-flex align-items-center pe-2 mb-5">
                                         <span class="text-muted fw-bolder fs-5 flex-grow-1">10 days ago</span>
                                         <div class="symbol symbol-50px">
                                             <span class="symbol-label bg-light">
                                                 <img src="assets/media/svg/brand-logos/telegram.svg"
                                                     class="h-50 align-self-center" alt="" />
                                             </span>
                                         </div>
                                     </div>
                                     <!--end::Info-->
                                     <!--begin::Link-->
                                     <a href="#" class="text-dark fw-bolder text-hover-primary fs-4">ReactJS Admin
                                         Theme</a>
                                     <!--end::Link-->
                                     <!--begin::Desc-->
                                     <p class="py-3">Keenthemes uses the latest and greatest
                                         <br />frameworks for complete modernization.
                                     </p>
                                     <!--end::Desc-->
                                 </div>
                                 <!--begin::Team-->
                                 <div class="d-flex align-items-center">
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Ana Stone">
                                         <img src="assets/media/avatars/150-1.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Mark Larson">
                                         <img src="assets/media/avatars/150-4.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Sam Harris">
                                         <img src="assets/media/avatars/150-8.jpg" alt="" />
                                     </a>
                                 </div>
                                 <!--end::Team-->
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::Mixed Widget 9-->
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-xl-4">
                         <!--begin::Mixed Widget 9-->
                         <div class="card card-xl-stretch mb-5 mb-xl-0">
                             <!--begin::Body-->
                             <div class="card-body d-flex flex-column pb-10 pb-lg-15">
                                 <div class="flex-grow-1">
                                     <!--begin::Info-->
                                     <div class="d-flex align-items-center pe-2 mb-5">
                                         <span class="text-muted fw-bolder fs-5 flex-grow-1">2 weeks ago</span>
                                         <div class="symbol symbol-50px">
                                             <span class="symbol-label bg-light">
                                                 <img src="assets/media/svg/brand-logos/vimeo.svg"
                                                     class="h-50 align-self-center" alt="" />
                                             </span>
                                         </div>
                                     </div>
                                     <!--end::Info-->
                                     <!--begin::Link-->
                                     <a href="#" class="text-dark fw-bolder text-hover-primary fs-4">KT.com - High
                                         Quality Templates</a>
                                     <!--end::Link-->
                                     <!--begin::Desc-->
                                     <p class="py-3">Easy to use, incredibly flexible and secure
                                         <br />with in-depth documentation that outlines.
                                     </p>
                                     <!--end::Desc-->
                                 </div>
                                 <!--begin::Team-->
                                 <div class="d-flex align-items-center">
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Ana Stone">
                                         <img src="assets/media/avatars/150-1.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Mark Larson">
                                         <img src="assets/media/avatars/150-4.jpg" alt="" />
                                     </a>
                                     <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip"
                                         title="Sam Harris">
                                         <img src="assets/media/avatars/150-8.jpg" alt="" />
                                     </a>
                                 </div>
                                 <!--end::Team-->
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::Mixed Widget 9-->
                     </div>
                     <!--end::Col-->
                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Container-->
         </div>
     @endsection
     @if (isset($topBarangs))
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 var labels = @json($topBarangs->pluck('nama_barang'));
                 var data = {
                     labels: labels,
                     datasets: [{
                         label: 'Trends',
                         data: [1, 2, 3],
                         backgroundColor: 'rgba(255, 206, 86, 0.2)',
                         borderColor: 'rgba(255, 206, 86, 1)',
                         borderWidth: 1
                     }]
                 };

                 var ctx = document.getElementById('trendsChart').getContext('2d');
                 var myChart = new Chart(ctx, {
                     type: 'line',
                     data: data,
                     options: {
                         scales: {
                             y: {
                                 beginAtZero: true
                             }
                         }
                     }
                 });
             });
         </script>
     @endif
