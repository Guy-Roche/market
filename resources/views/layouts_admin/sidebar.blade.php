            <div class="left-side-menu">

                <div class="h-100" data-simplebar>


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="{{ route('dashboard') }}" >
                                    <i class="mdi mdi-view-dashboard-outline"></i>

                                    <span> Dashboards </span>
                                </a>
                            </li>
                            @if (Auth::user()->can('pos.menu'))
                                <li>
                                    <a href="{{ route('pos') }}">
                                        <span class="badge bg-pink float-end">POS</span>
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> POS </span>
                                    </a>
                                </li>
                            @endif

                            <li class="menu-title mt-2">Apps</li>

                            @if (Auth::user()->can('employee.menu'))
                                <li>
                                    <a href="#employee" data-bs-toggle="collapse">
                                        <i class="mdi mdi-account-box-multiple"></i>
                                        <span> Employee Manage </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="employee">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('employee.all')) 
                                            <li>
                                                <a href="{{ route('admin.employees') }}">All Employees</a>
                                            </li>
                                            @endif
                                            @if (Auth::user()->can('employee.menu'))
                                            
                                            <li>
                                                <a href="{{ route('admin.addemployee') }}">Add Employee</a>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('customer.menu'))
                                <li>
                                    <a href="#customers" data-bs-toggle="collapse">
                                        <i class="mdi mdi-account-multiple-outline"></i>
                                        <span> Customer Manage </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="customers">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('customer.all'))
                                            <li>
                                                <a href="{{ route('admin.customers') }}">All Customers</a>
                                            </li>
                                            @endif
                                            @if (Auth::user()->can('customer.add'))
                                            <li>
                                                <a href="{{ route('admin.addcustomer') }}">Add Customer</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('supplier.menu'))
                                <li>
                                    <a href="#suppliers" data-bs-toggle="collapse">
                                        <i class="mdi mdi-email-multiple-outline"></i>
                                        <span> Suppliers Manage </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="suppliers">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('supplier.all'))
                                            <li>
                                                <a href="{{ route('admin.suppliers') }}">All Suppliers</a>
                                            </li>
                                            @endif
                                            @if (Auth::user()->can('supplier.add'))
                                            <li>
                                                <a href="{{ route('admin.addsupplier') }}">Add Supplier</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('salary.menu'))
                                <li>
                                    <a href="#salary" data-bs-toggle="collapse">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span> Employee Salary </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="salary">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('salary.add'))
                                                <li>
                                                    <a href="{{ route('admin.add_advance_salary') }}">Add Advance Salary</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('salary.all'))
                                            <li>
                                                <a href="{{ route('admin.advance_salaries') }}">All Advance Salary</a>
                                            </li>
                                            @endif
                                            @if (Auth::user()->can('salary.pay'))
                                            <li>
                                                <a href="{{ route('admin.pay_salary') }}">Pay Salary</a>
                                            </li>
                                            @endif

                                            <li>
                                                <a href="{{ route('admin.lastmonthsalary') }}">Last Month Salary</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('attendance.menu'))
                                <li>
                                    <a href="#Attendance" data-bs-toggle="collapse">
                                        <i class="fas fa-book"></i>
                                        <span> Employee Attendance </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="Attendance">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('attendances') }}">Employee Attendance List</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('category.menu'))
                                <li>
                                    <a href="#Categories" data-bs-toggle="collapse">
                                        <i class="fas fa-align-justify"></i>
                                        <span> Categories </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="Categories">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('categories') }}">Categories List</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('product.menu'))
                                <li>
                                    <a href="#products" data-bs-toggle="collapse">
                                        <i class="fab fa-product-hunt"></i>
                                        <span> Products </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="products">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('products') }}">Products List</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('product.add') }}">Add Product</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('product.import') }}">Import Products</a>
                                            </li>
                                        </ul>
                                    </div>

                                </li>
                            @endif

                            @if (Auth::user()->can('orders.menu'))
                                <li>
                                    <a href="#orders" data-bs-toggle="collapse">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <span> Orders </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="orders">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('order.pending') }}">Pending Orders</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('order.completed') }}">Complete Orders</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('pending.due') }}">Pending Due</a>
                                            </li>
                                        </ul>
                                    </div>

                                </li>
                            @endif

                            @if (Auth::user()->can('stock.menu'))
                                <li>
                                    <a href="#stocks" data-bs-toggle="collapse">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <span> Stock Manage </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="stocks">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('stock.manage') }}">Stock</a>
                                            </li>

                                        </ul>
                                    </div>

                                </li>
                            @endif

                            @if (Auth::user()->can('permission.menu'))
                                <li>
                                    <a href="#permission" data-bs-toggle="collapse">
                                        <i class="fas fa-users-cog"></i>
                                        <span> Rôles & Permissions </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="permission">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('permissions') }}">All Permissions</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('roles') }}">All Roles</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('rolespermissions') }}">Roles in Permission</a>
                                            </li>

                                        </ul>
                                    </div>

                                </li>
                            @endif

                            <li>
                                <a href="#admin" data-bs-toggle="collapse">
                                    <i class="fas fa-user-lock"></i>
                                    <span> Settings Admin User </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('adminusers') }}">All Admin</a>
                                        </li>

                                    </ul>
                                </div>

                            </li>

                            <li class="menu-title mt-2">Custom</li>

                            <li>
                                <a href="#expense" data-bs-toggle="collapse">
                                    <i class=" fas fa-wallet"></i>
                                    <span> Expense</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="expense">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('expense.add') }}">Add Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expense.today') }}">Today Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expense.monthly') }}">Monthly Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expense.yearly') }}">Yearly Expense</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#backup" data-bs-toggle="collapse">
                                    <i class="fas fa-database"></i>
                                    <span> Database Backup</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="backup">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('database.backup') }}">Backup List</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidebarExpages" data-bs-toggle="collapse">
                                    <i class="mdi mdi-text-box-multiple-outline"></i>
                                    <span> Extra Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="pages-starter.html">Starter</a>
                                        </li>
                                        <li>
                                            <a href="pages-timeline.html">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="pages-sitemap.html">Sitemap</a>
                                        </li>
                                        <li>
                                            <a href="pages-invoice.html">Invoice</a>
                                        </li>
                                        <li>
                                            <a href="pages-faqs.html">FAQs</a>
                                        </li>
                                        <li>
                                            <a href="pages-search-results.html">Search Results</a>
                                        </li>
                                        <li>
                                            <a href="pages-pricing.html">Pricing</a>
                                        </li>
                                        <li>
                                            <a href="pages-maintenance.html">Maintenance</a>
                                        </li>
                                        <li>
                                            <a href="pages-coming-soon.html">Coming Soon</a>
                                        </li>
                                        <li>
                                            <a href="pages-gallery.html">Gallery</a>
                                        </li>
                                        <li>
                                            <a href="pages-404.html">Error 404</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-two.html">Error 404 Two</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-alt.html">Error 404-alt</a>
                                        </li>
                                        <li>
                                            <a href="pages-500.html">Error 500</a>
                                        </li>
                                        <li>
                                            <a href="pages-500-two.html">Error 500 Two</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
