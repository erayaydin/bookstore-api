@if ($increase > 0)
    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="Geçen aydan {{ $increase }}% fazla"> {{ $increase }}% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
@elseif ($increase === 0)
    <div class="report-box__indicator bg-theme-8 tooltip cursor-pointer" title="Geçen ay ile aynı" style="padding-left: 0.25rem;"><i style="width: 24px; height: 24px; text-align: center; display: inline-block; line-height: 27px;">-</i></div>
@else
    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="Geçen aydan {{ $increase }}% az"> {{ $increase }}% <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
@endif
