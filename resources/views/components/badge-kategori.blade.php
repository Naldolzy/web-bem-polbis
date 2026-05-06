<span class="badge-kategori {{ $style ? 'badge-custom' : '' }}"
    @if($style) style="{{ $badgeStyle }}" @endif>
    @if($icon)<i data-lucide="{{ $icon }}" class="w-3 h-3 mr-1" style="display:inline-block;vertical-align:middle;"></i>@endif
    {{ $kategori }}
</span>
