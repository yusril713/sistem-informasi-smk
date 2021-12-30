@if (count(Pengumuman::get()) > 0)
<div style="position: relative">
<div class="toast" data-autohide="false" style="position: fixed; top: 5rem; right: 0;">
    <div class="toast-header">
        <strong class="mr-auto text-primary">Pengumuman</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    @foreach (Pengumuman::get() as $item)
    <div class="toast-body" style="background-color: white !important">
        {{ $item->pengumuman }}
    </div>
    @endforeach
</div></div>

@endif
