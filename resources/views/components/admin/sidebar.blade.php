<div>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->site_name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $alias }}</a>
        </div>
        <ul class="sidebar-menu">
            @can('Dashboard')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                            class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @endcan

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-newspaper"></i>
                    <span>Blog</span></a>
                <ul class="dropdown-menu">
                    @can('Artikel Create')
                        <li><a href="{{ route('admin.post-categories.index') }}">Kategori</a></li>
                    @endcan
                    @can('Artikel Create')
                        <li><a href="{{ route('admin.post-tags.index') }}">Tag</a></li>
                    @endcan
                    @can('Artikel View')
                        <li><a href="{{ route('admin.posts.index') }}">Artikel</a></li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-tasks"></i>
                    <span>Project</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.project-categories.index') }}">Kategori</a></li>
                    <li><a href="{{ route('admin.project-tags.index') }}">Tag</a></li>
                    <li><a href="{{ route('admin.projects.index') }}">Project</a></li>
                </ul>
            </li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-newspaper"></i>
                    <span>Service</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.service-types.index') }}">Jenis</a></li>
                    <li><a href="{{ route('admin.payments.index') }}">Pembayaran</a></li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i>
                    <span>Management User</span></a>
                <ul class="dropdown-menu">
                    @can('User View')
                        <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                    @endcan
                    @can('Role View')
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                <span>Role</span></a>
                        </li>
                    @endcan
                    @can('Permission View')
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">
                                <span>Permission</span></a>
                        </li>
                    @endcan
                </ul>
            </li> --}}
            @can('Invoice View')
                <li>
                    <a class="nav-link" href="{{ route('admin.invoices.index') }}"><i class="fas fa-file-invoice"></i>
                        <span>Invoice</span></a>
                </li>
            @endcan
            <li>
                <a class="nav-link" href="{{ route('admin.utang-piutang.index') }}"><i
                        class="fas fa-hand-holding-usd"></i>
                    <span>Utang Piutang</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.visitor.index') }}"><i class="fas fa-user-friends"></i>
                    <span>Visitor</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i>
                    <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.report.income.index') }}">Pendapatan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i>
                    <span>Master</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.skills.index') }}">Skill</a></li>
                    <li><a href="{{ route('admin.tools.index') }}">Tool</a></li>
                    <li><a href="{{ route('admin.payments.index') }}">Jenis Pembayaran</a></li>
                    <li><a href="{{ route('admin.inboxes.index') }}">Pesan Masuk</a></li>
                    @can('Sosial Media View')
                        <li><a href="{{ route('admin.socmeds.index') }}">Sosial Media</a></li>
                    @endcan
                    @can('Filemanager View')
                        <li><a href="{{ url('admin/filemanager') }}" target="_blank">File Manager</a></li>
                    @endcan
                    @can('Setting View')
                        <li><a href="{{ route('admin.settings.index') }}" target="">Pengaturan Web</a></li>
                    @endcan
                    @can('Sitemap View')
                        <li><a href="{{ route('admin.sitemap.update') }}" target="">Perbaharui Sitemap</a></li>
                    @endcan
                    <li><a href="{{ route('admin.pengaturan-seo.index') }}" target="">Pengaturan SEO</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>
