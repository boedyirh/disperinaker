@foreach ($layanan as $item)
    <?php
    $submenu = App\Models\MenuModel::subMenu($item->id);
    $jumlahSubMenu = $submenu->count();
    ?>

    @if ( $jumlahSubMenu >0)
        <?php $induk = request()->segment(1); ?>

        <li class="treeview {{ $induk==$item->url ? 'active menu-open':'' }}">
            <a href="#">
                <i class="{{ $item->icon }}"></i> <span>{{ $item->title }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{ $induk==$item->url ? 'display: block;':'display: none;' }}"   >
                @foreach ($submenu as $subitem)
                    <li class="{{ request()->is($subitem->url) ? 'active':'' }}"><a href="/{{ $subitem->url }}"><i class="{{ $subitem->icon }}"></i> <span>{{ $subitem->title }}</span></a></li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="{{ request()->is($item->url) ? 'active':'' }}"><a href="/{{ $item->url }}"><i class="{{ $item->icon }}"></i> <span>{{ $item->title }}</span></a></li>
    @endif
@endforeach




